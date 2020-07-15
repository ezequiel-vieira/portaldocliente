<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Mail\SendNewsletterMail;
use Auth;
use DB;
use DateTime;

class GetNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'month news';

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
        $current_date = date("Y-m-d"); 
        $n_days_ago = new DateTime($current_date);
        $n_days_ago ->modify("-30 days");
        $n_days_ago = $n_days_ago ->format("Y-m-d");

        $clients =  DB::table('users')
                    ->where('type', '!=', 'admin')
                    ->where('email_verified_at', '!=', '')
                    ->where('newsletter', '=', 1)
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

                Mail::to($mail_addresses)->cc($mail_cc_addresses)->send(new SendNewsletterMail($data));
            }
        }
    }
}
