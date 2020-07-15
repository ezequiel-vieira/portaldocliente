<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\User;
use App\Current_account;
use App\Account;
use App\News;
use App\Document;
use App\Material;
use App\Product;
use App\Encomenda;
use Carbon\Carbon;
use App\Mail\SendContactMail;
use App\Mail\SendQuestionMail;
use App\Mail\SendChangeEmailMail;
use App\Mail\SendProductsEmailMail;
use App\Mail\SendCatalogoMail;
use App\Mail\SendChangePerfilMail;
use App\Mail\SendRefundMail;
use App\Mail\SendHotNewsMail;
use App\Mail\SendNewsletterMail;
use App\Mail\SendPriceMail;
use App\Mail\SendNewClientMail;
use App\Mail\SendEncomendaMail;
use App\Mail\SendUserEncomendaMail;

use App\Mail\SendNewOnClientConfirmationMail;
use App\Mail\SendNewOnClientPendingMail;

/* TEMP */
use App\Mail\SendEncomendaMail2;
use App\Mail\SendUserEncomendaMail2;
/* TEMP */
use Auth;
use DB;
use SoapClient;
use File;
use wasRecentlyCreated;
use wasChanged;
use DateTime;
use Session;

use URL;

use RecursiveDirectoryIterator;
use FilesystemIterator;
use RecursiveIteratorIterator;

class HomeController extends Controller
{
    public function __construct()
    {

        $timestamp = Carbon::now();

        $rand = str_random(32);

        set_time_limit(0);

        $this->middleware(['auth', 'verified']);
    }
    //HOME
    public function index()
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        return view('dashboardmanagement.show-dashboard')->with($data);
    }
    /* TEMP */
    public function getCatalogoFiltered2(Request $request)
    {
        $user = \Auth::user();
        $menu = '';
        $top_menu = '';
        $select = '';
        $url = '';

        $url_conservacao    = $request->query('conservacao');
        $url_familia        = $request->query('familia');
        $url_order_by       = $request->query('order_by');
        $page               = $request->query('page');

        if (isset($url_order_by) && !empty($url_order_by)) 
        {
            $element = explode('_', $url_order_by);
            $order = $element[0];
            $by    = $element[1];
        }else{
            $order = 'number';
            $by    = 'asc';
        }

        if (isset($url_conservacao)) {
            $url .= 'conservacao='.$request->query('conservacao');
        }else{
            $url .= 'conservacao=ambiente';
        }

        if (isset($url_familia)) {
            $url .= '&familia='.$request->query('familia');
        }else{
            $url .= '&familia=all';
        }

        //SELECT OPTIONS
        switch ([$order, $by]) {
            case ['number', 'asc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc" selected="selected">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc">Novidades</option>';
            break;
            case ['name', 'asc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc" selected="selected">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc">Novidades</option>';
            break;
            case ['name', 'desc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc" selected="selected">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc">Novidades</option>';
            break;
            case ['preco', 'asc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc" selected="selected">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc">Novidades</option>';
            break;
            case ['preco', 'desc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc" selected="selected">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc">Novidades</option>';
            break;
            case ['last', 'desc']:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc" selected="selected">Novidades</option>';
            break;
            default:
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=number_asc" selected="selected">Código</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_asc" selected="selected">Nome (Crescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=name_desc" selected="selected">Nome (Decrescente)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_asc" selected="selected">Preço (Menor para Maior)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=preco_desc" selected="selected">Preço (Maior para Menor)</option>';
                $select .= '<option value="'.URL::current().'?'.$url.'&order_by=last_desc" selected="selected">Novidades</option>';
        }

        if (isset($page)) {
            $url .= '&page='.$request->query('page');
        }else{
            $url .= '&page=1';
        }

        $familias_array = [
            ['family_link' => 'aves', 'family_title'                    => 'aves'],
            ['family_link' => 'bovinos', 'family_title'                 => 'bovinos'],
            ['family_link' => 'caprinos', 'family_title'                => 'caprinos'],
            ['family_link' => 'charcutaria', 'family_title'             => 'charcutaria'],
            ['family_link' => 'gelados-e-sobremesas', 'family_title'    => 'GELADOS E SOBREMESAS'],
            ['family_link' => 'geral', 'family_title'                   => 'geral'],
            ['family_link' => 'gorduras-vegetais', 'family_title'       => 'GORDURAS VEGETAIS'],
            ['family_link' => 'lacticinios', 'family_title'             => 'LACTICÍNIOS'],
            ['family_link' => 'mar', 'family_title'                     => 'PEIXE E MARISCO'],
            ['family_link' => 'ovoprodutos', 'family_title'             => 'OVOS LÍQUIDOS'],
            ['family_link' => 'padaria', 'family_title'                 => 'PÃO E FOLHADOS'],
            ['family_link' => 'pre-cozinhados', 'family_title'          => 'PRÉ-COZINHADOS'],
            ['family_link' => 'preparados-de-carne', 'family_title'     => 'HAMBURGUERES E SALSICHAS'],
            ['family_link' => 'suinos', 'family_title'                  => 'SUÍNOS'],
            ['family_link' => 'vegetais', 'family_title'                => 'FRUTAS E VEGETAIS'],
        ];
        
        //CLIENTE GUEST
        if($user->cat_page_lite === 1)
        {

            $not_allowed = ['C010885001','C010885002','C010885003','C010885004','C010885005','C010885006','C010885007','C010885008','C010885009','C010885010','C010885011','C010885012','C010885013','C010885014','C010887001','C010887002','C010887003','C010887004','C010887005','C010887006','C010887007','C010887008','C010887009','C038026001','C038026002','C038026003','C038026004','C038026005','C038026006','C038026007','C038026008','C038026009', 'C038026010', 'C038026011','R038026000','R038026001','R038026002','C010130022', 'C010130019', 'C010130016', 'C010130036', 'C010130037','C010130038' , 'C010130039','C010130040', 'C010130041','C010130035', 'C010130034','C010130029','C010880001','C010880002','C010880003','C010880004','C010880005','C010880006','C010880007','C010880008','C010880009','C010880010','C010880011','C010880012','C010880013','C010880014','C010880015','C010880016','C010880017','C010880018','C010880019','C010880020','C010880021','C010880022','C010880023','C010880024','C010880025','C010880026','C010880027','C010880028','C010880029','C010880030','C010880031','C010880032','C010880033','C010880034','C010880035','C010880036','C010880037','C010880038','C010880039','C010880040','C010880041','C010880042','C010880043','C010880044','C010880045','C010880100','C010880101','C010880102','C010880103','C010880104','C010880105','C010880106','C010880107','C010880108','C010880109','C010880110','C010880111','C010880112','C010880113','C010880114','C010880115','C010880116','C010880117','C010880118','C010880119','C010880120','C010880121','C010880122','C010880123','C010880124','C010880125','C010880126','C010880127','C010880128','C010880129','C01088013','C010880130','C010880131','C010880132','C010880133','C010880134','C010880135','C010880136','C010884001','C010884002','C010884003','C010884004','C010884005','C010884006','C010884007','C010884008','C010884009','C010884010','C010884011','C010884012','C010884013','C010884014','C010884015','C010884016','C010884017','C010884018','C010884019','C010884020','C010884021','C010884022','C010884023','C010884024','C010883001','C010883002','C010883003','C010883004','C010883005','C010883006','C010883007','C010883008','C010883009','C010883010','C010883011','C010883012','C010883013','C010883014','C010883015','C010883016','C010883017','C010883018','C010881001','C010881002','C010881003','C010881004','C010881005','C010881006','C010881007','C010881008','C010881009','C010881010','C010881011','C010881012','C010881013','C010881014','C010881015','C010881016','C010881017','C010881018','C010881019','C010881020','C010881021','C010881022','C010881023','C010881024','C010881025','C010881026','C010881027','C010881028','C010881029','C010881030','C010881100','C010881101','C010881102','C010881103','C010881104','C010881105','C010881106','C010881107','C010881108','C010881109','C010881110','C010881111','C010881112','C010881113','C010881114','C010881115','C010881116','C010881117','C010881118','C010881119','C010881120','C010881121','C010881122','C010881123','C010881124','C010881125','C010881126','C010881127','C010881128','C010881129','C010881130','C010881131','C010881132','C010881133','C010881134','C010881135','C010881136','C010881137','C010881138','C010881139','C010881140','C010881141','C010881142','C010881143','C010881144','C010881145','C010881146','C010881147','C010881148','C010881149','C010881150','C010881151','C010881152','C010881153','C010881154','C010881155','C010881156','C010881157','C010881158','C010881159','C010881160','C010881161','C010881162','C010881163','C010881164','C010881165','C010881166','C010881167','C010881168','C010881169','C010881170','C010881171','C010881172','C010881173','C010881174','C010881175','C010881176','C010881177','C010881178','C010881179','C010881180','C010881181','C010881182','C010881183','C010881184','C010881185','C010881186','C010881187','C010881188','C010881189','C010881190','C010881191','C010881192','C010881193','C010881194','C010881195','C010881196','C010881197','C010881198','C010881199','C010881200','C010881201','C010881202','C010881203','C010881204','C010881205','C010881206','C010881207','C010881208','C010881209','C010881210','C010881211','C010881212','C010881213','C010881214','C010881215','C010881216','C010881217','C010881218','C010881219','C010881220','C010881221','C010881222','C010881223','C010881224','C010881225','C010881226','C010881227','C010881228','C010881229','C010881230','C010881231','C010881232','C010881233','C010881234','C010881235','C010881236','C010881237','C010881238','C010881239','C010881240','C010881241','C010881242','C010881243','C010881244']; 

            if ($request->ajax()) 
            {
                if ($request->input('_search')) 
                {
                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');
                    $products->where('name', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('number', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('origem', 'like', '%'.$request->input('_search').'%');
                    $products = $products->paginate(1500)->onEachSide(2); 

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type = 'all';
                    $subtype = 'all';

                    return view('shopping-cart.show-catalogo-result2', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }else{
                    $conservacao    = $request->input('conservacao');
                    $familia        = $request->input('familia'); 

                    $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                    $subtype        = ($familia === 'all' ? '' : $familia);

                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');  
                            if (!empty($type)) {
                                $products->where('type', '=', $type);
                            }
                            if (!empty($subtype)) {
                                $products->where('alias_subtype', '=', $subtype);
                            }
                    
                    $products = $products->paginate(99)->onEachSide(2);

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type           = ($conservacao === '' ? 'all' : $conservacao);
                    $subtype        = ($familia === '' ? 'all' : $familia);

                    return view('shopping-cart.show-catalogo-result2', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }
            }

            if ($request->input('conservacao') || $request->input('familia')) 
            {
                $conservacao    = $request->input('conservacao');
                $familia        = $request->input('familia'); 

                $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                $subtype        = ($familia === 'all' ? '' : $familia);

                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');  
                        if (!empty($type)) {
                            $products->where('type', '=', $type);
                        }
                        if (!empty($subtype)) {
                            $products->where('alias_subtype', '=', $subtype);
                        }
                
                $products = $products->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }

                $type           = ($conservacao === '' ? 'all' : $conservacao);
                $subtype        = ($familia === '' ? 'all' : $familia);
            }else{
                $type = 'all';
                $subtype = 'all';
                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1')->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }
            }
        } 

        //CLIENTE PROFESSIONAL
        if($user->cat_page === 1)
        {

            $not_allowed = ['C010885001','C010885002','C010885003','C010885004','C010885005','C010885006','C010885007','C010885008','C010885009','C010885010','C010885011','C010885012','C010885013','C010885014','C010887001','C010887002','C010887003','C010887004','C010887005','C010887006','C010887007','C010887008','C010887009','C038026001','C038026002','C038026003','C038026004','C038026005','C038026006','C038026007','C038026008','C038026009','C038026010','C038026011','R038026000','R038026001','R038026002','C010130022','C010130019','C010130016','C010130036','C010130037','C010130038','C010130039','C010130040','C010130041','C010130035','C010130034','C010130029','C010880001','C010880002','C010880003','C010880004','C010880005','C010880006','C010880007','C010880008','C010880009','C010880010','C010880011','C010880012','C010880013','C010880014','C010880015','C010880016','C010880017','C010880018','C010880019','C010880020','C010880021','C010880022','C010880023','C010880024','C010880025','C010880026','C010880027','C010880028','C010880029','C010880030','C010880031','C010880032','C010880033','C010880034','C010880035','C010880036','C010880037','C010880038','C010880039','C010880040','C010880041','C010880042','C010880043','C010880044','C010880045','C010880100','C010880101','C010880102','C010880103','C010880104','C010880105','C010880106','C010880107','C010880108','C010880109','C010880110','C010880111','C010880112','C010880113','C010880114','C010880115','C010880116','C010880117','C010880118','C010880119','C010880120','C010880121','C010880122','C010880123','C010880124','C010880125','C010880126','C010880127','C010880128','C010880129','C01088013','C010880130','C010880131','C010880132','C010880133','C010880134','C010880135','C010880136','C010884001','C010884002','C010884003','C010884004','C010884005','C010884006','C010884007','C010884008','C010884009','C010884010','C010884011','C010884012','C010884013','C010884014','C010884015','C010884016','C010884017','C010884018','C010884019','C010884020','C010884021','C010884022','C010884023','C010884024','C010883001','C010883002','C010883003','C010883004','C010883005','C010883006','C010883007','C010883008','C010883009','C010883010','C010883011','C010883012','C010883013','C010883014','C010883015','C010883016','C010883017','C010883018','C010881001','C010881002','C010881003','C010881004','C010881005','C010881006','C010881007','C010881008','C010881009','C010881010','C010881011','C010881012','C010881013','C010881014','C010881015','C010881016','C010881017','C010881018','C010881019','C010881020','C010881021','C010881022','C010881023','C010881024','C010881025','C010881026','C010881027','C010881028','C010881029','C010881030','C010881100','C010881101','C010881102','C010881103','C010881104','C010881105','C010881106','C010881107','C010881108','C010881109','C010881110','C010881111','C010881112','C010881113','C010881114','C010881115','C010881116','C010881117','C010881118','C010881119','C010881120','C010881121','C010881122','C010881123','C010881124','C010881125','C010881126','C010881127','C010881128','C010881129','C010881130','C010881131','C010881132','C010881133','C010881134','C010881135','C010881136','C010881137','C010881138','C010881139','C010881140','C010881141','C010881142','C010881143','C010881144','C010881145','C010881146','C010881147','C010881148','C010881149','C010881150','C010881151','C010881152','C010881153','C010881154','C010881155','C010881156','C010881157','C010881158','C010881159','C010881160','C010881161','C010881162','C010881163','C010881164','C010881165','C010881166','C010881167','C010881168','C010881169','C010881170','C010881171','C010881172','C010881173','C010881174','C010881175','C010881176','C010881177','C010881178','C010881179','C010881180','C010881181','C010881182','C010881183','C010881184','C010881185','C010881186','C010881187','C010881188','C010881189','C010881190','C010881191','C010881192','C010881193','C010881194','C010881195','C010881196','C010881197','C010881198','C010881199','C010881200','C010881201','C010881202','C010881203','C010881204','C010881205','C010881206','C010881207','C010881208','C010881209','C010881210','C010881211','C010881212','C010881213','C010881214','C010881215','C010881216','C010881217','C010881218','C010881219','C010881220','C010881221','C010881222','C010881223','C010881224','C010881225','C010881226','C010881227','C010881228','C010881229','C010881230','C010881231','C010881232','C010881233','C010881234','C010881235','C010881236','C010881237','C010881238','C010881239','C010881240','C010881241','C010881242','C010881243','C010881244']; 

            if ($request->input('_search')) 
            {
                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');
                $products->where('name', 'like', '%'.$request->input('_search').'%');
                $products->orWhere('number', 'like', '%'.$request->input('_search').'%');
                $products->orWhere('origem', 'like', '%'.$request->input('_search').'%');
                $products = $products->paginate(1500)->onEachSide(2); 

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }

                $type = 'all';
                $subtype = 'all';
                $menu .= '<ul class="nav nav-pills flex-column text-sm category-menu">';
                $menu .= '<a href="/catalogo-cart" class="btn btn-warning btn active" role="button" aria-pressed="true">Ver Catálogo</a>';
                $menu .= '</ul>';

                return view('shopping-cart.show-catalogo-cart2', ['search_title' => 'Pesquisa','select' => $select,'url' => $url, 'sidebar' => $menu, 'topbar' => $top_menu, 'sort_by' => $order.'_'.$by, 'conservacao' => $type, 'familia' => $subtype, 'products' => $products]);
            }

            if ($request->input('conservacao') || $request->input('familia')) 
            {

                $conservacao    = $request->input('conservacao');
                $familia        = $request->input('familia'); 

                $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                $subtype        = ($familia === 'all' ? '' : $familia);

                if (!empty($url_order_by)) {
                    if ($order === 'last') {
                        $order = 'created_at';
                        $by    = 'DESC';
                    } 
                }

                if ($order === 'preco') 
                {
                    $query = "CAST(preco AS DECIMAL(10,2)) ".$by;
                    //DB::table('test')->where(...)->orderByRaw($query)->get();
                    $products = product::orderByRaw($query)->whereNOTIn('number', $not_allowed);
                }else{
                    $products = product::orderBy($order,$by)->whereNOTIn('number', $not_allowed);
                }

                if (!empty($type)) {
                    $products->where('type', '=', $type);
                }
                if (!empty($subtype)) {
                    $products->where('alias_subtype', '=', $subtype);
                }
                
                $products = $products->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }

                //SIDEBAR-MENU
                switch ($conservacao) {
                    case 'ambiente':
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column flex-sm-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                    foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                             
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    case 'congelado':
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                   foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                           
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    case 'refrigerado':
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                   foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                            
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    default:
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column flex-sm-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                    foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                             
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                }

                $type           = ($conservacao === '' ? 'all' : $conservacao);
                $subtype        = ($familia === '' ? 'all' : $familia);
            }else{
                $type = 'ambiente';
                $subtype = 'all';
                $conservacao = 'ambiente';
                $familia = '';
                
                //SIDEBAR-MENU
                switch ($conservacao) {
                    case 'ambiente':
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column flex-sm-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                    foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                             
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    case 'congelado':
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                   foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                           
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    case 'refrigerado':
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                   foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                            
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                    default:
                        $top_menu .= '<a class="nav-item nav-link active" href="/catalogo-cart?conservacao=ambiente&amp;familia=all">Ambiente</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=congelado&amp;familia=all">Congelados</a>';
                        $top_menu .= '<a class="nav-item nav-link" href="/catalogo-cart?conservacao=refrigerado&amp;familia=all">Refrigerados</a>';
                        $menu .= '<ul class="nav nav-pills flex-column flex-sm-column text-sm category-menu">';
                            $menu .= '<li class="nav-item">';
                                  $menu .= '<ul class="nav nav-pills flex-column family-menu">';
                                    foreach ($familias_array as $key => $value) 
                                    {
                                        if ($value['family_link'] === $familia) {
                                            $active_status = 'active';
                                        }else{
                                            $active_status = '';
                                        }

                                        $menu .= '<li class="nav-item">';
                                            $menu .= '<a class="nav-link sub-link '.$active_status.'" href="/catalogo-cart?conservacao='.$conservacao.'&amp;familia='.$value['family_link'].'">'.$value['family_title'].'</a>';
                                        $menu .= '</li>';
                                    }                                                                             
                                  $menu .= '</ul>';
                            $menu .= '</li>';
                        $menu .= '</ul>';
                        break;
                }

                $products = product::orderBy($order,$by)->whereNOTIn('number', $not_allowed)->where('type', '=', $type)->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name']  = $value['short_name'];
                    }
                    $value['preco'] = $value['preco_uni'];
                }
            }
        }

        return view('shopping-cart.show-catalogo-cart2', ['select' => $select, 'url' => $url,'sidebar' => $menu, 'topbar' => $top_menu, 'sort_by' => $order.'_'.$by, 'conservacao' => $type, 'familia' => $subtype, 'products' => $products]);
    }
    /* TEMP */
    public function getCatalogoFiltered(Request $request)
    {
        $user = \Auth::user();
       
       //$not_allowed = [ 'C010130022', 'C010130019', 'C010130016', 'C010130037','C010130038' ,'C010130035', 'C010130034','C010130029']; 

        if($user->cat_page_lite === 1)
        {

            $not_allowed = ['C010885001','C010885002','C010885003','C010885004','C010885005','C010885006','C010885007','C010885008','C010885009','C010885010','C010885011','C010885012','C010885013','C010885014','C010887001','C010887002','C010887003','C010887004','C010887005','C010887006','C010887007','C010887008','C010887009','C038026001','C038026002','C038026003','C038026004','C038026005','C038026006','C038026007','C038026008','C038026009', 'C038026010', 'C038026011','R038026000','R038026001','R038026002','C010130022', 'C010130019', 'C010130016', 'C010130036', 'C010130037','C010130038' , 'C010130039','C010130040', 'C010130041','C010130035', 'C010130034','C010130029','C010880001','C010880002','C010880003','C010880004','C010880005','C010880006','C010880007','C010880008','C010880009','C010880010','C010880011','C010880012','C010880013','C010880014','C010880015','C010880016','C010880017','C010880018','C010880019','C010880020','C010880021','C010880022','C010880023','C010880024','C010880025','C010880026','C010880027','C010880028','C010880029','C010880030','C010880031','C010880032','C010880033','C010880034','C010880035','C010880036','C010880037','C010880038','C010880039','C010880040','C010880041','C010880042','C010880043','C010880044','C010880045','C010880100','C010880101','C010880102','C010880103','C010880104','C010880105','C010880106','C010880107','C010880108','C010880109','C010880110','C010880111','C010880112','C010880113','C010880114','C010880115','C010880116','C010880117','C010880118','C010880119','C010880120','C010880121','C010880122','C010880123','C010880124','C010880125','C010880126','C010880127','C010880128','C010880129','C01088013','C010880130','C010880131','C010880132','C010880133','C010880134','C010880135','C010880136','C010884001','C010884002','C010884003','C010884004','C010884005','C010884006','C010884007','C010884008','C010884009','C010884010','C010884011','C010884012','C010884013','C010884014','C010884015','C010884016','C010884017','C010884018','C010884019','C010884020','C010884021','C010884022','C010884023','C010884024','C010883001','C010883002','C010883003','C010883004','C010883005','C010883006','C010883007','C010883008','C010883009','C010883010','C010883011','C010883012','C010883013','C010883014','C010883015','C010883016','C010883017','C010883018','C010881001','C010881002','C010881003','C010881004','C010881005','C010881006','C010881007','C010881008','C010881009','C010881010','C010881011','C010881012','C010881013','C010881014','C010881015','C010881016','C010881017','C010881018','C010881019','C010881020','C010881021','C010881022','C010881023','C010881024','C010881025','C010881026','C010881027','C010881028','C010881029','C010881030','C010881100','C010881101','C010881102','C010881103','C010881104','C010881105','C010881106','C010881107','C010881108','C010881109','C010881110','C010881111','C010881112','C010881113','C010881114','C010881115','C010881116','C010881117','C010881118','C010881119','C010881120','C010881121','C010881122','C010881123','C010881124','C010881125','C010881126','C010881127','C010881128','C010881129','C010881130','C010881131','C010881132','C010881133','C010881134','C010881135','C010881136','C010881137','C010881138','C010881139','C010881140','C010881141','C010881142','C010881143','C010881144','C010881145','C010881146','C010881147','C010881148','C010881149','C010881150','C010881151','C010881152','C010881153','C010881154','C010881155','C010881156','C010881157','C010881158','C010881159','C010881160','C010881161','C010881162','C010881163','C010881164','C010881165','C010881166','C010881167','C010881168','C010881169','C010881170','C010881171','C010881172','C010881173','C010881174','C010881175','C010881176','C010881177','C010881178','C010881179','C010881180','C010881181','C010881182','C010881183','C010881184','C010881185','C010881186','C010881187','C010881188','C010881189','C010881190','C010881191','C010881192','C010881193','C010881194','C010881195','C010881196','C010881197','C010881198','C010881199','C010881200','C010881201','C010881202','C010881203','C010881204','C010881205','C010881206','C010881207','C010881208','C010881209','C010881210','C010881211','C010881212','C010881213','C010881214','C010881215','C010881216','C010881217','C010881218','C010881219','C010881220','C010881221','C010881222','C010881223','C010881224','C010881225','C010881226','C010881227','C010881228','C010881229','C010881230','C010881231','C010881232','C010881233','C010881234','C010881235','C010881236','C010881237','C010881238','C010881239','C010881240','C010881241','C010881242','C010881243','C010881244']; 

            if ($request->ajax()) 
            {
                if ($request->input('_search')) 
                {
                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');
                    $products->where('name', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('number', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('origem', 'like', '%'.$request->input('_search').'%');
                    $products = $products->paginate(1500)->onEachSide(2); 

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type = 'all';
                    $subtype = 'all';

                    return view('shopping-cart.show-catalogo-result', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }else{
                    $conservacao    = $request->input('conservacao');
                    $familia        = $request->input('familia'); 

                    $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                    $subtype        = ($familia === 'all' ? '' : $familia);

                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');  
                            if (!empty($type)) {
                                $products->where('type', '=', $type);
                            }
                            if (!empty($subtype)) {
                                $products->where('alias_subtype', '=', $subtype);
                            }
                    
                    $products = $products->paginate(99)->onEachSide(2);

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type           = ($conservacao === '' ? 'all' : $conservacao);
                    $subtype        = ($familia === '' ? 'all' : $familia);

                    return view('shopping-cart.show-catalogo-result', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }
            }

            if ($request->input('conservacao') || $request->input('familia')) 
            {
                $conservacao    = $request->input('conservacao');
                $familia        = $request->input('familia'); 

                $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                $subtype        = ($familia === 'all' ? '' : $familia);

                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1');  
                        if (!empty($type)) {
                            $products->where('type', '=', $type);
                        }
                        if (!empty($subtype)) {
                            $products->where('alias_subtype', '=', $subtype);
                        }
                
                $products = $products->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }

                $type           = ($conservacao === '' ? 'all' : $conservacao);
                $subtype        = ($familia === '' ? 'all' : $familia);
            }else{
                $type = 'all';
                $subtype = 'all';
                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->where('catalogo_type', '=', '1')->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }
            }
        } 

        if($user->cat_page === 1)
        {

            $not_allowed = ['C010885001','C010885002','C010885003','C010885004','C010885005','C010885006','C010885007','C010885008','C010885009','C010885010','C010885011','C010885012','C010885013','C010885014','C010887001','C010887002','C010887003','C010887004','C010887005','C010887006','C010887007','C010887008','C010887009','C038026001','C038026002','C038026003','C038026004','C038026005','C038026006','C038026007','C038026008','C038026009', 'C038026010', 'C038026011','R038026000','R038026001','R038026002','C010130022', 'C010130019', 'C010130016', 'C010130036', 'C010130037','C010130038' , 'C010130039','C010130040', 'C010130041','C010130035', 'C010130034','C010130029','C010880001','C010880002','C010880003','C010880004','C010880005','C010880006','C010880007','C010880008','C010880009','C010880010','C010880011','C010880012','C010880013','C010880014','C010880015','C010880016','C010880017','C010880018','C010880019','C010880020','C010880021','C010880022','C010880023','C010880024','C010880025','C010880026','C010880027','C010880028','C010880029','C010880030','C010880031','C010880032','C010880033','C010880034','C010880035','C010880036','C010880037','C010880038','C010880039','C010880040','C010880041','C010880042','C010880043','C010880044','C010880045','C010880100','C010880101','C010880102','C010880103','C010880104','C010880105','C010880106','C010880107','C010880108','C010880109','C010880110','C010880111','C010880112','C010880113','C010880114','C010880115','C010880116','C010880117','C010880118','C010880119','C010880120','C010880121','C010880122','C010880123','C010880124','C010880125','C010880126','C010880127','C010880128','C010880129','C01088013','C010880130','C010880131','C010880132','C010880133','C010880134','C010880135','C010880136','C010884001','C010884002','C010884003','C010884004','C010884005','C010884006','C010884007','C010884008','C010884009','C010884010','C010884011','C010884012','C010884013','C010884014','C010884015','C010884016','C010884017','C010884018','C010884019','C010884020','C010884021','C010884022','C010884023','C010884024','C010883001','C010883002','C010883003','C010883004','C010883005','C010883006','C010883007','C010883008','C010883009','C010883010','C010883011','C010883012','C010883013','C010883014','C010883015','C010883016','C010883017','C010883018','C010881001','C010881002','C010881003','C010881004','C010881005','C010881006','C010881007','C010881008','C010881009','C010881010','C010881011','C010881012','C010881013','C010881014','C010881015','C010881016','C010881017','C010881018','C010881019','C010881020','C010881021','C010881022','C010881023','C010881024','C010881025','C010881026','C010881027','C010881028','C010881029','C010881030','C010881100','C010881101','C010881102','C010881103','C010881104','C010881105','C010881106','C010881107','C010881108','C010881109','C010881110','C010881111','C010881112','C010881113','C010881114','C010881115','C010881116','C010881117','C010881118','C010881119','C010881120','C010881121','C010881122','C010881123','C010881124','C010881125','C010881126','C010881127','C010881128','C010881129','C010881130','C010881131','C010881132','C010881133','C010881134','C010881135','C010881136','C010881137','C010881138','C010881139','C010881140','C010881141','C010881142','C010881143','C010881144','C010881145','C010881146','C010881147','C010881148','C010881149','C010881150','C010881151','C010881152','C010881153','C010881154','C010881155','C010881156','C010881157','C010881158','C010881159','C010881160','C010881161','C010881162','C010881163','C010881164','C010881165','C010881166','C010881167','C010881168','C010881169','C010881170','C010881171','C010881172','C010881173','C010881174','C010881175','C010881176','C010881177','C010881178','C010881179','C010881180','C010881181','C010881182','C010881183','C010881184','C010881185','C010881186','C010881187','C010881188','C010881189','C010881190','C010881191','C010881192','C010881193','C010881194','C010881195','C010881196','C010881197','C010881198','C010881199','C010881200','C010881201','C010881202','C010881203','C010881204','C010881205','C010881206','C010881207','C010881208','C010881209','C010881210','C010881211','C010881212','C010881213','C010881214','C010881215','C010881216','C010881217','C010881218','C010881219','C010881220','C010881221','C010881222','C010881223','C010881224','C010881225','C010881226','C010881227','C010881228','C010881229','C010881230','C010881231','C010881232','C010881233','C010881234','C010881235','C010881236','C010881237','C010881238','C010881239','C010881240','C010881241','C010881242','C010881243','C010881244']; 

            if ($request->ajax()) 
            {
                if ($request->input('_search')) 
                {
                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed);
                    $products->where('name', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('number', 'like', '%'.$request->input('_search').'%');
                    $products->orWhere('origem', 'like', '%'.$request->input('_search').'%');
                    $products = $products->paginate(1500)->onEachSide(2); 

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type = 'all';
                    $subtype = 'all';

                    return view('shopping-cart.show-catalogo-result', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }else{
                    $conservacao    = $request->input('conservacao');
                    $familia        = $request->input('familia'); 

                    $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                    $subtype        = ($familia === 'all' ? '' : $familia);

                    $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed);  
                            if (!empty($type)) {
                                $products->where('type', '=', $type);
                            }
                            if (!empty($subtype)) {
                                $products->where('alias_subtype', '=', $subtype);
                            }
                    
                    $products = $products->paginate(99)->onEachSide(2);

                    foreach ($products as $key => $value) 
                    {
                        if (!empty($value['short_name'])) 
                        {
                            $value['name'] = $value['short_name'];
                        }
                    }

                    $type           = ($conservacao === '' ? 'all' : $conservacao);
                    $subtype        = ($familia === '' ? 'all' : $familia);

                    return view('shopping-cart.show-catalogo-result', ['user' => $user,'conservacao' => $type, 'familia' => $subtype, 'products' => $products])->render();
                }
            }

            if ($request->input('conservacao') || $request->input('familia')) 
            {
                $conservacao    = $request->input('conservacao');
                $familia        = $request->input('familia'); 

                $type           = ($conservacao === 'all' ? '' : ucfirst($conservacao));
                $subtype        = ($familia === 'all' ? '' : $familia);

                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed);  
                        if (!empty($type)) {
                            $products->where('type', '=', $type);
                        }
                        if (!empty($subtype)) {
                            $products->where('alias_subtype', '=', $subtype);
                        }
                
                $products = $products->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }

                $type           = ($conservacao === '' ? 'all' : $conservacao);
                $subtype        = ($familia === '' ? 'all' : $familia);
            }else{
                $type = 'all';
                $subtype = 'all';
                $products = product::orderBy('number','ASC')->whereNOTIn('number', $not_allowed)->paginate(99)->onEachSide(2);

                foreach ($products as $key => $value) 
                {
                    if (!empty($value['short_name'])) 
                    {
                        $value['name'] = $value['short_name'];
                    }
                }
            }
        } 
  
        return view('shopping-cart.show-catalogo-cart', ['user' => $user, 'conservacao' => $type, 'familia' => $subtype, 'products' => $products]);
    }
    public function showFaq()
    {
        $user = \Auth::user();

        $data = [
            'user'      => $user
        ];

        return view('faq.show-faq')->with($data);
    }
    /*SHOP///////////////////////////////////////////////////////////////*/
    public function saveEncomenda3(Request $request)
    {
        $timestamp = Carbon::now();

        $validatedData = $request->validate([
            'material'          => 'required',
            'InputNome'         => 'required',
            'InputTelefone'     => 'required|integer|min:9|digits_between: 1,9', 
            'InputNif'          => 'required|integer|min:9|digits_between: 1,9',
            'InputEmail'        => 'required|email',
            'InputAddress'      => 'required',
            'InputCodPostal'    => 'required',
        ]);

        if (isset($request['material']) && isset($request['InputNome']) )
        {
            
            $client         = $request['InputNome'];
            $telefone       = $request['InputTelefone'];
            $nif            = $request['InputNif'];
            $current_email  = $request['InputEmail'];
            $morada         = $request['InputAddress'];
            $concelho       = $request['concelho']; 
            $order_date     = $request['order-date'];
            $cod_postal     = $request['InputCodPostal'];
            $valor_total    = $request['valor_total'];
            $nota           = $request['userNote'];

            if ($valor_total <= '45.00') 
            {
                $taxa = '10.00';
            }else{
                $taxa = '0.00';
            }
           
            $assunto        = 'Portal do Cliente - Encomenda Online';

            $materials['artigos']   = [];

            switch ($concelho) 
            {
                case 'funchal':
                    $concelho = 'Funchal';
                    break;
                case 'santa_cruz':
                    $concelho = 'Santa Cruz';
                    break;
                case 'machico':
                    $concelho = 'Machico';
                    break;
                case 'santana':
                    $concelho = 'Santana';
                    break;
                case 'camara_lobos':
                    $concelho = 'Câmara de Lobos';
                    break;
                case 'ribeira_brava':
                    $concelho = 'Ribeira Brava';
                    break;
                case 'porto_moniz':
                    $concelho = 'Porto Moniz';
                    break;
                case 'sao_vicente':
                    $concelho = 'São Vicente';
                    break;
                case 'calheta':
                    $concelho = 'Calheta';
                    break;
            }

            $i = 0;

            foreach ($request['material'] as $key => $value) 
            {
                if ($value > 0) 
                {
                    $materials['artigos'][$i]['codigo']        = $key;
                    $materials['artigos'][$i]['quantidade']    = $value;

                    $mat_name = DB::table('products')
                            ->select('name', 'preco', 'peso_venda')
                            ->where('number', '=', $key)
                            ->first();

                    if(isset($mat_name))
                    {
                        $materials['artigos'][$i]['name']       = $mat_name->name;
                        $materials['artigos'][$i]['preco']      = $mat_name->preco;
                        $materials['artigos'][$i]['peso_venda'] = $mat_name->peso_venda;
                    }
                }

                $i++;
            }

            $data = [
                    'material'      => $materials['artigos'],
                    'nome'          => $client,
                    'telefone'      => $telefone,
                    'nif'           => $nif,
                    'email'         => $current_email,
                    'morada'        => $morada,
                    'concelho'      => $concelho,
                    'order_date'    => $order_date,
                    'cod_postal'    => $cod_postal,
                    'valor_total'   => $valor_total,
                    'nota'          => $nota,
                    'assunto'       => $assunto,
                    'encomenda_id'  => '',
                    'taxa'          => $taxa
                ];      
            
            $encomenda= new Encomenda;

            $encomenda->cliente         = $client;
            $encomenda->telefone        = $telefone;
            $encomenda->nif             = $nif;
            $encomenda->email           = $current_email;
            $encomenda->data_entrega    = $order_date;
            $encomenda->data_encomenda  = $timestamp;
            $encomenda->morada          = $morada;
            $encomenda->valor           = $valor_total;
            $encomenda->notas           = $nota;

            //$encomenda->save();

            if ($encomenda->id) 
            {
                $data['encomenda_id'] = 'ANNONLINE'.$encomenda->id;
            }

            //dd($data);
            /*$mail_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
            $mail_cc_addresses  = ['vitor.nobrega@gruponobrega.pt', 'bruno.camacho@gruponobrega.pt'];
            $mail_bcc_addresses = ['ezequiel.vieira@gruponobrega.pt'];*/

            //EMAIL TO ENCOMENDAS
            $mail_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
            Mail::to($mail_addresses)
                ->send(new SendEncomendaMail2($data));

            //EMAIL TO CLIENT
            $mail_addresses1     = [$current_email, 'ezequiel.vieira@gruponobrega.pt'];
            Mail::to($mail_addresses1)
                ->send(new SendUserEncomendaMail2($data));

            // check for failures
            if (Mail::failures()) {
                // return response showing failed emails
                return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
            }else{
                session()->forget('cart2');
                return redirect('catalogo')->with('success', 'Encomenda realizada com sucesso. Muito Obrigado pela sua preferência!');
            }
        }else{
            return back()->with('error', 'Preencha todos os campos obrigatorios! Tente novamente sff! ');
        }
    }
    public function cart3()
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        return view('shopping-cart.cart3')->with($data);
    }
    //SEND ENCOMENDA EMAIL
    public function saveEncomenda2(Request $request)
    {
        //dd($request);
        $timestamp = Carbon::now();

        if ($request['user_type'] === 'registered_type' ) 
        {
            $validatedData = $request->validate([
                'material'          => 'required',
            ]);
            //dd($request);
            if (isset($request['material']) )
            {
                
                $userId = Auth::id();

                $account = User::find($userId)->account;

                $user = \Auth::user();

                $client         = $account['name'];
                $telefone       = $account['telefone'];
                $nif            = $account['nif'];
                $current_email  = $account['email1'];
                $morada         = $account['morada'];
                $concelho       = $account['localidade']; 
                $order_date     = '';
                $cod_postal     = $account['cod_postal'];
                $valor_total    = $request['valor_total'];
                $nota           = $request['userNote'];
                $id_sap         = $account['id_sap'];

                if ($valor_total <= '45.00') 
                {
                    $taxa = '10.00';
                }else{
                    $taxa = '0.00';
                }
               
                $assunto        = 'Portal do Cliente - Encomenda Online';

                $materials['artigos']   = [];

                switch ($concelho) 
                {
                    case 'funchal':
                        $concelho = 'Funchal';
                        break;
                    case 'santa_cruz':
                        $concelho = 'Santa Cruz';
                        break;
                    case 'machico':
                        $concelho = 'Machico';
                        break;
                    case 'santana':
                        $concelho = 'Santana';
                        break;
                    case 'camara_lobos':
                        $concelho = 'Câmara de Lobos';
                        break;
                    case 'ribeira_brava':
                        $concelho = 'Ribeira Brava';
                        break;
                    case 'porto_moniz':
                        $concelho = 'Porto Moniz';
                        break;
                    case 'sao_vicente':
                        $concelho = 'São Vicente';
                        break;
                    case 'calheta':
                        $concelho = 'Calheta';
                        break;
                }

                $i = 0;

                foreach ($request['material'] as $key => $value) 
                {
                    if ($value > 0) 
                    {
                        $materials['artigos'][$i]['codigo']        = $key;
                        $materials['artigos'][$i]['quantidade']    = $value;

                        $mat_name = DB::table('products')
                                ->select('name', 'preco_uni', 'peso_venda')
                                ->where('number', '=', $key)
                                ->first();

                        if(isset($mat_name))
                        {
                            $materials['artigos'][$i]['name']       = $mat_name->name;
                            $materials['artigos'][$i]['preco']      = $mat_name->preco_uni;
                            $materials['artigos'][$i]['peso_venda'] = $mat_name->peso_venda;
                        }
                    }

                    $i++;
                }

                $data = [
                        'material'      => $materials['artigos'],
                        'nome'          => $client,
                        'telefone'      => $telefone,
                        'nif'           => $nif,
                        'email'         => $current_email,
                        'morada'        => $morada,
                        'concelho'      => $concelho,
                        'order_date'    => $order_date,
                        'cod_postal'    => $cod_postal,
                        'valor_total'   => $valor_total,
                        'nota'          => $nota,
                        'assunto'       => $assunto,
                        'encomenda_id'  => '',
                        'taxa'          => $taxa,
                        'id_sap'        => $id_sap
                    ];      
                
                $encomenda= new Encomenda;

                $encomenda->cliente         = $client;
                $encomenda->telefone        = $telefone;
                $encomenda->nif             = $nif;
                $encomenda->email           = $current_email;
                $encomenda->data_entrega    = $order_date;
                $encomenda->data_encomenda  = $timestamp;
                $encomenda->morada          = $morada;
                $encomenda->valor           = $valor_total;
                $encomenda->notas           = $nota;

                $encomenda->save();

                if ($encomenda->id) 
                {
                    $data['encomenda_id'] = 'ANNONLINE'.$encomenda->id;
                }

                //dd($data);
                /*$mail_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
                $mail_cc_addresses  = ['vitor.nobrega@gruponobrega.pt', 'bruno.camacho@gruponobrega.pt'];
                $mail_bcc_addresses = ['ezequiel.vieira@gruponobrega.pt'];*/

                //EMAIL TO ENCOMENDAS
                $mail_addresses         = ['encomendas@gruponobrega.pt'];
                $mail_cc_addresses      = ['jose.dias@gruponobrega.pt'];
                $mail_bcc_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->bcc($mail_bcc_addresses)
                    ->send(new SendEncomendaMail($data));

                //EMAIL TO CLIENT
                $mail_addresses1     = [$current_email];
                $mail_bcc_addresses1  = ['ezequiel.vieira@gruponobrega.pt', 'vitor.nobrega@gruponobrega.pt'];
                Mail::to($mail_addresses1)
                    ->bcc($mail_bcc_addresses1)
                    ->send(new SendUserEncomendaMail($data));

                // check for failures
                if (Mail::failures()) {
                    // return response showing failed emails
                    return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
                }else{
                    session()->forget('cart2');
                    return redirect('catalogo')->with('success', 'Encomenda realizada com sucesso. Muito Obrigado pela sua preferência!');
                }
            }else{
                return back()->with('error', 'Preencha todos os campos obrigatorios! Tente novamente sff! ');
            }
        }else{

            $validatedData = $request->validate([
                'material'          => 'required',
                'InputNome'         => 'required',
                'InputTelefone'     => 'required|integer|min:9|digits_between: 1,9', 
                'InputNif'          => 'required|integer|min:9|digits_between: 1,9',
                'InputEmail'        => 'required|email',
                'InputAddress'      => 'required',
                'InputCodPostal'    => 'required',
            ]);

            if (isset($request['material']) && isset($request['InputNome']) )
            {
                
                $client         = $request['InputNome'];
                $telefone       = $request['InputTelefone'];
                $nif            = $request['InputNif'];
                $current_email  = $request['InputEmail'];
                $morada         = $request['InputAddress'];
                $concelho       = $request['concelho']; 
                $order_date     = $request['order-date'];
                $cod_postal     = $request['InputCodPostal'];
                $valor_total    = $request['valor_total'];
                $nota           = $request['userNote'];

                if ($valor_total <= '45.00') 
                {
                    $taxa = '10.00';
                }else{
                    $taxa = '0.00';
                }
               
                $assunto        = 'Portal do Cliente - Encomenda Online';

                $materials['artigos']   = [];

                switch ($concelho) 
                {
                    case 'funchal':
                        $concelho = 'Funchal';
                        break;
                    case 'santa_cruz':
                        $concelho = 'Santa Cruz';
                        break;
                    case 'machico':
                        $concelho = 'Machico';
                        break;
                    case 'santana':
                        $concelho = 'Santana';
                        break;
                    case 'camara_lobos':
                        $concelho = 'Câmara de Lobos';
                        break;
                    case 'ribeira_brava':
                        $concelho = 'Ribeira Brava';
                        break;
                    case 'porto_moniz':
                        $concelho = 'Porto Moniz';
                        break;
                    case 'sao_vicente':
                        $concelho = 'São Vicente';
                        break;
                    case 'calheta':
                        $concelho = 'Calheta';
                        break;
                }

                $i = 0;

                foreach ($request['material'] as $key => $value) 
                {
                    if ($value > 0) 
                    {
                        $materials['artigos'][$i]['codigo']        = $key;
                        $materials['artigos'][$i]['quantidade']    = $value;

                        $mat_name = DB::table('products')
                                ->select('name', 'preco', 'peso_venda')
                                ->where('number', '=', $key)
                                ->first();

                        if(isset($mat_name))
                        {
                            $materials['artigos'][$i]['name'] = $mat_name->name;
                            $materials['artigos'][$i]['preco']      = $mat_name->preco;
                            $materials['artigos'][$i]['peso_venda'] = $mat_name->peso_venda;
                        }
                    }

                    $i++;
                }

                $data = [
                        'material'      => $materials['artigos'],
                        'nome'          => $client,
                        'telefone'      => $telefone,
                        'nif'           => $nif,
                        'email'         => $current_email,
                        'morada'        => $morada,
                        'concelho'      => $concelho,
                        'order_date'    => $order_date,
                        'cod_postal'    => $cod_postal,
                        'valor_total'   => $valor_total,
                        'nota'          => $nota,
                        'assunto'       => $assunto,
                        'encomenda_id'  => '',
                        'taxa'          => $taxa
                    ];      
                
                $encomenda= new Encomenda;

                $encomenda->cliente         = $client;
                $encomenda->telefone        = $telefone;
                $encomenda->nif             = $nif;
                $encomenda->email           = $current_email;
                $encomenda->data_entrega    = $order_date;
                $encomenda->data_encomenda  = $timestamp;
                $encomenda->morada          = $morada;
                $encomenda->valor           = $valor_total;
                $encomenda->notas           = $nota;

                $encomenda->save();

                if ($encomenda->id) 
                {
                    $data['encomenda_id'] = 'ANNONLINE'.$encomenda->id;
                }

                //dd($data);
                /*$mail_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
                $mail_cc_addresses  = ['vitor.nobrega@gruponobrega.pt', 'bruno.camacho@gruponobrega.pt'];
                $mail_bcc_addresses = ['ezequiel.vieira@gruponobrega.pt'];*/

                //EMAIL TO ENCOMENDAS
                $mail_addresses         = ['encomendas@gruponobrega.pt'];
                $mail_cc_addresses      = ['jose.dias@gruponobrega.pt'];
                $mail_bcc_addresses     = ['ezequiel.vieira@gruponobrega.pt'];
                Mail::to($mail_addresses)
                    ->cc($mail_cc_addresses)
                    ->bcc($mail_bcc_addresses)
                    ->send(new SendEncomendaMail($data));

                //EMAIL TO CLIENT
                $mail_addresses1     = [$current_email];
                $mail_bcc_addresses1  = ['ezequiel.vieira@gruponobrega.pt', 'vitor.nobrega@gruponobrega.pt'];
                Mail::to($mail_addresses1)
                    ->bcc($mail_bcc_addresses1)
                    ->send(new SendUserEncomendaMail($data));

                // check for failures
                if (Mail::failures()) {
                    // return response showing failed emails
                    return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
                }else{
                    session()->forget('cart2');
                    return redirect('catalogo')->with('success', 'Encomenda realizada com sucesso. Muito Obrigado pela sua preferência!');
                }
            }else{
                return back()->with('error', 'Preencha todos os campos obrigatorios! Tente novamente sff! ');
            }
        }
    }
    //CATALOGO-CART
    public function showCatalogo1(Request $request)
    {
        $user = \Auth::user();

        $userId = Auth::id();

        $account = User::find($userId)->account;

        if($user->cat_page_lite === 1)
        {

            $allowed = [ 'C038026001', 'C038026002', 'C038026003', 'C038026004','C038026005' ,'C038026006', 'C038026007','C038026008', 'C038026009', 'C038026010', 'R038026000','R038026001','R038026002']; 

            $products = DB::table('products')
                         ->whereIn('number', $allowed)
                         ->orderBy('id','ASC')
                         ->get();      

            if(isset($products) && !empty($products))
            {
                $products_grid = '';

                foreach ($products as $key => $product) 
                {
                    switch ($product->type) 
                    {
                        case 'Congelado':
                            $product->category = 'congelados';
                            break;
                        case 'Ambiente':
                            $product->category = 'ambiente';
                            break;
                        case 'Refrigerado':
                            $product->category = 'refrigerados';
                            break;
                    }

                    switch ($product->number) 
                    {
                        //CABAZES////////////////////////////////
                        //CABRITO
                        case'R030496004': $product->price = '11.45'; $product->unity = 'KG'; break;
                        //BORREGO
                        case'R030496003': $product->price = '11.76'; $product->unity = 'KG'; break;
                        //PASCOA
                        case'C038026011': $product->price = '160.00'; $product->unity = 'UN'; break;
                        //PADARIA
                        case'C038026010': $product->price = '20.00'; $product->unity = 'UN'; break;
                        //VEGETARIANO
                        case'C038026009': $product->price = '40.00'; $product->unity = 'UN'; break;
                        //PIZZAS
                        case'C038026008': $product->price = '38.00'; $product->unity = 'UN'; break;
                        //PANADINHOS
                        case'C038026007': $product->price = '15.00'; $product->unity = 'UN'; break;
                        //PRE-COZINHADOS
                        case'C038026006': $product->price = '75.00'; $product->unity = 'UN'; break;
                        //CHARCUTARIA
                        case'R038026002': $product->price = '45.00'; $product->unity = 'UN'; break;
                        //VEGETAIS 7
                        case'C038026005': $product->price = '18.00'; $product->unity = 'UN'; break;
                        //CARNE REFRIGERADA 6
                        case'R038026001': $product->price = '90.00'; $product->unity = 'UN'; break;
                        //CARNE REFRIGERADA 5
                        case'R038026000': $product->price = '90.00'; $product->unity = 'UN'; break;
                        //CARNE CONGELADA 4
                        case'C038026004': $product->price = '45.00'; $product->unity = 'UN'; break;
                        //MARISCO 1
                        case'C038026001': $product->price = '25.00'; $product->unity = 'UN'; break;
                        //PEIXE 2
                        case'C038026002': $product->price = '65.00'; $product->unity = 'UN'; break;
                        //PEIXE 3
                        case'C038026003': $product->price = '50.00'; $product->unity = 'UN'; break;
                    }
                }
            }

            $data = [
                'cliente'   => $account,
                'products'  => $products
            ];

            return view('shopping-cart.show-catalogo5')->with($data);

        }else{

            if ($user->type === 'child') 
            {
                $company = User::find($user->parent_id)->account;

                if ($company->vendedor) {
                    switch ($company->vendedor) 
                    {
                        case '1014':
                            $vendedor['vendedor_nome']   = 'Miguel Drumond';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                            break;
                        case '1017':
                            $vendedor['vendedor_nome']   = 'José Dias';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                            break;
                        case '1025':
                            $vendedor['vendedor_nome']   = 'Jaime Afonso';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                            $vendedor['vendedor_telef']  = '967030318';
                            $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                            break;
                        case '1045':
                            $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                            $vendedor['vendedor_telef']  = '925881226';
                            $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                            break;
                        case '1053':
                            $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                            $vendedor['vendedor_telef']  = '962127299';
                            $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                            break;
                        case '1069':
                            $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                            $vendedor['vendedor_telef']  = '969658614';
                            $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                            break;
                        case '1080':
                            $vendedor['vendedor_nome']   = 'Alirio Conceição';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                            break;
                        case '1135':
                            $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                            $vendedor['vendedor_telef']  = '961309735';
                            $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                            break;
                        case '1145':
                            $vendedor['vendedor_nome']   = 'Aires Agrela';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '963470743';
                            $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                            break;
                        case '9999':
                            $vendedor['vendedor_nome']   = 'Aires Agrela';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '963470743';
                            $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                            break;
                    }
                }else{
                    $vendedor['vendedor_nome']   = 'Madeira Cash';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '291526839';
                    $vendedor['vendedor_email']  = 'carnes.madeiracash@ann.com.pt';
                }

            }else{
                switch ($account->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }
            
            if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
            {
                $vendedor['vendedor_nome']   = 'José Dias';
                $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                $vendedor['vendedor_telef']  = '925790722';
                $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
            }

            $products = DB::table('products')
                                ->orderBy('number', 'asc')
                                ->get();

            if(isset($products) && !empty($products))
            {
                $products_grid = '';

                foreach ($products as $key => $product) 
                {
                    switch ($product->type) 
                    {
                        case 'Congelado':
                            $product->category = 'congelados';
                            break;
                        case 'Ambiente':
                            $product->category = 'ambiente';
                            break;
                        case 'Refrigerado':
                            $product->category = 'refrigerados';
                            break;
                    }

                    $products_grid .= '<div class="element-item color-shape col col-sm-12 col-md-6 col-lg-3 '.$product->category.' '.$product->alias_subtype.'">';
                        $products_grid .= '<div class="card mb-4 hovereffect">';
                            $products_grid .= '<div class="img-hover-zoom">';
                                $products_grid .= ' <img width="" loading="eager" class="card-img" mousetip-pos="top center" mousetip mousetip-msg="'.$product->name.'" mousetip-css-padding="10px" alt="'.$product->name.'" src="'.$product->url.'">';
                            $products_grid .= '</div>';
                            $products_grid .= '<p class="text-center">';
                                $products_grid .= '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmPriceConsult" data-title="'.$product->name.'" data-image="'.$product->url.'" data-codigo="'.$product->number.'" data-vendedor="'.$vendedor['vendedor_nome'].'" data-vend_mail="'.$vendedor['vendedor_email'].'"> Consultar Preço </button>';
                            $products_grid .= '</p>';
                            $products_grid .= '<div class="card-body">';
                                $products_grid .= '<h4 class="card-title" style="height: 55px; font-size: 14px; line-height: 20px;padding-top:10px;"> '.$product->name.' </h4>';
                                $products_grid .= '<small class="text-muted cat">';
                                    $products_grid .= '<span class="float-left">';
                                    switch ($product->type) 
                                        {
                                            case 'Congelado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Ambiente':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Refrigerado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                        }
                                    $products_grid .= '</span>';
                                    $products_grid .= '<span class="float-right" title="'.mb_strtoupper($product->subfamily,'UTF-8').'">';
                                        //$products_grid .= '<i class="fas fa-barcode text-primary" title="Código de Produto"></i> '.$product->number.' ';
                                        $products_grid .= $product->number;
                                    $products_grid .= '</span>';
                                $products_grid .= '</small>';
                                //$products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';
                            $products_grid .= '</div>';
                        $products_grid .= '</div>';
                    $products_grid .= '</div>';
                }
            }

            $data = [
                'cliente'   => $account,
                'products'  => $products,
                'prod_grid' => $products_grid
            ];

            return view('catalogomanagement.show-catalogo5')->with($data);

        }

        /*$data = [
            'cliente'   => $account,
            'products'  => $products
        ];

        return view('shopping-cart.show-catalogo5')->with($data);*/
    }
    //CATALOGO-CART
    public function showCatalogoCart(Request $request)
    {
        $user = \Auth::user();

        $userId = Auth::id();

        $account = User::find($userId)->account;

        if($user->cat_page_lite === 1)
        {

            $allowed = [ 'C038026001', 'C038026002', 'C038026003', 'C038026004','C038026005' ,'C038026006', 'C038026007','C038026008', 'C038026009', 'C038026010', 'C038026011', 'R038026000','R038026001','R038026002']; 

            $hot_products = DB::table('products')
                         ->whereIn('number', $allowed)
                         ->orderBy('id','ASC')
                         ->get();

            $products = product::orderBy('id','ASC')->paginate(100,['*'],'pag');     

            if(isset($products) && !empty($products))
            {
                $products_grid = '';

                foreach ($products as $key => $product) 
                {
                    switch ($product->type) 
                    {
                        case 'Congelado':
                            $product->category = 'congelados';
                            break;
                        case 'Ambiente':
                            $product->category = 'ambiente';
                            break;
                        case 'Refrigerado':
                            $product->category = 'refrigerados';
                            break;
                    }

                    /*if (in_array($product->number, $allowed))
                    {
                        $hot_products[] = $product;
                    }*/
                }
            }

            $data = [
                'cliente'       => $account,
                'products'      => $products,
                'hot_products'  => $hot_products
            ];

            //return view('shopping-cart.show-catalogo-cart')->with($data);
            return view('shopping-cart.show-catalogo-cart', ['cliente' => $account,'products' => $products,'hot_products' => $hot_products]);
        }else{

            if ($user->type === 'child') 
            {
                $company = User::find($user->parent_id)->account;

                if ($company->vendedor) {
                    switch ($company->vendedor) 
                    {
                        case '1014':
                            $vendedor['vendedor_nome']   = 'Miguel Drumond';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                            break;
                        case '1017':
                            $vendedor['vendedor_nome']   = 'José Dias';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                            break;
                        case '1025':
                            $vendedor['vendedor_nome']   = 'Jaime Afonso';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                            $vendedor['vendedor_telef']  = '967030318';
                            $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                            break;
                        case '1045':
                            $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                            $vendedor['vendedor_telef']  = '925881226';
                            $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                            break;
                        case '1053':
                            $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                            $vendedor['vendedor_telef']  = '962127299';
                            $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                            break;
                        case '1069':
                            $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                            $vendedor['vendedor_telef']  = '969658614';
                            $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                            break;
                        case '1080':
                            $vendedor['vendedor_nome']   = 'Alirio Conceição';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '925790722';
                            $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                            break;
                        case '1135':
                            $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                            $vendedor['vendedor_telef']  = '961309735';
                            $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                            break;
                        case '1145':
                            $vendedor['vendedor_nome']   = 'Aires Agrela';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '963470743';
                            $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                            break;
                        case '9999':
                            $vendedor['vendedor_nome']   = 'Aires Agrela';
                            $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                            $vendedor['vendedor_telef']  = '963470743';
                            $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                            break;
                    }
                }else{
                    $vendedor['vendedor_nome']   = 'Madeira Cash';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '291526839';
                    $vendedor['vendedor_email']  = 'carnes.madeiracash@ann.com.pt';
                }
            }else{
                switch ($account->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }
            
            if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
            {
                $vendedor['vendedor_nome']   = 'José Dias';
                $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                $vendedor['vendedor_telef']  = '925790722';
                $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
            }

            $products = DB::table('products')
                                ->orderBy('number', 'asc')
                                ->get();

            if(isset($products) && !empty($products))
            {
                $products_grid = '';

                foreach ($products as $key => $product) 
                {
                    switch ($product->type) 
                    {
                        case 'Congelado':
                            $product->category = 'congelados';
                            break;
                        case 'Ambiente':
                            $product->category = 'ambiente';
                            break;
                        case 'Refrigerado':
                            $product->category = 'refrigerados';
                            break;
                    }

                    $products_grid .= '<div class="element-item color-shape col col-sm-12 col-md-6 col-lg-3 '.$product->category.' '.$product->alias_subtype.'">';
                        $products_grid .= '<div class="card mb-4 hovereffect">';
                            $products_grid .= '<div class="img-hover-zoom">';
                                $products_grid .= ' <img width="" loading="eager" class="card-img" mousetip-pos="top center" mousetip mousetip-msg="'.$product->name.'" mousetip-css-padding="10px" alt="'.$product->name.'" src="'.$product->url.'">';
                            $products_grid .= '</div>';
                            $products_grid .= '<p class="text-center">';
                                $products_grid .= '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmPriceConsult" data-title="'.$product->name.'" data-image="'.$product->url.'" data-codigo="'.$product->number.'" data-vendedor="'.$vendedor['vendedor_nome'].'" data-vend_mail="'.$vendedor['vendedor_email'].'"> Consultar Preço </button>';
                            $products_grid .= '</p>';
                            $products_grid .= '<div class="card-body">';
                                $products_grid .= '<h4 class="card-title" style="height: 55px; font-size: 14px; line-height: 20px;padding-top:10px;"> '.$product->name.' </h4>';
                                $products_grid .= '<small class="text-muted cat">';
                                    $products_grid .= '<span class="float-left">';
                                    switch ($product->type) 
                                        {
                                            case 'Congelado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Ambiente':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Refrigerado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                        }
                                    $products_grid .= '</span>';
                                    $products_grid .= '<span class="float-right" title="'.mb_strtoupper($product->subfamily,'UTF-8').'">';
                                        //$products_grid .= '<i class="fas fa-barcode text-primary" title="Código de Produto"></i> '.$product->number.' ';
                                        $products_grid .= $product->number;
                                    $products_grid .= '</span>';
                                $products_grid .= '</small>';
                                //$products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';
                            $products_grid .= '</div>';
                        $products_grid .= '</div>';
                    $products_grid .= '</div>';
                }
            }

            $data = [
                'cliente'   => $account,
                'products'  => $products,
                'prod_grid' => $products_grid
            ];

            return view('catalogomanagement.show-catalogo5')->with($data);
        }
    }
    public function cart()
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        //dd($data);
        
        return view('shopping-cart.cart2')->with($data);
    }
    public function addToCart2($id, $quantity)
    {
        $user = \Auth::user();

        $product = Product::find($id);

        if(!$product ) {
            abort(404);
        }

        switch ($product->iva) {
            case '0':
                $product->iva = '0';
                break;
            case '1':
                $product->iva = '22';
                break;
            case '2':
                $product->iva = '12';
                break;
            case '3':
                $product->iva = '5';
                break;               
            default:
                $product->iva = '0';
                break;
        }

        $cart = session()->get('cart2');

        if($user->type === 'default') {
            $product->preco_kg = $product->preco_uni;
        }else{
            $product->preco_kg = $product->preco_kg;
        }

        // if cart is empty then this the first product
        if(!$cart) {

            $cart = [
                $id => [
                    "name"          => $product->name,
                    "quantity"      => $quantity,
                    "price_un"      => $product->preco,
                    "price"         => $product->preco_kg,
                    "peso_venda"    => $product->peso_venda,
                    "tax"           => $product->iva,
                    "photo"         => $product->url,
                    "unity"         => $product->unit,
                    "codigo"        => $product->number
                ]
            ];

            session()->put('cart2', $cart);

            $htmlCart = view('partials.navbar')->render();

            return response()->json(['msg' => 'Produto adicionado!', 'data' => $htmlCart]);
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity'] = $quantity;

            session()->put('cart2', $cart);

             $htmlCart = view('partials.navbar')->render();

            return response()->json(['msg' => 'Produto adicionado!', 'data' => $htmlCart]);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name"          => $product->name,
            "quantity"      => $quantity,
            "price_un"      => $product->preco,
            "price"         => $product->preco_kg,
            "peso_venda"    => $product->peso_venda,
            "tax"           => $product->iva,
            "photo"         => $product->url,
            "unity"         => $product->unit,
            "codigo"        => $product->number
        ];

        session()->put('cart2', $cart);

        $htmlCart = view('partials.navbar')->render();

        return response()->json(['msg' => 'Produto adicionado!', 'data' => $htmlCart]);
    }
    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart2');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart2', $cart);

            switch ($cart[$request->id]['tax']) {
                case '0':
                    $cart[$request->id]['tax'] = '1';
                    break;
                case '22':
                    $cart[$request->id]['tax'] = '1.22';
                    break;
                case '12':
                    $cart[$request->id]['tax'] = '1.12';
                    break;
                case '5':
                    $cart[$request->id]['tax'] = '1.05';
                    break;               
                default:
                    $cart[$request->id]['tax'] = '1';
                    break;
            }

            $subTotal = round(( $cart[$request->id]['price'] * $cart[$request->id]['tax'] ) * $cart[$request->id]['quantity'] , 2); 

            $total = $this->getCartTotal2();

            $htmlCart = view('partials.navbar')->render();

            return response()->json(['msg' => 'Carrinho atualizado', 'data' => $htmlCart, 'total' => $total, 'subTotal' => $subTotal, 'quantidade' => $request->quantity]);

        }
    }
    public function remove2(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart2');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart2', $cart);
            }

            $total = $this->getCartTotal2();

            $htmlCart = view('partials.navbar')->render();

            return response()->json(['msg' => 'Produto removido', 'data' => $htmlCart, 'total' => $total]);
        }
    }
    private function getCartTotal2()
    {
        $total = 0;

        $cart = session()->get('cart2');

        foreach($cart as $id => $details) {

            switch ($details['tax']) {
                case '0':
                    $details['iva'] = '1';
                    break;
                case '22':
                    $details['iva'] = '1.22';
                    break;
                case '12':
                    $details['iva'] = '1.12';
                    break;
                case '5':
                    $details['iva'] = '1.05';
                    break;               
                default:
                    $details['iva'] = '1';
                    break;
            }

            $total += ( $details['price'] * $details['iva'] ) * $details['quantity']; 

            $total = round($total , 2);

            //$total += $details['price'] * $details['quantity'];
        }

        return number_format($total, 2);
    }
    /*SHOP//////////////////////////////////////////////////////////////*/
    // REGISTER USERS 
    public function showGestao()
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $usersList = User::all()->except(Auth::id())->where('email_verified_at', '=', NULL)->sortByDesc('id');

        $data = [
            'cliente'   => $account,
            'usersList' => $usersList
        ];

        return view('clientsmanagement.gerir_utilizadores')->with($data);
    }
    public function editUserVerification(User $user)
    {   
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $data = [
            'cliente'   => $account,
            'user'      => $user
        ];

        return view('clientsmanagement.edit_user')->with($data);
    }
    public function updateUserVerification(Request $request, User $user)
    { 
        if ($request['form_type'] === 'clionline') {
            $this->validate(request(), [
                'InputCodSap' => 'required'
            ]);

            $user->id_sap = sprintf('%010d', request('InputCodSap'));

        }

        $user->email_verified_at    = Carbon::now();

        $user->save();

        if ($request['form_type'] === 'clionline') {

            $AccountUpdateOrCreate = $user->account()->updateOrCreate(
                [
                    'user_id' => $user->id
                ], 
                [
                    'id_sap' => $user->id_sap
                ] );
        }

        $client_mail_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        $mail_bcc_addresses = ['ezequiel.vieira@gruponobrega.pt', 'joana.neves@gruponobrega.pt'];

        $data = [];

        Mail::to($client_mail_addresses)->bcc($mail_bcc_addresses)->send(new SendNewOnClientConfirmationMail($data));

        return redirect('gestao')->with('success', 'O Cliente foi ativado com sucesso!');

        //return back()->with('success', 'O Cliente foi ativado com sucesso!');
    }
    // REGISTER USERS
    public function criarCliente()
    {
        
        return view('clientsmanagement.create_client');
    }
    public function showPerfil(Request $request)
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        return view('catalogomanagement.show-cuts')->with($data);
    }
    public function showCortes(Request $request)
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        return view('catalogomanagement.show-cuts')->with($data);
    }
    public function showFamilias(Request $request)
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        $data = [
            'user'      => $user,
            'cliente'   => $account
        ];

        return view('catalogomanagement.show-family-tree')->with($data);
    }
    public function showFamilies(Request $request)
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $user = \Auth::user();

        if(empty($account)) 
        {
            $account = Auth::user();
        }

        //NO ACCESS
        if($user->family_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->family_page === 1) 
        {

            $data = [
                'user'      => $user,
                'cliente'   => $account
            ];

            return view('catalogomanagement.show-families')->with($data);
        }
    }
    public function consultPrice(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(),
            [
                'product_id'     => ['required']
            ]
        );

        if ($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }else{
            $user           = Auth::user();
            $current_email  = Auth::user()->email;
            $sap_id         = Auth::user()->id_sap;
            $client         = Auth::user()->name;
            
            $data = [
                'produto_name'      => $input['product_name'],
                'produto_codigo'    => $input['product_id'],
                'client'            => $client,
                'client_email'      => $current_email,
                'client_id'         => $sap_id,
                'vendedor'          => $input['vend_name'],
                'vendedor_email'    => $input['vend_mail']
            ];

            $mail_addresses     = [$input['vend_mail'], $current_email];
            $mail_cc_addresses  = ['ezequiel.vieira@gruponobrega.pt'];

            Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendPriceMail($data));

            // check for failures
            if (Mail::failures()) {
                // return response showing failed emails
                return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
            }else{
                return back()->with('success', 'Obrigado pelo seu Contato!');
            }
        }
    }
    //HOTNEWS
    public function sendHotNews(Request $request)
    {
        $input = $request->all();

        $element = $input['element'];

        $user = auth()->user();

        switch ($element) 
        {
            case 0:
                $hotnews = 1;
                break;
            case 1:
                $hotnews = 0;
                break;
        }

        $updateOrCreate = User::updateOrCreate(
        [
            'id' => $user->id
        ], 
        [
            'hot_news'  => $hotnews
        ] );

        if($updateOrCreate)
        {
            return response()->json(['success'=>'Data is successfully added']);
        }
    }
    //NEWSLETTER
    public function sendNewsletter2(Request $request)
    {
        $input = $request->all();

        $element = $input['element'];

        $user = auth()->user();

        switch ($element) 
        {
            case 0:
                $newsletter = 1;
                
                break;
            case 1:
                $newsletter = 0;
                
                break;
        }

        $updateOrCreate = User::updateOrCreate(
        [
            'id' => $user->id
        ], 
        [
            'newsletter'  => $newsletter
        ] );

        if($updateOrCreate)
        {
            return response()->json(['success'=>'Data is successfully added']);
        }
    }
    //PAGE OWNER - MANAGE USERS
    public function showUtilizadores()
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->owner_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->owner_page === 1) 
        {
            $account = User::find($user->id)->account;

            if (!empty($user)) 
            {
                $childUsers = DB::table('users')
                            ->where('id_sap', $user->id_sap)
                            ->where('id', '!=', Auth::user()->id)
                            ->get(); 
            }

            if(empty($account)) 
            {
                $account = $user;
            }

            $data = [
                'user'          => $user,
                'cliente'       => $account,
                'childUsers'    => $childUsers
            ];

            return view('usersmanagement.show-usersTable')->with($data);
        }
    }
    //PAGE OWNER - MANAGE USER PAGE ACCESS
    public function editUserRoles(Request $request)
    {
        $input = $request->all();

        if (!empty($input)) 
        {
            $element = explode('-', $input['element']); 

            $id     = $element[0];
            $page   = $element[1];
            $status = $element[2];

            switch ($status) 
            {
                case '0':
                    $status = 1;
                    break;
                case '1':
                    $status = 0;
                    break;
            }

            $updateOrCreate = User::updateOrCreate(
            [
                'id' => $id
            ], 
            [
                $page  => $status
            ] );

            if($updateOrCreate)
            {
                return response()->json(['success'=>'Data is successfully added']);
            }

        }else{
            return response()->json(['error'=>'Error in Ajax Request.']);
        }
    }
    public function newUserRole(Request $request)
    {
        $timestamp = Carbon::now();

        $rand = str_random(32);

        $validator = Validator::make($request->all(),
            [
                'name'                      => ['required', 'string', 'max:255'],
                'password'                  => ['required', 'string', 'min:8', 'confirmed'],
                'email'                     => ['required_with:password_confirmation | same:password_confirmation'],
                'password_confirmation'     => ['required']
            ]
        );

        if ($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

        $user                       = new User;
        $user->name                 = $request->name;
        $user->alias                = str_slug($request->name, '-');
        $user->email                = $request->email;
        $user->password             = Hash::make($request->password);
        $user->email_verified_at    = Carbon::now();
        $user->id_sap               = $request->sap_id;
        $user->parent_id            = $request->parent_id;
        $user->update_time          = $timestamp;
        $user->update_version       = $rand;
        $user->type                 = User::CHILD_TYPE;
        $user->owner_page           = 0;
        $user->users_page           = 0;
        $user->cco_page             = 0;
        $user->refunds_page         = 0;
        $user->orders_page          = 0;
        $user->cat_page             = 1;
        $user->news_page            = 1;
        $user->save();

        $id = $user->id;

        if($id)
        {
            $AccountUpdateOrCreate = $user->account()->updateOrCreate(
            [
                'user_id' => $id
            ], 
            [
                'name'                  => $request->name,
                'alias'                 => str_slug($request->name, '-'),
                'morada'                => NULL,
                'telefone'              => NULL,
                'telemovel'             => NULL,
                'email1'                => $request->email,
                'email2'                => $request->email,
                'email3'                => $request->email,
                'cod_postal'            => NULL,
                'localidade'            => NULL,
                'nif'                   => NULL,
                'vendedor'              => NULL,
                'vendedor_contato'      => NULL,
                'id_sap'                => $request->sap_id,
                'update_time'           => NULL,
                'update_version'        => NULL
            ] );

            return back()->with('success', 'Utilizador adicionado com sucesso!');

        }else{
            return back()->withErrors($validator)->withInput();
        }
    }
    public function deleteUserRole(Request $request)
    {
        $input = $request->all();

        if (!empty($input)) 
        {
            $ids_to_delete = User::destroy($input['parent_id']);
                
            if($ids_to_delete)
            {
                return redirect()->back()->with('success', 'Data is successfully deleted');
            }
        }else{
            return redirect()->back()->with('error', 'Error in Request.');
        }
    }
    //GET REFUND ORDERS
    public function getClientDevOrders()
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
    public function infoClient()
    {
        $userId = Auth::id();

        $user = auth()->user();

        //NO ACCESS
        if($user->perfil_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->perfil_page === 1) 
        {
            if ($user->type === 'child') 
            {
                $client     = DB::table('users')->where('id_sap', $user->id_sap)->first();
                $user       = auth()->user();
                $account    = User::find($client->id)['account'];
            }else{
                $account    = User::find($user->id)->account;
                $user       = auth()->user();
            }

            if (isset($account) && !empty($account))
            {
                switch ($account->vendedor) 
                {
                    case '1014':
                        $account['vendedor_nome']   = 'Miguel Drumond';
                        $account['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $account['vendedor_telef']  = '925790722';
                        $account['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $account['vendedor_nome']   = 'José Dias';
                        $account['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $account['vendedor_telef']  = '925790722';
                        $account['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $account['vendedor_nome']   = 'Jaime Afonso';
                        $account['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $account['vendedor_telef']  = '967030318';
                        $account['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $account['vendedor_nome']   = 'Tiago Saturnino';
                        $account['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $account['vendedor_telef']  = '925881226';
                        $account['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $account['vendedor_nome']   = 'Marco Rodrigues';
                        $account['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $account['vendedor_telef']  = '962127299';
                        $account['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $account['vendedor_nome']   = 'Paulo Chicharo';
                        $account['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $account['vendedor_telef']  = '969658614';
                        $account['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $account['vendedor_nome']   = 'Alirio Conceição';
                        $account['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $account['vendedor_telef']  = '925790722';
                        $account['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $account['vendedor_nome']   = 'Ezequiel Luís';
                        $account['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $account['vendedor_telef']  = '961309735';
                        $account['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $account['vendedor_nome']   = 'Aires Agrela';
                        $account['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $account['vendedor_telef']  = '963470743';
                        $account['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }

            $data = [
                'cliente'   => $account,
                'user'      => $user
            ];

            return view('clientsmanagement.show-client')->with($data);
        }
    }
    public function clientAccount()
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->cco_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->cco_page === 1) 
        {
            $timestamp = Carbon::now();

            $rand = str_random(32);

            $client_cco = $this->getCurrentAccount($user->id_sap);

            if(!empty($client_cco) && isset($client_cco[0]))
            {
                foreach ($client_cco as $key => $value) 
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
                        $CAccount->user_id          = $user->id;
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
                        $CAccount->user_id          = $user->id;
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

            //DELETE OLD CURRENT ACCOUNT ITEMS
            $deleteOldItems = $this->deleteOldItems($rand);

            $faturas_total      = [];
            $nota_cred_finan    = [];

            $credito_total      = [];

            $saldo_total        = [];
            $saldo_ft_prazo     = [];
            $saldo_ft_vencido   = [];

            $saldo_nc           = [];

            $data_atual = date('Y-m-d');
            $data_atual = strtotime($data_atual);

            if ($user->type === 'child') 
            {
                $account    = User::find($user->parent_id)->account;
                $docs       = User::find($user->parent_id)->current_account;
            }else{
                $account    = User::find($user->id)->account;
                $docs       = User::find($user->id)->current_account;
            }

            if(!empty($docs))
            {
                foreach ($docs as $key => $value) 
                {
                    $value->doc_value = number_format($value->doc_value, 2, '.', '');

                    $payment_date = strtotime($value->payment_date);

                    if($value->doc_tag === 'FT')
                    {
                        $result = mb_substr($value->doc_number, 0, 3);

                        if ($result === '009') 
                        {
                            $value->row_class = '';
                            $value->badge_class = 'badge-primary';
                            //LOGIC
                            if($payment_date < $data_atual)
                            {
                                $saldo_ft_vencido[] = $value->doc_value;
                                $value->row_class = 'table-danger';
                                $value->badge_class = 'badge-danger';
                            }else{
                                $saldo_ft_prazo[]   = $value->doc_value;
                            }
                        }elseif ($result === '020') 
                        {
                            $value->doc_tag = 'NC';
                            $value->row_class = 'table-danger';
                            $value->badge_class = 'badge-danger';
                            //LOGIC
                            $nota_cred_finan[] = $value->doc_value;
                        }
                    }

                    if($value->doc_tag === 'NC')
                    {
                        $value->row_class = 'table-warning';

                        $value->badge_class = 'badge-warning';

                        $saldo_nc[]   = $value->doc_value;
                    }
                }
            }
            
            //SOMATORIO VALORES
            $saldo_ft_prazo     = array_sum($saldo_ft_prazo);

            $saldo_ft_vencido   = array_sum($saldo_ft_vencido);

            $saldo_nc           = array_sum($saldo_nc);

            $saldo_nc_finan     = array_sum($nota_cred_finan);

            //TOTAIS
            $total_ncredito     = $saldo_nc+$saldo_nc_finan;

            $saldo_vencido      = $saldo_ft_vencido;

            $saldo_prazo        = $saldo_ft_prazo-$total_ncredito;

            $saldo_total        = $saldo_vencido+$saldo_prazo;

            $data = [
                'cliente'           => $account,
                'docs'              => $docs,
                'saldo_prazo'       => $saldo_prazo,
                'saldo_vencido'     => $saldo_vencido,
                'saldo_total'       => $saldo_total
            ];



            return view('accountmanagement.show-account-manager')->with($data);
        }
    }
    /* GET USER CONTA CORRENTE */
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
                'keep_alive'    => FALSE,
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
    // DELETE OLD ITEMS FROM CCO //
    public function deleteOldItems($update_version = NULL) 
    {
        if (isset($update_version) && !empty($update_version)) 
        {
            $items_to_delete = Current_account::where('update_version', '!=', $update_version)
                                ->get(['id']);

            $ids_to_delete = Current_account::destroy($items_to_delete->toArray());
            
        }
    }
    //NOVIDADES
    public function showNews()
    {
        $user = \Auth::user();
        //NO ACCESS
        if($user->news_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->news_page === 1) 
        {
            $account = User::find($user->id)->account;

            if ($user->type === 'child') 
            {
                $company = User::find($user->parent_id)->account;

                switch ($company->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }else{
                switch ($account->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }
            if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
            {
                $vendedor['vendedor_nome']   = 'José Dias';
                $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                $vendedor['vendedor_telef']  = '925790722';
                $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
            }

            $news = DB::table('news')
                    ->orderBy('id', 'desc')
                    ->get();

            $data = [
                'user'      => $user,
                'cliente'   => $account,
                'company'   => $vendedor,
                'news'      => $news
            ];

            return view('newsmanagement.show-news')->with($data);
        }
    }
    //CATALOGO
    public function showCatalogo()
    {
        $user = \Auth::user();

        $userId = Auth::id();

        $account = User::find($userId)->account;

        if ($user->type === 'child') 
        {
            $company = User::find($user->parent_id)->account;

            if ($company->vendedor) {
                switch ($company->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                    case '9999':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }else{
                $vendedor['vendedor_nome']   = 'Madeira Cash';
                $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                $vendedor['vendedor_telef']  = '291526839';
                $vendedor['vendedor_email']  = 'carnes.madeiracash@ann.com.pt';
            }
        }else{
            switch ($account->vendedor) 
            {
                case '1014':
                    $vendedor['vendedor_nome']   = 'Miguel Drumond';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                    break;
                case '1017':
                    $vendedor['vendedor_nome']   = 'José Dias';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                    break;
                case '1025':
                    $vendedor['vendedor_nome']   = 'Jaime Afonso';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                    $vendedor['vendedor_telef']  = '967030318';
                    $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                    break;
                case '1045':
                    $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                    $vendedor['vendedor_telef']  = '925881226';
                    $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                    break;
                case '1053':
                    $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                    $vendedor['vendedor_telef']  = '962127299';
                    $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                    break;
                case '1069':
                    $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                    $vendedor['vendedor_telef']  = '969658614';
                    $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                    break;
                case '1080':
                    $vendedor['vendedor_nome']   = 'Alirio Conceição';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                    break;
                case '1135':
                    $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                    $vendedor['vendedor_telef']  = '961309735';
                    $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                    break;
                case '1145':
                    $vendedor['vendedor_nome']   = 'Aires Agrela';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '963470743';
                    $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                    break;
            }
        }
        if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
        {
            $vendedor['vendedor_nome']   = 'José Dias';
            $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
            $vendedor['vendedor_telef']  = '925790722';
            $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
        }

        $products = DB::table('products')
                            ->orderBy('number', 'asc')
                            ->get();

        // ALLOWED PRODUCTS
        /*$allowed = [ 'A010550008','C010101003','C010108006','C010108016','C010108021','C010110007','C010111156','C010113023','C010115054','C010115028','C010116003','C010203011','C010205008','C010211006','C010213015','C010330132','C010330070','C010332044','C010338015','C010403009','C010406010','C010550356','C010550282','C010550230','C010552243','C010552246','C010552273','C010552288','C010553075','C010553067','C010553066','C010555002','C010554045', 'C010557006', 'C010557007','C010561019','C010561022','C010564009','C010660004','C010660057','C010660080','C010660090','C010661016','C010661018','C010663009','C010664022','C010888009','C010888008','C011000024','C011000019','C011000039','C011000037','C030196043','C030192016','C030294003','C030293001','C030296019','C030496002','C030193002','C030694044','C030694045','C030694047','C031296044','C031296012','C031293028','C031293020','R010110019','R010111019','R010112008','R010113002','R010771002','R010772001','R010772002','R010772003','R010772004','R010770121','R010900031','R010900075','R010900166' ];*/  

        $allowed = [ 'C010333005','C010332043','C031293021','C010339019','C030293001','C010338014','C030296015','C031293020','C031293019','C031293024','C030393005','C010338015','C030393004','C031296012','C010103009','C010330071','C010339010','C010402003','C010403009','C010215003','C010211006','C031294001','C031294002','C010332036','C031293018','C031293023','C031296011','C010330070','C010108017','C010108016','C010331045','C010558005','C010554013','C010566017','C010552072','C010567022','C010553047','C010550350','C010553069','C010558015','C010553070','c010550166','C010550348','C010550356','C010553073','C010552273','C010553067','C010550290','C010550381','C011000094','c010555005','C010550037','C010550036','C010556017','C010550073','C010550299','C010556010','C010550372','C010552141','C010550341','C010550172','C010550358','c010550069','C010550386','c010550166','C010550342','C010550174','R010772029','R010772010','R010772012','R010772017','R010772030','R010772019','R010772023','R010770121','R010770122','R010772028','R010772004','R010772002','R010772001','R010771007','R010771002','C030880033','C030880013','C010882004','C030880022','C030880032','C010882008','C010886033','C010886034','C010886032','C030881001','c010882006','C011000024','C011000019','C011000033','C011000069','C011000022','C011000017','C011000029','C010660015','C010660016','C010660007','C010661019','C010660026','C010660022','C010660090','C030694018','C030694045','C030694047','C030694044','C010660093','C030694028','C030694027','C030694033','C030694020','C010662009','C010662003','C010662004' ];      

        if(isset($products) && !empty($products))
        {
            $products_grid = '';

            $i = 1;

            foreach ($products as $key => $product) 
            {
                if (in_array($product->number, $allowed)) 
                { 
                    switch ($product->type) 
                    {
                        case 'Congelado':
                            $product->category = 'congelados';
                            break;
                        case 'Ambiente':
                            $product->category = 'ambiente';
                            break;
                        case 'Refrigerado':
                            $product->category = 'refrigerados';
                            break;
                    }

                    $products_grid .= '<div class="element-item color-shape col col-sm-12 col-md-6 col-lg-3 '.$product->category.' '.$product->alias_subtype.'">';
                        $products_grid .= '<div class="card mb-4 hovereffect">';
                            $products_grid .= '<div class="img-hover-zoom">';
                                $products_grid .= ' <img width="" loading="eager" class="card-img" mousetip-pos="top center" mousetip mousetip-msg="'.$product->name.'" mousetip-css-padding="10px" alt="'.$product->name.'" src="'.$product->url.'">';
                            $products_grid .= '</div>';
                            $products_grid .= '<p class="text-center">';
                                /*$products_grid .= '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmPriceConsult" data-title="'.$product->name.'" data-image="'.$product->url.'" data-codigo="'.$product->number.'" data-vendedor="'.$vendedor['vendedor_nome'].'" data-vend_mail="'.$vendedor['vendedor_email'].'"> Consultar Preço </button>';*/
                            $products_grid .= '</p>';
                            $products_grid .= '<div class="card-body">';
                                $products_grid .= '<h4 class="card-title" style="height: 55px; font-size: 14px; line-height: 20px;padding-top:10px;"> '.$product->name.' </h4>';
                                $products_grid .= '<small class="text-muted cat">';
                                    $products_grid .= '<span class="float-left">';
                                    switch ($product->type) 
                                        {
                                            case 'Congelado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Ambiente':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                            case 'Refrigerado':
                                                $products_grid .= strtoupper($product->type);
                                                break;
                                        }
                                    $products_grid .= '</span>';
                                    $products_grid .= '<span class="float-right" title="'.mb_strtoupper($product->subfamily,'UTF-8').'">';
                                        //$products_grid .= '<i class="fas fa-barcode text-primary" title="Código de Produto"></i> '.$product->number.' ';
                                        $products_grid .= $product->number;
                                    $products_grid .= '</span>';
                                $products_grid .= '</small>';
                                /*$products_grid .= '<small class="text-muted cat">';
                                    $products_grid .= '<span class="float-left">';
                                        $products_grid .= '<h1 class="card-title pricing-card-title">€10,00 <small class="text-muted">/ kg</small></h1>';
                                    $products_grid .= '</span>';
                                    $products_grid .= '<span class="float-right" title="">';
                                        $products_grid .= '<button type="submit" name="my-add-button" class="btn btn-primary btn-sm">Adicionar</button>';
                                    $products_grid .= '</span>';
                                $products_grid .= '</small>';*/
                                //$products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';
                            $products_grid .= '</div>';
                        $products_grid .= '</div>';
                    $products_grid .= '</div>';
                    $i++;
                }

            }
        }

        $data = [
            'cliente'   => $account,
            //'products'  => $products,
            'prod_grid' => $products_grid
        ];

        return view('catalogomanagement.show-catalogo5')->with($data);
    }
    //CATALOGO
    public function showCatalogo2()
    {
        $user = \Auth::user();

        $userId = Auth::id();

        $account = User::find($userId)->account;

        if ($user->type === 'child') 
        {
            $company = User::find($user->parent_id)->account;

            if ($company->vendedor) {
                switch ($company->vendedor) 
                {
                    case '1014':
                        $vendedor['vendedor_nome']   = 'Miguel Drumond';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                        break;
                    case '1017':
                        $vendedor['vendedor_nome']   = 'José Dias';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                        break;
                    case '1025':
                        $vendedor['vendedor_nome']   = 'Jaime Afonso';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                        $vendedor['vendedor_telef']  = '967030318';
                        $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                        break;
                    case '1045':
                        $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                        $vendedor['vendedor_telef']  = '925881226';
                        $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                        break;
                    case '1053':
                        $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                        $vendedor['vendedor_telef']  = '962127299';
                        $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                        break;
                    case '1069':
                        $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                        $vendedor['vendedor_telef']  = '969658614';
                        $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                        break;
                    case '1080':
                        $vendedor['vendedor_nome']   = 'Alirio Conceição';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '925790722';
                        $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                        break;
                    case '1135':
                        $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                        $vendedor['vendedor_telef']  = '961309735';
                        $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                        break;
                    case '1145':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                    case '9999':
                        $vendedor['vendedor_nome']   = 'Aires Agrela';
                        $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                        $vendedor['vendedor_telef']  = '963470743';
                        $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                        break;
                }
            }else{
                $vendedor['vendedor_nome']   = 'Madeira Cash';
                $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                $vendedor['vendedor_telef']  = '291526839';
                $vendedor['vendedor_email']  = 'carnes.madeiracash@ann.com.pt';
            }

        }else{
            switch ($account->vendedor) 
            {
                case '1014':
                    $vendedor['vendedor_nome']   = 'Miguel Drumond';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                    break;
                case '1017':
                    $vendedor['vendedor_nome']   = 'José Dias';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                    break;
                case '1025':
                    $vendedor['vendedor_nome']   = 'Jaime Afonso';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                    $vendedor['vendedor_telef']  = '967030318';
                    $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                    break;
                case '1045':
                    $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                    $vendedor['vendedor_telef']  = '925881226';
                    $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                    break;
                case '1053':
                    $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                    $vendedor['vendedor_telef']  = '962127299';
                    $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                    break;
                case '1069':
                    $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                    $vendedor['vendedor_telef']  = '969658614';
                    $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                    break;
                case '1080':
                    $vendedor['vendedor_nome']   = 'Alirio Conceição';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                    break;
                case '1135':
                    $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                    $vendedor['vendedor_telef']  = '961309735';
                    $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                    break;
                case '1145':
                    $vendedor['vendedor_nome']   = 'Aires Agrela';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '963470743';
                    $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                    break;
            }
        }
        if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
        {
            $vendedor['vendedor_nome']   = 'José Dias';
            $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
            $vendedor['vendedor_telef']  = '925790722';
            $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
        }

        $products = DB::table('products')
                            ->orderBy('number', 'asc')
                            ->get();

        if(isset($products) && !empty($products))
        {
            $products_grid = '';

            foreach ($products as $key => $product) 
            {
                switch ($product->type) 
                {
                    case 'Congelado':
                        $product->category = 'congelados';
                        break;
                    case 'Ambiente':
                        $product->category = 'ambiente';
                        break;
                    case 'Refrigerado':
                        $product->category = 'refrigerados';
                        break;
                }

                $products_grid .= '<div class="element-item color-shape col col-sm-12 col-md-6 col-lg-3 '.$product->category.' '.$product->alias_subtype.'">';
                    $products_grid .= '<div class="card mb-4 hovereffect">';
                        $products_grid .= '<div class="img-hover-zoom">';
                            $products_grid .= ' <img width="" loading="eager" class="card-img" mousetip-pos="top center" mousetip mousetip-msg="'.$product->name.'" mousetip-css-padding="10px" alt="'.$product->name.'" src="'.$product->url.'">';
                        $products_grid .= '</div>';
                        $products_grid .= '<p class="text-center">';
                            $products_grid .= '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#confirmPriceConsult" data-title="'.$product->name.'" data-image="'.$product->url.'" data-codigo="'.$product->number.'" data-vendedor="'.$vendedor['vendedor_nome'].'" data-vend_mail="'.$vendedor['vendedor_email'].'"> Consultar Preço </button>';
                        $products_grid .= '</p>';
                        $products_grid .= '<div class="card-body">';
                            $products_grid .= '<h4 class="card-title" style="height: 55px; font-size: 14px; line-height: 20px;padding-top:10px;"> '.$product->name.' </h4>';
                            $products_grid .= '<small class="text-muted cat">';
                                $products_grid .= '<span class="float-left">';
                                switch ($product->type) 
                                    {
                                        case 'Congelado':
                                            $products_grid .= strtoupper($product->type);
                                            break;
                                        case 'Ambiente':
                                            $products_grid .= strtoupper($product->type);
                                            break;
                                        case 'Refrigerado':
                                            $products_grid .= strtoupper($product->type);
                                            break;
                                    }
                                $products_grid .= '</span>';
                                $products_grid .= '<span class="float-right" title="'.mb_strtoupper($product->subfamily,'UTF-8').'">';
                                    //$products_grid .= '<i class="fas fa-barcode text-primary" title="Código de Produto"></i> '.$product->number.' ';
                                    $products_grid .= $product->number;
                                $products_grid .= '</span>';
                            $products_grid .= '</small>';
                            //$products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';
                        $products_grid .= '</div>';
                    $products_grid .= '</div>';
                $products_grid .= '</div>';
            }
        }

        $data = [
            'cliente'   => $account,
            'products'  => $products,
            'prod_grid' => $products_grid
        ];

        return view('catalogomanagement.show-catalogo5')->with($data);
    }
    public function showCatalogo6()
    {
        $user = \Auth::user();

        $userId = Auth::id();

        $account = User::find($userId)->account;

        if ($user->type === 'child') 
        {
            $company = User::find($user->parent_id)->account;

            switch ($company->vendedor) 
            {
                case '1014':
                    $vendedor['vendedor_nome']   = 'Miguel Drumond';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                    break;
                case '1017':
                    $vendedor['vendedor_nome']   = 'José Dias';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                    break;
                case '1025':
                    $vendedor['vendedor_nome']   = 'Jaime Afonso';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                    $vendedor['vendedor_telef']  = '967030318';
                    $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                    break;
                case '1045':
                    $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                    $vendedor['vendedor_telef']  = '925881226';
                    $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                    break;
                case '1053':
                    $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                    $vendedor['vendedor_telef']  = '962127299';
                    $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                    break;
                case '1069':
                    $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                    $vendedor['vendedor_telef']  = '969658614';
                    $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                    break;
                case '1080':
                    $vendedor['vendedor_nome']   = 'Alirio Conceição';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                    break;
                case '1135':
                    $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                    $vendedor['vendedor_telef']  = '961309735';
                    $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                    break;
                case '1145':
                    $vendedor['vendedor_nome']   = 'Aires Agrela';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '963470743';
                    $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                    break;
            }
        }else{
            switch ($account->vendedor) 
            {
                case '1014':
                    $vendedor['vendedor_nome']   = 'Miguel Drumond';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Miguel.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'miguel.drumond@gruponobrega.pt';
                    break;
                case '1017':
                    $vendedor['vendedor_nome']   = 'José Dias';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
                    break;
                case '1025':
                    $vendedor['vendedor_nome']   = 'Jaime Afonso';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Jaime.jpg';
                    $vendedor['vendedor_telef']  = '967030318';
                    $vendedor['vendedor_email']  = 'jaime.afonso@gruponobrega.pt';
                    break;
                case '1045':
                    $vendedor['vendedor_nome']   = 'Tiago Saturnino';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Tiago.jpg';
                    $vendedor['vendedor_telef']  = '925881226';
                    $vendedor['vendedor_email']  = 'tiago.saturnino@gruponobrega.pt';
                    break;
                case '1053':
                    $vendedor['vendedor_nome']   = 'Marco Rodrigues';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Marco.jpg';
                    $vendedor['vendedor_telef']  = '962127299';
                    $vendedor['vendedor_email']  = 'marco.rodrigues@gruponobrega.pt';
                    break;
                case '1069':
                    $vendedor['vendedor_nome']   = 'Paulo Chicharo';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Chicharo.jpg';
                    $vendedor['vendedor_telef']  = '969658614';
                    $vendedor['vendedor_email']  = 'paulo.chicharo@gruponobrega.pt';
                    break;
                case '1080':
                    $vendedor['vendedor_nome']   = 'Alirio Conceição';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '925790722';
                    $vendedor['vendedor_email']  = 'alirio.conceicao@gruponobrega.pt';
                    break;
                case '1135':
                    $vendedor['vendedor_nome']   = 'Ezequiel Luís';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Ezequiel.jpg';
                    $vendedor['vendedor_telef']  = '961309735';
                    $vendedor['vendedor_email']  = 'ezequiel.luis@gruponobrega.pt';
                    break;
                case '1145':
                    $vendedor['vendedor_nome']   = 'Aires Agrela';
                    $vendedor['vendedor_foto']   = '../images/images-vendedores/Aires.jpg';
                    $vendedor['vendedor_telef']  = '963470743';
                    $vendedor['vendedor_email']  = 'aires.agrela@gruponobrega.pt';
                    break;
            }
        }
        if ($user->type === 'admin' || $user->type === 'guest' || $user->type === 'vendedor') 
        {
            $vendedor['vendedor_nome']   = 'José Dias';
            $vendedor['vendedor_foto']   = '../images/images-vendedores/Dias.jpg';
            $vendedor['vendedor_telef']  = '925790722';
            $vendedor['vendedor_email']  = 'jose.dias@gruponobrega.pt';
        }

        $products = DB::table('products')
                            ->orderBy('number', 'asc')
                            ->get();

        if(isset($products) && !empty($products))
        {
            $products_grid = '';

            foreach ($products as $key => $product) 
            {
                switch ($product->type) 
                {
                    case 'Congelado':
                        $product->category = 'congelados';
                        break;
                    case 'Ambiente':
                        $product->category = 'ambiente';
                        break;
                    case 'Refrigerado':
                        $product->category = 'refrigerados';
                        break;
                }

                $products_grid .= '<div class="mix '.$product->category.' '.$product->alias_subtype.'" data-color="'.$product->category.'" data-size="'.$product->alias_subtype.'">';
                    /*$products_grid .= '<div class="img-hover-zoom">';
                        $products_grid .= ' <img loading="eager" class="card-img" alt="'.$product->name.'" src="'.$product->url.'">';
                    $products_grid .= '</div>';
                    $products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';*/
                    $products_grid .= '<div class="card mb-4 hovereffect">';
                        $products_grid .= '<div class="img-hover-zoom">';
                            $products_grid .= ' <img loading="eager" class="card-img" alt="'.$product->name.'" src="'.$product->url.'">';
                        $products_grid .= '</div>';
                        $products_grid .= '<div class="card-body">';
                            $products_grid .= '<h4 class="card-title" style="height: 75px"> '.$product->name.' </h4>';
                            $products_grid .= '<small class="text-muted cat">';
                                $products_grid .= '<span class="float-left">';
                                switch ($product->type) 
                                {
                                    case 'Congelado':
                                        $products_grid .= '<i class="far fa-snowflake text-primary" title="Conservação"></i> <span class="span_conservacao">'.strtoupper($product->type).'</span> ';
                                        break;
                                    case 'Ambiente':
                                        $products_grid .= '<i class="fas fa-bacon text-primary" title="Conservação"></i> <span class="span_conservacao">'.strtoupper($product->type).'</span> ';
                                        break;
                                    case 'Refrigerado':
                                        $products_grid .= '<i class="fas fa-temperature-low text-primary" title="Conservação"></i> <span class="span_conservacao">'.strtoupper($product->type).'</span> ';
                                        break;
                                }  
                                $products_grid .= '</span>';
                                $products_grid .= '<span class="float-right" title="'.mb_strtoupper($product->subfamily,'UTF-8').'">';
                                    $products_grid .= '<i class="fas fa-barcode text-primary" title="Código de Produto"></i> '.$product->number.' ';
                                $products_grid .= '</span>';
                            $products_grid .= '</small>';
                        $products_grid .= '</div>';
                    $products_grid .= '</div>';

                $products_grid .= '</div>';
            }
        }

        $data = [
            'cliente'   => $account,
            'products'  => $products,
            'prod_grid' => $products_grid
        ];

        return view('catalogomanagement.show-catalogo6')->with($data);
    }
    //LISTA DE DEVOLUCOES
    public function listDevolucoes()
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->refunds_page === 0)
        {
            return redirect()->route('home');
        }
        //HAVE ACCESS
        elseif($user->refunds_page === 1) 
        {
            if ($user->type === 'child') 
            {
                $account    = User::find($user->parent_id)->account;
                $docs       = User::find($user->parent_id)->documents;
            }else{
                $account    = User::find($user->id)->account;
                $docs       = User::find($user->id)->documents;
            }

            $data = [
                'cliente'       => $account,
                'docs'          => $docs,
                'current_user'  => $user
            ];

            return view('devolucaomanagement.list-devolucoes')->with($data);
        }
    }
    //SHOW DEVOLUCAO
    public function showDevolucao(Request $request)
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->refunds_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->refunds_page === 1) 
        {
            $account = User::find($user->id)->account;

            $devolucao_id = $request->devolucao_id;

            $document = Document::find($devolucao_id);

            $mats = DB::table('materials_has_documents')
                    ->where('document_id', '=', $devolucao_id)
                    ->leftJoin('materials', 'materials_has_documents.material_id', '=', 'materials.id')
                    ->leftJoin('documents', 'materials_has_documents.document_id', '=', 'documents.id')
                    ->get();

            $data = [
                'cliente'       => $account,
                'devolucao_id'  => $devolucao_id,
                'document'      => $document,
                'mats'          => $mats
            ];

            return view('devolucaomanagement.show-devolucao')->with($data);
        }
    }
    //SHOW ENCOMENDAS
    public function listEncomendas(Request $request)
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->orders_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->orders_page === 1) 
        {
            $account = User::find($user->id)->account;

            $clientOrders = $this->getClientOrders($account->id_sap);

            $total = count($clientOrders['all_items']);

            $data = [
                'cliente'       => $account,
                'encomendas'    => $clientOrders['all_items'],
                'total'         => $total
            ];

            return view('encomendamanagement.list-encomendas')->with($data);
        }
    }
    //SHOW ENCOMENDA
    public function showEncomenda($client_id, $encomenda_id)
    {
        $user = \Auth::user();

        //NO ACCESS
        if($user->orders_page === 0)
        {
            return redirect()->route('home');
        }//HAVE ACCESS
        elseif($user->orders_page === 1) 
        {
            $account = User::find($user->id)->account;

            $materials['all_items'] = [];

            $mats['all_items'] = $this->getDocMaterials($encomenda_id);

            foreach ($mats['all_items'] as $key => $value) {

                if (isset($value[0])) 
                {
                    $materials['all_items'] = $value;
                }else{
                    $materials['all_items'][0] = $value;
                }
            }

            $data = [
                'cliente'       => $account,
                'encomenda_id'  => $encomenda_id,
                'mats'          => $materials['all_items']
            ];

            return view('encomendamanagement.show-encomenda')->with($data);
        }
    }
    /* USER DEVOLUCAO DOCS - GET MATERIALS */
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
    // GET CLIENT ENCOMENDAS SAP
    public function getClientOrders($client_id)
    {
        //periodo 2 MESES
        $current_date = date("Ymd"); 
        $n_days_ago = new DateTime($current_date);
        $n_days_ago ->modify("-2000 days");
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
            'location'      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_encomendas_list/300/zws_get_encomendas_list/zws_get_encomendas_list'
            //'location'      => 'http://192.168.110.228:8001/sap/bc/srt/rfc/sap/zws_get_encomendas_v12/300/zws_get_encomendas_v12/zws_get_encomendas_v12'

            
        );

        //PHP OPTIONS
        ini_set('default_socket_timeout', 900);
        ini_set("soap.wsdl_cache_enabled", "0");
        libxml_disable_entity_loader(false);
            
        $wsdl = "http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/bndg_url/sap/bc/srt/rfc/sap/zws_get_encomendas_list/300/zws_get_encomendas_list/zws_get_encomendas_list?sap-client=300";
        //$wsdl = "http://192.168.110.228:8001/sap/bc/srt/wsdl/flv_10002A101AD1/bndg_url/sap/bc/srt/rfc/sap/zws_get_encomendas_v12/300/zws_get_encomendas_v12/zws_get_encomendas_v12?sap-client=300";

        //BUILD SOAP CLIENT INSTANCE
        $soap_client = new SoapClient($wsdl, $this->SOAP_OPTS);

        $params["ZS_VBAK"]   = 'ZS_VBAK';
        $params["ZT_VBAK"]   = 'ZT_VBAK';

        $params["ENC_DAT1"]  = $n_days_ago;
        $params["ENC_DAT2"]  = $current_date;

        $params["ZKUNNR"] = $client_id;

        $soap_client->ZANN_FM_GET_ENCOMENDAS($params);

        $data           = $soap_client->__getLastResponse();
        $plainXML       = $this->mungXML($data);
        $arrayResult    = json_decode(json_encode(SimpleXML_Load_String($plainXML, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        $tempData = [];

        if(isset($arrayResult['soap-env_Body']))
        {
            if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_GET_ENCOMENDASResponse']))
            {
                if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_GET_ENCOMENDASResponse']['ZT_VBAK']))
                {
                    if(isset($arrayResult['soap-env_Body']['n0_ZANN_FM_GET_ENCOMENDASResponse']['ZT_VBAK']['item']))
                    {
                        $tempData['all_items'] = $arrayResult['soap-env_Body']['n0_ZANN_FM_GET_ENCOMENDASResponse']['ZT_VBAK']['item'];
                    }else{
                        $tempData['all_items'] = [];
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
    //SEND CUSTOM DEVOLUCAO EMAIL
    public function sendCustomRefund(Request $request)
    {
        $validatedData = $request->validate([
            'InputDocumento'    => 'required',
            'InputNotas'        => 'required',
            'current_user_id'   => 'required',
            'current_user_name' => 'required',
            'current_company'   => 'required',
            'current_sap_id'    => 'required',
            'current_email'     => 'required'
        ]);

        if ($validatedData) 
        {
            $user               = $request['current_user_name'];
            $company            = $request['current_sap_id'];
            $current_email      = $request['current_email'];
            $sap_id             = $request['current_sap_id'];
            $assunto            = 'Portal do Cliente - Devolução: '.$request['InputDocumento'];
            $document_id        = $request['InputDocumento'];
            $notas              = $request['InputNotas'];

            $data = [
                    'email'     => $current_email,
                    'sap_id'    => $sap_id,
                    'nome'      => $user.'('.$company.')',
                    'document'  => $request['InputDocumento'],
                    'assunto'   => $assunto,
                    'notas'     => $notas,
                    'type'      => 'CustomRefund'
                    ];

            /*$mail_addresses = ['ezequiel.vieira@gruponobrega.pt'];

            Mail::to($mail_addresses)->send(new SendRefundMail($data));*/

            $mail_addresses = ['qualidade@gruponobrega.pt'];
            $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

            Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendRefundMail($data));

            // check for failures
            if (Mail::failures()) {
                // return response showing failed emails
                return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
            }else{
                return back()->with('success', 'Obrigado pelo seu Contato!');
            }
        }else{
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }
    }
    //SEND DEVOLUCAO EMAIL
    public function sendRefund(Request $request)
    {
        $validatedData = $request->validate([
            'material'  => 'required'
        ]);

        if (isset($request['material'])) 
        {
            $current_email  = Auth::user()->email;
            $sap_id         = Auth::user()->id_sap;
            $client         = Auth::user()->name;
            $assunto        = 'Portal do Cliente - Devolução: '.$request['ft_number'];
            $document_id    = $request['doc_number'];

            $materials['artigos']   = [];
            $materials['notes']     = [];

            if(isset($request['noteinput'])) 
            {
                foreach ($request['noteinput'] as $key => $value) 
                {
                    if ($value != NULL) 
                    {
                        $materials['notes'][$key] = $value;
                    }
                }
            }

            $i = 0;

            foreach ($request['material'] as $key => $value) 
            {
                if ($value > 0) 
                {
                    $pieces = explode("_", $key);
                    $materials['artigos'][$i]['codigo']        = $pieces[0];
                    $materials['artigos'][$i]['lote']          = $pieces[1];
                    $materials['artigos'][$i]['unidade']       = $pieces[2];
                    $materials['artigos'][$i]['quantidade']    = $pieces[3];
                    $materials['artigos'][$i]['devolver']      = $value;
                    $materials['artigos'][$i]['notas']         = '';

                    $mat_name = DB::table('materials')
                            ->select('name')
                            ->where('number', '=', $pieces[0])
                            ->first();

                    if(isset($mat_name))
                    {
                        $materials['artigos'][$i]['name'] = $mat_name->name;
                    }
                }

                $i++;
            }

            $i = 0;

            foreach ($materials['artigos'] as $key => $value) 
            {
                foreach ($materials['notes'] as $keys => $values) 
                {
                    if ($keys === $value['codigo']) 
                    {
                        $materials['artigos'][$key]['notas'] = $values;
                    }
                }

                $i++;
            }

            $data = [
                    'material'  => $materials['artigos'],
                    'email'     => $current_email,
                    'sap_id'    => $sap_id,
                    'nome'      => $client,
                    'document'  => $request['ft_number'],
                    'assunto'   => $assunto,
                    'type'      => 'NormalRefund'
                ];               

            $mail_addresses = ['qualidade@gruponobrega.pt'];
            $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

            Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendRefundMail($data));

            // check for failures
            if (Mail::failures()) {
                // return response showing failed emails
                return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
            }else{
                return back()->with('success', 'Obrigado pelo seu Contato!');
            }
        }else{
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }
    }
    //////////////
    //EMAILS
    //////////////
    public function sendChangePerfilMail(Request $request)
    {
        $this->validate($request, [
            'morada'        =>  'required_without_all:cod_postal,localidade,telefone,telemovel',
            'cod_postal'    =>  'required_without_all:morada,localidade,telefone,telemovel',
            'localidade'    =>  'required_without_all:morada,cod_postal,telefone,telemovel',
            'telefone'      =>  'required_without_all:morada,cod_postal,localidade,telemovel',
            'telemovel'     =>  'required_without_all:morada,cod_postal,localidade,telefone'
        ]);

        $current_email  = Auth::user()->email;
        $client         = Auth::user()->name;
        $sap_id         = Auth::user()->id_sap;

        $data = array(
            'assunto'       =>  'Portal do Cliente - Alteração de dados de Perfil',
            'name'          =>  $client,
            'morada'        =>  $request->morada,
            'cod_postal'    =>  $request->cod_postal,
            'localidade'    =>  $request->localidade,
            'telefone'      =>  $request->telefone,
            'telemovel'     =>  $request->telemovel,
            'sap_id'        =>  $sap_id
        );

        $mail_addresses = ['isabel.fernandes@gruponobrega.pt', 'marisela.caires@gruponobrega.pt'];

        $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendChangePerfilMail($data));

        //Mail::to($mail_addresses)->send(new SendChangePerfilMail($data))->bcc('ezequiel.vieira@gruponobrega.pt', 'Ezequiel Vieira');

        // check for failures
        if (Mail::failures()) 
        {
            // return response showing failed emails
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }else{
            return back()->with('success', 'Obrigado pelo seu Contato!');
        }
    }
    public function sendChangeEmailMail(Request $request)
    {
        $this->validate($request, [
            'email_novo'    => 'required_with:email_novo_2|same:email_novo_2',
            'email_novo_2'  => 'required'
        ]);

        $current_email  = Auth::user()->email;
        $sap_id         = Auth::user()->id_sap;
        $client         = Auth::user()->name;

        $data = array(
            'assunto'   =>  'Portal do Cliente - Alteração de Email',
            'name'      =>  $client,
            'sap_id'    =>  $sap_id,
            'message'   =>  $request->email_novo
        );

        $mail_addresses = ['isabel.fernandes@gruponobrega.pt', 'marisela.caires@gruponobrega.pt'];

        $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendChangeEmailMail($data));

        /*Mail::to($mail_addresses)
            ->send(new SendChangeEmailMail($data))
            ->bcc('ezequiel.vieira@gruponobrega.pt', 'Ezequiel Vieira');*/

        // check for failures
        if (Mail::failures()) {
            // return response showing failed emails
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }else{
            return back()->with('success', 'Obrigado pelo seu Contato!');
        }  
    }
    public function sendQuestionMail(Request $request)
    {
        $this->validate($request, [
            'question_opt'      =>  'required'
        ]);

        $current_email  = Auth::user()->email;
        $sap_id         = Auth::user()->id_sap;
        $client         = Auth::user()->name;

        $data = array(
            'assunto'   =>  'Portal do Cliente - Questionário',
            'name'      =>  $client,
            'sap_id'    =>  $sap_id,
            'message'   =>  $request->question_opt
        );

        $mail_addresses = ['vitor.nobrega@gruponobrega.pt', 'jose.dias@gruponobrega.pt'];

        $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendQuestionMail($data));

        /*$mail_addresses = ['vitor.nobrega@gruponobrega.pt', 'jose.dias@gruponobrega.pt'];

        Mail::to($mail_addresses)
            ->send(new SendQuestionMail($data))
            ->bcc('ezequiel.vieira@gruponobrega.pt', 'Ezequiel Vieira');*/

        // check for failures
        if (Mail::failures()) {
            // return response showing failed emails
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }else{
            return back()->with('success', 'Obrigado pelo seu Contato!');
        }
    }
    public function sendContactMail(Request $request)
    {
        $this->validate($request, [
            'select_assunto'    =>  'required',
            'name'              =>  'required',
            'message'           =>  'required'
        ]);

        $current_email  = Auth::user()->email;

        $sap_id         = Auth::user()->id_sap;

        $data = array(
            'assunto'   =>  $request->select_assunto,
            'name'      =>  $request->name,
            'sap_id'    =>  $sap_id,
            'message'   =>  $request->message
        );

        $mail_addresses = ['vitor.nobrega@gruponobrega.pt'];

        $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendContactMail($data));

        // check for failures
        if (Mail::failures()) {
            // return response showing failed emails
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }else{
            return back()->with('success', 'Obrigado pelo seu Contato!');
        }
    }
    public function sendNewClientMail(Request $request)
    {
        $current_email  = Auth::user()->email;
        $current_name   = Auth::user()->name;

        $data = array(
            'assunto'                   =>  'Novo Cliente',
            'nome_vendedor'             =>  $current_name,
            'nome_cliente'              =>  $request->InputGuestName,
            'nif_cliente'               =>  $request->InputNIF,
            'telefone_cliente'          =>  $request->InputTelefone,
            'telemovel_cliente'         =>  $request->InputTelemovel,
            'email_cliente'             =>  $request->InputGuestEmail,
            'morada_cliente'            =>  $request->InputMoradaFiscal,
            'nome_cliente_receptor'     =>  $request->InputReceptorName,
            'morada_cliente_receptor'   =>  $request->InputMoradaFiscalReceptor,
            'telefone_cliente_receptor' =>  $request->InputReceptorTelefone,
            'contato_responsavel'       =>  $request->InputContatoResponsavel,
            'pagamento_cliente'         =>  $request->InputCPagamento,
            'metodo_pagamento_cliente'  =>  $request->InputMPagamento
        );

        $mail_addresses = ['isabel.fernandes@gruponobrega.pt'];

        $mail_cc_addresses = ['ezequiel.vieira@gruponobrega.pt'];

        Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendNewClientMail($data));

        // check for failures
        if (Mail::failures()) {
            // return response showing failed emails
            return back()->with('error', 'Ocorreu um erro! Tente novamente sff! ');
        }else{
            return back()->with('success', 'Obrigado pelo seu Contato!');
        }
    }
    //////////////
    //EDIT
    //////////////
    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password)))
        {
            // The passwords matches
            return redirect()->back()->with("error","A password inserida não corresponde com password fornecida. tente novamente.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            //Current password and new password are same
            return redirect()->back()->with("error","A nova Password não pode ser igual à atual. Por favor escolher uma diferente.");
        }

        $validatedData = $request->validate([
            'current-password'  => 'required',
            'new-password'      => 'required|string|min:6|confirmed',
        ]);
        
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request['new-password']); 
        //bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password alterada com sucesso!!!");
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

