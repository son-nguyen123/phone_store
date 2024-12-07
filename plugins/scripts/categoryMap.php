<?php
$product = $stmt->fetch(PDO::FETCH_ASSOC) ?: [
    'name' => 'Product',
    'storage' => 'N/A',
    'description' => 'No description available.',
    'price' => 0,
    'discount' => 0,
    'image' => 'default-image.jpg',
    'other_images' => 'default-image.jpg',
    'long_description' => '',
    'screen_size' => '',
    'screen_technology' => '',
    'rear_camera' => '',
    'front_camera' => '',
    'chipset' => '',
    'internal_memory' => '',
    'sim_type' => '',
    'screen_resolution' => ''
];
?>