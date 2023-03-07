<!doctype html>
<html id="admin" lang="<?php echo str_replace('_', '-', Config::app('language')); ?>" data-bs-theme="<?php echo Config::meta('admin_theme'); ?>">
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
    <?php if (Config::meta('admin_theme') == 'auto'): ?>
    <script src="<?php echo asset('app/views/assets/js/auto-modes.js');?>"></script>
    <?php endif; ?>
</head>
<body>
<?php if (Auth::user()): ?>
    <header class="p-3 border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12">
                    <nav class="navbar d-flex px-0 py-1">
                        <?php $page = in_array(Config::meta('dashboard_page'), ['panel', 'pages', 'posts']) ? Config::meta('dashboard_page') : 'panel'; ?>
                        <a href="<?php echo Uri::to('admin/' . $page); ?>" class="text-body-emphasis mr-3">
                            <?php echo __('global.administration'); ?>
                        </a>
                        <ul class="navbar-nav flex-row">
                            <?php $count_visitors_online = Query::table(Base::table('visitors_online'))->count(); ?>
                            <li class="ms-3 me-4 pt-2">
                                <a class="text-body-emphasis" href="<?php echo Uri::to('admin/reports/visitors_online'); ?>">
                                <span id="notification" class="position-relative">
                                    <span id="count_online_visitors"  class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <span class="count_online_visitors"><?php echo $count_visitors_online; ?></span>
                                    </span>
                                    <i class="bi bi-people-fill fs-5"></i>
                                 </span>
                                </a>
                            </li>
                            <?php $home = '/' ?>
                            <?php $user = Auth::user(); ?>
                            <?php $count_pending = Query::table(Base::table('comments'))->where('status', '=', 'pending')->count(); ?>
                            <?php $count_spam = Query::table(Base::table('comments'))->where('status', '=', 'spam')->count(); ?>
                            <?php $count = $count_pending + $count_spam; ?>
                            <li class="ms-3 me-4 pt-2">
                                <a class="text-body-emphasis" href="<?php echo Uri::to('admin/comments'); ?>">
                                <span id="notification" class="position-relative">
                                    <span id="count_comments"  class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <span class="count_comments"><?php echo $count; ?></span>
                                    </span>
                                    <i class="bi bi-bell fs-5"></i>
                                 </span>
                                </a>
                            </li>
                            <?php if ($user->image): ?>
                                <?php $avatar = $user->image; ?>
                            <?php else: ?>
                                <?php $avatar = 'app/views/assets/img/no_avatar.png'; ?>
                            <?php endif; ?>
                            <div id="avatar" class="dropdown keep-open">
                                <img src="<?php echo Uri::to($avatar); ?>" alt="<?php echo $user->real_name; ?>"
                                     id="dropdown" class="dropdown-toggle avatar-sm me-2"
                                     data-bs-toggle="dropdown">
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="<?php echo Uri::to('admin/users/edit/' . $user->id); ?>">
                                            <?php echo $user->real_name; ?>
                                        </a>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <li>
                                        <?php echo Html::link($home, '<i class="bi bi-eye"></i> ' . __('global.visit_your_blog'), ['class' => 'dropdown-item', 'target' => '_blank']); ?>
                                    </li>
                                    <hr class="dropdown-divider">
                                    <?php if (Auth::admin()): ?>
                                    <?php $menu = ['posts', 'categories', 'comments', 'pages',  'users', 'reports', 'extend']; ?>
                                    <?php else: ?>
                                    <?php $menu = ['posts']; ?>
                                    <?php endif; ?>
                                    <?php foreach ($menu as $url): ?>
                                        <li>
                                            <a class="dropdown-item <?php if (strpos(Uri::current(), $url) !== false) { echo 'active'; } ?>" href="<?php echo Uri::to('admin/' . $url); ?>">
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
                </div>
            </div>
        </div>
    </header>
<?php endif; ?>
<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="row">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12">
            <?php echo Notify::read(); ?>

