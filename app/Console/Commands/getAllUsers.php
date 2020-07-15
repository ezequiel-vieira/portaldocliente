<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Current_account;
use App\Account;
use Carbon\Carbon;
use Auth;
use DB;
use SoapClient;
use File;
use wasRecentlyCreated;
use wasChanged;
use DateTime;

class getAllUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all available users';

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
    public function handle()
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
            "location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_portal_users_v1/300/zws_get_portal_users/zws_get_portal_users'
        );

        set_time_limit(0);

        //30-03-2020 old users call
        //"location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/ZWS_USERS_V5/300/ZWS_USERS_V5/ZWS_USERS_V5'
        //$wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/ZWS_USERS_V5/300/ZWS_USERS_V5/ZWS_USERS_V5?sap-client=300';
        //ZANN_FM_PORTAL_V5Response
        /*******************************/
        //old: http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_clients/300/zws_get_clients/zws_get_clients
        
        //PHP OPTIONS
        ini_set('default_socket_timeout', 1200);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_portal_users_v1/300/zws_get_portal_users/zws_get_portal_users?sap-client=300';


        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["ZCS_KNA1"]           = 'ZCS_KNA1';
        $params["ZCT_KNA1"]           = 'ZCT_KNA1';

        $soap_client->ZANN_PORTAL_USERS_V1_FM($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_PORTAL_USERS_V1_FMResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_PORTAL_USERS_V1_FMResponse']['ZCT_KNA1']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_PORTAL_USERS_V1_FMResponse']['ZCT_KNA1']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_PORTAL_USERS_V1_FMResponse']['ZCT_KNA1']['item'];
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
            $timestamp = Carbon::now();

            $rand = str_random(32);

            $i = 1;

            $total_items = count($tempData['all_items']);

            echo 'USERS: '.$total_items;

            foreach ($tempData['all_items'] as $key => $value) 
            {                             

                $password = (is_numeric($value['KUNNR'])) ? (int)$value['KUNNR'] : $value['KUNNR'] ;
                
                if ($value['KUNNR'] === 'HORECASH') 
                {
                    $updateOrCreate = User::updateOrCreate(
                    [
                        'id_sap' => $value['KUNNR']
                    ], 
                    [
                        'name'              => $value['NAME1'],
                        'alias'             => str_slug($value['NAME1'], '-'),
                        'email'             => 'bruno.camacho@gruponobrega.pt',
                        'password'          => Hash::make($password),
                        'id_sap'            => $value['KUNNR'],
                        'update_time'       => $timestamp,
                        'update_version'    => $rand,
                        'type'              => User::DEFAULT_TYPE,
                        'owner_page'        => 1,
                        'users_page'        => 1,
                        'cco_page'          => 1,
                        'refunds_page'      => 1,
                        'orders_page'       => 1,
                        'cat_page'          => 1,
                        'news_page'         => 1,
                    ] );
                }elseif ($value['KUNNR'] === '0001100001') {
                    
                    $updateOrCreate = User::updateOrCreate(
                    [
                        'id_sap' => $value['KUNNR']
                    ], 
                    [
                        'name'              => $value['NAME1'],
                        'alias'             => str_slug($value['NAME1'], '-'),
                        'email'             => 'pedroferreira@portobay.pt',
                        'password'          => Hash::make($password),
                        'id_sap'            => $value['KUNNR'],
                        'update_time'       => $timestamp,
                        'update_version'    => $rand,
                        'type'              => User::DEFAULT_TYPE,
                        'owner_page'        => 1,
                        'users_page'        => 1,
                        'cco_page'          => 1,
                        'refunds_page'      => 1,
                        'orders_page'       => 1,
                        'cat_page'          => 1,
                        'news_page'         => 1,
                    ] );
                }else{

                    $rand_int = random_int(00000, 99999);

                    $updateOrCreate = User::updateOrCreate(
                    [
                        'id_sap' => $value['KUNNR']
                    ], 
                    [
                        'name'              => $value['NAME1'],
                        'alias'             => str_slug($value['NAME1'], '-'),
                        'email'             => 'portaldeclientes'.$key.$rand_int.'@gruponobrega.pt',
                        'password'          => Hash::make($password),
                        'id_sap'            => $value['KUNNR'],
                        'update_time'       => $timestamp,
                        'update_version'    => $rand,
                        'type'              => User::DEFAULT_TYPE,
                        'owner_page'        => 1,
                        'users_page'        => 1,
                        'cco_page'          => 1,
                        'refunds_page'      => 1,
                        'orders_page'       => 1,
                        'cat_page'          => 1,
                        'news_page'         => 1,
                    ] );
                }

                //INSERT CLIENT DETAILS
                if($updateOrCreate)
                {
                    //CHECK IF ROW WAS CREATED OR UPDATED
                    // If true then created otherwise maybe updated
                    $wasCreated = $updateOrCreate->wasRecentlyCreated;

                    //echo $value['NAME1'].': '.$value['KUNNR'].'- updated';
                    //echo "<br>";
                    
                    if ($wasCreated === true) 
                    {
                        //echo $value['NAME1'].': '.$value['KUNNR'].'- created';
                        //echo '<br>';
                        $updateOrCreate->sendEmailVerificationNotification();
                    }

                    $userId = $updateOrCreate->id;

                    $status = 'inserted:'.$userId;

                    $AccountUpdateOrCreate = $updateOrCreate->account()->updateOrCreate(
                    [
                        'user_id' => $userId
                    ], 
                    [
                        'name'                  => $value['NAME1'],
                        'alias'                 => str_slug($value['NAME1'], '-'),
                        'morada'                => $value['STRAS'],
                        'telefone'              => isset($value['TELF1']) && empty($value['TELF1']) ? NULL : $value['TELF1'],
                        'telemovel'             => isset($value['TELF1']) && empty($value['TELF1']) ? NULL : $value['TELF1'],
                        'email1'                => $value['SMTP_ADDR'],
                        'email2'                => $value['SMTP_ADDR'],
                        'email3'                => $value['SMTP_ADDR'],
                        'cod_postal'            => $value['PSTLZ'],
                        'localidade'            => $value['ORT01'],
                        'nif'                   => $value['STCEG'],
                        'vendedor'              => (int)$value['PERNR'],
                        'vendedor_contato'      => '291934333',
                        'id_sap'                => $value['KUNNR'],
                        'update_time'           => $timestamp,
                        'update_version'        => $rand
                    ] );

                    $status = 'updated:'.$userId. 'with account'.$AccountUpdateOrCreate->id;
                }else{
                    $status = 'error';
                }

                //INSERT CLIENT CURRENT ACCOUNT ITEMS
                if($updateOrCreate)
                {
                    $userId = $updateOrCreate->id;

                    $clientCurrentAccount = $this->getCurrentAccount($value['KUNNR']);

                    if(!empty($clientCurrentAccount) && isset($clientCurrentAccount[0]))
                    {
                        foreach ($clientCurrentAccount as $key => $value) 
                        {
                            //FATURAS
                            if ($value['BLART'] === 'RV') 
                            {
                                switch ($value['ZTERM']) 
                                {
                                    case 'PC10':
                                        $value['ZTERM_DESC']    = 'Pagamento a 60 dias';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PC11':
                                        $value['ZTERM_DESC']    = 'Pagamento a 90 dias';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PC12':
                                        $value['ZTERM_DESC']    = 'Pagamento a 120 dias';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PC13':
                                        $value['ZTERM_DESC']    = 'Pagamento a 30 dias (Resumo Mensal)';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PC14':
                                        $value['ZTERM_DESC']    = 'Pagamento a 45 dias (Resumo Mensal)';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PC15':
                                        $value['ZTERM_DESC']    = 'Pagamento a 60 dias (Resumo Mensal)';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PC16':
                                        $value['ZTERM_DESC']    = 'Pagamento a 90 dias (Resumo Mensal)';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PC17':
                                        $value['ZTERM_DESC']    = 'Pagamento a 120 dias (Resumo Mensal)';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PCC1':
                                        $value['ZTERM_DESC']    = 'Pagamento a 8 dias';
                                        $value['payment_value'] = '8';
                                        break;
                                    case 'PCC2':
                                        $value['ZTERM_DESC']    = 'Pagamento a 15 dias';
                                        $value['payment_value'] = '15';
                                        break;
                                    case 'PCC3':
                                        $value['ZTERM_DESC']    = 'Pag. a 30 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PCC4':
                                        $value['ZTERM_DESC']    = 'Pag. a 45 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PCC5':
                                        $value['ZTERM_DESC']    = 'Pag. a 60 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PCC6':
                                        $value['ZTERM_DESC']    = 'Pag. a 90 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PCC7':
                                        $value['ZTERM_DESC']    = 'Pag. a 120 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PCC8':
                                        $value['ZTERM_DESC']    = 'Pagamento a 30 dias';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PCC9':
                                        $value['ZTERM_DESC']    = 'Pagamento a 45 dias';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PPC0':
                                        $value['ZTERM_DESC']    = 'Pronto pagamento s/ desconto';
                                        $value['payment_value'] = '0';
                                        break;
                                    case 'PPC1':
                                        $value['ZTERM_DESC']    = 'Pronto pagamento c/ 3% desconto';
                                        $value['payment_value'] = '0';
                                        break;
                                }

                                //Tipos de Documento
                                $result = mb_substr($value['ZUONR'], 0, 3);
                                if ($result === '009') {
                                    $value['BLART']     = 'FT';
                                    $value['DOCDESC']   = 'Fatura';
                                }elseif ($result === '020') {
                                    $value['BLART']     = 'FT';
                                    $value['DOCDESC']   = 'N.Crédito';
                                }

                                //Tipos de Documento
                                switch ($value['BLART']) 
                                {
                                    case 'RV':
                                        $value['BLART']     = 'FT';
                                        $value['DOCDESC']   = 'Fatura';
                                        break;
                                    case 'RC':
                                        $value['BLART']     = 'RC';
                                        $value['DOCDESC']   = 'Recibo';
                                        break;
                                }

                                $value['BLMAXDAT'] = date('Y-m-d', strtotime($value['BLDAT']. ' + '.$value['payment_value']. ' days'));

                                $CAccount                   = new Current_account;
                                $CAccount->user_id          = $userId;
                                $CAccount->doc_type         = $value['DOCDESC'];
                                $CAccount->doc_tag          = $value['BLART'];
                                $CAccount->doc_number       = $value['ZUONR'];
                                $CAccount->doc_date         = $value['BLDAT'];
                                $CAccount->payment_type     = $value['ZTERM_DESC'];
                                $CAccount->payment_tag      = $value['ZTERM'];
                                $CAccount->payment_value    = $value['payment_value'];
                                $CAccount->payment_date     = $value['BLMAXDAT'];
                                $CAccount->doc_value        = $value['DMBTR'];
                                $CAccount->update_time      = $timestamp;
                                $CAccount->update_version   = $rand;
                                $CAccount->save();
                            }
                            //NOTAS CREDITO
                            if ($value['BLART'] === 'CC') 
                            {
                                //CONDICOES DE PAGAMENTO
                                switch ($value['ZTERM']) 
                                {
                                    case 'PC10':
                                        $value['ZTERM_DESC']    = 'Pagamento a 60 dias';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PC11':
                                        $value['ZTERM_DESC']    = 'Pagamento a 90 dias';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PC12':
                                        $value['ZTERM_DESC']    = 'Pagamento a 120 dias';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PC13':
                                        $value['ZTERM_DESC']    = 'Pagamento a 30 dias (Resumo Mensal)';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PC14':
                                        $value['ZTERM_DESC']    = 'Pagamento a 45 dias (Resumo Mensal)';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PC15':
                                        $value['ZTERM_DESC']    = 'Pagamento a 60 dias (Resumo Mensal)';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PC16':
                                        $value['ZTERM_DESC']    = 'Pagamento a 90 dias (Resumo Mensal)';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PC17':
                                        $value['ZTERM_DESC']    = 'Pagamento a 120 dias (Resumo Mensal)';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PCC1':
                                        $value['ZTERM_DESC']    = 'Pagamento a 8 dias';
                                        $value['payment_value'] = '8';
                                        break;
                                    case 'PCC2':
                                        $value['ZTERM_DESC']    = 'Pagamento a 15 dias';
                                        $value['payment_value'] = '15';
                                        break;
                                    case 'PCC3':
                                        $value['ZTERM_DESC']    = 'Pag. a 30 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PCC4':
                                        $value['ZTERM_DESC']    = 'Pag. a 45 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PCC5':
                                        $value['ZTERM_DESC']    = 'Pag. a 60 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '60';
                                        break;
                                    case 'PCC6':
                                        $value['ZTERM_DESC']    = 'Pag. a 90 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '90';
                                        break;
                                    case 'PCC7':
                                        $value['ZTERM_DESC']    = 'Pag. a 120 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                        $value['payment_value'] = '120';
                                        break;
                                    case 'PCC8':
                                        $value['ZTERM_DESC']    = 'Pagamento a 30 dias';
                                        $value['payment_value'] = '30';
                                        break;
                                    case 'PCC9':
                                        $value['ZTERM_DESC']    = 'Pagamento a 45 dias';
                                        $value['payment_value'] = '45';
                                        break;
                                    case 'PPC0':
                                        $value['ZTERM_DESC']    = 'Pronto pagamento s/ desconto';
                                        $value['payment_value'] = '0';
                                        break;
                                    case 'PPC1':
                                        $value['ZTERM_DESC']    = 'Pronto pagamento c/ 3% desconto';
                                        $value['payment_value'] = '0';
                                        break;
                                }

                                $value['BLART']     = 'NC';
                                $value['DOCDESC']   = 'N.Crédito';

                                $value['BLMAXDAT'] = $value['BLDAT'];

                                $CAccount                   = new Current_account;
                                $CAccount->user_id          = $userId;
                                $CAccount->doc_type         = $value['DOCDESC'];
                                $CAccount->doc_tag          = $value['BLART'];
                                $CAccount->doc_number       = $value['ZUONR'];
                                $CAccount->doc_date         = $value['BLDAT'];
                                $CAccount->payment_type     = $value['ZTERM_DESC'];
                                $CAccount->payment_tag      = $value['ZTERM'];
                                $CAccount->payment_value    = $value['payment_value'];
                                $CAccount->payment_date     = $value['BLMAXDAT'];
                                $CAccount->doc_value        = $value['DMBTR'];
                                $CAccount->update_time      = $timestamp;
                                $CAccount->update_version   = $rand;
                                $CAccount->save();
                            }
                        }
                    }                        
                }else{
                    $status = 'error_CURRENT_ACCOUNT';
                }
                $i++;
            }

            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldUsers = $this->deleteOldUsers($rand);

            //DELETE OLD CURRENT ACCOUNT ITEMS
            $deleteOldItems = $this->deleteOldItems($rand);
        }
    }
    /*public function handle()
    {
        $this->SOAP_OPTS = array (
            'login'         => 'fpires',
            'password'      => 'Madeira2019',
            'style'         => SOAP_DOCUMENT,
            'trace'         => 1,
            'exceptions'    => true,
            'Content-Type'  => 'soap/xml',
            'use'           => SOAP_LITERAL,
            'compression'   => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'cache_wsdl'    => WSDL_CACHE_NONE,
            "location"      => 'http://192.168.110.225:8001/sap/bc/srt/rfc/sap/zws_get_clients/300/zws_get_clients/zws_get_clients'
        );
        
        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = 'http://192.168.110.225:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_get_clients/300/zws_get_clients/zws_get_clients?sap-client=300';

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["CS_KNA1"]           = 'CS_KNA1';
        $params["CT_KNA1"]           = 'CT_KNA1';

        $soap_client->ZANNFM_CLIENTES($params);

        $data           = $soap_client->__getLastResponse();

        $plainXML       = $this->mungXML($data);

        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CLIENTESResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CLIENTESResponse']['CT_KNA1']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANNFM_CLIENTESResponse']['CT_KNA1']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANNFM_CLIENTESResponse']['CT_KNA1']['item'];
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
            
            $timestamp = Carbon::now();

            $rand = str_random(32);

            foreach ($tempData['all_items'] as $key => $value) 
            {               
                $password = (int)$value['KUNNR'];

                //if ($value['KUNNR'] === '0001100205'){
                    
                    $updateOrCreate = User::updateOrCreate(
                    [
                        'id_sap' => $value['KUNNR']
                    ], 
                    [
                        'name'              => $value['NAME1'],
                        'alias'             => str_slug($value['NAME1'], '-'),
                        'email'             => 'portaldeclientes'.$key.'@gruponobrega.pt',
                        //'email'             => 'sirzica@gmail.com',
                        'password'          => Hash::make($password),
                        'id_sap'            => $value['KUNNR'],
                        'update_time'       => $timestamp,
                        'update_version'    => $rand,
                        'type'              => User::DEFAULT_TYPE
                    ] );

                    //INSERT CLIENT DETAILS
                    if($updateOrCreate)
                    {
                        //CHECK IF ROW WAS CREATED OR UPDATED
                        // If true then created otherwise maybe updated
                        $wasCreated = $updateOrCreate->wasRecentlyCreated;
                        
                        if ($wasCreated === true) {
                            echo 'wasCreated:'.$wasCreated. 'created';
                            $updateOrCreate->sendEmailVerificationNotification();
                        }

                        $userId = $updateOrCreate->id;

                        $status = 'inserted:'.$userId;

                        $AccountUpdateOrCreate = $updateOrCreate->account()->updateOrCreate(
                        [
                            'user_id' => $userId
                        ], 
                        [
                            'name'                  => $value['NAME1'],
                            'alias'                 => str_slug($value['NAME1'], '-'),
                            'morada'                => $value['STRAS'],
                            'telefone'              => isset($value['TELF1']) && empty($value['TELF1']) ? NULL : $value['TELF1'],
                            'telemovel'             => isset($value['TELF1']) && empty($value['TELF1']) ? NULL : $value['TELF1'],
                            'email1'                => $value['SMTP_ADDR'],
                            'email2'                => $value['SMTP_ADDR'],
                            'email3'                => $value['SMTP_ADDR'],
                            'cod_postal'            => $value['PSTLZ'],
                            'localidade'            => $value['ORT01'],
                            'nif'                   => $value['STCEG'],
                            'vendedor'              => (int)$value['PERNR'],
                            'vendedor_contato'      => '291934333',
                            'id_sap'                => $value['KUNNR'],
                            'update_time'           => $timestamp,
                            'update_version'        => $rand
                        ] );

                        $status = 'updated:'.$userId. 'with account'.$AccountUpdateOrCreate->id;
                    }else{
                        $status = 'error';
                    }

                    //INSERT CLIENT CURRENT ACCOUNT ITEMS
                    if($updateOrCreate)
                    {
                        $userId = $updateOrCreate->id;

                        $clientCurrentAccount = $this->getCurrentAccount($value['KUNNR']);

                        if(!empty($clientCurrentAccount) && isset($clientCurrentAccount[0]))
                        {
                            foreach ($clientCurrentAccount as $key => $value) 
                            {
                                //FATURAS
                                if ($value['BLART'] === 'RV') 
                                {
                                    switch ($value['ZTERM']) 
                                    {
                                        case 'PC10':
                                            $value['ZTERM_DESC']    = 'Pagamento a 60 dias';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PC11':
                                            $value['ZTERM_DESC']    = 'Pagamento a 90 dias';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PC12':
                                            $value['ZTERM_DESC']    = 'Pagamento a 120 dias';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PC13':
                                            $value['ZTERM_DESC']    = 'Pagamento a 30 dias (Resumo Mensal)';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PC14':
                                            $value['ZTERM_DESC']    = 'Pagamento a 45 dias (Resumo Mensal)';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PC15':
                                            $value['ZTERM_DESC']    = 'Pagamento a 60 dias (Resumo Mensal)';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PC16':
                                            $value['ZTERM_DESC']    = 'Pagamento a 90 dias (Resumo Mensal)';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PC17':
                                            $value['ZTERM_DESC']    = 'Pagamento a 120 dias (Resumo Mensal)';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PCC1':
                                            $value['ZTERM_DESC']    = 'Pagamento a 8 dias';
                                            $value['payment_value'] = '8';
                                            break;
                                        case 'PCC2':
                                            $value['ZTERM_DESC']    = 'Pagamento a 15 dias';
                                            $value['payment_value'] = '15';
                                            break;
                                        case 'PCC3':
                                            $value['ZTERM_DESC']    = 'Pag. a 30 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PCC4':
                                            $value['ZTERM_DESC']    = 'Pag. a 45 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PCC5':
                                            $value['ZTERM_DESC']    = 'Pag. a 60 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PCC6':
                                            $value['ZTERM_DESC']    = 'Pag. a 90 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PCC7':
                                            $value['ZTERM_DESC']    = 'Pag. a 120 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PCC8':
                                            $value['ZTERM_DESC']    = 'Pagamento a 30 dias';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PCC9':
                                            $value['ZTERM_DESC']    = 'Pagamento a 45 dias';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PPC0':
                                            $value['ZTERM_DESC']    = 'Pronto pagamento s/ desconto';
                                            $value['payment_value'] = '0';
                                            break;
                                        case 'PPC1':
                                            $value['ZTERM_DESC']    = 'Pronto pagamento c/ 3% desconto';
                                            $value['payment_value'] = '0';
                                            break;
                                    }

                                    //Tipos de Documento
                                    $result = mb_substr($value['ZUONR'], 0, 3);
                                    if ($result === '009') {
                                        $value['BLART']     = 'FT';
                                        $value['DOCDESC']   = 'Fatura';
                                    }elseif ($result === '020') {
                                        $value['BLART']     = 'FT';
                                        $value['DOCDESC']   = 'N.Crédito';
                                    }

                                    //Tipos de Documento
                                    switch ($value['BLART']) 
                                    {
                                        case 'RV':
                                            $value['BLART']     = 'FT';
                                            $value['DOCDESC']   = 'Fatura';
                                            break;
                                        case 'RC':
                                            $value['BLART']     = 'RC';
                                            $value['DOCDESC']   = 'Recibo';
                                            break;
                                    }

                                    $value['BLMAXDAT'] = date('Y-m-d', strtotime($value['BLDAT']. ' + '.$value['payment_value']. ' days'));

                                    $CAccount                   = new Current_account;
                                    $CAccount->user_id          = $userId;
                                    $CAccount->doc_type         = $value['DOCDESC'];
                                    $CAccount->doc_tag          = $value['BLART'];
                                    $CAccount->doc_number       = $value['ZUONR'];
                                    $CAccount->doc_date         = $value['BLDAT'];
                                    $CAccount->payment_type     = $value['ZTERM_DESC'];
                                    $CAccount->payment_tag      = $value['ZTERM'];
                                    $CAccount->payment_value    = $value['payment_value'];
                                    $CAccount->payment_date     = $value['BLMAXDAT'];
                                    $CAccount->doc_value        = $value['DMBTR'];
                                    $CAccount->update_time      = $timestamp;
                                    $CAccount->update_version   = $rand;
                                    $CAccount->save();
                                }
                                //NOTAS CREDITO
                                if ($value['BLART'] === 'CC') 
                                {
                                    //CONDICOES DE PAGAMENTO
                                    switch ($value['ZTERM']) 
                                    {
                                        case 'PC10':
                                            $value['ZTERM_DESC']    = 'Pagamento a 60 dias';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PC11':
                                            $value['ZTERM_DESC']    = 'Pagamento a 90 dias';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PC12':
                                            $value['ZTERM_DESC']    = 'Pagamento a 120 dias';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PC13':
                                            $value['ZTERM_DESC']    = 'Pagamento a 30 dias (Resumo Mensal)';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PC14':
                                            $value['ZTERM_DESC']    = 'Pagamento a 45 dias (Resumo Mensal)';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PC15':
                                            $value['ZTERM_DESC']    = 'Pagamento a 60 dias (Resumo Mensal)';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PC16':
                                            $value['ZTERM_DESC']    = 'Pagamento a 90 dias (Resumo Mensal)';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PC17':
                                            $value['ZTERM_DESC']    = 'Pagamento a 120 dias (Resumo Mensal)';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PCC1':
                                            $value['ZTERM_DESC']    = 'Pagamento a 8 dias';
                                            $value['payment_value'] = '8';
                                            break;
                                        case 'PCC2':
                                            $value['ZTERM_DESC']    = 'Pagamento a 15 dias';
                                            $value['payment_value'] = '15';
                                            break;
                                        case 'PCC3':
                                            $value['ZTERM_DESC']    = 'Pag. a 30 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PCC4':
                                            $value['ZTERM_DESC']    = 'Pag. a 45 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PCC5':
                                            $value['ZTERM_DESC']    = 'Pag. a 60 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '60';
                                            break;
                                        case 'PCC6':
                                            $value['ZTERM_DESC']    = 'Pag. a 90 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '90';
                                            break;
                                        case 'PCC7':
                                            $value['ZTERM_DESC']    = 'Pag. a 120 dias c/1% desc. ao 7º dia e 0.5% ao 15º dia';
                                            $value['payment_value'] = '120';
                                            break;
                                        case 'PCC8':
                                            $value['ZTERM_DESC']    = 'Pagamento a 30 dias';
                                            $value['payment_value'] = '30';
                                            break;
                                        case 'PCC9':
                                            $value['ZTERM_DESC']    = 'Pagamento a 45 dias';
                                            $value['payment_value'] = '45';
                                            break;
                                        case 'PPC0':
                                            $value['ZTERM_DESC']    = 'Pronto pagamento s/ desconto';
                                            $value['payment_value'] = '0';
                                            break;
                                        case 'PPC1':
                                            $value['ZTERM_DESC']    = 'Pronto pagamento c/ 3% desconto';
                                            $value['payment_value'] = '0';
                                            break;
                                    }

                                    $value['BLART']     = 'NC';
                                    $value['DOCDESC']   = 'N.Crédito';

                                    $value['BLMAXDAT'] = $value['BLDAT'];

                                    $CAccount                   = new Current_account;
                                    $CAccount->user_id          = $userId;
                                    $CAccount->doc_type         = $value['DOCDESC'];
                                    $CAccount->doc_tag          = $value['BLART'];
                                    $CAccount->doc_number       = $value['ZUONR'];
                                    $CAccount->doc_date         = $value['BLDAT'];
                                    $CAccount->payment_type     = $value['ZTERM_DESC'];
                                    $CAccount->payment_tag      = $value['ZTERM'];
                                    $CAccount->payment_value    = $value['payment_value'];
                                    $CAccount->payment_date     = $value['BLMAXDAT'];
                                    $CAccount->doc_value        = $value['DMBTR'];
                                    $CAccount->update_time      = $timestamp;
                                    $CAccount->update_version   = $rand;
                                    $CAccount->save();
                                }
                            }
                        }                        
                    }else{
                        $status = 'error_CURRENT_ACCOUNT';
                    }
                //}
            }

            //DELETE OLD DATA AND USER TYPE = DEFAULT
            $deleteOldUsers = $this->deleteOldUsers($rand);

            //DELETE OLD CURRENT ACCOUNT ITEMS
            $deleteOldItems = $this->deleteOldItems($rand);
        }
        print_r($status);
    }*/
    public function getCurrentAccount($client = NULL)
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
    public function deleteOldUsers($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $users_to_delete = User::where('update_version', '!=', $update_version)
                            ->where('type', '=', 'default')
                            ->get(['id']);

            $ids_to_delete = User::destroy($users_to_delete->toArray());
            
        }
    }
    public function deleteOldItems($update_version = NULL)
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = Current_account::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $ids_to_delete = Current_account::destroy($items_to_delete->toArray());
            
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
