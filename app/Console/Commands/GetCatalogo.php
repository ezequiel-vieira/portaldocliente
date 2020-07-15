<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

use App\Mail\SendCatalogoMail;

use DateTime;

use SoapClient;

use Carbon\Carbon;

use App\Product;

use RecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class GetCatalogo extends Command
{
    protected $signature = 'catalogo:list';
    protected $description = 'Get All Products Available';

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
            'keep_alive'    => FALSE,
            'location'      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_mat/300/zws_get_mat/zws_get_mat'
        );
        
        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_mat/300/zws_get_mat/zws_get_mat?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["ZS_MARA"]      = 'ZS_MARA';
        $params["ZT_MARA"]      = 'ZT_MARA';

        $params["DATE30"]       = '20140101';
        $params["DATE_TODAY"]   = $current_date;

        $soap_client->ZANN_FM_PORTAL_WEB($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEBResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEBResponse']['ZT_MARA']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEBResponse']['ZT_MARA']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEBResponse']['ZT_MARA']['item'];
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

        /*foreach ($tempData['all_items'] as $key => $value) 
        {
            if ($value['MATNR'] === 'C010116009') {
                 dd($value);
            }
        }

        dd('end');*/

        if (isset($tempData['all_items']) && !empty($tempData['all_items'])) 
        {
            //DELETE ALL IMAGES BEFORE INSERTING NEW ONES
            $dir = public_path().'/material_images';
            $di = new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS);
            $ri = new RecursiveIteratorIterator($di, RecursiveIteratorIterator::CHILD_FIRST);
            
            foreach ( $ri as $file ) {
                $file->isDir() ?  rmdir($file) : unlink($file);
            }

            $rand = str_random(32);

            $no_image_items = [];

            $fetch_type = 'getFullNews';

            foreach ($tempData['all_items'] as $key => $value) 
            {
                //CHECK IF IMAGE EXIST
                $checkImage = $this->checkImage($value['MATNR'], $fetch_type);
                //IF IMAGE EXISTS INSERT DATA
                if ($checkImage['status'] === true) 
                {
                    //GET DETAILS////////////////////////////////
                    $mat_details = $this->getMatDetails($value['MATNR']);

                    if (!empty($mat_details)) 
                    {
                        $value['peso_un']    = (!empty($mat_details['UN']) ? $mat_details['UN'] : '');
                        $value['peso_cx']    = (!empty($mat_details['CX']) ? $mat_details['CX'] : '');
                        $value['peso_kg']    = (!empty($mat_details['KG']) ? $mat_details['KG'] : '');
                    }

                    if ($value['peso_un'] === '' && $value['peso_cx'] === '') {
                        # code...
                    }else{

                        $codigo = mb_substr($value['MATNR'], 0, 3);
                        $value['preco']     = (!empty($value['KBETR']) ? number_format($value['KBETR'], 2) : '');
                        $value['iva']       = (!empty($value['TAXM1']) ? $value['TAXM1'] : '');
                        $value['origem']    = (!empty($value['LANDX50']) ? $value['LANDX50'] : '');
                        $value['brand']    = (!empty($value['ATWRT']) ? $value['ATWRT'] : '');

                        $value['S_DESC']    = (!empty($value['S_DESC']) ? $value['S_DESC'] : '');

                        $value['preco']     = number_format(($value['preco'] * 1.05), 2);

                        switch ($value['iva']) { 
                            case '0':
                                $value['preco_iva'] = round(($value['preco'] * 1) , 2);
                                break;
                            case '1':
                                $value['preco_iva'] = round(($value['preco'] * 1.22) , 2);
                                break;
                            case '2':
                                $value['preco_iva'] = round(($value['preco'] * 1.12) , 2);
                                break;
                            case '3':
                                $value['preco_iva'] = round(($value['preco'] * 1.05) , 2);
                                break;               
                            default:
                                 $value['preco_iva'] = round(($value['preco'] * 1) , 2);
                                break;
                        }

                        //ADD PESO VENDA
                        if (!empty($value['peso_un'])) 
                        {
                            $value['peso_venda'] = strval($value['peso_un']);
                        }elseif (empty($value['peso_un']) && !empty($value['peso_cx'])) {
                            $value['peso_venda'] = strval($value['peso_cx']);
                        }else{
                            $value['peso_venda'] = '1.0';
                        }
                        
                        //ADD PRECO POR PESO UNIDADE
                        $value['preco_kg'] = '';

                        if ($value['MEINS'] === 'EA' || $value['MEINS'] === 'UN') 
                        {
                            $value['preco_kg'] = strval($value['preco']);
                        }else{
                            if ((!empty($value['peso_un']) && !empty($value['peso_cx'])) || (!empty($value['peso_un']) && empty($value['peso_cx']))) 
                            {
                                if (filter_var($value['peso_un'], FILTER_VALIDATE_FLOAT) && $value['peso_un'] > 1) {
                                    $value['preco_kg'] = strval($value['preco'] * $value['peso_un']);
                                }
                                else {
                                    $value['preco_kg'] = strval($value['preco'] * $value['peso_un']);
                                }
                            }elseif (empty($value['peso_un']) && !empty($value['peso_cx'])) {
                                $value['preco_kg'] = strval($value['preco'] * $value['peso_cx']);
                            }else{
                                $value['preco_kg'] = strval($value['preco']);
                            }
                        }

                        if (($value['MEINS'] <> 'UN' || $value['MEINS'] <> 'EA') && ( $value['peso_un'] === '' && $value['peso_cx'] > '10.0')) 
                        {
                            $value['catalogo_type'] = '0';
                        }else{
                            $value['catalogo_type'] = '1';
                        }
                        //GET DETAILS////////////////////////////////

                        //AMBIENTE 
                        if ($codigo === 'A01' || $codigo === 'A03') 
                        {
                            $imagesDir = '/material_images/';

                            $value['type']     = 'Ambiente';

                            //$checkImage['extension'] = 'webp';

                            $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];

                            $family = substr($value['MATNR'],0,5);

                            switch ($family) 
                            {
                                case 'A0101':
                                case 'A0301':
                                    $value['subtype']           = 'Bovinos'; 
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0102':
                                case 'A0302':
                                    $value['subtype']       = 'Suinos';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0103':
                                case 'A0303':
                                    $value['subtype']     = 'Aves';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0104':
                                case 'A0304':
                                    $value['subtype']     = 'Caprinos';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0105':
                                case 'A0305':
                                    $value['subtype']     = 'Mar';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0106':
                                case 'A0306':
                                    $value['subtype']     = 'Vegetais';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0107':
                                case 'A0307':
                                    $value['subtype']     = 'Lacticinios';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0108':
                                case 'A0308':
                                    $value['subtype']     = 'Padaria';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0109':
                                case 'A0309':
                                    $value['subtype']     = 'Charcutaria';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0110':
                                case 'A0310':
                                    $value['subtype']     = 'Pre-cozinhados';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0111':
                                case 'A0311':
                                    $value['subtype']     = 'Ovoprodutos';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0112':
                                case 'A0312':
                                    $value['subtype']     = 'Preparados de carne';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0171':
                                    $value['subtype']     = 'Gorduras Vegetais';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                case 'A0172':
                                    $value['subtype']     = 'Temperos';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                    break;
                                default:
                                    $value['subtype']     = 'Geral';
                                    $value['alias_subtype']     = str_slug($value['subtype'], '-');
                            }

                            $subfamily = substr($value['MATNR'],5,2);

                            /* SUB-FAMILIA*/
                            if ( $family === 'A0100' || $family === 'A0300') 
                            {
                                switch ($subfamily) 
                                {
                                    case '00':
                                        $value['subfamily']           = 'Geral'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ( $family === 'A0101' || $family === 'A0102' || $family === 'A0301' || $family === 'A0302') 
                            {
                                switch ($subfamily) 
                                {
                                    case '01':
                                        $value['subfamily']           = 'Carcaças'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '02':
                                        $value['subfamily']           = 'Cortes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '03':
                                        $value['subfamily']           = 'Miudezas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '04':
                                        $value['subfamily']           = 'Ossos';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '05':
                                        $value['subfamily']           = 'Peles';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '10':
                                        $value['subfamily']             = 'Filete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '11':
                                        $value['subfamily']             = 'Vazia';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '12':
                                        $value['subfamily']             = 'Acém';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '13':
                                        $value['subfamily']             = 'Alcatra';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '14':
                                        $value['subfamily']             = 'Rabadilha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '15':
                                        $value['subfamily']             = 'Picanha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '34':
                                        $value['subfamily']             = 'Caça';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0103' || $family === 'A0303') 
                            {
                                switch ($subfamily) 
                                {
                                    case '01':
                                        $value['subfamily']           = 'Carcaças'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '02':
                                        $value['subfamily']           = 'Cortes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '03':
                                        $value['subfamily']           = 'Miudezas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '04':
                                        $value['subfamily']           = 'Ossos';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '05':
                                        $value['subfamily']           = 'Peles';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '10':
                                        $value['subfamily']             = 'Filete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '11':
                                        $value['subfamily']             = 'Vazia';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '12':
                                        $value['subfamily']             = 'Acém';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '13':
                                        $value['subfamily']             = 'Alcatra';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '14':
                                        $value['subfamily']             = 'Rabadilha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '15':
                                        $value['subfamily']             = 'Picanha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '30':
                                        $value['subfamily']             = 'Frango';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '31':
                                        $value['subfamily']             = 'Peru';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '32':
                                        $value['subfamily']             = 'Pato';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '33':
                                        $value['subfamily']             = 'Galinhas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;  
                                    case '34':
                                        $value['subfamily']             = 'Caça';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0104' || $family === 'A0304') 
                            {
                                switch ($subfamily) 
                                {
                                    case '01':
                                        $value['subfamily']           = 'Carcaças'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '02':
                                        $value['subfamily']           = 'Cortes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '03':
                                        $value['subfamily']           = 'Miudezas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '04':
                                        $value['subfamily']           = 'Ossos';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '05':
                                        $value['subfamily']           = 'Peles';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '10':
                                        $value['subfamily']             = 'Filete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '11':
                                        $value['subfamily']             = 'Vazia';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '12':
                                        $value['subfamily']             = 'Acém';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '13':
                                        $value['subfamily']             = 'Alcatra';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '14':
                                        $value['subfamily']             = 'Rabadilha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '15':
                                        $value['subfamily']             = 'Picanha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '34':
                                        $value['subfamily']             = 'Caça';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0105' || $family === 'A0305') 
                            {
                                switch ($subfamily) 
                                {
                                    case '50':
                                        $value['subfamily']           = 'Peixe'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '51':
                                        $value['subfamily']           = 'Marisco';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0106' || $family === 'A0306') 
                            {
                                switch ($subfamily) 
                                {
                                    case '60':
                                        $value['subfamily']           = 'Legumes'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '61':
                                        $value['subfamily']           = 'Batatas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '62':
                                        $value['subfamily']           = 'Fruta';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '63':
                                        $value['subfamily']           = 'Legumes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0107' || $family === 'A0307') 
                            {
                                switch ($subfamily) 
                                {
                                    case '70':
                                        $value['subfamily']           = 'Queijos'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '71':
                                        $value['subfamily']           = 'Manteigas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '72':
                                        $value['subfamily']           = 'Iogurtes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0108' || $family === 'A0308') 
                            {
                                switch ($subfamily) 
                                {
                                    case '80':
                                        $value['subfamily']             = 'Padaria';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '81':
                                        $value['subfamily']             = 'Pastelaria';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0109' || $family === 'A0309') 
                            {
                                switch ($subfamily) 
                                {
                                    case '01':
                                        $value['subfamily']           = 'Carcaças'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '02':
                                        $value['subfamily']           = 'Cortes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '03':
                                        $value['subfamily']           = 'Miudezas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '04':
                                        $value['subfamily']           = 'Ossos';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '05':
                                        $value['subfamily']           = 'Peles';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '10':
                                        $value['subfamily']             = 'Filete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '11':
                                        $value['subfamily']             = 'Vazia';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '12':
                                        $value['subfamily']             = 'Acém';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '13':
                                        $value['subfamily']             = 'Alcatra';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '14':
                                        $value['subfamily']             = 'Rabadilha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '15':
                                        $value['subfamily']             = 'Picanha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '30':
                                        $value['subfamily']             = 'Frango';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '31':
                                        $value['subfamily']             = 'Peru';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '32':
                                        $value['subfamily']             = 'Pato';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '33':
                                        $value['subfamily']             = 'Galinhas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '34':
                                        $value['subfamily']             = 'Caça';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '50':
                                        $value['subfamily']             = 'Peixe';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '51':
                                        $value['subfamily']             = 'Marisco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0110' || $family === 'A0112' || $family === 'A0120' || $family === 'A0152' || $family === 'A0310' || $family === 'A0312' || $family === 'A0320' || $family === 'A0352') 
                            {
                                switch ($subfamily) 
                                {
                                    case '01':
                                        $value['subfamily']           = 'Carcaças'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '02':
                                        $value['subfamily']           = 'Cortes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '03':
                                        $value['subfamily']           = 'Miudezas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '04':
                                        $value['subfamily']           = 'Ossos';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '05':
                                        $value['subfamily']           = 'Peles';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '10':
                                        $value['subfamily']             = 'Filete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '11':
                                        $value['subfamily']             = 'Vazia';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '12':
                                        $value['subfamily']             = 'Acém';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '13':
                                        $value['subfamily']             = 'Alcatra';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '14':
                                        $value['subfamily']             = 'Rabadilha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '15':
                                        $value['subfamily']             = 'Picanha';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '30':
                                        $value['subfamily']             = 'Frango';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '31':
                                        $value['subfamily']             = 'Peru';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '32':
                                        $value['subfamily']             = 'Pato';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '33':
                                        $value['subfamily']             = 'Galinhas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '34':
                                        $value['subfamily']             = 'Caça';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '50':
                                        $value['subfamily']             = 'Peixe';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '51':
                                        $value['subfamily']             = 'Marisco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '60':
                                        $value['subfamily']             = 'Batatas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '61':
                                        $value['subfamily']             = 'Fruta';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '62':
                                        $value['subfamily']             = 'Marisco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '70':
                                        $value['subfamily']             = 'Queijos';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '71':
                                        $value['subfamily']             = 'Manteigas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '72':
                                        $value['subfamily']             = 'Iogurtes';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '80':
                                        $value['subfamily']             = 'Padaria';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '81':
                                        $value['subfamily']             = 'Pastalaria';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0111' || $family === 'A0311') 
                            {
                                switch ($subfamily) 
                                {
                                    case '70':
                                        $value['subfamily']           = 'Queijos'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '71':
                                        $value['subfamily']           = 'Manteigas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '72':
                                        $value['subfamily']           = 'Iogurtes';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '80':
                                        $value['subfamily']           = 'Queijos'; 
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '81':
                                        $value['subfamily']           = 'Manteigas';
                                        $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                        break;
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0150' || $family === 'A0151' || $family === 'A0160' || $family === 'A0350' || $family === 'A0351' || $family === 'A0360') 
                            {
                                switch ($subfamily) 
                                {
                                    case '91':
                                        $value['subfamily']             = 'ATM';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '92':
                                        $value['subfamily']             = 'Covete';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '93':
                                        $value['subfamily']             = 'Vácuo';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '94':
                                        $value['subfamily']             = 'Saco';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '95':
                                        $value['subfamily']             = 'Skin';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '96':
                                        $value['subfamily']             = 'Avulso';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0171' || $family === 'A0371') 
                            {
                                switch ($subfamily) 
                                {
                                    case '00':
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }
                            if ($family === 'A0172' || $family === 'A0371') 
                            {
                                switch ($subfamily) 
                                {
                                    case '00':
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    case '01':
                                        $value['subfamily']             = 'Margarinas';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                        break;
                                    default:
                                        $value['subfamily']             = 'Geral';
                                        $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                }
                            }

                            //DEFAULT VALUES
                            if (!isset($value['subfamily']) && !isset($value['alias_subfamily'])) 
                            {
                                $value['subfamily']         = 'Geral';
                                $value['alias_subfamily']   = str_slug($value['subfamily'], '-');
                            }

                            $timestamp = Carbon::now();

                            if ($value['MEINS'] === 'EA') {
                                $value['MEINS'] = 'UN';
                            }

                            $updateOrCreate = Product::updateOrCreate(
                            [
                                'number' => $value['MATNR']
                            ], 
                            [
                                'name'              => $value['MAKTX'],
                                'short_name'        => $value['S_DESC'],
                                'type'              => $value['type'],
                                'subtype'           => $value['subtype'],
                                'alias_subtype'     => $value['alias_subtype'],
                                'subfamily'         => $value['subfamily'],
                                'alias_subfamily'   => $value['alias_subfamily'],
                                'number'            => $value['MATNR'],
                                'url'               => $value['url'],
                                'preco'             => $value['preco'], 
                                'preco_kg'          => $value['preco_kg'], 
                                'preco_iva'         => $value['preco_iva'],
                                'iva'               => $value['iva'],
                                'origem'            => $value['origem'],
                                'brand'             => $value['brand'],
                                'peso_un'           => $value['peso_un'],    
                                'peso_cx'           => $value['peso_cx'],
                                'peso_kg'           => $value['peso_kg'],
                                'peso_venda'        => $value['peso_venda'],
                                'unit'              => $value['MEINS'],
                                'catalogo_type'     => $value['catalogo_type'],
                                'update_time'       => $timestamp,
                                'update_version'    => $rand
                            ] );
                        }

                        //CONGELADO
                        if ($codigo === 'C01' || $codigo === 'C03') 
                        {
                            /*if ($codigo === 'C03') {
                                echo $value['MATNR'];
                                echo '<br>';
                            }*/
                                $imagesDir = '/material_images/';

                                $value['type']     = 'Congelado';

                                //$checkImage['extension'] = 'webp';                        

                                $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];

                                $family = substr($value['MATNR'],0,5);

                                switch ($family) 
                                {
                                    case 'C0101':
                                    case 'C0301':
                                        $value['subtype']           = 'Bovinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0102':
                                    case 'C0302':
                                        $value['subtype']     = 'Suinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0103':
                                    case 'C0303':
                                        $value['subtype']     = 'Aves';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0104':
                                    case 'C0304':
                                        $value['subtype']     = 'Caprinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0105':
                                    case 'C0305':
                                        $value['subtype']     = 'Mar';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0106':
                                    case 'C0306':
                                        $value['subtype']     = 'Vegetais';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0107':
                                    case 'C0307':
                                        $value['subtype']     = 'Lacticinios';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0108':
                                    case 'C0308':
                                        $value['subtype']     = 'Padaria';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0109':
                                    case 'C0309':
                                        $value['subtype']     = 'Charcutaria';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0110':
                                    case 'C0310':
                                        $value['subtype']     = 'Pre-cozinhados';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0111':
                                    case 'C0311':
                                        $value['subtype']     = 'Ovoprodutos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0112':
                                    case 'C0312':
                                        $value['subtype']           = 'Preparados de carne';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0113':
                                        $value['subtype']           = 'Sushi';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0171':
                                        $value['subtype']     = 'Gorduras Vegetais';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'C0172':
                                        $value['subtype']     = 'Temperos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    default:
                                        $value['subtype']     = 'Geral';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                }

                                $subfamily = substr($value['MATNR'],5,2);

                                /* SUB-FAMILIA*/
                                /*C01*/
                                if ( $family === 'C0100') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Foie Gras';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '33':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ( $family === 'C0101') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Lingua'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Figado';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Dobrada';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Chambão';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Chã Dentro';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '06':
                                            $value['subfamily']             = 'Maminha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '08':
                                            $value['subfamily']             = 'Porcionados';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '09':
                                            $value['subfamily']             = 'Filete 3/4 LBS';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete 4/5 & +5 LBS';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia c/cordão' ;
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Vazia s/cordão';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '16':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '20':
                                            $value['subfamily']             = 'Vitela';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Exchilled';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Bovinos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0102') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Cachaço c/osso'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cachaço s/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Entremeada';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Joelheira';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Perna s/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '06':
                                            $value['subfamily']             = 'Pá Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '07':
                                            $value['subfamily']             = 'Patas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '08':
                                            $value['subfamily']             = 'Orelhas Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '09':
                                            $value['subfamily']             = 'Rabos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'lombo Suino s/osso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Entrecosto';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Porco Preto';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '16':
                                            $value['subfamily']             = 'Leitão';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '17':
                                            $value['subfamily']             = 'Leitão Cortes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0103') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango Inteiro';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Frango Peito';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Frango Pernas&Quartos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Frango Cotos&Coxa';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;  
                                        case '34':
                                            $value['subfamily']             = 'Frango Asas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '35':
                                            $value['subfamily']             = 'Frango Miudezas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '36':
                                            $value['subfamily']             = 'Peru Inteiro';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '37':
                                            $value['subfamily']             = 'Peru Cortes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '38':
                                            $value['subfamily']             = 'Pato & Galinhas Inteiro';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '39':
                                            $value['subfamily']             = 'Pato Cortes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0104') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Dianteiro & Pá'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Perna s/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Perna c/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Lombro c/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Lombo s/osso';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '06':
                                            $value['subfamily']             = 'Costoletas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '07':
                                            $value['subfamily']             = 'Joelheira';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '08':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
          
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Cabrito & Borrego Inteiro';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0105') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '50':
                                            $value['subfamily']           = 'Filetes&Lombo'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']           = 'Peixe Inteiro';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '52':
                                            $value['subfamily']           = 'Polvo';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '53':
                                            $value['subfamily']           = 'Lulas&Chocos&Pota';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '54':
                                            $value['subfamily']           = 'Bivalves';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;                                                                        
                                        case '55':
                                            $value['subfamily']           = 'Atum';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '56':
                                            $value['subfamily']           = 'Bacalhau e Paloco';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '57':
                                            $value['subfamily']           = 'Peixe Fumado';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '58':
                                            $value['subfamily']           = 'Mistura de Marisco';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '59':
                                            $value['subfamily']           = 'Lagosta & Similares';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']           = 'Gambão Argentino'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']           = 'Camarão Black Tiger'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']           = 'Camarão Moçambique'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '63':
                                            $value['subfamily']           = 'Camarão Nigéria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '64':
                                            $value['subfamily']           = 'Camarão Cozido'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '65':
                                            $value['subfamily']           = 'Camarão Tanzania'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '66':
                                            $value['subfamily']           = 'Camarão s/cabeça'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '67':
                                            $value['subfamily']           = 'Miolo Camarão'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '68':
                                            $value['subfamily']           = 'Carabinero&Cigala'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;                                    

                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0106') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '60':
                                            $value['subfamily']           = 'Legumes'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']           = 'Batatas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']           = 'Fruta';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '64':
                                            $value['subfamily']           = 'Batatas Especialidades';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0107') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0108') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '80':
                                            $value['subfamily']             = 'Padaria Miniatura';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Mini Folhados';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '82':
                                            $value['subfamily']             = 'Sem Glúten';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '83':
                                            $value['subfamily']             = 'Padaria Fatiar';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '84':
                                            $value['subfamily']             = 'Folhados';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '85':
                                            $value['subfamily']             = 'Donuts&Muffins';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '86':
                                            $value['subfamily']             = 'Pastelaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '87':
                                            $value['subfamily']             = 'Padaria Média';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '88':
                                            $value['subfamily']             = 'Pizzas&Focaccias';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;


                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0109') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas&Patos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça&Outros';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0110') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']             = 'Queijos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']             = 'Manteigas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']             = 'Iogurtes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']             = 'Padaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Pastalaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0111') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0112') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia' ;
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Legumes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Padaria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Pastelaria';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Bovinos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0113') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0120') 
                                {
                                }
                                /*********C03***********/
                                if ( $family === 'C0300') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ( $family === 'C0301') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia' ;
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Bovinos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0302') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0303') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0304') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Suino';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0305') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']           = 'Peixe'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']           = 'Marisco';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0306') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case 'Geral':
                                            $value['subfamily']           = 'Legumes'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']           = 'Legumes'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']           = 'Batatas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']           = 'Fruta';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0307') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0308') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']             = 'Padaria Miniatura';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Mini Folhados';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0309') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas&Patos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça&Outros';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0310') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;

                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '60':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '70':
                                            $value['subfamily']             = 'Queijos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']             = 'Manteigas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']             = 'Iogurtes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;

                                        case '80':
                                            $value['subfamily']             = 'Padaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Pastalaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0311') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Padaria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Pastelaria';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0312') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia' ;
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Legumes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Padaria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Pastelaria';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0320') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']           = 'Filete';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']           = 'Vazia' ;
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']           = 'Acém';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']           = 'Alcatra';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Legumes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Padaria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Pastelaria';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0350' || $family === 'C0351' || $family === 'C0360') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0352') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']           = 'Filete';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']           = 'Vazia' ;
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']           = 'Acém';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']           = 'Alcatra';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Legumes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Padaria'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Pastelaria';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'C0380') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']           = 'Geral'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }

                                //DEFAULT VALUES
                                if (!isset($value['subfamily']) && !isset($value['alias_subfamily'])) 
                                {
                                    $value['subfamily']         = 'Geral';
                                    $value['alias_subfamily']   = str_slug($value['subfamily'], '-');
                                }

                                $timestamp = Carbon::now();

                                if ($value['MEINS'] === 'EA') {
                                    $value['MEINS'] = 'UN';
                                }

                                $updateOrCreate = Product::updateOrCreate(
                                [
                                    'number' => $value['MATNR']
                                ], 
                                [
                                    'name'              => $value['MAKTX'],
                                    'short_name'        => $value['S_DESC'],
                                    'type'              => $value['type'],
                                    'subtype'           => $value['subtype'],
                                    'alias_subtype'     => $value['alias_subtype'],
                                    'subfamily'         => $value['subfamily'],
                                    'alias_subfamily'   => $value['alias_subfamily'],
                                    'number'            => $value['MATNR'],
                                    'url'               => $value['url'],
                                    'preco'             => $value['preco'],
                                    'preco_kg'          => $value['preco_kg'],
                                    'preco_iva'         => $value['preco_iva'],
                                    'iva'               => $value['iva'],
                                    'origem'            => $value['origem'],
                                    'brand'             => $value['brand'],
                                    'peso_un'           => $value['peso_un'],    
                                    'peso_cx'           => $value['peso_cx'],
                                    'peso_kg'           => $value['peso_kg'],
                                    'peso_venda'        => $value['peso_venda'],
                                    'unit'              => $value['MEINS'],
                                    'catalogo_type'     => $value['catalogo_type'],
                                    'update_time'       => $timestamp,
                                    'update_version'    => $rand
                                ] );   
                        }

                        //REFRIGERADO
                        if ($codigo === 'R01' || $codigo === 'R03') 
                        {
                            /*if ($codigo === 'R03') {
                                echo $value['MATNR'];
                                echo '<br>';
                            }*/
                                $imagesDir = '/material_images/';

                                $value['type']     = 'Refrigerado';

                                //$checkImage['extension'] = 'webp';

                                $value['url']      = $imagesDir.$value['MATNR'].'.'.$checkImage['extension'];

                                $family = substr($value['MATNR'],0,5);

                                switch ($family) 
                                {
                                    case 'R0101':
                                    case 'R0301':
                                        $value['subtype']     = 'Bovinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0102':
                                    case 'R0302':
                                        $value['subtype']     = 'Suinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0103':
                                    case 'R0303':
                                        $value['subtype']     = 'Aves';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0104':
                                    case 'R0304':
                                        $value['subtype']     = 'Caprinos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0105':
                                    case 'R0305':
                                        $value['subtype']     = 'Mar';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0106':
                                    case 'R0306':
                                        $value['subtype']     = 'Vegetais';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0107':
                                    case 'R0307':
                                        $value['subtype']     = 'Lacticinios';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0108':
                                    case 'R0308':
                                        $value['subtype']     = 'Padaria';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0109':
                                    case 'R0309':
                                        $value['subtype']     = 'Charcutaria';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0110':
                                    case 'R0310':
                                        $value['subtype']     = 'Pre-cozinhados';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0111':
                                    case 'R0311':
                                        $value['subtype']     = 'Ovoprodutos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0112':
                                    case 'R0312':
                                        $value['subtype']     = 'Preparados de carne';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0171':
                                        $value['subtype']     = 'Gorduras Vegetais';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    case 'R0172':
                                        $value['subtype']     = 'Temperos';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                        break;
                                    default:
                                        $value['subtype']     = 'Geral';
                                        $value['alias_subtype']     = str_slug($value['subtype'], '-');
                                }

                                $subfamily = substr($value['MATNR'],5,2);

                                /* SUB-FAMILIA*/
                                if ( $family === 'R0101' || $family === 'R0102' || $family === 'R0301' || $family === 'R0302') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0103' || $family === 'R0303') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;  
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0104' || $family === 'R0304') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0105' || $family === 'R0305') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '50':
                                            $value['subfamily']           = 'Peixe'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']           = 'Marisco';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0106' || $family === 'R0306') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '60':
                                            $value['subfamily']           = 'Legumes'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']           = 'Batatas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']           = 'Fruta';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '63':
                                            $value['subfamily']           = 'Legumes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0107' || $family === 'R0307') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0108' || $family === 'R0308') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '80':
                                            $value['subfamily']             = 'Padaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Pastelaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'A0109' || $family === 'A0309') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0110' || $family === 'R0112' || $family === 'R0120' || $family === 'R0152' || $family === 'R0310' || $family === 'R0312' || $family === 'R0320' || $family === 'R0352') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '01':
                                            $value['subfamily']           = 'Carcaças'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '02':
                                            $value['subfamily']           = 'Cortes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '03':
                                            $value['subfamily']           = 'Miudezas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '04':
                                            $value['subfamily']           = 'Ossos';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '05':
                                            $value['subfamily']           = 'Peles';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '10':
                                            $value['subfamily']             = 'Filete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '11':
                                            $value['subfamily']             = 'Vazia';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '12':
                                            $value['subfamily']             = 'Acém';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '13':
                                            $value['subfamily']             = 'Alcatra';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '14':
                                            $value['subfamily']             = 'Rabadilha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '15':
                                            $value['subfamily']             = 'Picanha';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '30':
                                            $value['subfamily']             = 'Frango';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '31':
                                            $value['subfamily']             = 'Peru';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '32':
                                            $value['subfamily']             = 'Pato';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '33':
                                            $value['subfamily']             = 'Galinhas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '34':
                                            $value['subfamily']             = 'Caça';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '50':
                                            $value['subfamily']             = 'Peixe';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '51':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '60':
                                            $value['subfamily']             = 'Batatas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '61':
                                            $value['subfamily']             = 'Fruta';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '62':
                                            $value['subfamily']             = 'Marisco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '70':
                                            $value['subfamily']             = 'Queijos';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']             = 'Manteigas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']             = 'Iogurtes';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']             = 'Padaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']             = 'Pastalaria';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0111' || $family === 'R0311') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '70':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '71':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '72':
                                            $value['subfamily']           = 'Iogurtes';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '80':
                                            $value['subfamily']           = 'Queijos'; 
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '81':
                                            $value['subfamily']           = 'Manteigas';
                                            $value['alias_subfamily']     = str_slug($value['subfamily'], '-');
                                            break;
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0150' || $family === 'R0151' || $family === 'R0160' || $family === 'R0350' || $family === 'R0351' || $family === 'R0360') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '91':
                                            $value['subfamily']             = 'ATM';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '92':
                                            $value['subfamily']             = 'Covete';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '93':
                                            $value['subfamily']             = 'Vácuo';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '94':
                                            $value['subfamily']             = 'Saco';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '95':
                                            $value['subfamily']             = 'Skin';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '96':
                                            $value['subfamily']             = 'Avulso';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0171' || $family === 'R0371') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }
                                if ($family === 'R0172' || $family === 'R0371') 
                                {
                                    switch ($subfamily) 
                                    {
                                        case '00':
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        case '01':
                                            $value['subfamily']             = 'Margarinas';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                            break;
                                        default:
                                            $value['subfamily']             = 'Geral';
                                            $value['alias_subfamily']       = str_slug($value['subfamily'], '-');
                                    }
                                }

                                //DEFAULT VALUES
                                if (!isset($value['subfamily']) && !isset($value['alias_subfamily'])) 
                                {
                                    $value['subfamily']         = 'Geral';
                                    $value['alias_subfamily']   = str_slug($value['subfamily'], '-');
                                }

                                $timestamp = Carbon::now();

                                if ($value['MEINS'] === 'EA') {
                                    $value['MEINS'] = 'UN';
                                }

                                $updateOrCreate = Product::updateOrCreate(
                                [
                                    'number' => $value['MATNR']
                                ], 
                                [
                                    'name'              => $value['MAKTX'],
                                    'short_name'        => $value['S_DESC'],
                                    'type'              => $value['type'],
                                    'subtype'           => $value['subtype'],
                                    'alias_subtype'     => $value['alias_subtype'],
                                    'subfamily'         => $value['subfamily'],
                                    'alias_subfamily'   => $value['alias_subfamily'],
                                    'number'            => $value['MATNR'],
                                    'url'               => $value['url'],
                                    'preco'             => $value['preco'],
                                    'preco_kg'          => $value['preco_kg'],
                                    'preco_iva'         => $value['preco_iva'],
                                    'iva'               => $value['iva'],
                                    'origem'            => $value['origem'],
                                    'brand'             => $value['brand'],
                                    'peso_un'           => $value['peso_un'],    
                                    'peso_cx'           => $value['peso_cx'],
                                    'peso_kg'           => $value['peso_kg'],
                                    'peso_venda'        => $value['peso_venda'],
                                    'unit'              => $value['MEINS'],
                                    'catalogo_type'     => $value['catalogo_type'],                            
                                    'update_time'       => $timestamp,
                                    'update_version'    => $rand
                                ] );   
                        }
                    }

                }else{
                    $no_image_items[$key]['cod_sap']        = $value['MATNR'];
                    $no_image_items[$key]['nome_produto']   = $value['MAKTX'];
                }
            } 

            /*$updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026001"
                ], 
                [
                    'name'              => "1.0 CABAZ MARISCO",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026001",
                    'url'               => "/temp/cabaz/Cabaz_Marisco.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026002"
                ], 
                [
                    'name'              => "2.0 CABAZ PEIXE",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026002",
                    'url'               => "/temp/cabaz/Cabaz_Peixe1.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026003"
                ], 
                [
                    'name'              => "3.0 CABAZ PEIXE",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026003",
                    'url'               => "/temp/cabaz/Cabaz_Peixe2.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026004"
                ], 
                [
                    'name'              => "4.0 CABAZ CARNE CONGELADA ",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026004",
                    'url'               => "/temp/cabaz/Cabaz_Carne_Congelada.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "R038026000"
                ], 
                [
                    'name'              => "5.0 CABAZ CARNE REFRIGERADA",
                    'type'              => "Refrigerado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "R038026000",
                    'url'               => "/temp/cabaz/Cabaz_Refrigerada_1.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "R038026001"
                ], 
                [
                    'name'              => "6.0 CABAZ CARNE REFRIGERADA",
                    'type'              => "Refrigerado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "R038026001",
                    'url'               => "/temp/cabaz/Cabaz_Refrigerada_2.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026005"
                ], 
                [
                    'name'              => "7.0 CABAZ VEGETAIS",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026005",
                    'url'               => "/temp/cabaz/Cabaz_Vegetais.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "R038026002"
                ], 
                [
                    'name'              => "8.0 CABAZ CHARCUTARIA E LACTICINIOS",
                    'type'              => "Refrigerado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "R038026002",
                    'url'               => "/temp/cabaz/Cabaz_Charcutaria.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026006"
                ], 
                [
                    'name'              => "9.0 CABAZ PRECOZINHADOS E OVO INTEIRO",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026006",
                    'url'               => "/temp/cabaz/Cabaz_Precozinhados.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026007"
                ], 
                [
                    'name'              => "10.0 CABAZ PANADINHOS",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026007",
                    'url'               => "/temp/cabaz/Cabaz_Panadinhos.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026008"
                ], 
                [
                    'name'              => "11.0 CABAZ PIZZAS",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026008",
                    'url'               => "/temp/cabaz/Cabaz_Pizzas.jpg",
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026009"
                ], 
                [
                    'name'              => "12.0 CABAZ VEGETARIANO",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026009",
                    'url'               => "/temp/cabaz/Cabaz_Vegetariano1.jpg", 
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );

            $updateOrCreate = Product::updateOrCreate(
                [
                    'number' => "C038026010"
                ], 
                [
                    'name'              => "13.0 CABAZ PADARIA",
                    'type'              => "Congelado",
                    'subtype'           => "geral",
                    'alias_subtype'     => "geral",
                    'subfamily'         => "Geral",
                    'alias_subfamily'   => "geral",
                    'unit'              => "UN",
                    'peso_un'           => '',    
                    'peso_cx'           => '',
                    'peso_kg'           => '',
                    'number'            => "C038026010",
                    'url'               => "/temp/cabaz/Cabaz_Padaria1.jpg", 
                    'update_time'       => $timestamp,
                    'update_version'    => $rand
                ] );*/

            //EMAIL DATA
            $mail_addresses     = ['joana.neves@gruponobrega.pt'];
            $mail_cc_addresses  = ['ezequiel.vieira@gruponobrega.pt']; 

            $image_items = usort($no_image_items, function($a, $b) {
                return $a['cod_sap'] <=> $b['cod_sap'];
            });

            $data = array(
                'data'          =>  $no_image_items,
                'fetch_type'    =>  'Catálogo'
            );

            /*if (!empty($no_image_items)) 
            {
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->send(new SendCatalogoMail($data));
            }else{
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->send(new SendCatalogoMail($data));
            }*/
            
            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldProducts = $this->deleteOldProducts($rand);    
        }
    }
    /* GET MATERIAL DETAILS */
    public function getMatDetails($material_id)
    {
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
            'keep_alive'    => FALSE,
            'location'      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_mat_detais/300/zws_get_mat_details/zws_get_mat_details'
        );

        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_mat_detais/300/zws_get_mat_details/zws_get_mat_details?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["ZZSS_MARM"]      = 'ZZSS_MARM';
        $params["ZZTT_MARM"]      = 'ZZTT_MARM';

        $params["ZMATNR"]       = $material_id;

        $soap_client->ZANN_FM_PORTAL_WEB_DETAILS($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        $units= [
            'UN' => NULL,
            'KG' => NULL,
            'CX' => NULL,
        ];

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEB_DETAILSResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEB_DETAILSResponse']['ZZTT_MARM']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEB_DETAILSResponse']['ZZTT_MARM']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_FM_PORTAL_WEB_DETAILSResponse']['ZZTT_MARM']['item'];
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
            if ( isset($tempData['all_items'][0]) && is_array($tempData['all_items'][0])) 
            {
                foreach ($tempData['all_items'] as $key => $value) 
                {
                    if (is_array($value)) {
                        switch ($value["MEINH"]) {
                            case 'EA':
                                $units['UN'] = $value["BRGEW"];
                                break;
                            case 'KG':
                                $units['KG'] = $value["BRGEW"];
                                break;
                            case 'KI':
                                $units['CX'] = $value["BRGEW"];
                                break;
                        }
                    }
                }
            }else{
                switch ($tempData['all_items']["MEINH"]) {
                    case 'EA':
                        $units['UN'] = $tempData['all_items']["BRGEW"];
                        break;
                    case 'KG':
                        $units['KG'] = $tempData['all_items']["BRGEW"];
                        break;
                    case 'KI':
                        $units['CX'] = $tempData['all_items']["BRGEW"];
                        break;
                }
            }
        }

        return $units;
    }
    /* CHECK MATERIAL IMAGE */
    public function checkImage($material_id, $fetch_type)
    {
        $dir    = '/media/utilizador/DADOS/FOTOS';

        $image = current(preg_grep('/'.preg_quote($material_id.'.jpg').'$/i', glob("$dir/*")));

        $result = [];

        if ($image) 
        {    
            $status = true;
            $ext    = pathinfo($image, PATHINFO_EXTENSION);
            //NOVIDADES
            if ($fetch_type === 'getNews') 
            {
                //$copyImage = \File::copy($dir.'/'.$material_id.'.'.$ext, base_path('public/news_images/'.$material_id.'.'.$ext));

                $img = file_get_contents($dir.'/'.$material_id.'.'.$ext);

                $im = imagecreatefromstring($img);

                $width = imagesx($im);

                $height = imagesy($im);

                $newwidth = '300';

                $newheight = '300';

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

                $newwidth = '300';

                $newheight = '300';

                $quality = 60;

                $thumb = imagecreatetruecolor($newwidth, $newheight);

                imagecopyresized($thumb, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                $temp = imagejpeg($thumb, base_path('public/material_images/'.$material_id.'.'.$ext), $quality); //save image as jpg

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
    public function deleteOldProducts($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = Product::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $images_to_delete = Product::where('update_version', '!=', $update_version)
                                ->get(['number']);

            $ids_to_delete = Product::destroy($items_to_delete->toArray());
            
        }
    }
    //////////////
    //XML BUILDER
    //////////////
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
