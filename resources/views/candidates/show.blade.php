@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('shared.breadcrumb', [
'title' => 'Applicant Management',
'bc_data' => [
[
'link' => route('candidates.index'),
'text' => 'Applicants',
'is_active' => true
]
]
])

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Candidate Details</h5>
        </div>
        <div class="card-body">
            <!-- Candidate Name -->
            <h4 class="card-title">{{ $candidate->name }}</h4>

            <!-- Basic Candidate Information -->
            <p class="card-text">
                <strong>Email:</strong> {{ $candidate->email }}
            </p>
            <p class="card-text">
                <strong>Phone:</strong> {{ $candidate->phone ?? 'N/A' }}
            </p>
            <p class="card-text">
                <strong>Current Role:</strong> {{ $candidate->current_role }}
            </p>
            <p class="card-text">
                <strong>Years of Experience:</strong> {{ $candidate->years_of_experience }}
            </p>
            <p class="card-text">
                <strong>Expected Salary:</strong> ${{ number_format($candidate->expected_salary, 2) }}
            </p>
            <p class="card-text">
                <strong>Stage:</strong> {{ $candidate->stage }}
            </p>

            <!-- GitHub & LinkedIn (conditionally displayed if not null) -->
            @if ($candidate->github)
            <p class="card-text">
                <strong>GitHub:</strong> <a href="{{ $candidate->github }}" target="_blank" class="text-info">{{ $candidate->github }}</a>
            </p>
            @endif

            @if ($candidate->linkedin)
            <p class="card-text">
                <strong>LinkedIn:</strong> <a href="{{ $candidate->linkedin }}" target="_blank" class="text-info">{{ $candidate->linkedin }}</a>
            </p>
            @endif

            <!-- Resume Download -->
            <a href="{{ Storage::url($candidate->resume) }}" target="_blank" class="btn btn-success btn-sm">
                <i class="fas fa-download"></i> Download Resume
            </a>

            <!-- Send Email Button -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#emailModal">
                <i class="fas fa-envelope"></i> Send Email
            </button>
        </div>
    </div>

    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('send.email', $candidate->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea name="message" class="form-control" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection