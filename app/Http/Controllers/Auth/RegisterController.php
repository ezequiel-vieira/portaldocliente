<?php

namespace App\Http\Controllers\Auth;

// DON'T FORGET TO ADD THESE TWO!
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\User;
use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewOnlineClientMail;
use App\Mail\SendNewOnClientConfirmationMail;
use App\Mail\SendNewOnClientPendingMail;

use SoapClient;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/';
    protected $redirectTo = '/login-empresarial';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (empty($data['sap_code'])) 
        {
            $data['user_type']  = User::CLIONLINE_TYPE;
            $data['id_sap']     = NULL;
            $data['owner_page']         = '1';
            $data['users_page']         = '0';
            $data['cco_page']           = '1';
            $data['refunds_page']       = '0';
            $data['orders_page']        = '1';
            $data['cat_page']           = '0';
            $data['cat_page_lite']      = '1';
            $data['news_page']          = '1';
            $data['newsletter']         = '0';
            $data['hot_news']           = '0';
            $data['perfil_page']        = '1';
            $data['client_form_page']   = '0';
            $data['family_page']        = '0';
            $data['vendedor']           = '1017';
            $data['vendedor_contato']   = '925790722';
        }elseif (!empty($data['sap_code'])) 
        {
            $data['user_type']  = User::DEFAULT_TYPE;
            $data['id_sap']     = sprintf('%010d', $data['sap_code']);

            $data['owner_page']         = '1';
            $data['users_page']         = '1';
            $data['cco_page']           = '1';
            $data['refunds_page']       = '0';
            $data['orders_page']        = '1';
            $data['cat_page']           = '1';
            $data['cat_page_lite']      = '0';
            $data['news_page']          = '1';
            $data['newsletter']         = '0';
            $data['hot_news']           = '0';
            $data['perfil_page']        = '1';
            $data['client_form_page']   = '0';
            $data['family_page']        = '0';

            $data['vendedor']           = '1017';
            $data['vendedor_contato']   = '925790722';
        }else{
            $data['user_type']  = User::GUEST_TYPE;
            $data['id_sap']     = NULL;

            $data['owner_page']         = '0';
            $data['users_page']         = '0';
            $data['cco_page']           = '0';
            $data['refunds_page']       = '0';
            $data['orders_page']        = '0';
            $data['cat_page']           = '0';
            $data['cat_page_lite']      = '1';
            $data['news_page']          = '0';
            $data['newsletter']         = '0';
            $data['hot_news']           = '0';
            $data['perfil_page']        = '0';
            $data['client_form_page']   = '0';
            $data['family_page']        = '0';

            $data['vendedor']           = NULL;
            $data['vendedor_contato']   = NULL;
        }

        $user =  User::create([
            'name'              => $data['input_primeiro_nome'].' '.$data['input_ultimo_nome'],
            'email'             => $data['input_email'],
            'password'          => Hash::make($data['password']),
            'id_sap'            => $data['id_sap'],
            'type'              => $data['user_type'],
            'alias'             => str_slug($data['input_primeiro_nome'].' '.$data['input_ultimo_nome'], '-'),
            'owner_page'        => $data['owner_page'],
            'users_page'        => $data['users_page'],
            'cco_page'          => $data['cco_page'],
            'refunds_page'      => $data['refunds_page'],
            'orders_page'       => $data['orders_page'],
            'cat_page'          => $data['cat_page'],
            'cat_page_lite'     => $data['cat_page_lite'],
            'news_page'         => $data['news_page'],
            'newsletter'        => $data['newsletter'],
            'hot_news'          => $data['hot_news'],
            'perfil_page'       => $data['perfil_page'],
            'client_form_page'  => $data['client_form_page'],
            'family_page'       => $data['family_page'],
        ]);

        $id = $user->id; // Get current user id

        if ($id) 
        {
            $AccountUpdateOrCreate = $user->account()->updateOrCreate(
            [
                'user_id' => $id
            ], 
            [
                'name'                  => $data['input_primeiro_nome'].' '.$data['input_ultimo_nome'],
                'alias'                 => str_slug($data['input_primeiro_nome'].' '.$data['input_ultimo_nome'], '-'),
                'morada'                => $data['input_endereco_fiscal'],
                'telefone'              => $data['input_telefone'],
                'telemovel'             => $data['input_telemovel'],
                'email1'                => $data['input_email'],
                'email2'                => $data['input_email_compras'],
                'email3'                => $data['input_email_fin'],
                'cod_postal'            => $data['input_cod_postal'],
                'localidade'            => $data['input_concelho'],
                'nif'                   => $data['input_nif'],
                'vendedor'              => $data['vendedor'],
                'vendedor_contato'      => $data['vendedor_contato'],
                'id_sap'                => $data['id_sap'],
                'update_time'           => NULL,
                'update_version'        => NULL
            ] );
        }

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //$this->validator($request->all())->validate();

        /*if ($request) {
            Session::put('alert-class', 'alert-warning');
            return redirect()->back()->with('message', 'IT WORKS!');
        }*/

        //dd($request);

        //$user = $this->create($request->all());

        if (!empty($request->sap_code)) 
        {
            $assunto = 'Novo Cliente Profissional';
            $user_type = 'default';

            $sap_code = sprintf('%010d', $request->sap_code);
            
            $checkUser = $this->checkUser($sap_code);

            if (array_key_exists('all_items', $checkUser)) 
            {
                if (!empty($checkUser['all_items']['SMTP_ADDR']))
                {
                    if ($checkUser['all_items']['SMTP_ADDR'] === $request->input_email) 
                    {
                        event(new Registered($user = $this->create($request->all())));

                        //return $this->registered($request, $user) ? : redirect($this->redirectPath());

                        Session::put('alert-class', 'alert-success');

                        return redirect('/login-empresarial')->with('message', 'Conta criada com sucesso! Verifique sua caixa de correio.');

                    }else{

                        $request_all = $request->all();

                        $request_all['input_email'] = $checkUser['all_items']['SMTP_ADDR'];

                        event(new Registered($user = $this->create($request_all)));

                        Session::put('alert-class', 'alert-success');

                        return redirect('/login-empresarial')->with('message', 'Conta criada com sucesso! Foi enviado uma email de verificação para '.$checkUser['all_items']['SMTP_ADDR'].'. Verifique sua caixa de correio. Obrigado pela preferência.');
                        //return $this->registered($request, $user) ? : redirect($this->redirectPath());

                    }
                }else{

                    $data = array(
                        'assunto'                           =>  $assunto,
                        'cod_sap'                           =>  $sap_code,
                        'input_primeiro_nome'               =>  $request->input_primeiro_nome,
                        'input_ultimo_nome'                 =>  $request->input_ultimo_nome,
                        'input_telefone'                    =>  $request->input_telefone,
                        'input_telemovel'                   =>  $request->input_telemovel,
                        'input_email'                       =>  $request->input_email,
                        'input_cod_postal'                  =>  $request->input_cod_postal, 
                        'input_concelho'                    =>  $request->input_concelho,

                        'input_nif'                         =>  $request->input_nif,
                        'input_denominacao_fiscal'          =>  $request->input_denominacao_fiscal,
                        'input_endereco_fiscal'             =>  $request->input_endereco_fiscal,  
                        'input_codigo_postal_fiscal'        =>  $request->input_endereco_fiscal,
                        'input_localidade_fiscal'           =>  $request->input_localidade_fiscal,

                        'input_nome_estabelecimento'        =>  $request->input_nome_estabelecimento,
                        'input_endereco_estabelecimento'    =>  $request->input_endereco_estabelecimento,
                        'input_codigo_postal_estabelecimento'  =>  $request->input_codigo_postal,
                        'input_localidade_estabelecimento'  =>  $request->input_localidade,

                        'input_primeiro_nome_compras'       =>  $request->input_primeiro_nome_compras,
                        'input_ultimo_nome_compras'         =>  $request->input_ultimo_nome_compras,
                        'input_telefone_compras'            =>  $request->input_telefone_compras,
                        'input_telemovel_compras'           =>  $request->input_telemovel_compras,
                        'input_email_compras'               =>  $request->input_email_compras,

                        'input_primeiro_nome_fin'           =>  $request->input_primeiro_nome_fin,
                        'input_ultimo_nome_fin'             =>  $request->input_ultimo_nome_fin,
                        'input_telefone_fin'                =>  $request->input_telefone_fin,
                        'input_email_fin'                   =>  $request->input_email_fin,

                        'user_type'                         =>  $user_type
                    );

                    $mail_addresses = ['ezequiel.vieira@gruponobrega.pt'];

                    $mail_bcc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

                    Mail::to($mail_addresses)->bcc($mail_bcc_addresses)->send(new SendNewOnlineClientMail($data));

                    $client_mail_addresses = ['ezequiel.vieira@gruponobrega.pt', 'joana.neves@gruponobrega.pt'];

                    Mail::to($client_mail_addresses)->bcc($mail_bcc_addresses)->send(new SendNewOnClientPendingMail($data));

                    return redirect($this->redirectPath());
                }
            }else{
                Session::put('alert-class', 'alert-danger');
                return redirect()->back()->with('message', $checkUser['error']);
            }

            if (array_key_exists('error', $checkUser)) {
                Session::put('alert-class', 'alert-danger');
                return redirect()->back()->with('message', $checkUser['error']);
            }
        }

        //return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }

    /* GET USER CONTA CORRENTE */
    public function checkUser($client = NULL)
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
                'keep_alive'    => FALSE,
                "location"      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_check_user/300/zws_check_user/zws_check_user'
            );

            //PHP OPTIONS
            ini_set('default_socket_timeout', 900);
            ini_set("soap.wsdl_cache_enabled", "0");
            libxml_disable_entity_loader(false);
                
            $wsdl = 'http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/srvc_url/sap/bc/srt/rfc/sap/zws_check_user/300/zws_check_user/zws_check_user?sap-client=300';
                    
            //BUILD SOAP CLIENT INSTANCE
            $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

            $params["ZZS_KNA1"]           = 'ZZS_KNA1';
            $params["ZZT_KNA1"]           = 'ZZT_KNA1';
            $params["ZKUNNR"]             = $client;

            $soap_client->ZANN_FM_REGISTRATION($params);

            $data           = $soap_client->__getLastResponse();

            $plainXML       = $this->mungXML($data);

            $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

            if(isset($arrayResult['soap-env_Body']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_REGISTRATIONResponse']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_REGISTRATIONResponse']['ZZT_KNA1']))
                    {
                        if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_REGISTRATIONResponse']['ZZT_KNA1']['item']))
                        {
                            $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_FM_REGISTRATIONResponse']['ZZT_KNA1']['item'];
                        }else{
                            $tempData['error'] = 'Não existe nenhum cliente com esse número. Insira um número válido.';
                        }
                    }else{
                        $tempData['error'] = 'Ocorreu um erro. Tente novamente.';
                    } 
                }else{
                    $tempData['error'] = 'Ocorreu um erro. Tente novamente.';
                }
            }else{
                $tempData['error'] = 'Ocorreu um erro. Tente novamente.';
            }
            
            return $tempData;
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

    /*public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ? : redirect($this->redirectPath());
    }*/
}
