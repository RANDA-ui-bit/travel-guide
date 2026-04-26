<?php
require_once __DIR__ . '/../db.php';

if (!isset($pageTitle)) {
    $pageTitle = 'Travel & Tourism Guide';
}
$current = basename($_SERVER['PHP_SELF']);
function nav_active(string $file, string $current): string
{
    return $file === $current ? 'active' : '';
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= h($pageTitle) ?></title>
  <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml" />
  <link rel="stylesheet" href="assets/css/styles.css" />
  <?php if (isset($internalCss) && is_string($internalCss) && trim($internalCss) !== ''): ?>
    <style>
      <?= $internalCss ?>
    </style>
  <?php endif; ?>
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="index.php">
      <img src="assets/img/logo.svg" alt="Travel Guide Logo" />
      <div class="brand-title">Travel & Tourism Guide</div>
    </a>
    <nav class="nav" aria-label="Main Navigation">
      <a class="<?= nav_active('index.php', $current) ?>" href="index.php">Home</a>
      <a class="<?= nav_active('destinations.php', $current) ?>" href="destinations.php">Destinations</a>
      <a class="<?= nav_active('tours.php', $current) ?>" href="tours.php">Tours</a>
      <a class="<?= nav_active('gallery.php', $current) ?>" href="gallery.php">Gallery</a>
      <a class="<?= nav_active('tips.php', $current) ?>" href="tips.php">Travel Tips</a>
      <a class="<?= nav_active('contact.php', $current) ?>" href="contact.php">Contact</a>
      <a class="<?= nav_active('dashboard.php', $current) ?>" href="dashboard.php">Dashboard</a>
    </nav>
  </div>
</header>
<main>
