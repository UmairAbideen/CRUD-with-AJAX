<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div id="status" style="display: none" class="alert alert-success mt-3">
        <strong>Success!</strong> Indicates a successful or positive action.
    </div>

    <div id="status1" style="display: none" class="alert alert-warning mt-3">
        <strong>Warning!</strong> Indicates a warning that might need attention.
    </div>

    <div class="container">
        <h2>Users</h2>
        <!-- Trigger the modal with a button -->
        <button type="button" id="modal-button" class="btn btn-info btn-lg" data-toggle="modal"
            data-target="#myModal">Add User</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">User Form</h4>
                    </div>

                    <div class="modal-body">
                        <form id="form">
                            @csrf

                            <!-- Hidden Input-->
                            <input type="hidden" id="id">

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="name" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email"
                                    name="email">
                            </div>

                            <button id="button" value="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 40px;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody id="table1">
                </tbody>
            </table>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
    // Ensure getUsers is called when the page is loaded
    // When the DOM is fully loaded, this function runs
    $(document).ready(function() {
        getUsers(); // Calls the function to fetch and display users
    });

    // Function to fetch user data from the server
    function getUsers() {

        // AJAX request to fetch all users
        $.ajax({
            url: '/users', // Laravel route that returns JSON array of users
            type: 'GET', // HTTP GET request
            success: function(response) { // If the request is successful

                // Build table rows dynamically
                var tr = '';
                for (var i = 0; i < response.length; i++) {
                    var id = response[i].id;
                    var name = response[i].name;
                    var email = response[i].email;

                    // Start row
                    tr += '<tr>';
                    tr += '<td>' + id + '</td>'; // User ID
                    tr += '<td>' + name + '</td>'; // User Name
                    tr += '<td>' + email + '</td>'; // User Email

                    // Edit button with user ID
                    tr += '<td><button id="editButton" value="' + id +
                        '" class="btn btn-warning">Edit</button></td>';

                    // Delete button with user ID
                    tr += '<td><button id="deleteButton" value="' + id +
                        '" class="btn btn-danger">Delete</button></td>';

                    // End row
                    tr += '</tr>';
                }

                // Inject rows into the table body with ID 'table1'
                $('#table1').html(tr);
            },

            // If there's an error with the request
            error: function(xhr) {
                console.error('AJAX error response:', xhr); // Log the error in console

                // Show error alert on the screen
                $('#status1').show().html('<strong>Error!</strong> ' + xhr.responseText)
                    .delay(3000)
                    .fadeOut(); // Fade out after 3 seconds
            }
        });
    }



    // When the "Add User" button is clicked (opens modal)
    $('#modal-button').on('click', function() {
        $('#form')[0].reset(); // Clear the form fields
        $('#button').text('Submit'); // Set the button text to "Submit" for create action
    });

    // When the form inside the modal is submitted
    $('#form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission (page reload)

        // Gather form data into an object
        var formData = {
            id: $('#id').val(), // Hidden ID input (used for updating)
            name: $('#name').val(), // Name input
            email: $('#email').val(), // Email input
            "_token": "{{ csrf_token() }}" // CSRF token for Laravel POST request
        };

        // Set default URL to create a new user
        var url = '/users/form/create';

        // If we're updating an existing user, change the URL
        if ($('#button').text() === 'Update') {
            url = '/users/update';
        }

        // Send the data via AJAX
        $.ajax({
            url: url, // Laravel route (create or update)
            type: 'POST', // HTTP POST request
            data: formData, // Send form data

            beforeSend: function() {
                $('#button').text('Please wait...'); // Show loading state on button
            },

            success: function(response) {
                // Show success alert with message
                $('#status').show().html('<strong>Success!</strong> ' + response.message)
                    .delay(3000).fadeOut();

                $('#form')[0].reset(); // Clear the form fields
                $('#myModal').modal('hide'); // Hide the modal
                $('#button').text('Submit'); // Reset button text
                getUsers(); // Refresh user list on the table
            },

            error: function(xhr) {
                // Show error message in alert
                $('#status1').show().html('<strong>Error!</strong> ' + xhr.responseText)
                    .delay(3000).fadeOut();

                $('#button').text('Submit'); // Reset button text even on error
            }
        });
    });


    // To Edit data – This function is triggered when the Edit button is clicked
    $(document).on('click', '#editButton', function(e) {
        e.preventDefault(); // Prevent default button behavior (e.g., form submission)

        var id = $(this).val(); // Get the ID of the user from the clicked button

        // Send AJAX request to get user data by ID
        $.ajax({
            url: '/users/edit', // Laravel route to fetch user data for editing
            type: 'POST', // Use POST method
            data: {
                "_token": "{{ csrf_token() }}", // CSRF token for security
                id: id // Send user ID in the request
            },
            success: function(response) {
                $('#form')[0].reset(); // Reset the form before filling in new data

                // Fill form inputs with the user data from the response
                $('#id').val(response.id); // Set hidden input for ID
                $('#name').val(response.name); // Set name field
                $('#email').val(response.email); // Set email field

                // Change submit button text to "Update" (for conditional logic)
                $('#button').text('Update');

                // Show the modal so user can edit the fields
                $('#myModal').modal('show');
            },
            error: function(xhr) {
                // Log error to console for debugging
                console.error('Error:', xhr.responseText);
            }
        });
    });



    // When a "Delete" button is clicked
    $(document).on('click', '#deleteButton', function(e) {
        e.preventDefault(); // Prevent default button behavior (just in case it's inside a form)

        var id = $(this).val(); // Get the user ID from the clicked button's value

        // AJAX request to delete user by ID
        $.ajax({
            url: '/users/delete', // Backend route for deletion
            type: 'POST', // POST method to send data securely
            data: {
                "_token": "{{ csrf_token() }}", // CSRF token for Laravel protection
                id: id // The user ID to be deleted
            },
            success: function(response) {
                // Show success alert
                $('#status').show().html('<strong>Success!</strong> ' + response.message).delay(
                    3000).fadeOut();

                // Refresh the users table
                getUsers();
            },
            error: function(xhr) {
                // Show error alert if something goes wrong
                $('#status1').show().html('<strong>Error!</strong> ' + xhr.responseText).delay(3000)
                    .fadeOut();
            }
        });
    });
</script>

</html>
