<?php $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); ?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo __('global.upgrade'); ?></title>
      <link rel="stylesheet" href="<?php echo $base . '/assets/css/bootstrap.min.css'; ?>">
  </head>
  <body class="text-center bg-light">
  <div class="container p-lg-5 mx-auto my-5">
    <div id="start">
        <?php $compare = version_compare(VERSION, $version); ?>
        <?php if ($compare < 0) : // new release available ?>
          <h1><?php echo __('global.good_news'); ?></h1>
          <p><?php echo __('global.new_version_available'); ?></p>
          <p>
            <small><?php echo VERSION; ?></small>
            <span> &rarr; <?php echo $version; ?></span></p>
          <a class="btn btn-outline-primary" href="#" onclick="sendAjax()"><?php echo __('global.download_now'); ?></a>
          <a class="btn btn-outline-danger" href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_later'); ?></a>
        <?php elseif ($compare == 0) : // same version as newest ?>
          <h1><?php echo __('global.good_news'); ?></h1>
          <p><?php echo __('global.up_to_date'); ?></p>
          <p><?php echo VERSION; ?></p>
          <a href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_finished_thanks'); ?></a>
        <?php elseif ($compare > 0) : // we're at least one ahead! ?>
          <h1>Ooooooweeeeee!</h1>
          <p><?php echo __('global.better_version'); ?></p>
          <p><span><?php echo VERSION; ?> &#10567; </span>
            <small><?php echo $version; ?></small>
          </p>
          <a href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_finished_thanks'); ?></a>
        <?php else : // SOMETHING'S WRONG! ?>
          <p><?php __('global.error_phrase'); ?></p>
          <a href="<?php echo $base; ?>/admin"><?php echo __('global.error_button'); ?></a>
        <?php endif; ?>
    </div>
    <div id="loading" hidden>
      <h1><?php echo __('global.updating'); ?></h1>
    </div>
    <div id="finished" hidden>
      <h1 class="fin_h1"></h1>
      <a class="fin_goBack" href="<?php echo Uri::to('admin/upgrade/'); ?>">Try again</a>
      <a class="fin_continue" href="<?php echo Uri::to('admin/'); ?>">Nevermind</a>
        <svg class="rocket" width="100%" height="100%" viewBox="0 0 900 600" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="transparent" d="M0 0h900v600H0z"/><path fill-rule="evenodd" clip-rule="evenodd" d="m475.107 379.749 28.507 28.507a9.2 9.2 0 0 1 2.223 9.415l-7.858 23.576a9.203 9.203 0 0 1-12.843 5.32l-16.535-8.268" fill="#666AF6"/><path d="m475.107 379.749 28.507 28.507a9.2 9.2 0 0 1 2.223 9.415l-7.858 23.576a9.203 9.203 0 0 1-12.843 5.32l-16.535-8.268" stroke="#666AF6" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m407.346 438.301-16.534 8.267a9.198 9.198 0 0 1-12.843-5.319l-7.858-23.576a9.2 9.2 0 0 1 2.222-9.415l28.508-28.508" fill="#666AF6"/><path d="m407.346 438.301-16.534 8.267a9.198 9.198 0 0 1-12.843-5.319l-7.858-23.576a9.2 9.2 0 0 1 2.222-9.415l28.508-28.508" stroke="#666AF6" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m475.091 371.653-7.676 69.086a10.059 10.059 0 0 1-9.997 8.947h-38.89a10.059 10.059 0 0 1-9.997-8.947l-7.676-69.086a104.633 104.633 0 0 1 30.006-85.541c3.928-3.927 10.296-3.927 14.224 0a104.633 104.633 0 0 1 30.006 85.541zm-20.497 120.47-16.62 22.497-16.62-22.497a20.662 20.662 0 0 1 16.62-32.943 20.664 20.664 0 0 1 16.62 32.943z" fill="#666AF6" stroke="#666AF6" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/><path d="m320.323 260.329-17.871 17.87m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m287.536 277.093 3.799 12.223 12.222 3.799a2.795 2.795 0 0 1 .784 4.949l-10.45 7.39.164 12.799a2.795 2.795 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.11a2.793 2.793 0 0 1-3.544-3.543l4.111-12.121-7.655-10.259a2.793 2.793 0 0 1 2.275-4.464l12.798.164 7.391-10.451a2.794 2.794 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m323.897 278.198-7.148 7.149m279.863 27.393-17.87 17.87m0-21.444-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m563.825 329.504 3.8 12.223 12.222 3.799a2.793 2.793 0 0 1 .784 4.949l-10.45 7.39.163 12.799a2.793 2.793 0 0 1-4.464 2.275l-10.258-7.655-12.122 4.11a2.796 2.796 0 0 1-3.543-3.543l4.111-12.121-7.655-10.258a2.794 2.794 0 0 1 2.274-4.465l12.799.164 7.39-10.451a2.795 2.795 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m600.187 330.61-7.149 7.148m91.699 66.679-17.871 17.87m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m651.95 421.201 3.799 12.223 12.223 3.799a2.794 2.794 0 0 1 .783 4.949l-10.45 7.39.164 12.799a2.795 2.795 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.11a2.793 2.793 0 0 1-3.543-3.543l4.11-12.122-7.655-10.258a2.793 2.793 0 0 1 2.275-4.464l12.798.163 7.391-10.45a2.792 2.792 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m688.311 422.307-7.148 7.148m55.972-165.541-17.871 17.871m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m704.348 280.679 3.799 12.222 12.223 3.8a2.792 2.792 0 0 1 .784 4.949l-10.451 7.39.164 12.798a2.795 2.795 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.111a2.796 2.796 0 0 1-3.543-3.543l4.11-12.122-7.655-10.258a2.793 2.793 0 0 1 2.275-4.464l12.799.163 7.39-10.45a2.793 2.793 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m740.709 281.784-7.148 7.148m-165.53-75.034-17.87 17.87m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m535.245 230.662 3.799 12.223 12.222 3.799a2.794 2.794 0 0 1 .784 4.949l-10.45 7.39.164 12.799a2.795 2.795 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.11a2.793 2.793 0 0 1-3.544-3.543l4.111-12.121-7.655-10.258a2.795 2.795 0 0 1 2.275-4.465l12.798.164 7.391-10.451a2.794 2.794 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m571.606 231.768-7.148 7.148m-126.231-39.309-17.871 17.871m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m405.44 216.372 3.799 12.222 12.223 3.8a2.792 2.792 0 0 1 .784 4.949l-10.451 7.39.164 12.799a2.796 2.796 0 0 1-1.525 2.525 2.797 2.797 0 0 1-2.94-.251l-10.258-7.655-12.121 4.111a2.795 2.795 0 0 1-3.543-3.543l4.11-12.122-7.655-10.258a2.793 2.793 0 0 1 2.275-4.464l12.798.163 7.391-10.45a2.793 2.793 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m441.801 217.477-7.148 7.148m-206.019 7.136-17.871 17.87m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m195.847 248.525 3.799 12.223 12.223 3.799a2.795 2.795 0 0 1 .784 4.949l-10.451 7.39.164 12.799a2.794 2.794 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.11a2.793 2.793 0 0 1-3.543-3.543l4.11-12.121-7.655-10.258a2.795 2.795 0 0 1 2.275-4.465l12.799.164 7.39-10.451a2.795 2.795 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m232.208 249.631-7.148 7.148m120.279-117.906-17.87 17.871m0-21.445-7.149 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m312.552 155.637 3.799 12.223 12.223 3.799a2.793 2.793 0 0 1 .784 4.949l-10.45 7.391.163 12.798a2.793 2.793 0 0 1-4.464 2.275l-10.258-7.655-12.122 4.111a2.796 2.796 0 0 1-3.543-3.544l4.111-12.121-7.656-10.258a2.793 2.793 0 0 1 2.275-4.465l12.799.164 7.39-10.45a2.794 2.794 0 0 1 4.949.783z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m348.913 156.743-7.148 7.148M133.721 350.448l-9.919 9.919m0-11.903-3.968 3.968" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m115.523 359.753 2.108 6.784 6.784 2.109a1.551 1.551 0 0 1 .435 2.746l-5.8 4.102.091 7.104a1.55 1.55 0 0 1-2.478 1.263l-5.693-4.249-6.728 2.281a1.55 1.55 0 0 1-1.967-1.966l2.282-6.728-4.249-5.694a1.55 1.55 0 0 1 1.262-2.478l7.104.091 4.102-5.8a1.55 1.55 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m135.704 360.367-3.967 3.967m112.734 92.102-9.918 9.918m0-11.902-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m226.274 465.74 2.108 6.784 6.784 2.109a1.551 1.551 0 0 1 .435 2.747l-5.8 4.102.091 7.103a1.553 1.553 0 0 1-2.478 1.263l-5.694-4.249-6.727 2.282a1.552 1.552 0 0 1-1.967-1.967l2.282-6.728-4.249-5.693a1.552 1.552 0 0 1 1.262-2.478l7.104.091 4.102-5.801a1.55 1.55 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m246.455 466.354-3.967 3.967m333.045-6.74-9.919 9.919m0-11.903-3.967 3.968" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m557.335 472.885 2.109 6.784 6.784 2.109a1.55 1.55 0 0 1 .435 2.747l-5.801 4.102.091 7.103a1.55 1.55 0 0 1-2.478 1.263l-5.693-4.249-6.728 2.282a1.55 1.55 0 0 1-1.966-1.967l2.281-6.728-4.249-5.693a1.552 1.552 0 0 1 1.263-2.478l7.103.091 4.102-5.801a1.552 1.552 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m577.517 473.5-3.968 3.967m223.485-99.629-9.918 9.919m0-11.903-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m778.837 387.142 2.108 6.784 6.784 2.109a1.551 1.551 0 0 1 .435 2.747l-5.8 4.102.091 7.103a1.551 1.551 0 0 1-2.478 1.263l-5.693-4.249-6.728 2.281a1.55 1.55 0 0 1-1.967-1.966l2.282-6.728-4.249-5.693a1.552 1.552 0 0 1 1.262-2.478l7.104.09 4.102-5.8a1.552 1.552 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m799.018 387.756-3.967 3.968M668.42 178.963l-9.918 9.919m0-11.903-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m650.223 188.268 2.109 6.784 6.783 2.108a1.553 1.553 0 0 1 .436 2.747l-5.801 4.102.091 7.104a1.55 1.55 0 0 1-2.478 1.262l-5.693-4.249-6.728 2.282a1.554 1.554 0 0 1-1.595-.372 1.554 1.554 0 0 1-.372-1.595l2.282-6.727-4.249-5.694a1.55 1.55 0 0 1 1.263-2.478l7.103.091 4.102-5.8a1.551 1.551 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m670.404 188.881-3.967 3.968m-157.716-29.865-9.919 9.919m0-11.903-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m490.523 172.289 2.108 6.784 6.784 2.108c.564.175.979.656 1.072 1.238a1.552 1.552 0 0 1-.637 1.509l-5.8 4.102.091 7.104a1.55 1.55 0 0 1-2.478 1.262l-5.693-4.249-6.728 2.282a1.554 1.554 0 0 1-1.595-.372 1.554 1.554 0 0 1-.372-1.595l2.282-6.727-4.249-5.694a1.55 1.55 0 0 1 1.262-2.478l7.104.091 4.102-5.8a1.551 1.551 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m510.704 172.902-3.967 3.968m108.984-59.886-9.919 9.919m0-11.903-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m597.523 126.289 2.108 6.784 6.784 2.108c.564.175.979.656 1.072 1.238a1.552 1.552 0 0 1-.637 1.509l-5.8 4.102.091 7.104a1.55 1.55 0 0 1-2.478 1.262l-5.693-4.249-6.728 2.282a1.554 1.554 0 0 1-1.595-.372 1.554 1.554 0 0 1-.372-1.595l2.282-6.727-4.249-5.694a1.55 1.55 0 0 1 1.262-2.478l7.104.091 4.102-5.8a1.551 1.551 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m617.704 126.902-3.967 3.968m-73.016-42.886-9.919 9.919m0-11.903-3.968 3.968" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m522.523 97.289 2.108 6.784 6.784 2.108c.564.175.979.656 1.072 1.238a1.552 1.552 0 0 1-.637 1.509l-5.8 4.102.091 7.104a1.55 1.55 0 0 1-2.478 1.262l-5.693-4.249-6.728 2.282a1.554 1.554 0 0 1-1.595-.372 1.554 1.554 0 0 1-.372-1.595l2.282-6.727-4.249-5.694a1.55 1.55 0 0 1 1.262-2.478l7.104.091 4.102-5.8a1.551 1.551 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m542.704 97.902-3.967 3.968m-98.963-3.886-9.919 9.919m0-11.903-3.967 3.968" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m421.576 107.289 2.109 6.784 6.784 2.108a1.552 1.552 0 0 1 .435 2.747l-5.801 4.102.091 7.104a1.549 1.549 0 0 1-2.478 1.262l-5.693-4.249-6.728 2.282a1.552 1.552 0 0 1-1.967-1.967l2.282-6.727-4.249-5.694a1.55 1.55 0 0 1 1.263-2.478l7.103.091 4.102-5.8a1.551 1.551 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m441.757 107.902-3.967 3.968m-186.173 18.267-9.919 9.919m0-11.902-3.968 3.967" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m233.419 139.442 2.108 6.784 6.784 2.109a1.551 1.551 0 0 1 .435 2.747l-5.8 4.102.091 7.103a1.551 1.551 0 0 1-2.478 1.263l-5.693-4.249-6.728 2.281a1.55 1.55 0 0 1-1.967-1.966l2.282-6.728-4.249-5.693a1.552 1.552 0 0 1 1.262-2.478l7.104.09 4.102-5.8a1.552 1.552 0 0 1 2.747.435z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m253.6 140.056-3.967 3.967m90.943 228.26-17.871 17.871m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m307.789 389.048 3.799 12.222 12.223 3.799a2.793 2.793 0 0 1 .783 4.949l-10.45 7.391.164 12.798a2.793 2.793 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.111a2.795 2.795 0 0 1-3.543-3.543l4.11-12.122-7.655-10.258a2.793 2.793 0 0 1 2.275-4.464l12.798.163 7.391-10.45a2.793 2.793 0 0 1 4.949.784z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m344.15 390.153-7.148 7.149m-96.459-52.409-17.871 17.871m0-21.445-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="m207.756 361.657 3.799 12.223 12.223 3.799a2.793 2.793 0 0 1 .783 4.949l-10.45 7.391.164 12.798a2.794 2.794 0 0 1-4.465 2.275l-10.258-7.655-12.121 4.111a2.796 2.796 0 0 1-3.543-3.544l4.11-12.121-7.655-10.258a2.793 2.793 0 0 1 2.275-4.465l12.798.164 7.391-10.45a2.793 2.793 0 0 1 4.949.783z" fill="#E1E4E5" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="m244.117 362.763-7.148 7.148" stroke="#E1E4E5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M506.896 313h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm110-63h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm39 89h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm-68 62h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm146 35h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm-373-140h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm-182 17h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm-43 95h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm192 57h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm66-313h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839zm-214 28h.174c1.031 14.614 11.9 14.839 11.9 14.839s-11.985.234-11.985 17.121c0-16.887-11.985-17.121-11.985-17.121s10.864-.225 11.896-14.839z" fill="#E1E4E5"/></svg>
    </div>
  </div>
    <script type="text/javascript" src="<?php echo $base; ?>/assets/js/jquery.min.js"></script>
    <script>
      var sendAjax;
      $(document).ready(function(){
          function addClass ( el, clazz ) {
          if ( !el ) {
            return;
          }
          if ( el.classList ) {
            el.classList.add( clazz );
          } else {
            el.className += ' ' + clazz;
          }
        }

        function finished ( success ) {
          document.querySelector( '.fin_h1' ).innerText = ( success
              ? "<?php echo __('global.upgrade_good'); ?>"
              : "<?php echo __('global.upgrade_bad'); ?>"
          );

          var goBack = document.querySelector( '.fin_goBack' );
          var cont   = document.querySelector( '.fin_continue' );

          if ( success ) {
            goBack.parentNode.removeChild( goBack );
            cont.innerText = "<?php echo __('global.upgrade_finished_thanks')?>";
          } else {
            var rocket = document.querySelector( '.rocket' );
              rocket.parentNode.removeChild( rocket );
          }

          !success && addClass( document.querySelector( 'body' ), 'error' );
          setActiveDiv( 'finished' );
        }

        function setActiveDiv ( div ) {
          document.querySelector( '#start' ).hidden    = true;
          document.querySelector( '#loading' ).hidden  = true;
          document.querySelector( '#finished' ).hidden = true;
          document.querySelector( '#' + div ).hidden   = false;

          if ( div === 'finished' ) {
            addClass( document.querySelector( 'body' ), 'finished' );
          }
        }

        sendAjax = function () {
          $.ajax( {
                    url:     "<?php echo Uri::to('admin/upgrade/'); ?>",
                    type:    'POST',
                    success: function ( data) {
                      data = JSON.parse( data );
                      console.log( data );
                      finished( !!data.success );
                    },
                    error:   function ( jqXHR, textStatus, errorThrown ) {
                      // Error executing ajax.
                      console.log( errorThrown );
                      finished( false );
                    }
                  } );

          setActiveDiv( 'loading' );
        };
      });
    </script>
  </body>
</html>
