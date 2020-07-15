<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\News;

use Carbon\Carbon;

use Auth;

use DB;

use SoapClient;

use File;

use DateTime;

use Illuminate\Support\Facades\Mail;

use App\Mail\SendProductsEmailMail;

use RecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class GetNews extends Command
{
    protected $signature = 'news:list';
    protected $description = 'Get all new products';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $current_date = date("Ymd"); 
        $n_days_ago = new DateTime($current_date);
        $n_days_ago ->modify("-60 days");
        $n_days_ago = $n_days_ago ->format("Ymd");

        $this->SOAP_OPTS = array (
            'login'         => 'fpires',
            'password'      => 'c2babap',
            'style'         => SOAP_DOCUMENT,
            'trace'         => 1,
            'exceptions'    => true,
            'Content-Type'  => 'soap/xml',
            'use'           => SOAP_LITERAL,
            'compression'   => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'cache_wsdl'    => WSDL_CACHE_NONE,
             "location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_news/300/zws_get_news/zws_get_news'
        );
        
        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_news/300/zws_get_news/zws_get_news?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["CS_MARA"]      = 'CS_MARA';
        $params["CT_MARA"]      = 'CT_MARA';

        $params["DATE30"]       = $n_days_ago;
        $params["DATE_TODAY"]   = $current_date;

        $soap_client->ZANNFM_NOVIDADES($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_NOVIDADESResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_NOVIDADESResponse']['CT_MARA']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_NOVIDADESResponse']['CT_MARA']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANNFM_NOVIDADESResponse']['CT_MARA']['item'];
                    }else{
                        $tempData['error'] = 'No items available';
                    }
                }else{
                    $tempData['error'] = 'No Structure available';
                } 
            }else{
                $tempData['error'] = 'No Response available';
            }
        }else{
            $tempData['error'] = 'No Body available';
        }

        if (isset($tempData['all_items']) && !empty($tempData['all_items'])) 
        {
            //DELETE ALL IMAGES BEFORE INSERTING NEW ONES
            $dir = public_path().'/news_images';
            $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
            $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ( $ri as $file ) {
                $file->isDir() ?  rmdir($file) : unlink($file);
            }

            $rand = str_random(32);

            $no_image_items = [];

            $fetch_type = 'getNews';

            foreach ($tempData['all_items'] as $key => $value) 
            {
                //FILTER MATERIAL CODE
                $codigo = mb_substr($value['MATNR'], 0, 3);

                $value['preco']     = (!empty($value['KBETR']) ? $value['KBETR'] : '');

                $value['iva']       = (!empty($value['TAXM1']) ? $value['TAXM1'] : '');

                $value['origem']    = (!empty($value['LANDX50']) ? $value['LANDX50'] : '');

                if ($codigo === 'C01' || $codigo === 'C03' || $codigo === 'R01' || $codigo === 'R03' || $codigo === 'A01' || $codigo === 'A03') 
                {
                    $checkImage = $this->checkImage($value['MATNR'], $fetch_type);

                    //IF IMAGE EXISTS INSERT DATA
                    if ($checkImage['status'] === true) 
                    {
                        
                        $imagesDir = '/news_images/';

                        $type = substr($value['MATNR'],0,1);

                        switch ($type) 
                        {
                            case 'A':
                                $value['type']     = 'Ambiente';
                                $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];
                                break;
                            case 'R':
                                $value['type']     = 'Refrigerado';
                                $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];
                                break;
                            case 'C':
                                $value['type']     = 'Congelado';
                                $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];
                                break;
                        }

                        $timestamp = Carbon::now();

                        $updateOrCreate = News::updateOrCreate(
                        [
                            'codigo' => $value['MATNR']
                        ], 
                        [
                            'name'              => $value['MAKTX'],
                            'type'              => $value['type'],
                            'codigo'            => $value['MATNR'],
                            'url'               => $value['url'],
                            'preco'             => $value['preco'],
                            'iva'               => $value['iva'],
                            'origem'            => $value['origem'],
                            'update_time'       => $timestamp,
                            'update_version'    => $rand
                        ] );
                    }else{
                        $no_image_items[$key]['cod_sap']        = $value['MATNR'];
                        $no_image_items[$key]['nome_produto']   = $value['MAKTX'];
                        $no_image_items[$key]['created_at']     = $value['ERSDA'];
                    }
                }
            }

            //EMAIL DATA
            $mail_addresses     = ['joana.neves@gruponobrega.pt'];
            $mail_cc_addresses  = ['ezequiel.vieira@gruponobrega.pt']; 

            //SORT $no_image_items ARRAY BY SAP COD
            /*$image_items = usort($no_image_items, function($a, $b) {
                return $a['cod_sap'] <=> $b['cod_sap'];
            });*/

            $data = array(
                'data'          =>  $no_image_items,
                'fetch_type'    =>  'Novidades'
            );

            if (!empty($no_image_items)) 
            {
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->send(new SendProductsEmailMail($data));
            }else{
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->send(new SendProductsEmailMail($data));
            }

            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldNews = $this->deleteOldNews($rand);    
        }
    }
    public function checkImage($material_id, $fetch_type)
    {
        $dir    = '/media/utilizador/DADOS/FOTOS/FOTOS_NEW';

        $image = current(preg_grep('/'.preg_quote($material_id.'.jpg').'$/i', glob("$dir/*")));

        $result = [];

        if ($image) 
        {    
            $status = true;
            $ext    = pathinfo($image, PATHINFO_EXTENSION);
            //NOVIDADES
            if ($fetch_type === 'getNews') 
            {
                $img = file_get_contents($dir.'/'.$material_id.'.'.$ext);

                $im = imagecreatefromstring($img);

                $width = imagesx($im);

                $height = imagesy($im);

                $newwidth = '800';

                $newheight = '800';

                $quality = 60;

                $thumb = imagecreatetruecolor($newwidth, $newheight);

                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                $temp = imagejpeg($thumb, base_path('public/news_images/'.$material_id.'.'.$ext), $quality); //save image as jpg

                imagedestroy($thumb); 

                imagedestroy($im);
            }
            //CATALOGO
            if ($fetch_type === 'getFullNews') 
            {
                /*$copyImage = \File::copy($dir.'/'.$material_id.'.'.$ext, base_path('public/material_images/'.$material_id.'.'.$ext));
                
                /******/
                $img = file_get_contents($dir.'/'.$material_id.'.'.$ext);

                $im = imagecreatefromstring($img);

                $width = imagesx($im);

                $height = imagesy($im);

                $newwidth = '800';

                $newheight = '800';

                $quality = 60;

                $thumb = imagecreatetruecolor($newwidth, $newheight);

                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                $temp = imagejpeg($thumb, base_path('public/material_images/'.$material_id.'.'.$ext), $quality); //save image as jpg
                // Save the image
                //$temp = imagewebp($thumb, base_path('public/material_images/'.$material_id.'.webp'));

                imagedestroy($thumb); 

                imagedestroy($im);
            }
            $result = [
                    'status' => $status,
                    'extension' => $ext
                ];
        }else{
            $status = false;
            $result = [ 'status' => $status ];
        }

        return $result;
    }
    public function deleteOldNews($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = News::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $ids_to_delete = News::destroy($items_to_delete->toArray());
            
        }
    }
    // FUNCTION TO MUNG THE XML SO WE DO NOT HAVE TO DEAL WITH NAMESPACE
    public function mungXML($xml)
    {
        $obj = SimpleXML_Load_String($xml);
        if ($obj === FALSE) return $xml;

        // GET NAMESPACES, IF ANY
        $nss = $obj->getNamespaces(TRUE);
        if (empty($nss)) return $xml;

        // CHANGE ns: INTO ns_
        $nsm = array_keys($nss);
        foreach ($nsm as $key)
        {
            // A REGULAR EXPRESSION TO MUNG THE XML
            $rgx
            = '#'               // REGEX DELIMITER
            . '('               // GROUP PATTERN 1
            . '\<'              // LOCATE A LEFT WICKET
            . '/?'              // MAYBE FOLLOWED BY A SLASH
            . preg_quote($key)  // THE NAMESPACE
            . ')'               // END GROUP PATTERN
            . '('               // GROUP PATTERN 2
            . ':{1}'            // A COLON (EXACTLY ONE)
            . ')'               // END GROUP PATTERN
            . '#'               // REGEX DELIMITER
            ;
            // INSERT THE UNDERSCORE INTO THE TAG NAME
            $rep
            = '$1'          // BACKREFERENCE TO GROUP 1
            . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
            ;
            // PERFORM THE REPLACEMENT
            $xml =  preg_replace($rgx, $rep, $xml);
        }
        return $xml;
    }
}
