
        </div>
    </div>
</div>

<?php if (Auth::user()): ?>
<footer class="pt-5 my-5 text-muted">
    <div class="container text-center">
        <small class="fw-light pb-3"><?php echo __('global.motto'); ?>
            . <?php echo __('global.powered', VERSION); ?></small>
    </div>
</footer>
<button id="back-to-top" class="btn btn-primary back-to-top" role="button"><i class="bi bi-chevron-up"></i></button>
    <script>
        setInterval("notification();", 5000);

        function notification() {
            $('#count_online_visitors').load(location.href + " .count_online_visitors");
            $('#count_comments').load(location.href + " .count_comments");

        }

        const showMsg = localStorage.getItem('showMsg');

        if (showMsg === 'false') {
            $('.alert-greeting').hide();
        }

        $('.close').on('click', function () {
            $('.alert-greeting').fadeOut('show');
            localStorage.setItem('showMsg', 'false');
        });
        $(document).ready(function () {
            //Check to see if the window is top if not then display button
            $(window).scroll(function () {
                // Show button after 100px
                var showAfter = 100;
                if ($(this).scrollTop() > showAfter) {
                    $('.back-to-top').fadeIn();
                } else {
                    $('.back-to-top').fadeOut();
                }
            });
            //Click event to scroll to top
            $('.back-to-top').click(function () {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        });
    </script>
    <script>
        // Confirm any deletions
        $('.delete').on('click', function () {
            return confirm('<?php echo __('global.confirm_delete'); ?>');
        });
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
    <?php endif; ?>

    </body>
    </html>

