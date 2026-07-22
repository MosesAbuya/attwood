<?php
require_once __DIR__ . '/admin/config.php';
$pdo = getPDO();
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/Bali/pexels-airlangga-36913571.jpg' WHERE name = 'Bali'");
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/Dubai/pexels-axp-photography-500641970-16412106.jpg' WHERE name = 'Dubai'");
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/Santorini/pexels-pixabay-164435.jpg' WHERE name = 'Santorini'");
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/Thailand/pexels-streetwindy-2108831.jpg' WHERE name = 'Thailand'");
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/East Africa/pexels-diego-ferrari-33201434-13979356.jpg' WHERE name = 'Maasai Mara National Reserve'");
$pdo->query("UPDATE destinations SET featured_image = 'images/Attwood/East Africa/pexels-gabriele-brancati-32566116-14881252.jpg' WHERE name = 'Amboseli National Park'");
echo "DB destinations updated successfully!\n";
