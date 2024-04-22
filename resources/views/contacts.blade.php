<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
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
                    <!-- <th>{{ $cont->id }}</th> -->
                    <th>{{ $cont->name }}</th>
                    <th>{{ $cont->phone }}</th>
                    <th>{{ $cont->email }}</th>
                    <th>
                        <a href="/edit/{{ $cont->id }}" class="btn btn-primary edit-btn" data-id="{{ $cont->id }}"
                           data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                        <!-- Delete Button -->
                        <a href="/delete/{{ $cont->id }}" class="btn btn-danger delete-btn" data-id="{{ $cont->id }}"
                           data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete</a>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="/update/{{ $cont->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" value="{{ $cont->name }}">
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone" value="{{ $cont->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="{{ $cont->email }}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Save Changes</button>
                @csrf

            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this contact?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="/delete/{{ $cont->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Edit Contact
        $('.edit-btn').click(function() {
            var contactId = $(this).data('id');
            var contactName = $(this).closest('tr').find('.contact-name').text();
            var contactPhone = $(this).closest('tr').find('.contact-phone').text();
            var contactEmail = $(this).closest('tr').find('.contact-email').text();

            $('#editContactModal').modal('show');
            $('#editContactModal').find('#editId').val(contactId);
            $('#editContactModal').find('#editName').val(contactName);
            $('#editContactModal').find('#editPhone').val(contactPhone);
            $('#editContactModal').find('#editEmail').val(contactEmail);
        });

        // Submit Edit Form via AJAX
        $('#confirmEdit').click(function() {
            var formData = $('#editForm').serialize();

            $.ajax({
                url: '/update',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Update contact details on the page
                    var contact = response.contact;
                    $('#contactName_' + contact.id).text(contact.name);
                    $('#contactPhone_' + contact.id).text(contact.phone);
                    $('#contactEmail_' + contact.id).text(contact.email);

                    // Close the modal
                    $('#editContactModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>



</body>
</html>