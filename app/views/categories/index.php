<?php echo $header; ?>
    <div class="d-flex mt-3 mb-3">
        <div class="me-auto"><h3><?php echo __('categories.categories'); ?></h3></div>
        <div class="ps-2">
            <?php echo Html::link('admin/categories/add', __('categories.create_category'), [
                'class' => 'btn btn-success',
            ]); ?>
        </div>
    </div>
<?php if ($categories->count): ?>
    <?php foreach ($categories->results as $category): ?>
        <a class="mt-3 text-decoration-none"
           href="<?php echo Uri::to('admin/categories/edit/' . $category->id); ?>">
            <div class="border-top pt-3 pb-3">
                <h5 class="text-body-emphasis">
                    <strong><?php echo $category->title; ?></strong>
                </h5>
                <span class="text-muted"><?php echo $category->slug; ?></span>
            </div>
        </a>
    <?php endforeach; ?>
    <div class="d-flex justify-content-center">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $categories->links(); ?>
            </ul>
        </nav>
    </div>
<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('categories.nocategories_desc'); ?> <?php echo Html::link('admin/categories/add', __('categories.create_category'), ['class' => 'fw-semibold']); ?>
    </p>
<?php endif; ?>
<?php echo $footer; ?>