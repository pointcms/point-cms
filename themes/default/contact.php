<?php theme_include('header'); ?>
    <div class="col-xl-10 mx-auto">
        <h1 class="fw-light">Contact Us</h1>

        <!-- Notifications -->
        <div class="notify"><?php echo Notify::read(); ?></div>

        <div class="mt-5">
            <form method="post" action="<?php echo current_url(); ?>">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="contact-subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="contact-subject" name="contact-subject" type="text" placeholder="Subject" value="<?php echo Input::previous('contact-subject'); ?>">
                    </div>
                    <div class="col-sm-6">
                        <label for="contact-name" class="form-label">Your Name</label>
                        <input class="form-control" id="contact-name" name="contact-name" type="text" placeholder="Your Name" value="<?php echo Input::previous('contact-name'); ?>">
                    </div>
                    <div class="col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" id="contact-email" name="contact-email" type="email" placeholder="your_email@domain.com" value="<?php echo Input::previous('contact-email'); ?>">
                    </div>
                    <div class="col-sm-12">
		                <textarea class="form-control" name="contact-message" placeholder="Message" rows="5"><?php echo Input::previous('contact-message'); ?></textarea>
                    </div>
                    <div class="col-sm-12">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Send</button>
                    </div>
            </form>
        </div>
    </div>
<?php theme_include('footer'); ?>