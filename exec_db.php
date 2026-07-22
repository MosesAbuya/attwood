<?php
require_once 'e:/xampp/htdocs/attwood/includes/db.php';
$sql = file_get_contents('e:/xampp/htdocs/attwood/admin/update_live_db_v2.sql');
try {
    getPDO()->exec($sql);
    echo "DB Updates Applied Successfully\n";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
