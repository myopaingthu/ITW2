<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMailRequest;
use App\Mail\CandidateNotificationMail;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(SendMailRequest $request, $candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        // Ensure the candidate exists and has a valid email
        if (!$candidate || !$candidate->email) {
            return redirect()->back()->with('error', 'Candidate not found or email not available.');
        }

        // Send email to the candidate
        Mail::to($candidate->email)->send(new CandidateNotificationMail($request->subject, $request->message));

        // Return with success message
        return redirect()->back()->with('success', 'Email sent successfully to ' . $candidate->name);
    }
}
