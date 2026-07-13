<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3307', 'root', 'root');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS joki_adin_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "Database 'joki_adin_db' created successfully!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
