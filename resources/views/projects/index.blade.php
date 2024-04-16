<!-- Add Bootstrap -->  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workspace') }}
            
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome to Project Planning!") }}
                </div> 
            </div>

            <span class="d-block p-2 text-gray"></span>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($projects as $project)
                <div class="col">
                    <div class="card border-gray h-100">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $project->project_name }}</h5>
                            <a href="#" class="btn btn-link text-secondary text-decoration-none" data-bs-toggle="modal" data-bs-target="#projectDatesModal_{{ $project->id }}">&#x2026;</a>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="projectDatesModal_{{ $project->id }}" tabindex="-1" aria-labelledby="projectDatesModalLabel_{{ $project->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="projectDatesModalLabel_{{ $project->id }}">Project Dates</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
