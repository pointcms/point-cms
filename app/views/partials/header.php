<!doctype html>
<html id="admin" lang="<?php echo str_replace('_', '-', Config::app('language')); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Title -->
    <title><?php echo __('global.manage'); ?> - <?php echo Config::meta('sitename'); ?></title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo asset('assets/favicon/apple-touch-icon.png'); ?>"/>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo asset('assets/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset('assets/favicon/favicon-16x16.png'); ?>">
    <!-- Boostrap icons -->
    <link rel="stylesheet" href="<?php echo asset('assets/css/bootstrap-icons.css'); ?>">
    <!-- Boostrap Css -->
    <link rel="stylesheet" href="<?php echo asset('assets/css/bootstrap.min.css'); ?>">
    <!-- Admin Extra Css -->
    <link rel="stylesheet" href="<?php echo asset('app/views/assets/css/admin.css'); ?>">
    <!-- Boostrap Js -->
    <script src="<?php echo asset('assets/js/bootstrap.bundle.min.js'); ?>"></script>
    <!-- Jquery Js -->
    <script src="<?php echo asset('assets/js/jquery.min.js'); ?>"></script>
</head>
<body class="min-vh-100">
<?php if (Auth::user()): ?>
    <header class="p-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12">
                    <nav class="navbar d-flex px-0 py-1">
                        <?php $page = in_array(Config::meta('dashboard_page'), ['panel', 'pages', 'posts']) ? Config::meta('dashboard_page') : 'panel'; ?>
                        <a href="<?php echo Uri::to('admin/' . $page); ?>" class="text-body-emphasis mr-3">
                            <span class="lead  d-none d-sm-inline-block">Hi <span class="fw-semibold"><?php echo user_name(); ?></span></span>
                        </a>
                        <ul class="navbar-nav flex-row">
                            <a href="<?php echo Uri::to('admin/posts/add'); ?>" type="button" class="btn btn-outline-primary ms-3 me-1 pt-2 <?php if (Uri::current() === "admin/posts/add" || Uri::current() === "admin/posts/edit/" . substr(Uri::current(), 17)) { echo 'd-none'; } ?>">
                                Create Post
                            </a>
                            <li class="ms-3 me-2 pt-2">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseSearch"
                                   aria-expanded="false" aria-controls="collapseSearch">
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" width="24"
                                         height="24" viewBox="0 0 24 24" aria-hidden="true" fill-rule="evenodd"
                                         focusable="false" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path d="M18.031 16.617l4.283 4.282-1.415 1.415-4.282-4.283A8.96 8.96 0 0 1 11 20c-4.968 0-9-4.032-9-9s4.032-9 9-9 9 4.032 9 9a8.96 8.96 0 0 1-1.969 5.617zm-2.006-.742A6.977 6.977 0 0 0 18 11c0-3.868-3.133-7-7-7-3.868 0-7 3.132-7 7 0 3.867 3.132 7 7 7a6.977 6.977 0 0 0 4.875-1.975l.15-.15z"></path>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class="ms-3 me-4 pt-2">
                                <a class="text-body-emphasis" href="<?php echo Uri::to('admin/comments'); ?>">
                                    <span class="position-relative">
                                        <span id="newCommentBadge" class="position-absolute top-0 start-90 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                           role="img" aria-labelledby="title"><title id="title">Notifications</title>
                                      <path d="M20 17h2v2H2v-2h2v-7a8 8 0 1116 0v7zm-2 0v-7a6 6 0 10-12 0v7h12zm-9 4h6v2H9v-2z"></path>
                                      </svg>
                                    </span>
                                </a>
                            </li>
                            <div id="dropdown-menu" class="dropdown keep-open">
                                <img src="<?php echo Uri::to(avatar()); ?>" alt="<?php echo user_name(); ?>"
                                     id="dropdown" class="dropdown-toggle border avatar-sm me-2"
                                     data-bs-toggle="dropdown">
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item"
                                           href="<?php echo Uri::to('admin/users/edit/' . user_id()); ?>">
                                            <?php echo user_name(); ?>
                                        </a>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <li>
                                        <?php echo Html::link('/', '<i class="bi bi-eye"></i> ' . __('global.visit_your_blog'), ['class' => 'dropdown-item', 'target' => '_blank']); ?>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <?php if (Auth::admin()): ?>
                                        <?php $menu = ['categories', 'comments', 'menu', 'pages', 'posts', 'users', 'extend']; ?>
                                    <?php else: ?>
                                        <?php $menu = ['posts']; ?>
                                    <?php endif; ?>
                                    <?php foreach ($menu as $url): ?>
                                        <li>
                                            <a class="dropdown-item <?php if (strpos(Uri::current(), $url) !== false) {
                                                echo 'active';
                                            } ?>" href="<?php echo Uri::to('admin/' . $url); ?>">
                                                <?php echo ucfirst(__($url . '.' . $url)); ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <?php echo Html::link('admin/logout', '<i class="bi bi-power"></i> ' . __('global.logout'), ['class' => 'dropdown-item text-danger']); ?>
                                    </li>
                                </ul>

                            </div>
                        </ul>
                    </nav>
                    <div class="collapse" id="collapseSearch">
                        <form id="search" class="d-flex" action="<?php echo admin_search_url(); ?>" method="post"
                              role="search">
                            <div class="input-group border rounded">
                                <input id="term" class="form-control form-control-lg border-0" name="term" type="search"
                                       placeholder="<?php echo __('global.search_placeholder'); ?>"
                                       aria-label="Search" value="<?php echo admin_search_term(); ?>">
                                <button class="btn btn-outline-link border-0 rounded-end" type="submit"><i
                                            class="bi bi-search"></i></button>
                                <input type="hidden" id="whatSearch" name="whatSearch" value="all"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>
<div class="container p-3 m-auto flex-column">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12">
            <?php echo Notify::read(); ?>

