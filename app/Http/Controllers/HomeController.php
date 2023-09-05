<?php

namespace App\Http\Controllers;

use App\Models\PrimaryLead;
use Illuminate\Http\Request;
use App\Models\SsbLead;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Exports\SsbLeadsExport;
use App\Imports\SsbLeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Response;

use App\Exports\SsbLeadsPdfExport;
use Illuminate\Support\Facades\Storage;


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


    public function index(Request $request)
    {
        $duration = $request->input('duration', 1);
        $start_date = $request->input('start_date', Carbon::now()->format('Y-m-d'));
        $end_date = $request->input('end_date', Carbon::now()->format('Y-m-d'));

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

        $ssb_leads = $ssb_leads_query->get();

        return view('home', compact('ssb_leads', 'duration', 'start_date', 'end_date'));
    }






    public function create()
    {
        return view('create');
    }

    public function storessb(Request $request)
    {

       

        //$docsPath = null;
        $path = null;
        if ($request->hasFile('docs')) {
            // Generate a unique folder name using a timestamp
            $folderName = now()->format('Y-m-d-H-i-s');
            $file = $request->file('docs');
            // Store the file in the 'docs' folder within the generated folder
            // $docsPath = $request->file('docs')->store('app/docs');
            $path = Storage::disk('public')->put('docs', $file);
        }

        // Prepare data for insertion
        $data = [

            'created_at' => $request->input('create_date'),
            'updated_at' => $request->input('updated_date'),
            'documented_date' => $request->input('documented'),
            'case_id' => $request->input('caseid'),
            'uid' => $request->input('uid'),
            'source_id' => $request->input('sourceid'),
            'is_completed' => $request->input('iscompleted'),
            'case_description' => $request->input('casedescription'),
            'docs' => $path, // Save the file path

        ];

        // Insert data into the 'ssb_leads' table
        DB::table('ssb_leads')->insert($data);

        return response()->json(['message' => 'Data inserted successfully'], 201);
    }



    public function importExportView()
    {
        return view('home');
    }


    public function export(Request $request)
{
    $duration = $request->input('duration', 1);
    $start_date = $request->input('start_date', Carbon::now()->format('Y-m-d'));
    $end_date = $request->input('end_date', Carbon::now()->format('Y-m-d'));

    // Debugging: Dump the received parameters
    //dd($duration, $start_date, $end_date);

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

    $ssb_leads = $ssb_leads_query->get();

    // Check if there is data to export
    if ($ssb_leads->isEmpty()) {
        return back()->with('status', 'No data to export.');
    }

    // Create a CSV response
    $csvData = $ssb_leads->map(function ($lead) {
        return [
            'Id' => $lead->id,
            'Created At' => $lead->created_at,
            'Updated At' => $lead->updated_at,
            'Name' => $lead->case_description,
        ];
    });

    $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=ssb_leads.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    );

    return response()->stream(function () use ($csvData) {
        $handle = fopen('php://output', 'w');
        fputcsv($handle, array_keys($csvData->first()));
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
    }, Response::HTTP_OK, $headers);
}

    
    public function import(Request $request)
    {
        Excel::import(new SsbLeadsImport, $request->file('file'));

        return back();
    }
}
