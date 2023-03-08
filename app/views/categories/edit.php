<?php echo $header; ?>

        <h3 class="float-start mt-3 mb-3"><?php echo __('categories.edit_category'); ?></h3>
        <div class="float-end mt-3 mb-3">
            <?php echo Form::button(__('global.save'), [
                'type' => 'submit',
                'form' => 'form-edit',
                'class' => 'btn btn-success'
            ]); ?>

            <?php echo Html::link('admin/categories/delete/' . $category->id, '<i class="bi bi-trash"></i>', [
                'form' => 'form-edit',
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => __('global.delete'),
                'class' => 'btn btn-danger delete'
            ]); ?>

            <?php echo Html::link('admin/categories', '<i class="bi bi-x-lg"></i>', [
                'data-bs-toggle' => 'tooltip',
                'data-bs-title' => __('global.cancel'),
                'class' => 'btn btn-outline-secondary cancel'
            ]); ?>
        </div>
    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/categories/edit/' . $category->id); ?>" novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

            <div class="input-group mt-3 mb-3">
                <label class="input-group-text" for="label-title"><?php echo __('categories.title'); ?></label>
                <?php echo Form::text('title', Input::previous('title', $category->title), [
                    'class' => 'form-control',
                    'id' => 'label-title'
                ]); ?>
            </div>
            <small class="form-text"><?php echo __('categories.title_explain'); ?></small>

            <div class="input-group mt-3 mb-3">
                <label class="input-group-text" for="label-slug"><?php echo __('categories.slug'); ?></label>
                <?php echo Form::text('slug', Input::previous('slug', $category->slug), [
                    'class' => 'form-control',
                    'id' => 'label-slug'
                ]); ?>
            </div>
            <small class="form-text"><?php echo __('categories.slug_explain'); ?></small>
            <div class="input-group mt-3 mb-3">
                <label class="input-group-text"
                       for="label-description"><?php echo __('categories.description'); ?></label>
                <?php echo Form::textarea('description', Input::previous('description', $category->description),
                    [
                        'class' => 'form-control',
                        'id' => 'label-description'
                    ]); ?>
            </div>
            <small class="form-text"><?php echo __('categories.description_explain'); ?></small>

    </form>

    <script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/upload-fields.js'); ?>"></script>

<?php echo $footer; ?>