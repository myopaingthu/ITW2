<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function create()
    {
        return view('candidates.application-form');
    }

    public function store(StoreCandidateRequest $request)
    {
        $resume = $request->file('resume');
        $path = $resume->store('resumes', 'public');

        $candidate = Candidate::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'github' => $request->github,
            'linkedin' => $request->linkedin,
            'years_of_experience' => $request->years_of_experience,
            'current_role' => $request->current_role,
            'expected_salary' => $request->expected_salary,
            'resume' => $path,
            'stage' => 'Initial Review', // Default stage
        ]);

        return redirect('/application-form')->with('success', 'Application submitted!');
    }

    public function index()
    {
        $candidates = Candidate::all();
        $stages = ['Initial Review', 'Technical Test', 'Rejected'];
        return view('candidates.index', compact('candidates', 'stages'));
    }

    public function updateStage(Request $request)
    {
        $candidate = Candidate::find($request->id);
        $candidate->update(['stage' => $request->stage]);
        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('candidates.show', compact('candidate'));
    }
}
