<?php echo $header; ?>

<?php echo Notify::read(); ?>

<section class="row mt-5 p-5">
    <div class="col-md-6 offset-md-3">
        <h1 class="text-center">Install complete!</h1>

        <?php if ($htaccess): ?>
            <p class="code">We could not write the <code>htaccess</code> file for you, copy
                the contents below and create a .htaccess in your blog script root folder.<br>
                <textarea id="htaccess" class="form-control" rows="10"><?php echo $htaccess; ?></textarea>
            </p>

            <script>document.getElementById('htaccess').select();</script>
        <?php endif; ?>

        <div class="d-grid gap-2 mt-3">
            <a href="<?php echo $admin_uri; ?>" class="float-start btn btn-primary">Visit your admin panel</a>
            <a href="<?php echo $site_uri; ?>" class="float-end btn btn-success">Visit your new site</a>
        </div>
    </div>
</section>

<?php echo $footer; ?>
