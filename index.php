<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db.php';

$pageTitle = 'Home - Travel & Tourism Guide';

$internalCss = "
  .home-note {\n    border: 1px solid rgba(79, 209, 197, 0.35);\n    background: rgba(79, 209, 197, 0.10);\n    border-radius: 16px;\n    padding: 12px 14px;\n    margin-top: 14px;\n  }\n
  #welcomeTag {\n    color: var(--accent2);\n    font-weight: 800;\n  }\n";

try {
    // ✅ أول شيء: الاتصال
    $pdo = get_pdo();

    // ✅ إنشاء الجدول
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS destinations (
            id SERIAL PRIMARY KEY,
            name TEXT,
            country TEXT,
            description TEXT,
            image_url TEXT,
            best_time TEXT
        )
    ");

    // ✅ تنظيف التكرار (مرة وحدة بس)
    $pdo->exec("
        DELETE FROM destinations
        WHERE id NOT IN (
            SELECT MIN(id)
            FROM destinations
            GROUP BY name, country, description, image_url, best_time
        )
    ");

    // ✅ لا يضيف إلا إذا فاضي
    $count = $pdo->query("SELECT COUNT(*) FROM destinations")->fetchColumn();

    if ($count == 0) {
        $pdo->exec("
            INSERT INTO destinations (name, country, description, image_url, best_time)
            VALUES
            ('Paris', 'France', 'City of lights', 'https://picsum.photos/300', 'Spring'),
            ('Tokyo', 'Japan', 'Modern meets tradition', 'https://picsum.photos/301', 'Autumn')
        ");
    }

    // ✅ جلب البيانات
    $featured = $pdo->query('SELECT * FROM destinations ORDER BY id LIMIT 6')->fetchAll();

} catch (Exception $e) {
    die("ERROR: " . $e->getMessage());
}

// ✅ بعد كل شيء
require_once __DIR__ . '/partials/header.php';
?>