<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use App\User;

use App\Document;

use App\Material;

use DB;

use SoapClient;

use DateTime;

class GetUserRefundDocs extends Command
{
    protected $signature = 'users:refund_docs';
    protected $description = 'Get All Docs Available to Refund from all users';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $usersList = User::all();

        $vbeln_list = [];

        $timestamp = Carbon::now();

        $rand = str_random(32);

        if (isset($usersList) && !empty($usersList)) 
        {
            foreach ($usersList as $key => $value) 
            {
                $clientDocs = $this->getClientDocs($value['id_sap']);

                if (isset($clientDocs) && !empty($clientDocs)) 
                {
                    foreach ($clientDocs as $k => $val) 
                    {
                        $Document                   = new Document;
                        $Document->users_id         = $value['id'];
                        $Document->doc_number       = $val['vbeln'];
                        $Document->doc_date         = $val['audat'];
                        $Document->doc_value        = $val['netwr'];
                        $Document->ft_number        = $val['ftvbeln'];
                        $Document->update_time      = $timestamp;
                        $Document->update_version   = $rand;
                        $Document->save();

                        $documentId = $Document->id;

                        //GET DOC MATERIALS
                        if ($documentId) 
                        {
                            $docMaterials = $this->getDocMaterials($val['vbeln']);
                           
                            if (isset($docMaterials['all_items']) && !empty($docMaterials['all_items'])) 
                            {
                                if (isset($docMaterials['all_items'][0])) 
                                {
                                    foreach ($docMaterials['all_items'] as $v) 
                                    {
                                        $LFIMG = is_array($v['LFIMG']) ? 'NA' : $v['LFIMG'];
                                        $MEINS = is_array($v['MEINS']) ? 'NA' : $v['MEINS'];
                                        $CHARG = is_array($v['CHARG']) ? 'NA' : $v['CHARG'];

                                        $updateOrCreate = Material::updateOrCreate(
                                        [
                                            'number' => $v['MATNR']
                                        ], 
                                        [
                                            'name'              => $v['ARKTX'],
                                            'update_time'       => $timestamp,
                                            'update_version'    => $rand
                                        ] );

                                        if($updateOrCreate)
                                        {
                                            $insert_doc_mat = DB::table('materials_has_documents')
                                                                ->insert([
                                                                    'document_id'      => $documentId, 
                                                                    'material_id'      => $updateOrCreate->id,
                                                                    'quantidade'       => $LFIMG,
                                                                    'unidade'          => $MEINS,
                                                                    'lote'             => $CHARG,
                                                                    'update_time'      => $timestamp,
                                                                    'update_version'   => $rand
                                                                ]);
                                        }
                                    }
                                }else{
                                    $updateOrCreate = Material::updateOrCreate(
                                    [
                                        'number' => $docMaterials['all_items']['MATNR']
                                    ], 
                                    [
                                        'name'              => $docMaterials['all_items']['ARKTX'],
                                        'update_time'       => $timestamp,
                                        'update_version'    => $rand
                                    ] );

                                    if($updateOrCreate)
                                    {
                                        $LFIMG = is_array($docMaterials['all_items']['LFIMG']) ? 'NA' : $docMaterials['all_items']['LFIMG'];
                                        $MEINS = is_array($docMaterials['all_items']['MEINS']) ? 'NA' : $docMaterials['all_items']['MEINS'];
                                        $CHARG = is_array($docMaterials['all_items']['CHARG']) ? 'NA' : $docMaterials['all_items']['CHARG'];

                                        $insert_doc_mat = DB::table('materials_has_documents')
                                                            ->insert([
                                                                'document_id'       => $documentId, 
                                                                'material_id'       => $updateOrCreate->id,
                                                                'quantidade'        => $LFIMG,
                                                                'unidade'           => $MEINS,
                                                                'lote'              => $CHARG,
                                                                'update_time'       => $timestamp,
                                                                'update_version'    => $rand
                                                            ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldDocs = $this->deleteOldDocs($rand);

            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldMats = $this->deleteOldMats($rand);

            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldMatsDocs = $this->deleteOldMatsDocs($rand);
        }   
    }
    public function getClientDocs($client_id)
    {

        $current_date = date("Ymd"); 
        $five_days_ago = new DateTime($current_date);
        $five_days_ago ->modify("-5 days");
        $five_days_ago = $five_days_ago ->format("Ymd");

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
             "location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_docs/300/zws_get_docs/zws_get_docs'
        );

        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_docs/300/zws_get_docs/zws_get_docs?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["CS_VBAK"]      = 'CS_VBAK';
        $params["CT_VBAK"]      = 'CT_VBAK';

        $params["DATE5"]        = $five_days_ago;
        $params["DATE_TODAY"]   = $current_date;
        $params["ZKUNNR"]       = $client_id;

        $soap_client->ZANN_REFUND_DOCS($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        $vbeln_list = [];  

        $tempData['docs'] = [];

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_DOCSResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_DOCSResponse']['CT_VBAK']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_DOCSResponse']['CT_VBAK']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_REFUND_DOCSResponse']['CT_VBAK']['item'];
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
            foreach ($tempData['all_items'] as $key => $value) 
            {
                if (isset($value['VBELN'])) 
                {
                    $tempData['docs'][$key]['vbeln']    = $value['VBELN'];
                    $tempData['docs'][$key]['audat']    = $value['AUDAT'];
                    $tempData['docs'][$key]['netwr']    = $value['NETWR'];
                    $tempData['docs'][$key]['ftvbeln']  = $value['FTVBELN'];
                }
            }
        } 

        return $tempData['docs'];
    }
    public function getDocMaterials($doc_id)
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
            'location'      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_mats/300/zws_get_mats/zws_get_mats'
        );

        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_mats/300/zws_get_mats/zws_get_mats?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["CS_LIBS"]      = 'CS_LIBS';
        $params["CT_LIBS"]      = 'CT_LIBS';

        $params["ZBELV"]        = $doc_id;

        $soap_client->ZANN_REFUND_MATS($params);

        $data           = $soap_client->__getLastResponse();
        $plainXML       = $this->mungXML($data);
        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        $tempData = [];

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_MATSResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_MATSResponse']['CT_LIBS']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_REFUND_MATSResponse']['CT_LIBS']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_REFUND_MATSResponse']['CT_LIBS']['item'];
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

        return $tempData;
    }
    public function deleteOldDocs($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = Document::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $ids_to_delete = Document::destroy($items_to_delete->toArray());
            
        }
    }
    public function deleteOldMats($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = Material::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $ids_to_delete = Material::destroy($items_to_delete->toArray());
            
        }
    }
    public function deleteOldMatsDocs($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = DB::table('materials_has_documents')->where('update_version', '!=', $update_version)
                                ->get(['id']);

            if(!empty($items_to_delete))
            {
                foreach ($items_to_delete as $key => $item) 
                {
                    DB::table('materials_has_documents')->delete($item->id);
                }
            }
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
