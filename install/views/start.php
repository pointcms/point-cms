<?php echo $header; ?>

<section class="mt-5">
  <article>
    <h1 class="text-center">Hello. Willkommen. Bonjour. Croeso. Salut.</h1>

    <p>If you were looking for a truly lightweight blogging experience, you&rsquo;ve
      found the right place. Simply fill in the details below, and you&rsquo;ll have your
      new blog set up in no time.</p>

    <?php echo Notify::read(); ?>
  </article>

  <form method="post" action="<?php echo uri_to('start'); ?>" autocomplete="off">

    <fieldset>
      <div class="mb-3 row">
        <label for="lang" class="col-sm-2 col-form-label">Language</label>
        <div class="col-sm-10">
          <select id="lang" class="form-select" name="language" data-live-search="true" data-width="100%">
            <?php foreach ($languages as $lang): ?>
            <?php $selected = in_array($lang, $prefered_languages) ? ' selected' : ''; ?>
            <option<?php echo $selected; ?>><?php echo $lang; ?></option>
              <?php endforeach; ?>
          </select>
          <span class="form-text">Blog's language.</span>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="timezone" class="col-sm-2 col-form-label">Timezone</label>
        <div class="col-sm-10">
          <select id="timezone" class= "form-select" name="timezone" data-live-search="true" data-width="100%">
            <?php $set = false; ?>
            <?php foreach ($timezones as $zone): ?>
            <?php $selected = ($set === false and $current_timezone == $zone['timezone_id']) ? ' selected' : ''; ?>
            <option value="<?php echo $zone['timezone_id']; ?>" <?php echo $selected; ?>>
              <?php echo $zone['label']; ?>
            </option>
            <?php if ($selected) {
               $set = true;
            } ?>
            <?php endforeach; ?>
          </select>
          <span class="form-text">Your current time zone.</span>
        </div>
      </div>
    </fieldset>

    <section class="mt-3">
      <button type="submit" class="float-end btn btn-primary">Next Step &raquo;</button>
    </section>
  </form>
</section>

<?php echo $footer; ?>