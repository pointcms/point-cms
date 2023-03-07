<?php echo $header; ?>

    <div class="d-flex mt-3 mb-3">
        <div class="me-auto p-2"><h3><?php echo __('users.users'); ?></h3></div>
        <?php if (Auth::admin()) : ?>
            <div class="p-2">
                <?php echo Html::link('admin/users/add', '<i class="bi bi-plus-lg"></i>', [
                    'class' => 'btn btn-outline',
                    'data-bs-toggle' => 'tooltip',
                    'data-bs-title' => __('users.create_user')
                ]); ?>
            </div>
        <?php endif; ?>

    </div>

<?php foreach ($users->results as $user): ?>
    <a href="<?php echo Uri::to('admin/users/edit/' . $user->id); ?>" class="mt-3 text-decoration-none">
        <div class="d-flex border-top pt-3 pb-3">
            <div class="flex-grow-1 me-3">
                <div class="pl-2 col-md-8 col-sm-10 col-10 py-1">
                    <p class="text-body-emphasis mb-0 lead font-weight-bold text-truncate"><?php echo $user->real_name; ?></p>
                    <p class="mb-1 text-secondary"><?php echo $user->email; ?></p>
                </div>
            </div>
            <div class="flex-shrink-0">
                <div class="ml-auto d-none d-lg-inline pl-3">
                    <div class="d-none d-md-inline">
                        <span class="text-muted mr-3"><?php echo __('users.' . $user->role); ?></span>
                    </div>
                    <?php if ($user->image): ?>
                        <?php $avatar = $user->image; ?>
                    <?php else: ?>
                        <?php $avatar = 'app/views/assets/img/no_image.png'; ?>
                    <?php endif; ?>
                    <img src="<?php echo Uri::to($avatar); ?>"
                         alt="<?php echo $user->real_name; ?>"
                         class="mr-2 ml-3 shadow-inner rounded-circle"
                         style="width: 57px; height: 57px;">
                </div>
                <div class="d-inline d-lg-none pl-5 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" viewBox="0 0 24 24"
                         class="icon-cheveron-right-circle">
                        <circle cx="12" cy="12" r="10" style="fill: none;"></circle>
                        <path d="M10.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"
                              class="fill-light-gray"></path>
                    </svg>
                </div>
            </div>
        </div>
    </a>
<?php endforeach; ?>

    <div class="d-flex justify-content-center">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $users->links(); ?>
            </ul>
        </nav>
    </div>


<?php echo $footer; ?>