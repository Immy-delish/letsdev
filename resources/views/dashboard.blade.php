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
                        <!-- Add Bootstrap -->  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<!-- Add a slight space after the accordion. -->

<span class="d-block p-2 text-gray"></span>

<!-- Add two Cards -->

<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Projects to be takens</h5>
        <p class="card-text">These are projects to be taken</p>
        <a href="projects" class="btn btn-primary">Projects</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">What to Achieve</h5>
        <p class="card-text">Achieve specific goals.</p>
        <a href="#" class="btn btn-primary">Objectives</a>
      </div>
    </div>
  </div>
</div>
<!-- Add a slight space after the accordion. -->

<span class="d-block p-2 text-gray"></span>

<!-- Add two Cards -->

<div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">What to Do</h5>
        <p class="card-text">Tasks Taken to achieve the goals.</p>
        <a href="tasks" class="btn btn-primary">Tasks</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Visualize your Accomplishments</h5>
        <p class="card-text">Integrate with Excel and PowerBI.</p>
        <a href="#" class="btn btn-primary">Dashboard</a>

        </div>
        </div>
    </div>
</x-app-layout>
