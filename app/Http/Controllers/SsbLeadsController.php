<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SsbLead;

class SsbLeadsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming data
       

        // Create a new SsbLead record
        $ssbLead = SsbLead::create([
            'case_id' => $request->input('case_id'),
            'uid' => $request->input('uid'),
            'source_id' => $request->input('source_id'),
            'docs' => $request->input('docs')
            // Add more fields as needed
        ]);

        return response()->json([
            'message' => 'SsbLead created successfully',
            'data' => $ssbLead,
        ], 201);
    }
}
