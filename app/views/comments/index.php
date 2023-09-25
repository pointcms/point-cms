<?php echo $header; ?>
    <div class="d-flex mt-3 mb-3">
        <div class="me-auto"><h3><?php echo __('comments.comments'); ?></h3></div>
        <div>
            <div class="input-group">
                <select onchange="location = this.value;" class="form-select">
                    <option value="<?php echo Uri::to('admin/comments'); ?>" <?php if ($status == 'all'): ?> selected<?php endif; ?>><?php echo __('global.all'); ?></option>
                    <?php foreach (['pending', 'approved', 'spam'] as $type): ?>
                        <option value="<?php echo Uri::to('admin/comments/' . $type); ?>" <?php if ($status == $type): ?> selected<?php endif; ?>><?php echo __('global.' . $type); ?></option>
                    <?php endforeach; ?>
                </select>
                <label class="input-group-text"><i class="bi bi-funnel"></i></label>
            </div>
        </div>
    </div>
<?php if ($comments->count): ?>
    <?php foreach ($comments->results as $comment): ?>
        <a class="mt-3 text-decoration-none" href="<?php echo Uri::to('admin/comments/edit/' . $comment->id); ?>">
            <div class="border-top pt-3 pb-3">
                <h5 class="text-body-emphasis">
                    <strong><?php echo $comment->name; ?></strong>
                </h5>
                <p class="text-muted">
                    <?php echo strip_tags($comment->text); ?>
                </p>
                <small>
                    <status class="text-<?php echo $comment->status; ?>"><?php echo __('global.' . $comment->status); ?></status>
                    -
                    <date class="text-muted"><?php echo __('comments.posted'); ?><?php echo Date::format($comment->date); ?></date>
                </small>
            </div>
        </a>
    <?php endforeach; ?>

    <div class="d-flex justify-content-center">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $comments->links(); ?>
            </ul>
        </nav>
    </div>

<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('comments.nocomments_desc'); ?>
    </p>
<?php endif; ?>

<?php echo $footer; ?>