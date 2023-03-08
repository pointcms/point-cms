<?php echo $header; ?>

<?php if (Auth::admin() || Auth::me($user->id)) : ?>
    <div class="row">
        <div class="col">
            <h3 class="float-start mt-3 mb-3"><?php echo __('users.editing_user'); ?></h3>
            <div class="float-end mt-3 mb-3">
                <?php echo Form::button(__('global.update'), [
                    'type' => 'submit',
                    'form' => 'form-edit',
                    'class' => 'btn btn-success'
                ]); ?>

                <?php echo Html::link('admin/users/delete/' . $user->id, '<i class="bi bi-trash"></i>', [
                    'form' => 'form-edit',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-title' => __('global.delete'),
                    'class' => 'btn btn-danger delete'
                ]); ?>

                <?php echo Html::link('admin/users/', '<i class="bi bi-x-lg"></i>', [
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-title' => __('global.cancel'),
                    'class' => 'btn btn-outline-secondary'
                ]); ?>

            </div>
        </div>
    </div>


    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/users/edit/' . $user->id); ?>"
          novalidate autocomplete="off"
          enctype="multipart/form-data">
        <input name="token" type="hidden" value="<?php echo $token; ?>">
        <div class="card">
            <div class="card-body py-4">
                <a class="d-flex justify-content-end" data-bs-toggle="collapse" href="#collapseExample" role="button"
                   aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-info-circle"></i>
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body m-3">
                        <h5 class="card-title">Roles & Permissions</h5>
                        <ul>
                            <li> Contributor (A user who can write and manage their own posts but cannot publish them) </li>
                            <li>  Editor (A user who can publish and manage posts including the posts of other users) </li>
                            <li> Admin (A user who can do everything and see everything) </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 px-0 text-center">
                        <?php if ($user->image): ?>
                            <img id="show" src="<?php echo asset($user->image); ?>" alt="Avatar"
                                 class="img-fluid avatar-md rounded-circle img-thumbnail">
                        <?php else: ?>
                            <img id="show" src="<?php echo asset('app/views/assets/img/no_avatar.png'); ?>" alt="Avatar"
                                 class="img-fluid avatar-md rounded-circle img-thumbnail">
                        <?php endif; ?>
                        <br>
                        <label for="image-upload" class="user-image-upload btn btn-primary mt-2 mb-2">
                            <?php echo Form::file('image', [
                                'id' => 'image-upload',
                            ]); ?>
                            <input type="hidden" name="image" value="<?php echo $user->image; ?>">
                            <?php echo __('users.upload_image'); ?>
                        </label>
                    </div>
                    <div class="col-12 col-md-9 align-self-center px-0 text-center text-md-start">
                        <h5 class="mt-0 mb-1 font-weight-bold"><?php echo $user->real_name; ?> -
                            <small><?php echo __('users.' . $user->role); ?></small></h5>
                        <a href="mailto:<?php echo $user->email; ?>"
                           class="mb-1 text-primary text-decoration-none"><?php echo $user->email; ?></a>
                        <p class="text-secondary mb-0">
                            Posts ― <?php echo $posts_count; ?>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-real_name"><?php echo __('users.real_name'); ?></label>
            <?php echo Form::text('real_name', Input::previous('real_name', $user->real_name),
                [
                    'class' => 'form-control',
                    'id' => 'label-real_name'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.real_name_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-bio"><?php echo __('users.bio'); ?></label>
            <?php echo Form::textarea('bio', Input::previous('bio', $user->bio),
                [
                    'cols' => 20,
                    'class' => 'form-control',
                    'id' => 'label-bio'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.bio_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-status"><?php echo __('users.status'); ?></label>
            <?php echo Form::select('status', $statuses, Input::previous('status', $user->status),
                [
                    'class' => 'form-control',
                    'id' => 'label-status'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.status_explain'); ?></small>

        <?php if (Auth::admin()) : ?>

            <div class="input-group mt-3 mb-3">
                <label class="input-group-text" for="label-role"><?php echo __('users.role'); ?></label>
                <?php echo Form::select('role', $roles, Input::previous('role', $user->role),
                    [
                        'class' => 'form-select',
                        'id' => 'label-role'
                    ]); ?>
            </div>
            <small class="form-text"><?php echo __('users.role_explain'); ?></small>

        <?php endif; ?>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-username"><?php echo __('users.username'); ?></label>
            <?php echo Form::text('username', Input::previous('username', $user->username),
                [
                    'class' => 'form-control',
                    'id' => 'label-username'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.role_explain'); ?></small>

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
            <?php echo Form::text('email', Input::previous('email', $user->email), [
                'class' => 'form-control',
                'id' => 'label-email'
            ]); ?>
        </div>
        <small class="form-text"><?php echo __('users.email_explain'); ?></small>

    </form>

<?php else : ?>

    <p class="mt-5 ms-5 me-5 lead">
        You do not have the required privileges to modify this users information, you must be
        an Administrator. Please contact the Administrator of the site if you are supposed to have
        these privileges.
    </p>
    <br>
    <div class="d-grid gap-2 col-6 mx-auto">
        <a class="btn btn-primary" href="<?php echo Uri::to('admin/users'); ?>">Go back</a>
    </div>

<?php endif; ?>

    <script src="<?php echo asset('app/views/assets/js/upload-fields.js'); ?>"></script>
    <script>
        $(function () {
            $("#image-upload").change(function () {
                readURL(this);
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    //alert(e.target.result);
                    $('#show').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php echo $footer; ?>