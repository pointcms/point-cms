<?php echo $header; ?>
<div class="row mt-5">
    <div class="col-md-6 offset-md-3 mt-5">

        <?php $user = filter_var(Input::previous('user'), FILTER_SANITIZE_STRING); ?>

        <form method="post" action="<?php echo Uri::to('admin/login'); ?>">
            <input name="token" type="hidden" value="<?php echo $token; ?>">

            <div class="form-floating mb-3">
                <?php echo Form::text('user', $user, [
                    'class' => 'form-control',
                    'id' => 'label-user',
                    'autocapitalize' => 'off',
                    'placeholder' => __('users.username')
                ]); ?>
                <label for="label-user"><?php echo __('users.username'); ?></label>
            </div>

            <div class="form-floating mb-2">
                <?php echo Form::password('pass', [
                    'class' => 'form-control',
                    'id' => 'pass',
                    'placeholder' => __('users.password'),
                    'autocomplete' => 'off'
                ]); ?>
                <label for="label-pass"><?php echo __('users.password'); ?></label>
            </div>

            <a class="text-reset" href="<?php echo Uri::to('admin/amnesia'); ?>"><?php echo __('users.forgotten_password'); ?></a>
            <div class="mt-3">
                <button class="w-100 btn btn-lg btn-primary" type="submit"><?php echo __('global.login'); ?></button>
            </div>
        </form>

    </div>
</div>
<?php echo $footer; ?>
