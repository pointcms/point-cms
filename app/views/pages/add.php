<?php echo $header; ?>
<form id="form-add" method="post" action="<?php echo Uri::to('admin/pages/add'); ?>"
      enctype="multipart/form-data" novalidate>
    <input name="token" type="hidden" value="<?php echo $token; ?>">
    <?php echo Form::text('title', Input::previous('title'), [
        'class' => 'form-control form-control-lg mb-3 fs-2 border-0',
        'placeholder' => __('pages.title'),
        'autocomplete' => 'off',
        'autofocus' => 'true'
    ]); ?>
    <div class="d-grid gap-2">
    <?php echo Form::button(__('pages.redirect'), [
        'class' => 'btn btn-secondary btn-block mb-2',
        'data-bs-toggle' => 'collapse',
        'href' => '#redirector'
    ]); ?>
    </div>
    <div class="redirect  collapse multi-collapse" id="redirector">
        <?php echo Form::text('redirect', Input::previous('redirect'), [
            'class' => 'form-control form-control-lg mb-3',
            'placeholder' => __('pages.redirect_url')
        ]); ?>
    </div>
    <small class="form-text text-muted mb-3"><?php echo __('pages.redirect_explain'); ?></small>
    <?php echo Form::textarea('description', Input::previous('description'), [
        'id' => 'description',
        'class' => 'form-control mb-3',
        'placeholder' => __('pages.description_explain')
    ]); ?>
    <div class="input-group mt-3 mb-3">
        <label class="input-group-text" for="label-show_in_menu"><?php echo __('pages.show_in_menu'); ?></label>
        <?php echo Form::checkbox('show_in_menu', 1, Input::previous('show_in_menu', 0) == 1,
            [
                'class' => 'form-check-input',
                'id' => 'label-show_in_menu'
            ]); ?>
    </div>
    <small class="form-text text-muted"><?php echo __('pages.show_in_menu_explain'); ?></small>
    <div class="input-group mt-3 mb-3">
        <label class="input-group-text" for="label-show_in_footer"><?php echo __('pages.show_in_footer'); ?></label>
        <?php echo Form::checkbox('show_in_footer', 1, Input::previous('show_in_footer', 0) == 1,
            [
                'class' => 'form-check-input',
                'id' => 'label-show_in_footer'
            ]); ?>
    </div>
    <small class="form-text text-muted"><?php echo __('pages.show_in_footer_explain'); ?></small>
    <div class="input-group mt-3 mb-3">
        <label class="input-group-text" for="label-name"><?php echo __('pages.name'); ?></label>
        <?php echo Form::text('name', Input::previous('name'), [
            'class' => 'form-control',
            'id' => 'label-name'
        ]); ?>
    </div>
    <small class="form-text text-muted"><?php echo __('pages.name_explain'); ?></small>
    <div class="input-group mt-3 mb-3">
        <label class="input-group-text" for="label-slug"><?php echo __('pages.slug'); ?></label>
        <?php echo Form::text('slug', Input::previous('slug'), [
            'class' => 'form-control',
            'id' => 'label-slug'
        ]); ?>
    </div>
    <small class="form-text text-muted"><?php echo __('pages.slug_explain'); ?></small>
    <div class="input-group mt-3 mb-3">
        <label class="input-group-text" for="label-status"><?php echo __('pages.status'); ?></label>
        <?php echo Form::select('status', $statuses, Input::previous('status'), [
            'class' => 'form-select',
            'id' => 'label-status'
        ]); ?>
    </div>
    <small class="form-text text-muted"><?php echo __('pages.status_explain'); ?></small>
    <div class="sticky-sm-bottom bg-body">
        <div class=" d-grid gap-2 pt-3 pb-3" role="group">
            <?php echo Form::button(__('global.save'), [
                'type' => 'submit',
                'form' => 'form-add',
                'class' => 'btn btn-success'
            ]); ?>
        </div>
    </div>
</form>
<script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
<script src="<?php echo asset('app/views/assets/js/page-name.js'); ?>"></script>
<script src="<?php echo asset('app/views/assets/js/redirect.js'); ?>"></script>
<?php echo $editor; ?>
<?php echo $footer; ?>
