<?php echo $header; ?>

        <div class="row mt-5">
            <div class="col-md-6 offset-md-3 mt-5 text-center">

                <form method="post" action="<?php echo Uri::to('admin/reset/' . $key); ?>">
                    <input name="token" type="hidden" value="<?php echo $token; ?>">

                    <div class="input-group mb-3">
                        <label class="input-group-text"
                               for="label-pass"><?php echo __('users.new_password'); ?></label>
                        <?php echo Form::password('pass', ['placeholder' => __('users.input_new_password'),
                            'class' => 'form-control',
                            'id' => 'label-pass'
                        ]); ?>
                    </div>

                    <div class="d-grid gap-2 mt-3">
                        <?php echo Form::button(__('global.submit'), [
                            'class' => 'btn btn-primary',
                            'type' => 'submit']); ?>
                    </div>

                </form>

            </div>
        </div>

<?php echo $footer; ?>