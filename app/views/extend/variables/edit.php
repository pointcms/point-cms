<?php echo $header; ?>
    <h3 class="float-start mt-3 mb-3"><?php echo __('extend.editing_variable'); ?></h3>
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
            <?php echo Form::textarea('value', Input::previous('value', $variable->value),  [
                    'cols' => 20,
                    'class' => 'form-control',
                    'id' => 'label-value'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('extend.value_explain'); ?></small>
        <div class="card p-3 mt-3">
            <?php echo __('extend.value_code_snipet', $variable->user_key); ?>
        </div>
        <div class="sticky-sm-bottom bg-body">
            <div class="d-grid gap-2 pt-3 pb-2" role="group">
                <?php echo Form::button(__('global.update'), [
                    'type' => 'submit',
                    'form' => 'form-edit',
                    'class' => 'btn btn-success'
                ]); ?>
            </div>
        </div>
        <div class="d-grid gap-2 pb-3" role="group">
            <?php echo Html::link('admin/extend/variables/delete/' . $variable->key, __('global.delete'), [
                'form' => 'form-edit',
                'class' => 'btn btn-danger delete'
            ]); ?>
            <?php echo Html::link('admin/extend/variables/', __('global.cancel'), [
                'class' => 'btn btn-sm btn-primary'
            ]); ?>
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