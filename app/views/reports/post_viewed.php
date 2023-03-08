<?php echo $header; ?>

<h3 class="mt-3"><?php echo __('reports.post_viewed'); ?></h3>

<?php if ($posts->count): ?>

    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <td class="text-start lead"><?php echo __('reports.post_name'); ?></td>
                <td class="text-center lead"><?php echo __('reports.viewed'); ?></td>
                <td class="text-center lead"><?php echo __('reports.percent'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts->results as $post): ?>
                <tr>
                    <td class="text-start">
                        <?php echo $post->title; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $post->viewed; ?>
                    </td>
                    <td class="text-center">
                        <?php echo round($post->viewed / $total_viewed * 100, 2); ?> %
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <nav class="mt-3" aria-label="Page navigation">
            <ul class="pagination">
                <?php echo $posts->links(); ?>
            </ul>
        </nav>
    </div>

<?php else: ?>
    <p class="pt-5 lead">
        <?php echo __('reports.text_no_results'); ?>
    </p>
<?php endif; ?>

<?php echo $footer; ?>

