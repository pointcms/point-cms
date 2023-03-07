<?php echo $header; ?>

    <h3 class="float-start mt-3 mb-3"><?php echo __('extend.editing_variable'); ?></h3>
    <div class="float-end mt-3 mb-3">
        <?php echo Form::button(__('global.update'), [
            'type' => 'submit',
            'form' => 'form-edit',
            'class' => 'btn btn-success'
        ]); ?>

        <?php echo Html::link('admin/extend/variables/delete/' . $variable->key, '<i class="bi bi-trash"></i>', [
            'form' => 'form-edit',
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.delete'),
            'class' => 'btn btn-danger delete'
        ]); ?>

        <?php echo Html::link('admin/extend/variables/', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline-secondary'
        ]); ?>

    </div>
    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/extend/variables/edit/' . $variable->key); ?>"
          novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-name"><?php echo __('extend.name'); ?>:</label>
            <?php echo Form::text('key', Input::previous('key', $variable->user_key), [
                'class' => 'form-control',
                'id' => 'label-name']); ?>
        </div>
        <small class="form-text"><?php echo __('extend.name_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-value"><?php echo __('extend.value'); ?>:</label>
            <?php echo Form::textarea('value', Input::previous('value', $variable->value),
                ['cols' => 20,
                    'class' => 'form-control',
                    'id' => 'label-value']); ?>
        </div>
        <small class="form-text"><?php echo __('extend.value_explain'); ?></small>

        <div class="card p-3 mt-3">
            <?php echo __('extend.value_code_snipet', $variable->user_key); ?>
        </div>

    </form>

    <script>
        function myFunction() {
            var copyText = document.getElementById("code");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert("Copied the text: " + copyText.value);
        }
    </script>
<?php echo $footer; ?>