<?php echo $header; ?>
    <form id="form-edit" action="<?php echo Uri::to('admin/posts/edit/' . $article->id); ?>"
          method="post" enctype="multipart/form-data" novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">
        <?php echo Form::text('title', Input::previous('title', $article->title), [
            'class' => 'form-control form-control-lg mb-3 fs-2 border border-0',
            'placeholder' => __('posts.title'),
            'autocomplete' => 'off',
            'autofocus' => 'true'
        ]); ?>
        <!-- Tabs navs -->
        <ul class="nav nav-underline nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex3-tab-1" data-bs-toggle="tab" href="#ex3-tabs-1" role="tab"
                   aria-controls="ex3-tabs-1" aria-selected="true">
                    <?php echo __('posts.image'); ?>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex3-tab-2" data-bs-toggle="tab" href="#ex3-tabs-2" role="tab"
                   aria-controls="ex3-tabs-2" aria-selected="false">
                    <?php echo __('posts.video'); ?>
                </a>
            </li>
        </ul>
        <!-- Tabs navs -->
        <!-- Tabs content -->
        <div class="tab-content mb-3" id="ex2-content">
            <div class="tab-pane fade show active" id="ex3-tabs-1" role="tabpanel" aria-labelledby="ex3-tab-1">
                <div class="card border border-0 mt-3 text-center">
                    <button type="button" data-image-toggle='image'
                            class="btn btn-secondary mb-3"><?php echo __('posts.upload_image'); ?></button>
                    <input type="hidden" name="image" class="post-image" value="<?php echo $article->image; ?>">
                    <?php if ($article->image): ?>
                        <img id="show" src="<?php echo asset($article->image); ?>" class="img-fluid img-thumbnail"
                             alt="upload">
                    <?php else: ?>
                        <img id="show" src="<?php echo asset('app/views/assets/img/no_img.png'); ?>"
                             class="img-fluid img-thumbnail" alt="upload">
                    <?php endif; ?>
                </div>
                <small class="form-text text-muted"><?php echo __('posts.upload_image_explain'); ?></small>
            </div>
            <div class="tab-pane fade" id="ex3-tabs-2" role="tabpanel" aria-labelledby="ex3-tab-2">
                <div class="video-container mt-3 text-center">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="video-link"
                               placeholder="Enter YouTube or Vimeo link" name="videolink"
                               value="<?php echo $article->videolink; ?>">
                        <button class="btn btn-outline-secondary" type="button" id="preview-button">Preview Video
                        </button>
                    </div>
                    <div class="ratio ratio-16x9" id="video-preview"></div>
                </div>
            </div>
        </div>
        <!-- Tabs content -->
        <?php echo Form::textarea('description', Input::previous('description', $article->description), [
            'id' => 'description',
            'class' => 'form-control mb-3',
            'placeholder' => __('posts.description_explain')
        ]); ?>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" for="label-slug"><?php echo __('posts.slug'); ?></span>
            <?php echo Form::text('slug', Input::previous('slug', $article->slug), [
                'class' => 'form-control',
                'id' => 'label-slug'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.slug_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text"><?php echo __('posts.meta_description'); ?></span>
            <?php echo Form::textarea('meta_description', Input::previous('meta_description', $article->meta_description), [
                'id' => 'meta_description',
                'class' => 'form-control',
                'placeholder' => __('posts.meta_description_content'),
                'cols' => '5',
                'rows' => '5',
                'maxlength' => '160'
            ]); ?>
        </div>
        <div class="position-relative clearfix">
            <div id="the-count">
                <span id="current">0</span>
                <span id="maximum">/ 160</span>
            </div>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.meta_description_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text"><?php echo __('posts.time'); ?></span>
            <?php echo Form::text('created', Input::previous('created', $article->created), [
                'class' => 'form-control',

            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.time_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" for="label-category"><?php echo __('posts.category'); ?></span>
            <?php echo Form::select('category', $categories, Input::previous('category', $article->category), [
                'class' => 'form-select',
                'id' => 'label-category'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.category_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" for="label-comments"><?php echo __('posts.allow_comments'); ?></span>
            <?php echo Form::checkbox('comments', 1, Input::previous('comments', $article->comments) == 1, [
                'class' => 'form-check-input',
                'id' => ' label-comments'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.allow_comments_explain'); ?></small>
        <?php if (Auth::admin() || Auth::editor()): ?>
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" for="label-status"><?php echo __('posts.status'); ?></span>
                <?php echo Form::select('status', $statuses, Input::previous('status', $article->status), [
                    'class' => 'form-select',
                    'id' => 'label-status'
                ]); ?>
            </div>
            <small class="form-text text-muted"><?php echo __('posts.status_explain'); ?></small>
        <?php endif; ?>
        <div class="sticky-sm-bottom bg-body row">
               <div class="col-md px-0 d-grid gap-2">
                   <?php echo Form::button(__('global.save'), [
                       'type' => 'submit',
                       'form' => 'form-edit',
                       'class' => 'btn btn-success m-2'
                   ]); ?>
               </div>
                <div class="col-md px-0 d-grid gap-2">
                    <?php echo Html::link('admin/posts/delete/' . $article->id, __('global.delete'), [
                        'form' => 'form-edit',
                        'class' => 'btn btn-danger btn-block m-2 delete'
                    ]); ?>
                </div>
            <div class="col-md px-0 d-grid gap-2 ">
            <?php echo Html::link('admin/posts', __('global.cancel'), array(
                'class' => 'btn btn-link btn-block fw-bold text-muted text-decoration-none m-2'
            )); ?>
            </div>
        </div>
    </form>
    <script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/character-counter.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/video-preview.js'); ?>"></script>
<?php echo $editor; ?>
<?php echo $footer; ?>