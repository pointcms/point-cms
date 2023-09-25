<?php $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); ?>

<!doctype html>
<html lang="en-gb">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404</title>

  <link rel="stylesheet" href="<?php echo asset('views/assets/css/bootstrap.min.css'); ?>">

</head>

<body>
<body class="text-center bg-light">
  <div class="container mx-auto">

      <p>The page <code><?php echo htmlspecialchars(Uri::current()); ?></code> was not found.</p>
  
    <p>Try the <a href="<?php echo $base . '/'; ?>">homepage</a></p>
  </div>
</body>

</html>