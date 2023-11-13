<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Include your SweetAlert CSS and JS files here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
</head>
<body>

<script>
    // Include your SweetAlert initialization code here
    // For example:
    Swal.fire({
        icon: 'success',
        title: 'Import Successful',
        text: 'Data has been successfully imported.',
        confirmButtonText: 'OK'
    }).then(function() {
        // Redirect the user after clicking the OK button
        window.location.href = 'tblregistration.php';
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
</body>
</html>
