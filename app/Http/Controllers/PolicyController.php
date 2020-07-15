<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function readTermsConditions()
    {
        return view('terms_conditions.termos_e_condicoes');
    }

    public function readPrivacyPolitics()
    {
        return view('terms_conditions.politica_de_privacidade');
    }
}
