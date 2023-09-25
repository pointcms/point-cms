<!doctype html>
<html lang="<?php echo language(); ?>" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo site_description(); ?>">
    <meta name="generator" content="point cms">

    <title><?php echo site_name(); ?></title>
    <link rel="canonical" href="<?php echo canonical(); ?>">
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo rss_url(); ?>">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon/apple-touch-icon.png'); ?>"/>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon/favicon-16x16.png'); ?>">
    <link rel="mask-icon" href="<?php echo base_url('assets/favicon/safari-pinned-tab.svg'); ?>" color="#5bbad5">


    <!-- Facebook -->
    <meta property="og:title" content="<?php echo page_title(); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo current_url(); ?>">
    <meta property="og:site_name" content="<?php echo site_name(); ?>">
    <meta property="og:description" content="<?php echo page_description(); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="<?php echo page_title(); ?>">
    <meta name="twitter:description" content="<?php echo page_description(); ?>">

    <!-- Copyright -->
    <meta name="copyright" content="<?php echo site_name(); ?>">

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-icons.css'); ?>" rel="stylesheet">

    <!-- Theme Css -->
    <link href="<?php echo theme_url('css/style.css'); ?>" rel="stylesheet">

    <!-- Jquery Js -->
    <script src="<?php echo asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo asset('assets/js/color-modes.js'); ?>"></script>

</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
</svg>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url(); ?>"><?php echo site_name(); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php if (has_menu_items()):
                        while (menu_items()): ?>
                            <li class="nav-item">
                                <a <?php echo(menu_active() ? 'class="active nav-link"' : 'class="nav-link"'); ?>
                                        href="<?php echo menu_url(); ?>" title="<?php echo menu_title(); ?>">
                                    <?php echo menu_name(); ?>
                                </a>
                            </li>
                        <?php endwhile;
                    endif; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo __('site.categories'); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-large" aria-labelledby="navbarDropdown">
                            <?php while (categories()):
                                if (category_count() > 0) { ?>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo category_url(); ?>" title="<?php echo category_description(); ?>">
                                            <?php echo category_title();
                                            ?> <span class="float-end badge rounded-pill bg-secondary"><?php echo category_count(); ?></span>
                                        </a>
                                    </li>
                                <?php  } endwhile; ?>
                        </ul>
                    </li>
                </ul>
                <form id="search" class="d-flex" action="<?php echo search_url(); ?>" method="post" role="search">
                    <div class="input-group">
                        <input id="term" class="form-control" name="term" type="search" placeholder="<?php echo __('site.search_placeholder'); ?>"
                               aria-label="Search" value="<?php echo search_term(); ?>">
                        <button class="btn btn-outline-secondary rounded-end" type="submit" ><i class="bi bi-search"></i></button>
                        <input type="hidden" id="whatSearch" name="whatSearch" value="all"/>
                    </div>
                </form>
                <ul class="navbar-nav mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a id="bd-theme" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg class="bi my-1 theme-icon-active"> <use href="#circle-half"></use></svg> <span class="d-lg-none ms-2">Toggle theme</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme-text">
                            <li><a class="dropdown-item" href="#light" data-bs-theme-value="light" aria-pressed="false">
                                    <svg class="bi me-2 opacity-50 theme-icon"> <use href="#sun-fill"></use></svg> Light <svg class="bi ms-auto d-none"><use href="#check2"></use></svg></a>
                            </li>
                            <li><a class="dropdown-item" href="#dark" data-bs-theme-value="dark" aria-pressed="false"><svg class="bi me-2 opacity-50 theme-icon"> <use href="#moon-stars-fill"></use></svg> Dark<svg class="bi ms-auto d-none"><use href="#check2"></use></svg></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item active" href="#auto" data-bs-theme-value="auto" aria-pressed="true"><svg class="bi me-2 opacity-50 theme-icon"><use href="#circle-half"></use></svg>Auto<svg class="bi ms-auto d-none"><use href="#check2"></use></svg></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </nav>
</header>
<div class="container min-vh-100 mt-5">
