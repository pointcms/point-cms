<?php echo $header; ?>

<section class="content mt-5">
  <article>
    <h1>Site metadata</h1>

    <p>In order to personalise your blog, it's recommended you add some metadata about your site. This can all be
      changed at any time, though.</p>

    <?php echo Notify::read(); ?>
  </article>

  <form method="post" action="<?php echo Uri::to('metadata'); ?>" autocomplete="off">

    <fieldset>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label" for="site_name">Site Name</label>
        <div class="col-sm-10">
          <input id="site_name" class="form-control" name="site_name"
            value="<?php echo Input::previous('site_name', 'My First Blog'); ?>">
        </div>
        <span class="form-text">What’s your blog called? (Min. 4 characters)</span>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label" for="site_description">Site Description</label>
        <div class="col-sm-10">
          <textarea id="site_description" class="form-control" name="site_description" rows="5"><?php echo Input::previous('site_description',
                'It&rsquo;s not just any blog. It&rsquo;s an unique and beautiful blog.'); ?></textarea>
        </div>
        <span class="form-text">A little bit about you or your blog. (Min. 4 characters)</span>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label" for="site_path">Site Path</label>
        <div class="col-sm-10">
          <input id="site_path" class="form-control" name="site_path"
            value="<?php echo Input::previous('site_path', $site_path); ?>">
        </div>
        <span class="form-text">The folder where your blog script installation lives.</span>
      </div>
      <?php if (count($themes) > 1): ?>
      <div class="mb-3 row">
        <label class="col-sm-2 col-form-label" for="theme">Theme</label>
        <div class="col-sm-10">
          <select id="theme" class="form-select" name="theme">
            <?php foreach ($themes as $dir => $theme): ?>
            <option value="<?php echo $dir; ?>"><?php echo $theme['name']; ?> by <?php echo $theme['author']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <span class="form-text">Your blog theme.</span>
      </div>

      <?php else: $theme = key($themes); ?>
      <input name="theme" type="hidden" value="<?php echo $theme; ?>">
      <?php endif; ?>

      <div class="mb-3 row">
        <label class="col-sm-2 for=" rewrite">Clean Urls</label>
        <div class="col-sm-10">
          <span class="form-text">Url rewiting</span>

          <?php if (mod_rewrite()): ?>

          <div class="more">Looks like you are running apache with <code>mod_rewrite</code> enabled.<br>
            The installer will create the htaccess for you.
          </div>

          <?php elseif (is_apache()): ?>

          <div class="more">Looks like you are running apache, but <code>mod_rewrite</code> is not enabled.</div>

          <div class="more"><input id="rewrite" name="rewrite" type="checkbox" value="1">
            Create the htaccess file for me anyway.
          </div>

          <?php elseif (is_cgi()): ?>

          <div class="more">Looks like you are running <code>PHP</code> as a fastcgi process.<br>
            You will have to setup your own url rewriting.
          </div>

          <?php endif; ?>
        </div>
      </div>
    </fieldset>

    <section class="mt-3">
      <a href="<?php echo uri_to('database'); ?>" class="btn btn-secondary">&laquo; Back</a>
      <button type="submit" class="float-end btn btn-primary">Next Step &raquo;</button>
    </section>
  </form>
</section>

<?php echo $footer; ?>