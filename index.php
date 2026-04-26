<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
$pageTitle = 'Home - Travel & Tourism Guide';
$internalCss = "
  .home-note {\n    border: 1px solid rgba(79, 209, 197, 0.35);\n    background: rgba(79, 209, 197, 0.10);\n    border-radius: 16px;\n    padding: 12px 14px;\n    margin-top: 14px;\n  }\n
  #welcomeTag {\n    color: var(--accent2);\n    font-weight: 800;\n  }\n";

require_once __DIR__ . '/partials/header.php';

$pdo = get_pdo();
$featured = $pdo->query('SELECT * FROM destinations ORDER BY id LIMIT 6')->fetchAll();
?>

<section class="hero">
  <div class="container hero-grid">
    <div class="hero-card">
      <h1>Plan better trips with a simple guide</h1>
      <p class="help">Discover destinations, browse tours, and learn travel tips. Click any destination card to view details.</p>
      <div class="badges">
        <span class="badge" id="welcomeTag">Top picks</span>
        <span class="badge">Budget ideas</span>
        <span class="badge">Family-friendly</span>
        <span class="badge">Food & culture</span>
      </div>
      <div class="home-note" style="border-left: 6px solid var(--pink);">
        <strong>Tip:</strong> Use the <a href="dashboard.php">Dashboard</a> to add your own destinations.
      </div>
    </div>

    <div class="slideshow" data-slideshow aria-label="Image slideshow">
      <div class="slide" style="background-image:url('https://picsum.photos/id/1018/1100/700');"></div>
      <div class="slide" style="background-image:url('https://picsum.photos/id/1022/1100/700');"></div>
      <div class="slide" style="background-image:url('https://picsum.photos/id/1031/1100/700');"></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 style="margin-top:0;">Featured Destinations</h2>
    <div class="grid">
      <?php foreach ($featured as $d): ?>
        <article
          class="card"
          data-destination-card
          data-name="<?= h($d['name']) ?>"
          data-country="<?= h($d['country']) ?>"
          data-description="<?= h($d['description']) ?>"
          data-image-url="<?= h($d['image_url']) ?>"
          data-best-time="<?= h($d['best_time']) ?>"
          role="button"
          tabindex="0"
          aria-label="View details for <?= h($d['name']) ?>"
        >
          <img src="<?= h($d['image_url']) ?>" alt="<?= h($d['name']) ?>" />
          <div class="card-body">
            <p class="card-title"><?= h($d['name']) ?></p>
            <p class="card-meta"><?= h($d['country']) ?> • Best time: <?= h($d['best_time']) ?></p>
            <a class="btn" href="destination.php?id=<?= (int)$d['id'] ?>">Open full page</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div style="margin-top:14px;">
      <a class="btn" href="destinations.php">Browse all destinations</a>
    </div>
  </div>
</section>

<div class="modal" id="destinationModal" aria-hidden="true">
  <div class="modal-panel" role="dialog" aria-modal="true" aria-label="Destination details">
    <div class="modal-header">
      <div>
        <div data-modal-title style="font-weight:800;">Destination</div>
        <div class="help" data-modal-meta></div>
      </div>
      <button class="btn" type="button" data-close-modal>Close</button>
    </div>
    <div class="modal-body">
      <img data-modal-img src="" alt="" style="width:100%; border-radius:16px; border:1px solid rgba(184,192,255,0.15);" />
      <div>
        <p data-modal-desc class="help" style="font-size: 15px; color: var(--text);"></p>
        <div class="help">More: visit the <a href="destinations.php">Destinations</a> page for categories and recommendations.</div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
