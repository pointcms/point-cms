<?php echo $header; ?>


    <h3><?php echo __('reports.visitors_online'); ?></h3>

    <div class="row mt-3 mb-3">
        <div class="col">
            <?php if ($visitors_online->count): ?>

                <div class="table-responsive mt-3">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <td class="text-start"><?php echo __('reports.ip'); ?></td>
                            <td class="text-start"><?php echo __('reports.url'); ?></td>
                            <td class="text-start"><?php echo __('reports.referer'); ?></td>
                            <td class="text-end"><?php echo __('reports.date_added'); ?></td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($visitors_online->results as $visitor): ?>
                            <tr>
                                <td class="text-start">
                                    <a class="text-reset" href="http://whatismyipaddress.com/ip/<?php echo $visitor->ip; ?>"
                                       target="_blank"><?php echo $visitor->ip; ?>
                                    </a>
                                </td>
                                <td class="text-start">
                                    <a class="text-reset" href="<?php echo $visitor->url; ?>"
                                       target="_blank"><?php echo implode('<br/>', str_split($visitor->url, 30)); ?>
                                    </a>
                                </td>
                                <td class="text-start"><?php echo $visitor->referer; ?></td>
                                <td class="text-end">
                                    <?php echo $visitor->date; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    <nav class="mt-3" aria-label="Page navigation">
                        <ul class="pagination">
                            <?php echo $visitors_online->links(); ?>
                        </ul>
                    </nav>
                </div>

            <?php else: ?>
                <p class="mt-3 text-center">
                    <?php echo __('reports.text_no_results'); ?>
                </p>
            <?php endif; ?>

        </div>
    </div>


<?php echo $footer; ?>