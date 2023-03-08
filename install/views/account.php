<?php echo $header; ?>

<section class="mt-5">

    <div class="mt-3">
        <h1>Your first account</h1>
        <p>Oh, we're so tantalisingly close! All we need now is a username and password to log in to the admin area with.</p>
        <?php echo Notify::read(); ?>
    </div>

    <form class="mt-3" method="post" action="<?php echo uri_to('account'); ?>" autocomplete="off">

        <fieldset>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="username">Username</label>
                <div class="col-sm-10">
                    <input tabindex="1" id="username" class="form-control" name="username"
                           value="<?php echo Input::previous('username', 'admin'); ?>">
                </div>
                <span class="form-text">You use this to log in.</span>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="email">Email address</label>
                <div class="col-sm-10">
                    <input tabindex="2" id="email" class="form-control" type="email" name="email"
                           value="<?php echo Input::previous('email'); ?>">
                </div>
                <span class="form-text">Needed if you can’t log in.</span>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" tabindex="3" name="password" type="password"
                           value="<?php echo Input::previous('password'); ?>">
                </div>
                <span class="form-text">Make sure to pick a secure password.</span>
            </div>

        </fieldset>

        <section class="mt-3">
            <a href="<?php echo uri_to('metadata'); ?>" class="btn btn-secondary">&laquo; Back</a>
            <button type="submit" class="float-end btn btn-primary">Complete</button>
        </section>

    </form>

</section>

<?php echo $footer; ?>
