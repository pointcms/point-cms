<?php echo $header; ?>
<section class="mt-5">
    <article>
        <h1>Your database details</h1>
        <p>Firstly, we’ll need a database. The blog script needs them to store all of your blog’s information, so it’s
            vital you fill
            these in correctly. If you don’t know what these are, you’ll need to contact your webhost.
        </p>
        <?php echo Notify::read(); ?>
    </article>
    <form method="post" action="<?php echo uri_to('database'); ?>" autocomplete="off">
        <fieldset>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="host">Driver</label>
                <div class="col-sm-10">
                    <select id="driver" class="form-select" name="driver" data-live-search="true" data-width="100%">
                        <?php foreach ($drivers as $driver): ?>
                            <?php $selected = ($driver == Input::previous('driver', 'mysql')) ? ' selected' : ''; ?>
                            <option value="<?php echo $driver; ?>" <?php echo $selected; ?>>
                                <?php echo $driver; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text">We support MySQLi or SQLite.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="host">Database Host</label>
                <div class="col-sm-10">
                    <input id="host" class="form-control" name="host" value="<?php echo Input::previous('host', 'localhost'); ?>">
                    <span class="form-text">Most likely <b>localhost</b> or <b>127.0.0.1</b>.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="port">Port</label>
                <div class="col-sm-10">
                    <input id="port" class="form-control" name="port" value="<?php echo Input::previous('port', '3306'); ?>">
                    <span class="form-text">Usually <b>3306</b>.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="user">Username</label>
                <div class="col-sm-10">
                    <input id="user" class="form-control" name="user" value="<?php echo Input::previous('user', 'root'); ?>">
                    <span class="form-text">The database user, usually <b>root</b>.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="pass">Password</label>
                <div class="col-sm-10">
                    <input id="pass" name="pass" type="password" value="<?php echo Input::previous('pass'); ?>" class="form-control db-password-field" autocomplete="new-password">
                    <span class="form-text">Leave blank for empty password.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="show-hide">Show or hide password</label>
                <div class="col-sm-10">
                    <input name="show-hide" type="checkbox" value="Show/Hide password" class="form-check-input show-hide-password">
                    <span class="form-text">Check the box to show the password.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="name">Database Name</label>
                <div class="col-sm-10">
                    <input id="name" class="form-control" name="name" value="<?php echo Input::previous('name', 'blog'); ?>">
                    <span class="form-text">Your database’s name.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="prefix">Table Prefix</label>
                <div class="col-sm-10">
                    <input id="prefix" class="form-control" name="prefix" value="<?php echo Input::previous('prefix', 'blog_'); ?>">
                    <span class="form-text">Database table name prefix.</span>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label" for="collation">Collation</label>
                <div class="col-sm-10">
                    <select id="collation" class="form-select" name="collation" data-live-search="true"
                            data-width="100%">
                        <?php foreach ($collations as $code => $collation): ?>
                            <?php $selected = ($code == Input::previous('collation', 'utf8mb4_unicode_ci')) ? ' selected' : ''; ?>
                            <option value="<?php echo $code; ?>" <?php echo $selected; ?>>
                                <?php echo $code; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form-text">Change if <b>utf8mb4_unicode_ci</b> doesn’t work.</span>
                </div>
            </div>
        </fieldset>
        <section class="mt-3">
            <a href="<?php echo uri_to('start'); ?>" class="btn btn-secondary">&laquo; Back</a>
            <button type="submit" class="float-end btn btn-primary">Next Step &raquo;</button>
        </section>
    </form>
</section>
<?php echo $footer; ?>
