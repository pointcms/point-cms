<?php theme_include('header'); ?>

<div class="col-xl-10 mx-auto">
    <article>
        <h1 class="fw-light"><?php echo article_title(); ?></h1>
        <div class="mt-3">
            <img src="<?php echo article_image(); ?>" class="img-fluid" alt="<?php echo article_title(); ?>"/>
        </div>
        <div class="mt-2">
            <?php echo article_content(); ?>
        </div>
        <footer class="fw-light ps-0 text-muted">
            <!-- Unfortunately, CSS means everything's got to be inline. -->
            <p><?php echo __('site.this_article_is_my'); ?> <?php echo numeral(article_number(article_id()), true); ?> <?php echo __('site.oldest'); ?> <?php echo __('site.it_is'); ?> <?php echo count_words(article_content()); ?> <?php echo __('site.words_long'); ?> <?php if (comments_open()): ?>, <?php echo __('site.and_it_s_got'); ?><?php echo total_comments() . pluralise(total_comments(), ' comment'); ?><?php endif; ?></p>
        </footer>
    </article>

    <?php if (comments_open()): ?>
        <section class="comments">

            <?php if (has_comments()): ?>
                <ul class="nav flex-column">
                    <?php $i = 0;
                    while (comments()): $i++; ?>
                        <li class="nav-link mt-3 p-0" id="comment-<?php echo comment_id(); ?>">
                            <div class="text-secondary fw-light">
                                <h2 class="fw-light text-dark"><?php echo comment_name(); ?>
                                    <span class="float-end"><?php echo $i; ?></span>
                                </h2>
                                <time><?php echo relative_time(comment_time()); ?></time>
                                <p class="text-dark"> <?php echo comment_text(); ?> </p>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <form id="comment" class="commentform wrap" method="post"  action="<?php echo comment_form_url(); ?>#comment">
                <?php echo comment_form_notifications(); ?>

                <p class="mt-3">
                    <label for="name"><?php echo __('site.your_name'); ?>.</label>
                    <?php echo comment_form_input_name('placeholder="Your name"'); ?>
                </p>

                <p class="mt-3">
                    <label for="email"><?php echo __('site.your_email'); ?>.</label>
                    <?php echo Form::text('email', Input::previous('email'), array(
                        'name' => 'email',
                        'type' => 'email',
                        'id' => 'email',
                        'class' => 'form-control',
                        'placeholder' => __('site.your_email_placeholder')
                    )); ?>
                </p>

                <p class="mt-3">
                    <label for="text"><?php echo __('site.your_comment'); ?>.</label>
                    <?php echo Form::textarea('text', Input::previous('text'), array(
                        'id' => 'text',
                        'class' => 'form-control',
                        'placeholder' => __('site.your_comment_placeholder')
                    )); ?>
                </p>

                <p class="mt-3">
                    <?php echo Form::button(__('site.comment_submit'), array(
                        'type' => 'submit',
                        'class' => 'btn btn-primary',

                    )); ?>
                </p>
            </form>

        </section>
    <?php endif; ?>
</div>

<?php theme_include('footer'); ?>
