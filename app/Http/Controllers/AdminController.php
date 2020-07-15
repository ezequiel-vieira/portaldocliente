<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

use Log;

use DateTime;

use Config;

use SoapClient;

use PDO;

use Auth;

use App\User;

use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function criarGuest()
    {
        return view('admin.create_user');
    }
    public function saveGuest(Request $request)
    {
        $timestamp = Carbon::now();

        $rand = str_random(32);

        $validator = Validator::make($request->all(),
            [
                'InputGuestName'                        => ['required', 'string', 'max:255'],
                'InputGuestPassword'                    => ['required', 'string', 'min:6', 'confirmed'],
                'InputGuestEmail'                       => ['required', 'email'],
                'InputGuestPassword_confirmation'       => ['required_with:InputGuestPassword | same:InputGuestPassword']
            ]
        );

        $userType = $request->userType;

        if ($userType) 
        {
            switch ($userType) {
                case 'optionGuest':
                    $userTypeValue = User::GUEST_TYPE;
                    break;
                case 'optionVendedor':
                    $userTypeValue = User::VENDEDOR_TYPE;
                    break;
            }
        }

        if ($validator->fails()) 
        {
            return back()->withErrors($validator)->withInput();
        }

        $user                       = new User;
        $user->name                 = $request->InputGuestName;
        $user->alias                = str_slug($request->InputGuestName, '-');
        $user->email                = $request->InputGuestEmail;
        $user->password             = Hash::make($request->InputGuestPassword);
        $user->email_verified_at    = Carbon::now();
        $user->id_sap               = NULL;
        $user->parent_id            = NULL;
        $user->update_time          = $timestamp;
        $user->update_version       = $rand;
        $user->type                 = $userTypeValue;
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


        return view('admin.create_user');
    }
    public function getAllClientes()
    {
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $usersList = User::all()->except(Auth::id());

        $data = [
            'cliente'   => $account,
            'usersList' => $usersList
        ];

        return view('admin.users')->with($data);
    }
    public function edit(User $user)
    {   
        $userId = Auth::id();

        $account = User::find($userId)->account;

        $data = [
            'cliente'   => $account,
            'user'      => $user
        ];

        return view('admin.edit_user')->with($data);
    }
    public function update(Request $request, User $user)
    { 
        $this->validate(request(), [
            'email' => 'required|email|unique:users'
        ]);

        $user->email = request('email');

        $user->save();

        return back()->with('success', 'O Email foi atualizado com sucesso!');
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
