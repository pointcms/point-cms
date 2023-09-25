<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-image"></i> File Manager</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!-- Input field with class "image-upload" -->
            <input type="file" class="image-upload form-control" multiple>
            <!-- Image gallery container -->
            <div id="imageGallery" class="row mt-3"></div>
        </div>
    </div>
</div>

<script>
    $(function() {
        refreshImageGallery();

        var xhr;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            if (window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) { }
            }
        }

        var upload_fields = $('.image-upload');

        upload_fields.bind('change', function() {
            var field = this;
            var formData = new FormData();
            var files = field.files;

            for (var i = 0; i < files.length; i++) {
                var file = files[i];

                if (['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'application/pdf'].indexOf(file.type) !== -1) {
                    var path = window.location.pathname, uri, parts = path.split('/');

                    if (parts[parts.length - 1] == 'add') {
                        uri = path.split('/').slice(0, -2).join('/') + '/upload';
                    } else {
                        uri = path.split('/').slice(0, -3).join('/') + '/upload';
                    }

                    upload(uri, file, field);
                }
            }
        });

        var upload = function(uri, file, field) {
            xhr.open("post", uri);

            var formData = new FormData();
            formData.append('file', file);

            var progressBar = $('<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div></div>');
            $(field).after(progressBar);

            xhr.onreadystatechange = function() {
                if (this.readyState == 4) {
                    console.log('Uploaded');
                    var data = JSON.parse(this.responseText);
                    console.log(data);

                    progressBar.hide();

                    // Clear the input field after upload
                    $(field).val('');

                    refreshImageGallery();

                    $(field).siblings('.image').attr('value', data.uri);

                }
            };

            if (xhr.upload) {
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        progressBar.find('.progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
                    }
                };
            } else {
                xhr.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        progressBar.find('.progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
                    }
                }, false);
            }

            xhr.send(formData);
        };

        function refreshImageGallery() {
            var imageGallery = $("#imageGallery");

            // Clear the content of the div
            imageGallery.empty();

            // Fetch and load the updated content from the server
            $.get("<?php echo Uri::to('admin/filemanager_list'); ?>", function(data) {
                imageGallery.html(data);

                // Find all the image elements
                var images = imageGallery.find('.image-item');

                // Add buttons to each image
                images.each(function(index) {
                    var imageItem = $(this);

                    // Get the image path from the image element
                    var imagePath = imageItem.data('image-path'); // Assuming you store the image path in a data attribute
                    var cardBody = $('<div class="card-body"></div>');
                    var buttonGroup = $('<div class="btn-group" role="group"></div>');
                    // Create Edit button
                    var editButton = $('<button class="edit-button btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add Image"><i class="bi bi-check2"></i></button>');
                    editButton.click(function() {
                        // Set the image path as the value of the hidden input field
                        $('.post-image').val(imagePath);
                        // Update the src attribute of the preview image
                        $('#show').attr('src', imagePath);
                        // Hide the Bootstrap modal
                        $('#modal-image').modal('hide'); // Replace 'yourModalId' with the actual ID of your modal
                    });

                    // Create Delete button
                    var deleteButton = $('<button class="delete-button btn btn-danger btn-sm" data-bs-toggle="tooltip"  title="Delete Image"><i class="bi bi-trash3"></i></button>');
                    var imagePath = imageItem.data('image-path'); // Encode once

                    deleteButton.click(function() {
                        var imageItem = deleteButton.closest('.image-item'); // Find the parent image item
                        $.ajax({
                            url: '<?php echo Uri::to('admin/filemanager/delete'); ?>' + imagePath, // Adjust the route URL
                            type: 'POST', // Use 'GET' if your route is defined as such
                            data: { image_path: imagePath }, // Send the image path as data
                            success: function(response) {
                                // Handle success, e.g., remove the image from the DOM
                                if (response.success) {
                                    imageItem.remove(); // Remove the deleted image from the gallery
                                } else {
                                    console.error(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle error
                                console.error(error);
                            }
                        });
                    });

                    // Append the buttons to the button group
                    buttonGroup.append(editButton);
                    buttonGroup.append(deleteButton);
                    cardBody.append(buttonGroup);
                    // Append the button group to the image item
                    imageItem.append(cardBody);

                    // Initialize tooltips
                    $(function () {
                        $('[data-bs-toggle="tooltip"]').tooltip();
                    });
                });
            });
        }

    });
</script>