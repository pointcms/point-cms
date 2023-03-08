<?php $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo __('global.welcome_to_your_blog'); ?></title>
    <link rel="stylesheet" href="<?php echo $base . '/assets/css/bootstrap-icons.css'; ?>">
    <link rel="stylesheet" href="<?php echo $base . '/assets/css/bootstrap.min.css'; ?>">
    <script src="<?php echo $base . '/assets/js/bootstrap.bundle.min.js'; ?>"></script>
</head>
<body class="text-center bg-light">
<div class="container">
    <div class="row justify-content-md-center pt-5">
        <div class="col-md-6 pt-5">
            <h1 class="mt-5 fw-light"><?php echo __('global.welcome_to_your_blog_lets_go'); ?></h1>
            <a class="btn btn-primary btn-lg mt-2 mr-2 w-100" href="<?php echo $base . '/install/index.php'; ?>"><?php echo __('global.run_the_installer'); ?></a>
        </div>
    </div>
</div>
<script>
    (function (d) {
        var v = new Date().getTimezoneOffset();
        d.cookie = 'blog-install-timezone=' + v + '; path=/';
    }(document));
</script>
</body>
</html>
