<?php theme_include('header'); ?>
    <div class="col-xl-10 mx-auto">

        <?php if (has_posts()): ?>
            <?php posts(); ?>

            <h1 class="fw-light"><?php echo article_category('category'); ?> </h1>
            <p class="lead">
                <?php echo article_category_description('description'); ?>
            </p>
            <div class="mb-5 posts">
                <article>
                    <h3>
                        <a class="text-decoration-none fw-light text-body" href="<?php echo article_url(); ?>"
                           title="<?php echo article_title(); ?>"><?php echo article_title(); ?></a>
                    </h3>
                    <div class="lead">
                        <?php echo substr(article_content(), 0, 250); ?>
                    </div>
                    <footer class="fw-light ps-0 text-muted">
                        Posted <time datetime="<?php echo date(DATE_W3C, article_time()); ?>"><?php echo relative_time(article_time()); ?></time>  by <?php echo article_author('real_name'); ?>.
                    </footer>
                </article>
                <?php $i = 0;
                while (posts()): ?>
                    <article>
                        <h3>
                            <a class="text-decoration-none fw-light text-body" href="<?php echo article_url(); ?>"
                               title="<?php echo article_title(); ?>"><?php echo article_title(); ?></a>
                        </h3>
                        <div class="lead">
                            <?php echo substr(article_content(), 0, 250); ?>
                        </div>
                        <footer class="fw-light ps-0 text-muted">
                            Posted
                            <time datetime="<?php echo date(DATE_W3C, article_time()); ?>"><?php echo relative_time(article_time()); ?></time>
                            by <?php echo article_author('real_name'); ?>.
                        </footer>
                    </article>
                <?php endwhile; ?>

                <?php if (has_pagination() && show_all_posts()): ?>
                    <div class="d-flex justify-content-center mt-5">
                        <nav class="pagination ">
                            <div class="text-center">
                                <div class="float-start">
                                    <?php echo posts_prev(); ?>
                                </div>
                                <div class="float-end ms-5">
                                    <?php echo posts_next(); ?>
                                </div>
                            </div>
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