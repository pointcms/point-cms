<?php theme_include('header'); ?>
    <div class="col-xl-10 mx-auto">

        <h1 class="fw-light">You searched for &ldquo;<?php echo search_term(); ?>&rdquo;.</h1>

        <?php if (has_search_results()): ?>
            <?php $i = 0;
            while (search_results()): $i++; ?>
                <search class="mb-2">
                    <h3>
                        <a class="text-decoration-none fw-light text-body" href="<?php echo search_item_url(); ?>"
                           title="<?php echo search_item_title(); ?>"><?php echo search_item_title(); ?></a>
                    </h3>
                    <p class="fw-lighter"><?php echo substr(search_item_html(), 0, 350); ?></p>

                </search>
            <?php endwhile; ?>

            <?php if (has_pagination() && show_all_posts()): ?>
                <div class="d-flex justify-content-center">
                    <nav class="mt-5 pt-5" aria-label="Page navigation">
                        <ul class="pagination">
                            <?php echo links(); ?>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>

        <?php else: ?>

            <p>Unfortunately, there's no results for &ldquo;<?php echo search_term(); ?>&rdquo;. Did you spelleverything correctly?</p>

        <?php endif; ?>

    </div>

<?php theme_include('footer'); ?>