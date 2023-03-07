<?php echo $header; ?>

    <div class="float-start mt-3 mb-3">
        <?php echo Form::button(__('global.save'), [
            'type' => 'submit',
            'form' => 'form-add',
            'class' => 'btn btn-primary'
        ]); ?>
    </div>
    <div class="float-end mt-3 mb-3">
        <?php echo Html::link('admin/posts', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline-secondary'
        ]); ?>
    </div>
    <form id="form-add" method="post" action="<?php echo Uri::to('admin/posts/add'); ?>"
          enctype="multipart/form-data" novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <?php echo Form::text('title', Input::previous('title'), array(
            'class' => 'form-control form-control-lg mb-3',
            'placeholder' => __('posts.title'),
            'autocomplete' => 'off',
            'autofocus' => 'true'
        )); ?>

        <?php echo Form::textarea('description', Input::previous('description'), array(
            'class' => 'form-control mb-3',
            'id' => 'description',
            'placeholder' => __('posts.description_explain')
        )); ?>

        <div class="card mt-3 text-center">
            <img id="show" src="<?php echo asset('app/views/assets/img/no_img.png'); ?>"
                 class="img-fluid img-thumbnail" alt="upload">
            <label for="image-upload" class="image-file-upload btn btn-primary shadow">
                <?php echo Form::file('image', [
                    'class' => 'btn btn-primary',
                    'id' => 'image-upload',
                ]); ?>
                <input type="hidden" name="image">

                <?php echo __('posts.upload_image'); ?>
            </label>
        </div>

        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" for="label-slug"><?php echo __('posts.slug'); ?></span>
            <?php echo Form::text('slug', Input::previous('slug'), array(
                'class' => 'form-control',
                'id' => 'label-slug'
            )); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.slug_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <span class="input-group-text"><?php echo __('posts.meta_description'); ?></span>
            <?php echo Form::textarea('meta_description', Input::previous('meta_description'), array(
                'id' => 'meta_description',
                'class' => 'form-control',
                'placeholder' => __('posts.meta_description'),
                'cols' => '5',
                'rows' => '5',
                'maxlength' => '160'
            )); ?>
        </div>
        <div class="position-relative clearfix">
            <div id="the-count">
                <span id="current">0</span>
                <span id="maximum">/ 160</span>
            </div>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.meta_description_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <span class="input-group-text" for="label-category"><?php echo __('posts.category'); ?></span>
            <?php echo Form::select('category', $categories, Input::previous('category'), array(
                'class' => 'form-select',
                'id' => 'label-category')); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.category_explain'); ?></small>
        <div class="input-group mt-3 mb-3"><span class="input-group-text" for="label-comments"><?php echo __('posts.allow_comments'); ?></span>
            <?php echo Form::checkbox('comments', 1, Input::previous('comments', 0) == 1, array(
                'class' => 'form-check-input',
                'id' => 'label-comments')); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('posts.allow_comments_explain'); ?></small>

        <?php if (Auth::admin() || Auth::editor()): ?>
            <div class="input-group mt-3 mb-3">
                <span class="input-group-text" for="label-status"><?php echo __('posts.status'); ?></span>
                <?php echo Form::select('status', $statuses, Input::previous('status'), array(
                    'class' => 'form-select',
                    'id' => 'label-status')); ?>
            </div>
            <small class="form-text text-muted"><?php echo __('posts.status_explain'); ?></small>
        <?php endif; ?>

    </form>

    <script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/upload-fields.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/character-counter.js'); ?>"></script>

    <script>
        $(function () {
            $("#image-upload").change(function () {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    //alert(e.target.result);
                    $('#show').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

<?php echo $editor; ?>

<?php echo $footer; ?>