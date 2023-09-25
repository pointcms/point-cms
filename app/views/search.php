<?php echo $header; ?>
<h1 class="fw-light">You searched for &ldquo;<?php echo admin_search_term(); ?>&rdquo;.</h1>
<?php if (admin_has_search_results()): ?>
    <?php $i = 0;
    while (admin_search_results()): $i++; ?>
        <div>
            <a href="<?php echo admin_search_item_url(); ?>" class="text-decoration-none">
                <div class="p-3">
                    <div class="d-flex ">
                        <div class="me-auto col-md-11 col-sm-11 col-11">
                            <p class="mb-0 py-1 text-truncate text-start">
                                <span class="font-weight-bold text-lg lead"><?php echo admin_search_item_title(); ?></span>
                            </p>
                        </div>
                        <div class="ms-auto d-md-inline-block text-end">
                            <span class="me-3 text-muted"><?php echo admin_search_item_cat(); ?></span>
                        </div>

                    </div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>
    <?php if (admin_has_search_results()): ?>
        <div class="d-flex justify-content-center">
            <nav class="mt-5 pt-5" aria-label="Page navigation">
                <ul class="pagination">
                    <?php echo admin_search_pagination(); ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
<?php else: ?>
    <p>Unfortunately, there's no results for &ldquo;<?php echo admin_search_term(); ?>&rdquo;. Did you spelleverything
        correctly?</p>
<?php endif; ?>
<?php echo $footer; ?>
