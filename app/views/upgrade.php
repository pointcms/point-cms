<?php $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/'); ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo __('global.upgrade'); ?></title>
    <link rel="stylesheet" href="<?php echo $base . '/assets/css/bootstrap.min.css'; ?>">
</head>
<body class="text-center bg-light">
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 mt-5">
            <div id="start">
                <?php $compare = version_compare(VERSION, $version); ?>
                <?php if ($compare < 0) : // new release available ?>
                    <h2><?php echo __('global.good_news'); ?></h2>
                    <p><?php echo __('global.new_version_available'); ?></p>
                    <p>
                        <small><?php echo VERSION; ?></small>
                        <span> &rarr; <?php echo $version; ?></span></p>
                    <a class="btn btn-outline-primary" href="#" onclick="sendAjax()"><?php echo __('global.download_now'); ?></a>
                    <a class="btn btn-outline-danger" href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_later'); ?></a>
                <?php elseif ($compare == 0) : // same version as newest ?>
                    <h2><?php echo __('global.good_news'); ?></h2>
                    <p><?php echo __('global.up_to_date'); ?></p>
                    <p><?php echo VERSION; ?></p>
                    <a class="btn btn-outline-success" href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_finished_thanks'); ?></a>
                <?php elseif ($compare > 0) : // we're at least one ahead! ?>
                    <h2>Ooooooweeeeee!</h2>
                    <p><?php echo __('global.better_version'); ?></p>
                    <p>
                        <span><?php echo VERSION; ?> &#10567; </span>
                        <small><?php echo $version; ?></small>
                    </p>
                    <a class="btn btn-outline-primary" href="<?php echo $base; ?>/admin"><?php echo __('global.upgrade_finished_thanks'); ?></a>
                <?php else : // SOMETHING'S WRONG! ?>
                    <p><?php __('global.error_phrase'); ?></p>
                    <a class="btn btn-outline-primary" href="<?php echo $base; ?>/admin"><?php echo __('global.error_button'); ?></a>
                <?php endif; ?>
            </div>
            <div id="loading" hidden>
                <h4><?php echo __('global.updating'); ?></h4>
            </div>
            <div id="finished" hidden>
                <h2 class="fin_h2"></h2>
                <a class="fin_goBack btn btn-outline-primary" href="<?php echo Uri::to('admin/upgrade/'); ?>">Try again</a>
                <a class="fin_continue btn btn-outline-secondary" href="<?php echo Uri::to('admin/'); ?>">Nevermind</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $base; ?>/assets/js/jquery.min.js"></script>
<script>
    var sendAjax;
    $(document).ready(function () {
        function addClass(el, clazz) {
            if (!el) {
                return;
            }
            if (el.classList) {
                el.classList.add(clazz);
            } else {
                el.className += ' ' + clazz;
            }
        }

        function finished(success) {
            document.querySelector('.fin_h2').innerText = (success
                    ? "<?php echo __('global.upgrade_good'); ?>"
                    : "<?php echo __('global.upgrade_bad'); ?>"
            );

            var goBack = document.querySelector('.fin_goBack');
            var cont = document.querySelector('.fin_continue');

            if (success) {
                goBack.parentNode.removeChild(goBack);
                cont.innerText = "<?php echo __('global.upgrade_finished_thanks')?>";
            }

            !success && addClass(document.querySelector('body'), 'error');
            setActiveDiv('finished');
        }

        function setActiveDiv(div) {
            document.querySelector('#start').hidden = true;
            document.querySelector('#loading').hidden = true;
            document.querySelector('#finished').hidden = true;
            document.querySelector('#' + div).hidden = false;

            if (div === 'finished') {
                addClass(document.querySelector('body'), 'finished');
            }
        }

        sendAjax = function () {
            $.ajax({
                url: "<?php echo Uri::to('admin/upgrade/'); ?>",
                type: "POST",
                success: function(data, textStatus, jqXHR) {
                    console.log(data); // Data is already a JavaScript object
                    finished(!!data.success);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Error executing ajax.
                    console.log(errorThrown);
                    finished(false);
                }
            });

            setActiveDiv('loading');
        };
    });
</script>
</body>
</html>
