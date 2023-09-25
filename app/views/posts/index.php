<?php echo $header; ?>
    <div class="d-flex mt-3 mb-3">
        <div class="me-auto"><h3><?php echo __('posts.posts'); ?></h3></div>
        <div class="ps-2">
            <div class="input-group border-03">
                <select onchange="location = this.value;" class="form-select">
                    <option value="<?php echo Uri::to('admin/posts'); ?>" <?php if ($status == 'all'): ?> selected<?php endif; ?>><?php echo __('global.all'); ?></option>
                    <?php if(Auth::admin() || Auth::editor()): ?>
                    <option value="<?php echo Uri::to('admin/posts/my-posts'); ?>" <?php if ($status == 'my-posts'): ?> selected<?php endif; ?>><?php echo __('global.my_posts'); ?></option>
                   <?php endif; ?>
                    <?php foreach (['published', 'draft', 'archived'] as $type): ?>
                        <option value="<?php echo Uri::to('admin/posts/status/' . $type); ?>" <?php if ($status == $type): ?> selected<?php endif; ?>><?php echo __('global.' . $type); ?></option>
                    <?php endforeach; ?>
                </select>
                <label class="input-group-text"><i class="bi bi-funnel"></i></label>
            </div>
        </div>
    </div>
<?php if ($posts->count): ?>
    <?php foreach ($posts->results as $article): ?>
        <a href="<?php echo Uri::to('admin/posts/edit/' . $article->id); ?>" class="mt-3 text-decoration-none">
            <div class="d-flex align-items-center border-top pt-3 pb-3">
                <div class="pl-2 col-md-11 col-sm-11 col-11 py-1">
                    <p class="text-truncate lead text-body-emphasis font-weight-bold mb-0">
                        <?php echo $article->title; ?>
                    </p>
                    <p class="mb-1 text-secondary text-truncate">
                        <?php echo substr(strip_tags(html_entity_decode($article->description)), 0, 100); ?>
                    </p>
                    <!---->
                    <p class="text-secondary mt-1 mb-0">
                        <?php if ($article->status == 'published'): ?>
                            <span><?php echo __('posts.posted'); ?><?php echo Date::format($article->created); ?> </span>
                        <?php else: ?>
                            <span class="<?php echo $article->status; ?>"> <?php echo __('global.' . $article->status); ?></span>
                        <?php endif; ?>
                        <span class="d-none d-md-inline">― <?php echo __('posts.post_updated'); ?> <?php echo relative_time_admin($article->updated); ?></span>
                    </p>
                    <!---->
                </div>
                <div class="ml-auto d-none d-md-inline pl-3">
                    <div class="mx-3 align-middle">
                        <?php if ($article->image): ?>
                            <?php $image = $article->image; ?>
                        <?php else: ?>
                            <?php $image = 'app/views/assets/img/no_image.png'; ?>
                        <?php endif; ?>
                        <img src="<?php echo Uri::to($image); ?>" alt="<?php echo $article->title; ?>"
                             class="mr-2 ml-3 shadow-inner rounded-circle" style="width: 57px; height: 57px;">
                    </div>
                </div>
                <div class="d-inline d-lg-none pl-5 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24"
                         class="icon-cheveron-right-circle">
                        <circle cx="12" cy="12" r="10" style="fill: none;"></circle>
                        <path d="M10.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"
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
<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('posts.noposts_desc'); ?> <?php echo Html::link('admin/posts/add', __('posts.create_post'), ['class' => 'fw-semibold']); ?>
    </p>
<?php endif; ?>
<?php echo $footer; ?>