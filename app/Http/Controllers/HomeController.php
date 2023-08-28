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
        $duration = $request->input('duration');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $search_term = $request->input('search_term'); 

        $ssb_leads_query = SsbLead::query();

        if ($duration == 3) {
            $ssb_leads_query->where('is_completed', 1);
        } elseif ($duration == 2) {
            $ssb_leads_query->where('is_completed', 0);
        }

        if ($start_date) {
            $ssb_leads_query->where('created_at', '>=', $start_date);
        }

        if ($end_date) {
            $ssb_leads_query->where('updated_at', '<=', $end_date);
        }

        if ($search_term) {
            $ssb_leads_query->where(function ($query) use ($search_term) {
                $query->where('case_description', 'like', '%' . $search_term . '%');
                    // ->orWhere('field2', 'like', '%' . $search_term . '%'); 
            });
        }

        $ssb_leads = $ssb_leads_query->get();

        return view('home', compact('ssb_leads'));
    }
}
