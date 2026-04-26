<?php
$pageTitle = 'Destinations - Travel & Tourism Guide';
require_once __DIR__ . '/partials/header.php';

$pdo = get_pdo();
$destinations = $pdo->query('SELECT * FROM destinations ORDER BY name')->fetchAll();
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;">Destinations</h1>
    <p class="help">Click any card to view details (modal). Use "Open full page" for a dedicated details page.</p>

    <div class="grid">
      <?php foreach ($destinations as $d): ?>
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
        <div class="help">Try adding a new destination from the <a href="dashboard.php">Dashboard</a>.</div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
