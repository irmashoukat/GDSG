<?php
require __DIR__ . '/../includes/project_model.php';
$images = get_project_images(1);
print_r($images);
foreach ($images as $img) {
    $path = __DIR__ . '/../' . ltrim($img['image_url'], '/');
    echo $path . ': ' . (is_file($path) ? "exists\n" : "missing\n");
}
