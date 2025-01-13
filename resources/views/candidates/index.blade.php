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
    <div class="row">
        @foreach ($stages as $stage)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white text-center">
                    <h5 class="mb-0">{{ $stage }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group kanban-column" data-stage="{{ $stage }}" style="min-height: 200px; border: 1px dashed #ddd;">
                        @foreach ($candidates->where('stage', $stage) as $candidate)
                        <li class="list-group-item draggable" draggable="true" data-id="{{ $candidate->id }}" data-name="{{ $candidate->name }}">
                            <!-- Candidate details with clickable link -->
                            <a href="{{ route('candidates.show', $candidate->id) }}" class="text-dark">
                                <strong>{{ $candidate->name }}</strong>
                            </a>
                            <br>
                            <small class="text-muted">Current Role: {{ $candidate->current_role }}</small><br>
                            <small class="text-muted">Years of Experience: {{ $candidate->years_of_experience }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const draggables = document.querySelectorAll('.draggable');
            const columns = document.querySelectorAll('.kanban-column');
    
            // Track currently dragged element
            let draggedItem = null;
    
            // Drag Start
            draggables.forEach(item => {
                item.addEventListener('dragstart', () => {
                    draggedItem = item;
                    setTimeout(() => item.style.display = 'none', 0);
                });
    
                item.addEventListener('dragend', () => {
                    setTimeout(() => {
                        draggedItem.style.display = 'block';
                        draggedItem = null;
                    }, 0);
                });
            });
    
            // Drag Over and Drop
            columns.forEach(column => {
                column.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    column.style.backgroundColor = '#f8f9fa'; // Highlight drop area
                });
    
                column.addEventListener('dragleave', () => {
                    column.style.backgroundColor = 'white'; // Remove highlight
                });
    
                column.addEventListener('drop', (e) => {
                    e.preventDefault();
                    column.style.backgroundColor = 'white';
    
                    // Append dragged item to the new column
                    if (draggedItem) {
                        column.appendChild(draggedItem);
    
                        // Update stage in the backend
                        const candidateId = draggedItem.getAttribute('data-id');
                        const newStage = column.getAttribute('data-stage');
                        const candidateName = draggedItem.getAttribute('data-name');
    
                        fetch('{{ route("candidates.update.stage") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ id: candidateId, stage: newStage })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                toastr.error(data.message || 'Error updating stage!');
                            } else {
                                toastr.success(`${candidateName} has been moved to ${newStage}`)
                            }
                        })
                        .catch(err => {
                            console.error('Error:', err);
                            toastr.error('Error updating stage!');
                        });
                    }
                });
            });
        });
    </script>
</div>

@endsection