<?php echo $header; ?>

<div class="row mt-5">
    <div class="col-md-6 offset-md-3 mt-5 text-center">
        <form method="post" action="<?php echo Uri::to('admin/amnesia'); ?>">
            <input name="token" type="hidden" value="<?php echo $token; ?>">

            <div>
                <div class="input-group mb-3">
                    <label class="input-group-text" for="label-email"><?php echo __('users.email'); ?></label>
                    <?php echo Form::email('email', Input::previous('email'), [
                        'class' => 'form-control',
                        'id' => 'label-email',
                        'autocapitalize' => 'off',
                        'autofocus' => 'true',
                        'placeholder' => __('users.your_email')
                    ]); ?>
                </div>


                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit"><?php echo __('global.reset'); ?></button>
                </div>
                <a href="<?php echo Uri::to('admin/login'); ?>
                    "><?php echo __('users.remembered'); ?></a>

            </div>

        </form>

    </div>
</div>

<?php echo $footer; ?>
