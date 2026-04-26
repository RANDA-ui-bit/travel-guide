<?php
$pageTitle = 'Contact - Travel & Tourism Guide';
$pdo = null;
$serverErrors = [];
$serverNotice = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/db.php';
    $pdo = get_pdo();

    $fullName = isset($_POST['fullName']) ? trim((string)$_POST['fullName']) : '';
    $email = isset($_POST['email']) ? trim((string)$_POST['email']) : '';
    $message = isset($_POST['message']) ? trim((string)$_POST['message']) : '';

    if ($fullName === '' || $email === '' || $message === '') {
        $serverErrors[] = 'All fields are required.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $serverErrors[] = 'Please enter a valid email address.';
    }

    if (empty($serverErrors)) {
        $stmt = $pdo->prepare('INSERT INTO messages (full_name, email, message) VALUES (?, ?, ?)');
        $stmt->execute([$fullName, $email, $message]);
        header('Location: contact.php?sent=1');
        exit;
    }
}

if (isset($_GET['sent']) && (string)$_GET['sent'] === '1') {
    $serverNotice = 'Message saved successfully! You can view it in the Dashboard.';
}

require_once __DIR__ . '/partials/header.php';
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;">Contact</h1>
    <p class="help"></p>

    <?php if ($serverNotice !== ''): ?>
      <div class="help success" style="margin-bottom: 10px;"><?= h($serverNotice) ?></div>
    <?php endif; ?>

    <?php if (!empty($serverErrors)): ?>
      <div class="help error" style="margin-bottom: 10px;">
        <?php foreach ($serverErrors as $e): ?>
          <div><?= h($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form id="contactForm" class="form" action="contact.php" method="post">
      <div>
        <label for="fullName">Full name (required)</label>
        <input class="input" id="fullName" name="fullName" type="text" required value="<?= h(isset($_POST['fullName']) ? (string)$_POST['fullName'] : '') ?>" />
      </div>

      <div>
        <label for="email">Email (required)</label>
        <input class="input" id="email" name="email" type="email" required value="<?= h(isset($_POST['email']) ? (string)$_POST['email'] : '') ?>" />
      </div>

      <div>
        <label for="message">Message (required)</label>
        <textarea id="message" name="message" rows="5" required><?= h(isset($_POST['message']) ? (string)$_POST['message'] : '') ?></textarea>
      </div>

      <div>
        <button class="btn" type="submit">Send message</button>
        <div id="formStatus" class="help" style="margin-top: 8px;">All fields are required.</div>
      </div>
    </form>

    <p class="help" style="margin-top: 14px;">
      Internal link example: <a href="tips.php">Travel Tips</a>
    </p>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
