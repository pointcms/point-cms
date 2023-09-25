<link rel="stylesheet" href="<?php echo asset('app/views/assets/js/pixelEditor/pixelEditor.css'); ?>">
<script src="<?php echo asset('app/views/assets/js/pixelEditor/jquery.pixelEditor.js'); ?>"></script>
<script>
    jQuery(document).ready(function($) {
        new PixelEditor('#description');
    });
</script>