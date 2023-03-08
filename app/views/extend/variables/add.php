<?php echo $header; ?>

    <h3 class="float-start mt-3 mb-3"><?php echo __('extend.create_variable'); ?></h3>
    <div class="float-end mt-3 mb-3">
        <?php echo Form::button(__('global.save'), [
            'type' => 'submit',
            'form' => 'form-add',
            'class' => 'btn btn-success'
        ]); ?>

        <?php echo Html::link('admin/extend/variables/', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline-secondary'
        ]); ?>

    </div>

    <form id="form-add" method="post" action="<?php echo Uri::to('admin/extend/variables/add'); ?>"
          novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-name"><?php echo __('extend.name'); ?></label>
            <?php echo Form::text('key', Input::previous('key'), [
                'class' => 'form-control',
                'id' => 'label-name'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('extend.name_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-value"><?php echo __('extend.value'); ?></label>
            <?php echo Form::textarea('value', Input::previous('value'), ['cols' => 20,
                'class' => 'form-control',
                'id' => 'label-value'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('extend.value_explain'); ?></small>

    </form>

<?php echo $footer; ?>