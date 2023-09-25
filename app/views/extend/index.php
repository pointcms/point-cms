<?php echo $header; ?>
    <div class="d-flex mb-3">
        <div class="me-auto"><h3><?php echo __('extend.extend'); ?></h3></div>
    </div>
    <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/extend/metadata'); ?>">
        <div class="border-top pt-3 pb-3">
            <h5 class="text-body-emphasis"><strong><?php echo __('metadata.metadata'); ?></strong></h5>
            <span class="text-muted"><?php echo __('metadata.metadata_desc'); ?></span>
        </div>
    </a>
    <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/extend/variables'); ?>">
        <div class="border-top pt-3 pb-3">
            <h5 class="text-body-emphasis"><strong><?php echo __('extend.variables'); ?></strong></h5>
            <span class="text-muted"><?php echo __('extend.variables_desc'); ?></span>
        </div>
    </a>
    <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/extend/social'); ?>">
        <div class="border-top pt-3 pb-3">
            <h5 class="text-body-emphasis"><strong><?php echo __('metadata.social'); ?></strong></h5>
            <span class="text-muted"><?php echo __('metadata.social_desc'); ?></span>
        </div>
    </a>
<?php echo $footer; ?>