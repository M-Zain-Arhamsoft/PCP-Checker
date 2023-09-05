<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimaryLeadsController extends Controller
{
    //
    public function create(){
        return view('createprimary');
    }
    public function store(Request $request){

    }
}
