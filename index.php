<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db.php';

$pageTitle = 'Home - Travel & Tourism Guide';

$internalCss = "
  .home-note {\n    border: 1px solid rgba(79, 209, 197, 0.35);\n    background: rgba(79, 209, 197, 0.10);\n    border-radius: 16px;\n    padding: 12px 14px;\n    margin-top: 14px;\n  }\n
  #welcomeTag {\n    color: var(--accent2);\n    font-weight: 800;\n  }\n";

try {
    $pdo = get_pdo();

    // إنشاء الجدول إذا مو موجود
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

    // ✅ يمنع التكرار (يضيف فقط إذا الجدول فاضي)
    $count = $pdo->query("SELECT COUNT(*) FROM destinations")->fetchColumn();

    if ($count == 0) {
        $pdo->exec("
            INSERT INTO destinations (name, country, description, image_url, best_time)
            VALUES
            ('Paris', 'France', 'City of lights', 'https://picsum.photos/300', 'Spring'),
            ('Tokyo', 'Japan', 'Modern meets tradition', 'https://picsum.photos/301', 'Autumn')
        ");
    }

    // جلب البيانات
    $featured = $pdo->query('SELECT * FROM destinations ORDER BY id LIMIT 6')->fetchAll();

} catch (Exception $e) {
    die("ERROR: " . $e->getMessage());
}

// الهيدر بعد كل شيء
require_once __DIR__ . '/partials/header.php';
?>

<section class="hero">
  <div class="container hero-grid">
    <div class="hero-card">
      <h1>Plan better trips with a simple guide</h1>
      <p class="help">Discover destinations, browse tours, and learn travel tips.</p>
      <div class="badges">
        <span class="badge" id="welcomeTag">Top picks</span>
        <span class="badge">Budget ideas</span>
        <span class="badge">Family-friendly</span>
        <span class="badge">Food & culture</span>
      </div>
      <div class="home-note" style="border-left: 6px solid var(--pink);">
        <strong>Tip:</strong> Use the <a href="dashboard.php">Dashboard</a>
      </div>
    </div>

    <div class="hero-image">
  <img src="assets/img/travel.jpg" alt="Travel Image">
</div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2>Featured Destinations</h2>

    <div class="grid">
      <?php foreach ($featured as $d): ?>
        <article class="card">
          <img src="<?= h($d['image_url']) ?>" alt="<?= h($d['name']) ?>" />
          <div class="card-body">
            <p class="card-title"><?= h($d['name']) ?></p>
            <p class="card-meta">
              <?= h($d['country']) ?> • <?= h($d['best_time']) ?>
            </p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>