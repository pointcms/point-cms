<?php echo $header; ?>

    <h3 class="float-start mt-3 mb-3"><?php echo __('comments.editing_comment'); ?></h3>
    <div class="float-end mt-3 mb-3">
        <?php echo Form::button(__('global.save'), [
            'type' => 'submit',
            'form' => 'form-edit',
            'class' => 'btn btn-success'
        ]); ?>

        <?php echo Html::link('admin/comments/delete/' . $comment->id, '<i class="bi bi-trash"></i>', [
            'form' => 'form-edit',
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.delete'),
            'class' => 'btn btn-danger delete'
        ]); ?>

        <?php echo Html::link('admin/comments', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline cancel'
        ]); ?>
    </div>

    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/comments/edit/' . $comment->id); ?>" novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-email"><?php echo __('comments.post'); ?></label>
            <input type="text" readonly class="form-control" value="<?php echo $post->title; ?>">
        </div>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-name"><?php echo __('comments.name'); ?></label>
            <?php echo Form::text('name', Input::previous('name', $comment->name), [
                'class' => 'form-control',
                'id' => 'label-name'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('comments.name_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-email"><?php echo __('comments.email'); ?></label>
            <?php echo Form::email('email', Input::previous('email', $comment->email), [
                'class' => 'form-control',
                'id' => 'label-email'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('comments.email_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-text"><?php echo __('comments.text'); ?></label>
            <?php echo Form::textarea('text', Input::previous('text', $comment->text), [
                'class' => 'form-control',
                'id' => 'label-text'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('comments.text_explain'); ?></small>

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-status"><?php echo __('comments.status', 'Status'); ?></label>
            <?php echo Form::select('status', $statuses, Input::previous('status', $comment->status), [
                'class' => 'form-select',
                'id' => 'label-status'
            ]); ?>
        </div>
        <small class="form-text text-muted"><?php echo __('comments.status_explain'); ?></small>
    </form>

<?php echo $footer; ?>