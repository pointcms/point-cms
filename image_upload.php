<?php

// This is a simplified example, which doesn't cover security of uploaded images.
// This example just demonstrate the logic behind the process.

// files storage folder
$dir = '../../../content/';
$files = [];
$types = ['image/png', 'image/jpg', 'image/gif', 'image/jpeg', 'image/pjpeg'];

if (isset($_FILES['file']))
{
    foreach ($_FILES['file']['name'] as $key => $name)
    {
        $type = strtolower($_FILES['file']['type'][$key]);
        if (in_array($type, $types))
        {
            // setting file's mysterious name
            $filename = md5(date('YmdHis')).'.jpg';
            $path = $dir.$filename;

            // copying
            move_uploaded_file($_FILES['file']['tmp_name'][$key], $path);

            $files['file-'.$key] = array(
                'url' => 'content/'.$filename,
            );
        }
    }
}

echo stripslashes(json_encode($files));