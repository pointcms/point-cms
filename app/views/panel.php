<?php echo $header; ?>
    <div class="row mt-3">
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.comments_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/comments'); ?>">
                        <div class="icon-square bg-primary text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-chat-right-dots-fill fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo $total_comments; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.posts_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/posts'); ?>">
                        <div class="icon-square bg-info text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-pencil-fill fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo $total_posts; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.pages_total'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/pages'); ?>">
                        <div class="icon-square bg-warning text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-file-earmark fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo $total_pages; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.total_visitors'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <span class="d-flex cursor-pointer">
                        <div class="icon-square bg-secondary-subtle text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-people-fill fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo $total_visitors; ?></h1>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.online_visitors'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <span class="d-flex cursor-pointer">
                        <div class="icon-square bg-success-subtle text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-people fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo countOnlineVisitors(); ?></h1>
                            </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4 col-lg-4 mt-3">
            <div class="card bg-body-secondary border-0 rounded-3">
                <div class="card-header bg-transparent border-0 p-0 px-3 pt-3">
                    <?php echo __('panel.users'); ?>
                </div>
                <div class="card-body p-0 px-3 py-2">
                    <a class="d-flex" href="<?php echo Uri::to('admin/users'); ?>">
                        <div class="icon-square bg-primary-subtle text-body-emphasis flex-shrink-0 me-3">
                            <i class="bi bi-person-fill-gear fs-4 text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="float-end">
                                <h1 class="text-body-emphasis"><?php echo $total_users; ?></h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php echo $footer; ?>