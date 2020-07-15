<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetUserCurrentAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:current_account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get User Current Account';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle($client = NULL)
    {
        if (isset($client) && !empty($client)) 
        {
            //GET DATA FROM WS
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
                //"location"      => 'http://192.168.110.226:8000/sap/bc/srt/rfc/sap/zws_get_caccount/030/zws_get_caccount/zws_get_caccount'
                "location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_caccount/300/zws_get_caccount/zws_get_caccount'
            );

            //PHP OPTIONS
            ini_set('default_socket_timeout', 900);
            ini_set("soap.wsdl_cache_enabled", "0");
            libxml_disable_entity_loader(false);
                
            //$wsdl = 'http://192.168.110.226:8000/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_caccount/030/zws_get_caccount/zws_get_caccount?sap-client=030';

            $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_caccount/300/zws_get_caccount/zws_get_caccount?sap-client=300';
                    
            //BUILD SOAP CLIENT INSTANCE
            $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

            $params["CS_K1BSID"]           = 'CS_K1BSID';
            $params["CT_K1BSID"]           = 'CT_K1BSID';
            $params["ZKUNNR"]              = $client;

            $soap_client->ZANNFM_CCORRENTE($params);

            $data           = $soap_client->__getLastResponse();

            $plainXML       = $this->mungXML($data);

            $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if(isset($arrayResult['soap-env_Body']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CCORRENTEResponse']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CCORRENTEResponse']['CT_K1BSID']))
                    {
                        if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CCORRENTEResponse']['CT_K1BSID']['item']))
                        {
                            $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANNFM_CCORRENTEResponse']['CT_K1BSID']['item'];
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
            
            return $tempData['all_items'];
        }
    }
}
