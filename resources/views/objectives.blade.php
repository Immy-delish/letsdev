<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Workspace') }}
            <a href="{{ url('/myprojects') }}" class="btn btn-primary">My Projects</a>

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

 <!-- Add Bootstrap -->  
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
 integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
 integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
 </script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + New Project
</button>

<!-- objectives/create.blade.php -->

<form method="POST" action="{{ route('objectives.store') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Objective Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter objective name">
    </div>
    <div class="mb-3">
        <label class="form-label">Select Project</label>
        <select class="form-select" id="project_id" name="project_id">
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Objective</button>
</form>

</x-app-layout>

