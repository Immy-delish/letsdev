<!DOCTYPE html>
<html>
<head>
    <title>Items</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Items</h1>

    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description"><br><br>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#name').on('blur', function() {
                var name = $(this).val();
                $.ajax({
                    url: '{{ route("items.check") }}',
                    type: 'POST',
                    data: { name: name, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.exists) {
                            $('#description').prop('disabled', true);
                        } else {
                            $('#description').prop('disabled', false);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
