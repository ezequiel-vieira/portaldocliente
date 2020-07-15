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

use App\Mail\SendHotNewsMail;

class GetHotNews extends Command
{
    protected $signature = 'hotnews:list';
    protected $description = 'Get all hot new products';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $current_date = date("Y-m-d"); 
        $n_days_ago = new DateTime($current_date);
        $n_days_ago ->modify("-3 days");
        $n_days_ago = $n_days_ago ->format("Y-m-d");



        $news = DB::table('news')
                ->orderBy('id', 'desc')
                ->whereBetween('created_at', [$n_days_ago, \Carbon\Carbon::now()->format('Y-m-d')])
                ->get();

        $data = [
            'hot_news'      => $news,
            'fetch_type'    =>  'Últimas Novidades'
        ];
    }
}
