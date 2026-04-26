<?php
$pageTitle = 'Destination Details - Travel & Tourism Guide';
require_once __DIR__ . '/partials/header.php';

$pdo = get_pdo();
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $pdo->prepare('SELECT * FROM destinations WHERE id = ?');
$stmt->execute([$id]);
$d = $stmt->fetch();

if (!$d) {
    echo '<section class="section"><div class="container"><h1>Destination not found</h1><p class="help">Go back to <a href="destinations.php">Destinations</a>.</p></div></section>';
    require_once __DIR__ . '/partials/footer.php';
    exit;
}
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;"><?= h($d['name']) ?></h1>

    <div class="clearfix">
      <img class="float-left" src="<?= h($d['image_url']) ?>" alt="<?= h($d['name']) ?>" />
      <p class="help" style="color: var(--text); font-size: 15px;">
        <strong style="color: var(--accent2);">Country:</strong> <?= h($d['country']) ?><br />
        <strong style="color: var(--info);">Best time:</strong> <?= h($d['best_time']) ?>
      </p>
      <p class="help" style="color: var(--text); font-size: 15px;">
        <?= h($d['description']) ?>
      </p>

      <table class="table" aria-label="Destination quick facts">
        <thead>
          <tr>
            <th>Field</th>
            <th>Value</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>ID</td>
            <td><?= (int)$d['id'] ?></td>
          </tr>
          <tr>
            <td>Name</td>
            <td><?= h($d['name']) ?></td>
          </tr>
          <tr>
            <td>Country</td>
            <td><?= h($d['country']) ?></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div style="margin-top:14px;">
      <a class="btn" href="destinations.php">Back to Destinations</a>
      <a class="btn" href="dashboard.php?action=edit&id=<?= (int)$d['id'] ?>">Edit in Dashboard</a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
