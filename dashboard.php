<?php
$pageTitle = 'Dashboard - Travel & Tourism Guide';
require_once __DIR__ . '/partials/header.php';

$pdo = get_pdo();
$errors = [];
$notice = '';

function read_post(string $key): string
{
    return isset($_POST[$key]) ? trim((string)$_POST[$key]) : '';
}

$action = isset($_REQUEST['action']) ? (string)$_REQUEST['action'] : '';
$id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
$msgAction = isset($_REQUEST['msg_action']) ? (string)$_REQUEST['msg_action'] : '';
$msgId = isset($_REQUEST['msg_id']) ? (int)$_REQUEST['msg_id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create' || $action === 'update') {
        $name = read_post('name');
        $country = read_post('country');
        $description = read_post('description');
        $image_url = read_post('image_url');
        $best_time = read_post('best_time');

        if ($name === '' || $country === '' || $description === '' || $image_url === '' || $best_time === '') {
            $errors[] = 'All fields are required.';
        }

        if ($action === 'create' && empty($errors)) {
            $stmt = $pdo->prepare('INSERT INTO destinations (name, country, description, image_url, best_time) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$name, $country, $description, $image_url, $best_time]);
            $notice = 'Destination added successfully.';
            $action = '';
            $id = 0;
        }

        if ($action === 'update' && $id > 0 && empty($errors)) {
            $stmt = $pdo->prepare('UPDATE destinations SET name = ?, country = ?, description = ?, image_url = ?, best_time = ? WHERE id = ?');
            $stmt->execute([$name, $country, $description, $image_url, $best_time, $id]);
            $notice = 'Destination updated successfully.';
            $action = '';
            $id = 0;
        }
    }

    if ($action === 'delete' && $id > 0) {
        $stmt = $pdo->prepare('DELETE FROM destinations WHERE id = ?');
        $stmt->execute([$id]);
        $notice = 'Destination deleted.';
        $action = '';
        $id = 0;
    }

    if ($msgAction === 'delete' && $msgId > 0) {
        $stmt = $pdo->prepare('DELETE FROM messages WHERE id = ?');
        $stmt->execute([$msgId]);
        $notice = 'Message deleted.';
        $msgAction = '';
        $msgId = 0;
    }
}

$editing = null;
if ($action === 'edit' && $id > 0) {
    $stmt = $pdo->prepare('SELECT * FROM destinations WHERE id = ?');
    $stmt->execute([$id]);
    $editing = $stmt->fetch();
    if (!$editing) {
        $errors[] = 'Destination not found for editing.';
        $action = '';
        $id = 0;
    }
}

$q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';

if ($q !== '') {
    $like = '%' . $q . '%';
    $stmt = $pdo->prepare('SELECT * FROM destinations WHERE name LIKE ? OR country LIKE ? OR description LIKE ? ORDER BY id DESC');
    $stmt->execute([$like, $like, $like]);
    $rows = $stmt->fetchAll();
} else {
    $rows = $pdo->query('SELECT * FROM destinations ORDER BY id DESC')->fetchAll();
}

$messagesError = '';
$messages = [];
try {
    $messages = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC')->fetchAll();
} catch (Throwable $e) {
    $messagesError = 'Messages table not found. Please import the updated database.sql (or create table messages).';
}
?>

<section class="section">
  <div class="container">
    <h1 style="margin-top:0;">Dashboard</h1>
    <p class="help">MySQL CRUD (insert/update/delete) + search. Data source: <code>destinations</code> table.</p>

    <?php if ($notice !== ''): ?>
      <div class="help success" style="margin-bottom: 10px;"><?= h($notice) ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="help error" style="margin-bottom: 10px;">
        <?php foreach ($errors as $e): ?>
          <div><?= h($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form class="form" method="get" action="dashboard.php" style="margin-bottom: 14px;">
      <div>
        <label for="q">Search (name/country/description)</label>
        <input class="input" id="q" name="q" type="text" value="<?= h($q) ?>" placeholder="e.g., Egypt, beach, city" />
      </div>
      <div>
        <button class="btn" type="submit">Search</button>
        <a class="btn" href="dashboard.php">Reset</a>
      </div>
    </form>

    <h2><?= $editing ? 'Update destination' : 'Add new destination' ?></h2>
    <form class="form" method="post" action="dashboard.php?action=<?= $editing ? 'update&id=' . (int)$editing['id'] : 'create' ?>">
      <div>
        <label for="name">Name</label>
        <input class="input" id="name" name="name" type="text" required value="<?= h($editing['name'] ?? '') ?>" />
      </div>
      <div>
        <label for="country">Country</label>
        <input class="input" id="country" name="country" type="text" required value="<?= h($editing['country'] ?? '') ?>" />
      </div>
      <div>
        <label for="best_time">Best time</label>
        <input class="input" id="best_time" name="best_time" type="text" required value="<?= h($editing['best_time'] ?? '') ?>" />
      </div>
      <div>
        <label for="image_url">Image URL</label>
        <input class="input" id="image_url" name="image_url" type="url" required value="<?= h($editing['image_url'] ?? '') ?>" />
      </div>
      <div>
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required><?= h($editing['description'] ?? '') ?></textarea>
      </div>
      <div>
        <button class="btn" type="submit"><?= $editing ? 'Update' : 'Add' ?></button>
        <?php if ($editing): ?>
          <a class="btn" href="dashboard.php">Cancel edit</a>
        <?php endif; ?>
      </div>
    </form>

    <h2 style="margin-top: 18px;">Destinations (table #2)</h2>

    <table class="table" aria-label="Destinations list">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Country</th>
          <th>Best time</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= (int)$r['id'] ?></td>
            <td>
              <a href="destination.php?id=<?= (int)$r['id'] ?>"><?= h($r['name']) ?></a>
            </td>
            <td><?= h($r['country']) ?></td>
            <td><?= h($r['best_time']) ?></td>
            <td>
              <a class="btn" href="dashboard.php?action=edit&id=<?= (int)$r['id'] ?>">Edit</a>
              <form method="post" action="dashboard.php?action=delete&id=<?= (int)$r['id'] ?>" style="display:inline;">
                <button class="btn" type="submit" onclick="return confirm('Delete this destination?');" style="background: rgba(239, 68, 68, 0.14); border-color: rgba(239, 68, 68, 0.35);">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <p class="help" style="margin-top: 10px;">Total results: <?= (int)count($rows) ?></p>

    <h2 style="margin-top: 18px;">Contact Messages</h2>

    <?php if ($messagesError !== ''): ?>
      <div class="help error" style="margin-bottom: 10px;">
        <?= h($messagesError) ?>
      </div>
    <?php endif; ?>

    <?php if ($messagesError === ''): ?>
      <table class="table" aria-label="Contact messages">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($messages as $m): ?>
            <tr>
              <td><?= (int)$m['id'] ?></td>
              <td><?= h($m['full_name']) ?></td>
              <td><a href="mailto:<?= h($m['email']) ?>"><?= h($m['email']) ?></a></td>
              <td><?= h($m['message']) ?></td>
              <td><?= h($m['created_at']) ?></td>
              <td>
                <form method="post" action="dashboard.php?msg_action=delete&msg_id=<?= (int)$m['id'] ?>" style="display:inline;">
                  <button class="btn" type="submit" onclick="return confirm('Delete this message?');" style="background: rgba(239, 68, 68, 0.14); border-color: rgba(239, 68, 68, 0.35);">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <p class="help" style="margin-top: 10px;">Total messages: <?= (int)count($messages) ?></p>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
