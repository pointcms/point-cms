<?php echo $header; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var thehours = new Date().getHours();
            var themessage;
            var morning = ("<i class='bi bi-brightness-high'></i> <?php echo __('panel.good-morning') ?>");
            var afternoon = ("<i class='bi bi-brightness-alt-high'></i> <?php echo __('panel.good-afternoon') ?>");
            var evening = ("<i class='bi bi-cloud-moon'></i> <?php echo __('panel.good-evening') ?>");
            var night = ("<i class='bi bi-moon-stars'></i> <?php echo __('panel.good-night') ?>");

            if (thehours >= 0 && thehours < 12) {
                themessage = morning;
            } else if (thehours >= 12 && thehours < 17) {
                themessage = afternoon;
            } else if (thehours >= 17 && thehours < 20) {
                themessage = evening;
            } else if (thehours >= 20 && thehours < 24) {
                themessage = night;
            }
            $('.greeting').append(themessage);
        });
    </script>
    <div class="alert bg-body-secondary border-0 rounded-3 alert-dismissible" role="alert">
        <div class="lead text-center mt-3">
            <h4 class="fw-lighter"><?php echo __('panel.title', $user); ?> <span class="greeting"></span>
            </h4>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="row mb-5">
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.comments_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/comments'); ?>">
                        <div class="icon-square bg-primary text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-chat-right-dots-fill fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1><?php echo $total_comments; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.posts_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/posts'); ?>">
                        <div class="icon-square bg-info text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-pencil-fill fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1><?php echo $total_posts; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.pages_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/pages'); ?>">
                        <div class="icon-square bg-warning text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-file-earmark fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1><?php echo $total_pages; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

<?php if ($posts->count): ?>
    <?php foreach ($posts->results as $article): ?>
        <a href="<?php echo Uri::to('admin/posts/edit/' . $article->id); ?>" class="text-decoration-none">
            <div class="d-flex align-items-center">
                <div class="pl-2 col-md-10 col-sm-10 col-10">
                    <p class="text-truncate text-body-emphasis lead font-weight-bold mt-2 mb-0">
                        <?php echo $article->title; ?>
                    </p>
                    <p class="text-secondary mb-2">
                        <?php echo __('posts.posted'); ?><?php echo Date::format($article->created); ?>
                    </p>
                </div>
                <div class="ml-auto ps-4">
                    <div class="d-none d-md-inline">
                        <span class="text-muted mr-3"><?php echo $article->viewed; ?> Views</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                         viewBox="0 0 24 24" class="icon-cheveron-right-circle">
                        <circle cx="12" cy="12" r="10"
                                style="fill: none;"></circle>
                        <path data-v-74e272c6=""
                              d="M10.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"
                              class="fill-light-gray"></path>
                    </svg>
                </div>
            </div>
        </a>

    <?php endforeach; ?>
    <div class="d-flex justify-content-center">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $posts->links(); ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>


<?php echo $footer; ?>