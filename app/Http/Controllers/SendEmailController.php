<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    //
    function index()
    {
        return view('site.home.fr.contact');
    }

    function send(Request $request){

        $this->validate($request,[
            'Name' => 'required',
            'Email' => 'required',
            'Services' => 'required',
            'Objet' => 'required',
            'Message' => 'required'
        ]);
    }
}
