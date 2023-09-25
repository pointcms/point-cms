<?php theme_include('header'); ?>
<div class="col-xl-10 mx-auto">
    <article>
        <h1 class="fw-light"><?php echo article_title(); ?></h1>
        <div class="mt-3">
            <img src="<?php echo article_image(); ?>" class="img-fluid" alt="<?php echo article_title(); ?>"/>
            <?php echo article_videolink(); ?>
        </div>
        <div class="mt-2">
            <?php echo article_description(); ?>
        </div>
        <footer class="fw-light ps-0 text-muted list-inline">
            <!-- Unfortunately, CSS means everything's got to be inline. -->
            <p class="list-inline-item"><?php echo __('site.this_article_is_my'); ?> <?php echo numeral(article_number(article_id()), true); ?> <?php echo __('site.oldest'); ?> <?php echo __('site.it_is'); ?> <?php echo count_words(article_description()); ?> <?php echo __('site.words_long'); ?> <?php if (comments_open()): ?>, <?php echo __('site.and_it_s_got'); ?><?php echo total_comments() . pluralise(total_comments(), ' comment'); ?><?php endif; ?>
            <li class="list-inline-item dropup-start dropup">
                <a class="text-decoration-none text-muted" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" aria-hidden="true" fill="currentColor" fill-rule="evenodd" focusable="false" role="img" viewBox="0 0 24 24"><path d="M13.617 3.076a1 1 0 011.09.217l7 7a1 1 0 010 1.414l-7 7A1 1 0 0113 18v-3h-1.104a7 7 0 00-4.482 1.622L3.64 19.768a1 1 0 01-1.58-1.11l2.086-5.734A9 9 0 0112.6 7h.4V4a1 1 0 01.617-.924zM15 6.414V8a1 1 0 01-1 1h-1.4a7 7 0 00-6.574 4.608l-.819 2.25.927-.772A9 9 0 0111.896 13H14a1 1 0 011 1v1.586L19.586 11 15 6.414z"></path></svg>
                Share
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="copyLink()" href="javascript:void(0)"><i class="bi bi-link-45deg"></i> Copy link</a></li>
                    <li><a class="dropdown-item" onclick="shareFacebook()" href="javascript:void(0)"><i class="bi bi-facebook"></i> Facebook</a></li>
                    <li><a class="dropdown-item"  onclick="shareTwitter()" href="javascript:void(0)"><i class="bi bi-twitter"></i> Twitter</a></li>
                </ul>
            </li>
            <!-- Like button -->
            <button id="like-button" class="btn btn-like list-inline-item float-end" data-article-id="<?php echo article_id(); ?>" <?php echo hasLiked(article_id()) ? 'disabled' : ''; ?>>
                <?php if (hasLiked(article_id())): ?>
                    <i class="bi bi-heart-fill text-danger" data-bs-toggle="tooltip" data-bs-title="You've liked this post!"></i> <!-- Display filled heart icon -->
                <?php else: ?>
                    <i class="bi bi-heart text-danger" data-bs-toggle="tooltip" data-bs-title="Do you like this post? Vote"></i> <!-- Display empty heart icon -->
                <?php endif; ?>
                <span id="like-count"><?php echo total_likes(); ?></span>
            </button>
            </p>
        </footer>
    </article>
    <div class="d-flex">
        <div class="flex-shrink-0">
            <img src="<?php echo article_author_avatar(); ?>" class="rounded-circle" alt="<?php echo article_author(); ?>" style="width: 60px; height: 60px;">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5  class="fw-light"><?php echo article_author(); ?></h5>
            <p><?php echo article_author_bio(); ?></p>
        </div>
    </div>
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
                    <?php echo Form::text('name', Input::previous('name'), array(
                        'name' => 'name',
                        'type' => 'text',
                        'id' => 'name',
                        'class' => 'form-control',
                        'placeholder' => __('site.your_name_placeholder')
                    )); ?>
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
<script>
    function copyLink() {
        var currentURL = window.location.href;

        // Create a temporary text area element
        var tempTextArea = document.createElement("textarea");
        tempTextArea.value = currentURL;
        tempTextArea.style.position = "fixed"; // to prevent it from affecting the layout
        document.body.appendChild(tempTextArea);

        // Select the text inside the text area
        tempTextArea.select();

        // Use the Clipboard API to copy the selected text
        navigator.clipboard.writeText(currentURL)
            .then(() => {
                console.log("URL copied to clipboard:", currentURL);
            })
            .catch(error => {
                console.error("Unable to copy URL to clipboard:", error);
            })
            .finally(() => {
                // Clean up: remove the temporary text area
                document.body.removeChild(tempTextArea);
            });
    }
    function shareFacebook() {
        window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href));
    }
    function shareTwitter() {
        window.open("https://twitter.com/intent/tweet?url=" + encodeURIComponent(window.location.href));
    }
</script>
<!-- JavaScript for handling AJAX requests -->
<script>
    $(document).ready(function() {
        $('#like-button').click(function () {
            console.log("Button clicked"); // Log a message to confirm the button click
            var article_id = $(this).data('article-id');
            console.log("Article ID: " + article_id); // Log the article ID
            // Send an AJAX request to like the article
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('like'); ?>',
                data: { article_id: article_id },
                success: function (response) {
                    if (response.success) {
                        console.log("Like successful"); // Log if the like was successful
                        console.log("Like count: " + response.likeCount); // Log the updated like count
                        // Update the like count and button state
                        $('#like-count').text(+ response.likeCount);
                        $('#like-button').prop('disabled', true);
                        $('#like-button i').removeClass('bi-heart').addClass('bi-heart-fill');
                    } else {
                        console.log("Like failed"); // Log if the like failed
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", status, error); // Log AJAX errors
                }
            });
        });
    });

</script>

<?php theme_include('footer'); ?>
