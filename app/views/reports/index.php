<?php echo $header; ?>

    <h3 class="mt-3"><?php echo __('reports.reports'); ?></h3>

    <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/reports/post_viewed'); ?>">
        <div class="border-top pt-3 pb-3">
            <h5 class="text-body-emphasis"><strong><?php echo __('reports.posts'); ?></strong></h5>
            <span class="text-muted"><?php echo __('reports.posts_desc'); ?></span>
        </div>
    </a>

    <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/reports/visitors_online'); ?>">
        <div class="border-top pt-3 pb-3">
            <h5 class="text-body-emphasis"><strong><?php echo __('reports.visitors_online'); ?></strong></h5>
            <span class="text-muted"><?php echo __('reports.visitors_online_desc'); ?></span>
        </div>
    </a>


<?php echo $footer; ?>