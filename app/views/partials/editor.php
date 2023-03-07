<?php $menu = 'posts'; ?>
<!-- Include Tinymce Css/Js -->
<script src="<?php echo asset('app/views/assets/js/tinymce/tinymce.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo asset('app/views/assets/css/tinymce-theme.css'); ?>">
<script>
    var options = {
        selector: 'textarea#description',
        min_height: 300,
        menubar: !1,
        statusbar: !1,
        plugins: "autoresize,link,image,lists,media,code",
        toolbar: [{name: "history", items: ["undo", "redo"]}, {
            name: "formatting",
            items: ["bold", "italic", "underline", "strikethrough", "forecolor", "backcolor"]
        }, {
            name: "alignment",
            items: ["alignleft", "aligncenter", "alignright", "alignjustify"]
        }, {
            name: "list", items: ["numlist", "bullist"]
        }, {
            name: "link", items: ["link", "unlink"]
        }, {
            name: "media",
            items: ["image", "media"]
        }, {
            name: "code",
            items: ["code"]
        }]
    };

    const element = document.getElementById('admin');
    var theme = element.getAttribute('data-bs-theme');

    if (theme === "dark") {
        options["content_style"] = "body { background: #141824; color: white; font-size: 12pt; font-family: Arial; }";
    }
    else {
        options["content_style"] = "body { background: #fff; color: black; font-size: 12pt; font-family: Arial; }";

    }

    tinymce.init(options);
</script>
