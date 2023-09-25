<?php echo $header; ?>
    <h2 class="float-start mt-3 mb-3"> <?php echo __('menu.menu', 'Menu'); ?></h2>
    <div class="clearfix"></div>
    <section class="mt-1">
        <?php if (count($pages)): ?>
            <ul class="nav flex-column sortable">
                <?php foreach ($pages as $page): ?>
                    <li class="nav-item item bg-body-secondary" draggable="true">
                        <span data-id="<?php echo $page->id; ?>"><?php echo $page->name; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">
                <?php echo __('menu.nomenu_items'); ?>
            </p>
        <?php endif; ?>
    </section>
    <div class="sticky-sm-bottom bg-body">
        <div class=" d-grid gap-2 pt-3 pb-3" role="group">
            <?php echo Html::link('admin/pages', __('global.cancel'), [
                'class' => 'btn btn-primary cancel'
            ]); ?>
        </div>
    </div>
    <script src="<?php echo asset('app/views/assets/js/sortable.js'); ?>"></script>
    <script>
        $(function () {
            $('.sortable').sortable({
                element: 'li',
                dropped: function () {
                    var data = {sort: []};

                    $('.sortable span').each(function (index, item) {
                        data.sort.push($(item).data('id'));
                    });

                    $.ajax({
                        'type': 'POST',
                        'url': '<?php echo Uri::to("admin/menu/update"); ?>',
                        'data': $.param(data)
                    });
                }
            });
        });
    </script>
<?php echo $footer; ?>