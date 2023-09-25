<?php echo $header; ?>
<?php if (Auth::admin()) : ?>
    <h2 class="float-start mt-3 mb-3"><?php echo __('users.add_user'); ?></h2>
<?php endif; ?>
<form id="form-add" method="post" action="<?php echo Uri::to('admin/users/add'); ?>" novalidate
      autocomplete="off"
      enctype="multipart/form-data">
    <input name="token" type="hidden" value="<?php echo $token; ?>">
    <?php if (Auth::admin()) : ?>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-real_name"><?php echo __('users.real_name'); ?></label>
            <?php echo Form::text('real_name', Input::previous('real_name'), [
                'class' => 'form-control',
                'id' => 'label-real_name'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.real_name_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-bio"><?php echo __('users.bio'); ?></label>
            <?php echo Form::textarea('bio', Input::previous('bio'), [
                'cols' => 20,
                'class' => 'form-control',
                'id' => 'label-bio'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.bio_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-status"><?php echo __('users.status'); ?></label>
            <?php echo Form::select('status', $statuses, Input::previous('status'), [
                'class' => 'form-control',
                'id' => 'label-status'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.status_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-role"><?php echo __('users.role'); ?></label>
            <?php echo Form::select('role', $roles, Input::previous('role'), [
                'class' => 'form-select',
                'id' => 'label-role'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.role_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-username"><?php echo __('users.username'); ?></label>
            <?php echo Form::text('username', Input::previous('username'), [
                'class' => 'form-control',
                'id' => 'label-username'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.username_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-password"><?php echo __('users.password'); ?></label>
            <?php echo Form::password('password', [
                'class' => 'form-control',
                'id' => 'label-password'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.password_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-email"><?php echo __('users.email'); ?></label>
            <?php echo Form::text('email', Input::previous('email'), [
                'class' => 'form-control',
                'id' => 'label-email'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.email_explain'); ?></small>
        <div class="sticky-sm-bottom bg-body">
            <div class=" d-grid gap-2 pt-3 pb-3" role="group">
                <?php echo Form::button(__('global.create'), [
                    'class' => 'btn btn-success',
                    'type' => 'submit',
                    'form' => 'form-add',
                ]); ?>
                <?php echo Html::link('admin/users', __('global.cancel'), [
                    'class' => 'btn btn-primary'
                ]); ?>
            </div>
        </div>
    <?php else : ?>
        <p class="mt-5 ms-5 me-5 lead">You do not have the required privileges to modify this users
            information, you must
            be an Administrator.
            Please
            contact the Administrator of the site if you are supposed to have these privileges.</p>
        <br>
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" href="<?php echo Uri::to('admin/users'); ?>">Go back</a>
        </div>
    <?php endif; ?>
</form>
<?php echo $footer; ?>
