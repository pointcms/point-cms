<?php echo $header; ?>

<section class="bg-light mt-5">
    <article class="text-center">
      <h1 class="mt-3">Woops!</h1>

        <?php if (count($errors) > 1): ?>
          <ul class="nav flex-column">
              <?php foreach ($errors as $error): ?>
                <li class="nav-item fw-light"><?php echo $error; ?></li>
              <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="mt-3 fw-light"><?php echo current($errors); ?></p>
        <?php endif; ?>

      <p class="mt-3">
        <a class="btn btn-primary" href="<?php echo uri_to('start'); ?>">Let&apos;s try that again.</a>
      </p>
    </article>
</section>

<?php echo $footer; ?>
