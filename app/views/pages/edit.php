<?php echo $header; ?>

    <h3 class="float-start mt-3 mb-3"><?php echo __('pages.edit_page'); ?></h3>
    <div class="float-end mt-3 mb-3">
        <?php echo Form::button(__('global.save'), [
            'type' => 'submit',
            'form' => 'form-edit',
            'class' => 'btn btn-success'
        ]); ?>

        <?php echo Form::button(__('pages.redirect'), [
            'class' => 'btn btn-primary',
            'data-bs-toggle' => 'collapse',
            'href' => '#redirector'
        ]); ?>

        <?php echo Html::link('admin/pages/delete/' . $page->id, '<i class="bi bi-trash"></i>', [
            'form' => 'form-edit',
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.delete'),
            'class' => 'btn btn-danger delete'
        ]); ?>

        <?php echo Html::link('admin/pages', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline-secondary'
        ]); ?>

    </div>
    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/pages/edit/' . $page->id); ?>"
          enctype="multipart/form-data"
          novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <?php echo Form::text('title', Input::previous('title', $page->title), [
            'placeholder' => __('pages.title'),
            'class' => 'form-control form-control-lg mb-3',
            'autocomplete' => 'off',
            'autofocus' => 'true'
        ]); ?>

        <div class="redirect  collapse multi-collapse" id="redirector">
            <?php echo Form::text('redirect', Input::previous('redirect', $page->redirect), [
                'class' => 'form-control form-control-lg mb-3',
                'placeholder' => __('pages.redirect_url')
            ]); ?>

        </div>

        <?php echo Form::textarea('description', Input::previous('description', $page->description), [
            'id' => 'description',
            'class' => 'form-control mb-3',
            'placeholder' => __('pages.description_explain')
        ]); ?>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-show_in_menu"><?php echo __('pages.show_in_menu'); ?></label>
            <?php echo Form::checkbox('show_in_menu', 1, Input::previous('show_in_menu', $page->show_in_menu) == 1,
                [
                    'class' => 'form-check-input',
                    'id' => 'label-show_in_menu'
                ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('pages.show_in_menu_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-show_in_footer"><?php echo __('pages.show_in_footer'); ?></label>
            <?php echo Form::checkbox('show_in_footer', 1, Input::previous('show_in_footer', $page->show_in_footer) == 1,
                [
                    'class' => 'form-check-input',
                    'id' => 'label-show_in_footer'
                ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('pages.show_in_footer_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-name"><?php echo __('pages.name'); ?></label>
            <?php echo Form::text('name', Input::previous('name', $page->name), [
                'class' => 'form-control',
                'id' => 'label-name'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('pages.name_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-slug"><?php echo __('pages.slug'); ?></label>
            <?php echo Form::text('slug', Input::previous('slug', $page->slug), [
                'class' => 'form-control',
                'id' => 'label-slug'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('pages.slug_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-status"><?php echo __('pages.status'); ?></label>
            <?php echo Form::select('status', $statuses, Input::previous('status', $page->status),
                [
                    'class' => 'form-select',
                    'id' => 'label-status'
                ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('pages.status_explain'); ?></small>

    </form>

    <script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/page-name.js'); ?>"></script>
    <script src="<?php echo asset('app/views/assets/js/redirect.js'); ?>"></script>

<?php echo $editor; ?>

<?php echo $footer; ?>