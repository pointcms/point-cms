<?php echo $header; ?>
    <div class="d-flex mt-3 mb-3">
        <div class="me-auto"><h3><?php echo __('pages.pages'); ?></h3></div>
        <div class="ps-2">
            <select onchange="location = this.value;" class="form-select">
                <option value="<?php echo Uri::to('admin/pages'); ?>" <?php if ($status == 'all'): ?> selected<?php endif; ?>><?php echo __('global.all'); ?></option>
                <?php foreach (['published', 'draft', 'archived'] as $type): ?>
                    <option value="<?php echo Uri::to('admin/pages/status/' . $type); ?>" <?php if ($status == $type): ?> selected<?php endif; ?>><?php echo __('global.' . $type); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="ps-2">
            <?php if ($pages->count): ?>
                <?php echo Html::link('admin/pages/add', __('pages.create_page'), [
                    'class' => 'btn btn-success',
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
<?php if ($pages->count): ?>
    <?php foreach ($pages->results as $item): ?>
        <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/pages/edit/' . $item->id); ?>">
            <div class="border-top pt-3 pb-3">
                <h5 class="text-body-emphasis">
                    <strong><?php echo $item->title; ?></strong>
                </h5>
                <p class="text-muted">
                    <?php echo substr(strip_tags($item->description), 0, 150); ?>
                </p>
                <small>
                    <status class="text-<?php echo $item->status; ?>"><?php echo __('global.' . $item->status); ?></status>
                    -
                    <date class="text-muted"><?php echo __('posts.posted'); ?><?php echo Date::format($item->created); ?></date>
                </small>
            </div>
        </a>
    <?php endforeach; ?>
    <div class="d-flex justify-content-center">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $pages->links(); ?>
            </ul>
        </nav>
    </div>
<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('pages.nopages_desc'); ?> <span class="ps-1"><?php echo Html::link('admin/pages/add', __('pages.create_page'), ['class' => 'fw-semibold']); ?></span>
    </p>
<?php endif; ?>
<?php echo $footer; ?>