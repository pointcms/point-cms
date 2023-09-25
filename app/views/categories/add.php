<?php echo $header; ?>
            <form id="form-add" method="post" action="<?php echo Uri::to('admin/categories/add'); ?>" novalidate>
                <input name="token" type="hidden" value="<?php echo $token; ?>">
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="label-title"><?php echo __('categories.title'); ?></label>
                    <?php echo Form::text('title', Input::previous('title'), [
                            'class' => 'form-control',
                            'id' => 'label-title',
                            'placeholder' =>  __('categories.category_title')
                        ]
                    ); ?>
                </div>
                <small class="form-text"><?php echo __('categories.title_explain'); ?></small>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text" for="label-slug"><?php echo __('categories.slug'); ?></label>
                    <?php echo Form::text('slug', Input::previous('slug'), [
                        'class' => 'form-control',
                        'id' => 'label-slug'
                    ]); ?>
                </div>
                <small class="form-text"><?php echo __('categories.slug_explain'); ?></small>
                <div class="input-group mt-3 mb-3">
                    <label class="input-group-text"
                           for="label-description"><?php echo __('categories.description'); ?></label>
                    <?php echo Form::textarea('description', Input::previous('description'), [
                        'class' => 'form-control',
                        'id' => 'label-description'
                    ]); ?>
                </div>
                <small class="form-text"><?php echo __('categories.description_explain'); ?></small>
                <div class="sticky-sm-bottom bg-body">
                    <div class=" d-grid gap-2 pt-3 pb-3" role="group">
                        <?php echo Form::button(__('global.save'), [
                            'type' => 'submit',
                            'form' => 'form-add',
                            'class' => 'btn btn-success'
                        ]); ?>
                        <?php echo Html::link('admin/categories', __('global.cancel'), [
                            'class' => 'btn btn-primary'
                        ]); ?>
                    </div>
                </div>
            </form>
<script src="<?php echo asset('app/views/assets/js/slug.js'); ?>"></script>
<script src="<?php echo asset('app/views/assets/js/upload-fields.js'); ?>"></script>
<?php echo $footer; ?>
