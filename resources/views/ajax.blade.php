<!DOCTYPE html>
<html>
<head>
    <title>AJAX CRUD APP</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Your Tasks</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create a Task</a>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                        <div id="name-error" class="text-danger"></div>
                    </div>       
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control" disabled></textarea>
                        </div>
                    </div>       
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create" disabled>Save changes</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>      
</body>      
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('tasks.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'detail', name: 'detail'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
        $('#createNewProduct').click(function () {
            $('#saveBtn').val("create-product");
            $('#product_id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Task");
            $('#ajaxModel').modal('show');
        });
            
        $('body').on('click', '.editProduct', function () {
            var product_id = $(this).data('id');
            $.get("{{ route('tasks.index') }}" +'/' + product_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Task");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#product_id').val(data.id);
                $('#name').val(data.name);
                $('#detail').val(data.detail);
                $('#detail').prop('disabled', true); // Enable detail field
                $('#saveBtn').prop('disabled', true); // Enable Save Changes button
            })
        });
        
        
        // Enable detail field when name is input and focused out

         // $('#name').on('focusout', function () {
         
            //if ($(this).val() !== '') {
        $('#name').on('focusout', function () {
            var name = $(this).val();

            if (name !== '') {
                $.ajax({
                    url: '{{ route("checkNameExists") }}',
                    method: 'POST',
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.exists) {
                            $('#name-error').html('Name already exists');
                            $('#detail').prop('disabled', true);
                            $('#saveBtn').prop('disabled', true);
                        } else {
                            $('#name-error').html('');
                            $('#detail').prop('disabled', false);
                            $('#saveBtn').prop('disabled', true);
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        });


        // Enable Save Changes button when detail is input and focused out
        $('#detail').on('focusout', function () {
            if ($(this).val() !== '') {
                $('#detail').addClass('invalid');
                $('#saveBtn').prop('disabled', false);
            }else{
                $('#detail').addClass('valid');
                $('#saveBtn').prop('disabled', true); 
            }
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Save Changes');
        
            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('tasks.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });
        
        $('body').on('click', '.deleteProduct', function () {
            var product_id = $(this).data("id");

            if (confirm("Are You sure want to delete !")) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('tasks.store') }}"+'/'+product_id,
                    success: function (data) {
                        table.draw();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

    });     
  
</script>
</html>