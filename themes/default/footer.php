</div>
<footer class="py-3">
    <div class="container">
        <div class="col-xl-10 mx-auto">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="<?php echo rss_url(); ?>" class="nav-link px-2 text-muted"><?php echo __('site.rss') ?></a></li>
                    <li class="nav-item"><a href="<?php echo contact_url(); ?>" class="nav-link px-2 text-muted"><?php echo __('site.contact') ?></a></li>
                <?php if (has_information_items()):
                    while (information_items()): ?>
                        <li class="nav-item">
                            <a class="nav-link px-2 text-muted" href="<?php echo information_url(); ?>" title="<?php echo information_title(); ?>">
                                <?php echo information_name(); ?>
                            </a>
                        </li>
                    <?php endwhile;
                endif; ?>
                <li class="nav-item"><a href="<?php echo base_url('admin'); ?>" class="nav-link px-2 text-muted"><?php echo __('site.admin') ?></a></li>
                <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link px-2 text-muted"><?php echo __('site.home') ?></a></li>
            </ul>
            <div class="d-flex justify-content-between py-4 my-4 border-top">
                <p>&copy; <?php echo date('Y'); ?> <?php echo site_name(); ?> . <?php echo __('site.copyright') ?></p>
                <ul class="list-unstyled d-flex">
                    <?php if (social_meta('facebook')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('facebook'); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('instagram')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('instagram'); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('twitter')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('twitter'); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('youtube')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('youtube'); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('linkedin')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('linkedin'); ?>">
                                <svg  width="18" height="18" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('pinterest')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('pinterest'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('vkontakte')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('vkontakte'); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path class="st0" d="M13.162 18.994c.609 0 .858-.406.851-.915-.031-1.917.714-2.949 2.059-1.604 1.488 1.488 1.796 2.519 3.603 2.519h3.2c.808 0 1.126-.26 1.126-.668 0-.863-1.421-2.386-2.625-3.504-1.686-1.565-1.765-1.602-.313-3.486 1.801-2.339 4.157-5.336 2.073-5.336h-3.981c-.772 0-.828.435-1.103 1.083-.995 2.347-2.886 5.387-3.604 4.922-.751-.485-.407-2.406-.35-5.261.015-.754.011-1.271-1.141-1.539-.629-.145-1.241-.205-1.809-.205-2.273 0-3.841.953-2.95 1.119 1.571.293 1.42 3.692 1.054 5.16-.638 2.556-3.036-2.024-4.035-4.305-.241-.548-.315-.974-1.175-.974h-3.255c-.492 0-.787.16-.787.516 0 .602 2.96 6.72 5.786 9.77 2.756 2.975 5.48 2.708 7.376 2.708z"/></svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (social_meta('tumblr')): ?>
                        <li class="ms-3">
                            <a class="link-dark" href="<?php echo social_meta('tumblr'); ?>">
                                <svg width="18" height="18" viewBox="0 0 24 24"><path d="M19.512 17.489l-.096-.068h-3.274c-.153 0-.16-.467-.163-.622v-5.714c0-.056.045-.101.101-.101h3.82c.056 0 .101-.045.101-.101v-5.766c0-.055-.045-.1-.101-.1h-3.803c-.055 0-.1-.045-.1-.101v-4.816c0-.055-.045-.1-.101-.1h-7.15c-.489 0-1.053.362-1.135 1.034-.341 2.778-1.882 4.125-4.276 4.925l-.267.089-.068.096v4.74c0 .056.045.101.1.101h2.9v6.156c0 4.66 3.04 6.859 9.008 6.859 2.401 0 5.048-.855 5.835-1.891l.157-.208-1.488-4.412zm.339 4.258c-.75.721-2.554 1.256-4.028 1.281l-.165.001c-4.849 0-5.682-3.701-5.682-5.889v-7.039c0-.056-.045-.101-.1-.101h-2.782c-.056 0-.101-.045-.101-.101l-.024-3.06.064-.092c2.506-.976 3.905-2.595 4.273-5.593.021-.167.158-.171.159-.171h3.447c.055 0 .101.045.101.101v4.816c0 .056.045.101.1.101h3.803c.056 0 .101.045.101.1v3.801c0 .056-.045.101-.101.101h-3.819c-.056 0-.097.045-.097.101v6.705c.023 1.438.715 2.167 2.065 2.167.544 0 1.116-.126 1.685-.344.053-.021.111.007.13.061l.995 2.95-.024.104z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
<?php  if (cookie_policy()): ?>
    <script src="<?php echo asset('assets/js/jquery.cookieMessage.js'); ?>"></script>
    <script type="text/javascript">
        $.cookieMessage({
            'mainMessage': '🍪<?php echo __('site.cookie_messageText'); ?> <a href="<?php echo cookie_policy_page(); ?>"><?php echo __('site.cookie_PolicyButtonText'); ?></a>. ',
            'acceptButton': 'Got It',
        });
    </script>
<?php endif; ?>
<?php trackVisitorActivity(); ?>
<!-- JavaScript Bundle with Popper -->
<script src="<?php echo asset('assets/js/bootstrap.bundle.min.js'); ?>"></script>
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
</body>
</html>