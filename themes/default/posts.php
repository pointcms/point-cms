<?php theme_include('header'); ?>

    <div class="col-xl-10 mx-auto">
        <?php if (has_posts()): ?>

            <div class="mb-5 posts">
                <?php while (posts()) : ?>
                    <article id="posts" class="mb-2">
                        <h1 class="fw-light">
                            <a class="text-decoration-none text-body" href="<?php echo article_url(); ?>"
                               title="<?php echo article_title(); ?>"><?php echo article_title(); ?></a>
                        </h1>
                        <div class="lead">
                            <?php echo substr(article_description(), 0, 350); ?>
                        </div>
                        <footer class="ps-0 text-muted">
                            Posted
                            <time datetime="<?php echo date(DATE_W3C, article_time()); ?>"><?php echo relative_time(article_time()); ?></time>
                            by <?php echo article_author('real_name'); ?> In <?php echo article_category('category'); ?>
                            .
                        </footer>
                    </article>
                <?php endwhile; ?>

                <?php if (has_pagination() && show_all_posts()): ?>
                    <div class="d-flex justify-content-center">
                        <nav class="mt-5 pt-5" aria-label="Page navigation">
                            <ul class="pagination">
                                <?php echo posts_pagination(); ?>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>

        <?php else: ?>

            <div class="text-center">
                <h1 class="fw-light text-dark">No posts yet!</h1>
                <p>Looks like you have some writing to do!</p>
            </div>

        <?php endif; ?>
    </div>

<?php theme_include('footer'); ?>