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
                    <!-- <th>{{ $cont->id }}</th> -->
                    <td class="contact-name">{{ $cont->name }}</td>
                    <td class="contact-phone">{{ $cont->phone }}</td>
                    <td class="contact-email">{{ $cont->email }}</td>
                    <td>
                        <a href="#" class="btn btn-primary edit-btn" data-id="{{ $cont->id }}">Edit</a>
                        <!-- Delete Button -->
                        <a href="/delete/{{ $cont->id }}" class="btn btn-danger delete-btn" data-id="{{ $cont->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">No Data</td>
            </tr>
        @endif
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>
                    <div class="form-group">
                        <label for="editPhone">Phone</label>
                        <input type="text" class="form-control" id="editPhone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                url: '/update/' + $('#editId').val(),
                type: 'PUT',
                data: formData,
                success: function(response) {
                    // Update contact details on the page
                    var contact = response.contact;
                    $('.contact-name').each(function() {
                        if ($(this).text() == contact.name) {
                            $(this).siblings('.contact-phone').text(contact.phone);
                            $(this).siblings('.contact-email').text(contact.email);
                        }
                    });

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
