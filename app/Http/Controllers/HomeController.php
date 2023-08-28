<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SsbLead;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.gi
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ssb_leads = SsbLead::get();
        return view('home', compact('ssb_leads'));
    }

    public function completed(Request $request)
    {
    // $ssb_leads = SsbLead::where('is_completed',1)->get();
    $duration = $request->input('duration');

    // Fetch records based on the selected duration
    if ($duration == 3) {
        $ssb_leads = SsbLead::where('is_completed', 1)->get();
    } 
    else if ($duration == 2) {
        $ssb_leads = SsbLead::where('is_completed', 0)->get();
    } 
    else {
        
    }   
    return view('home', compact('ssb_leads'));
    }
}
