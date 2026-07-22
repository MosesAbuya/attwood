<?php
require_once __DIR__ . '/../includes/db.php';
$pdo = getPDO();

$tables_columns = [
    'tours' => ['title', 'slug', 'description', 'excerpt', 'meta_title', 'meta_description', 'seo_keywords'],
    'blogs' => ['title', 'slug', 'content', 'excerpt', 'meta_title', 'meta_description'],
    'destinations' => ['country', 'description'],
    'activities' => ['name', 'slug', 'description'],
    'itinerary_steps' => ['title', 'description']
];

$replacements = [
    'Filao Adventures' => 'Attwood Travel Agency Ltd',
    'Filao' => 'Attwood',
    'filao' => 'attwood'
];

foreach ($tables_columns as $table => $columns) {
    echo "Updating table $table...\n";
    foreach ($columns as $column) {
        foreach ($replacements as $search => $replace) {
            try {
                $sql = "UPDATE `$table` SET `$column` = REPLACE(`$column`, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$search, $replace]);
            } catch (Exception $e) {
                // Ignore if column doesn't exist
            }
        }
    }
}

echo "Database scrubbed successfully.\n";
