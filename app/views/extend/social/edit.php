<?php echo $header; ?>

    <h3 class="float-start mt-3 mb-3"><?php echo __('metadata.metadata'); ?></h3>
    <div class="float-end mt-3 mb-3">
        <?php echo Form::button(__('global.save'), [
            'form' => 'form-edit',
            'type' => 'submit',
            'class' => 'btn btn-success'
        ]); ?>

        <?php echo Html::link('admin/extend', '<i class="bi bi-x-lg"></i>', [
            'data-bs-toggle' => 'tooltip',
            'data-bs-title' => __('global.cancel'),
            'class' => 'btn btn-outline-secondary'
        ]); ?>
    </div>
    <form id="form-edit" method="post" action="<?php echo Uri::to('admin/extend/social'); ?>" novalidate>
        <input name="token" type="hidden" value="<?php echo $token; ?>">

        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-facebook"><?php echo __('social.facebook'); ?></label>
            <?php echo Form::text('facebook', Input::previous('facebook', $meta['facebook']),
                [
                    'class' => 'form-control',
                    'id' => 'label-facebook'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.facebook_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-twitter"><?php echo __('social.instagram'); ?></label>
            <?php echo Form::text('instagram', Input::previous('instagram', $meta['instagram']),
                [
                    'class' => 'form-control',
                    'id' => 'label-instagram'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.instagram_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-twitter"><?php echo __('social.twitter'); ?></label>
            <?php echo Form::text('twitter', Input::previous('twitter', $meta['twitter']),
                [
                    'class' => 'form-control',
                    'id' => 'label-twitter'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.twitter_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-youtube"><?php echo __('social.youtube'); ?></label>
            <?php echo Form::text('youtube', Input::previous('youtube', $meta['youtube']),
                [
                    'class' => 'form-control',
                    'id' => 'label-youtube'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.youtube_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-linkedin"><?php echo __('social.linkedin'); ?></label>
            <?php echo Form::text('linkedin', Input::previous('linkedin', $meta['linkedin']),
                [
                    'class' => 'form-control',
                    'id' => 'label-linkedin'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.linkedin_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-linkedin"><?php echo __('social.pinterest'); ?></label>
            <?php echo Form::text('pinterest', Input::previous('pinterest', $meta['pinterest']),
                [
                    'class' => 'form-control',
                    'id' => 'label-pinterest'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.pinterest_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text"
                   for="label-vkontakte"><?php echo __('social.vkontakte'); ?></label>
            <?php echo Form::text('vkontakte', Input::previous('vkontakte', $meta['vkontakte']),
                [
                    'class' => 'form-control',
                    'id' => 'label-vkontakte'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.vkontakte_explain'); ?></small>
        <div class="input-group mt-3 mb-3">
            <label class="input-group-text" for="label-tumblr"><?php echo __('social.tumblr'); ?></label>
            <?php echo Form::text('tumblr', Input::previous('tumblr', $meta['tumblr']),
                [
                    'class' => 'form-control',
                    'id' => 'label-tumblr'
                ]); ?>
        </div>
        <small class="form-text"><?php echo __('social.tumblr_explain'); ?></small>

    </form>

<?php echo $footer; ?>