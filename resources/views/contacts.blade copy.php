<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <form method="POST" action="/addcontact">
        @csrf
        <div class="form-group mb-2">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPassword1">Phone Number</label>
            <input type="text" class="form-control" name="phone" placeholder="Phone">
        </div>
        <div class="form-group mb-2">
            <label for="exampleInputPassword1">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table class="table mt-5">
        <thead>
        <tr>
            <!-- <th scope="col">Id</th>-->
            <th scope="col">Name</th>
            <th scope="col">Phone</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if (count($contact) > 0)
            @foreach ($contact as $cont)
                <tr>
                    <!-- <th>{{ $cont->id }}</th>-->
                    <th>{{ $cont->name }}</th>
                    <th>{{ $cont->phone }}</th>
                    <th>{{ $cont->email }}</th>
                    <th>
                        <a href="/edit/{{ $cont->id }}" class="btn btn-primary">Edit</a>
                        <!-- Delete Button -->
                        <a href="/delete/{{ $cont->id }}" class="btn btn-danger delete-btn" data-id="{{ $cont->id }}">Delete</a>

                    </th>
                </tr>
            @endforeach
        @else
            <tr>
                <th>No Data</th>
            </tr>
        @endif
        </tbody>

    </table>
</div>

<!-- Custom JavaScript code -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all delete buttons
        var deleteButtons = document.querySelectorAll('.delete-btn');

        // Attach click event listeners to all delete buttons
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                // Prevent the default behavior (e.g., following the link)
                event.preventDefault();

                // Get the ID of the contact to be deleted
                var deleteId = button.getAttribute('data-id');

                // Show the confirmation message
                var isConfirmed = confirm('Are you sure you want to delete this contact🙄?');

                // If user confirms, submit the delete form
                if (isConfirmed) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/delete/' + deleteId;
                    form.innerHTML = '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                        '<input type="hidden" name="_method" value="DELETE">';
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
</script>

</body>
</html>
