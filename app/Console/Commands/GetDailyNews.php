<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\News;

use Carbon\Carbon;

use Auth;

use DB;

use DateTime;

use Illuminate\Support\Facades\Mail;

use App\Mail\SendHotNewsMail;

class GetDailyNews extends Command
{
    protected $signature = 'dailynews:list';
    protected $description = 'Get all new daily products';

    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $current_date = date("Y-m-d"); 
        $n_days_ago = new DateTime($current_date);
        $n_days_ago ->modify("-1 days");
        $n_days_ago = $n_days_ago ->format("Y-m-d");

        $clients = DB::table('users')
                        ->where('type', '!=', 'admin')
                        ->where('email_verified_at', '!=', '')
                        ->where('hot_news', '=', 1)
                        ->get();

        $news = DB::table('news')
                ->orderBy('id', 'desc')
                ->whereBetween('created_at', [$n_days_ago, \Carbon\Carbon::now()->format('Y-m-d')])
                ->get();

        if($clients->first() && $news->first())
        {
            foreach ($clients as $key => $value) 
            {
                $email = $value->email;

                //EMAIL DATA
                $mail_addresses     = [$email];
                $mail_cc_addresses  = ['ezequiel.vieira@gruponobrega.pt']; 

                $data = [
                    'data'          => $news,
                    'client'        => $value,
                    'fetch_type'    => 'Últimas Novidades'
                ];

                Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendHotNewsMail($data));
            }
        }
    }
}
