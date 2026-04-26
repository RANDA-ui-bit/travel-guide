<?php
$pageTitle = 'Gallery - Travel & Tourism Guide';
require_once __DIR__ . '/partials/header.php';

$images = [
  'https://picsum.photos/id/1003/900/600',
  'https://picsum.photos/id/1005/900/600',
  'https://picsum.photos/id/1006/900/600',
  'https://picsum.photos/id/1008/900/600',
  'https://picsum.photos/id/1010/900/600',
  'https://picsum.photos/id/1012/900/600',
  'https://picsum.photos/id/1013/900/600',
  'https://picsum.photos/id/1016/900/600',
  'https://picsum.photos/id/1020/900/600',
  'https://picsum.photos/id/1024/900/600',
];
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;">Gallery</h1>
    <p class="help">Click an image to open it in a new tab.</p>

    <div class="grid">
      <?php foreach ($images as $i => $src): ?>
        <div class="card">
          <a href="<?= h($src) ?>" target="_blank" rel="noreferrer">
            <img src="<?= h($src) ?>" alt="Gallery image <?= (int)($i + 1) ?>" />
          </a>
          <div class="card-body">
            <p class="card-title">Photo <?= (int)($i + 1) ?></p>
            <p class="card-meta">Landscape inspiration for travel planning</p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
