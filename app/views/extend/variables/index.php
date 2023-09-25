<?php echo $header; ?>

    <div class="d-flex mb-3">
        <div class="me-auto p-2"><h3><?php echo __('extend.variables'); ?></h3></div>
        <div class="p-2">
            <?php echo Html::link('admin/extend/variables/add', __('extend.create_variable'), [
                'class' => 'btn btn-success',
            ]); ?>
        </div>
    </div>


<?php if (count($variables)): ?>
    <?php foreach ($variables as $var): ?>

        <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/extend/variables/edit/' . $var->key); ?>">
            <div class="border-top pt-3 pb-3">
                <h5 class="text-body-emphasis">
                    <strong><?php echo substr($var->key, strlen('custom_')); ?></strong></h5>
                <span class="text-muted"><?php echo e($var->value); ?></spam>
            </div>
        </a>

    <?php endforeach; ?>

<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('extend.novars_desc'); ?>
    </p>
<?php endif; ?>

<?php echo $footer; ?>