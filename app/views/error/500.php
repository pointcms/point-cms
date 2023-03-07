<?php $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - Internal Server Error</title>

    <!-- Bootstrap -->
    <script src="<?php echo $base . '/views/assets/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo $base . 'assets/bootstrap/css/bootstrap.min.css'; ?>">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="<?php echo $base . 'assets/bootstrap-icons/bootstrap-icons.css'; ?>">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="<?php echo $base . 'assets/css/style.css'; ?>">

</head>

<body class="text-center bg-light">
<div class="container text-center">
    <p class="error">500</p>
    <h2><i class="bi bi-x-circle text-danger"></i> Internal Server Error</h2>
    <p>An error occured while we were processing your request.</p>
</body>

</html>