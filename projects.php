<?php
// 1) Translations
$lang  = $_GET['lang'] ?? 'fr';
$trans = include "lang/$lang.php";

// 2) DB & fetch
require 'db/database.php';
$db    = Database::getInstance();

// 3) Read search term (GET)
$q     = trim($_GET['q'] ?? '');

// 4) Prepare query
if ($q !== '') {
  // search by title
  $stmt   = $db->prepare(
    "SELECT * FROM projects WHERE title LIKE :q ORDER BY id ASC"
  );
  $stmt->execute([':q' => "%$q%"]);
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  // no filter
  $results = $db
    ->query("SELECT * FROM projects ORDER BY id ASC")
    ->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($trans['projects']) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include "includes/header.php"; ?>

  <main>
    <h2><?= htmlspecialchars($trans['projects']) ?></h2>

    <!-- GET Search Form -->
    <form id="searchForm" method="GET" action="projects.php">
      <input
        type="hidden"
        name="lang"
        value="<?= htmlspecialchars($lang) ?>"
      />
      <input
        type="text"
        name="q"
        placeholder="Search projects…"
        value="<?= htmlspecialchars($q) ?>"
      />
      <button type="submit">🔍</button>
    </form>

    <!-- Results Grid -->
    <div class="projects-grid">
      <?php if (count($results) === 0): ?>
        <p>No projects found for “<?= htmlspecialchars($q) ?>”.</p>
      <?php else: ?>
        <?php foreach ($results as $p): ?>
          <div class="project">
            <h3><?= htmlspecialchars($p['title']) ?></h3>
            <p><?= htmlspecialchars($p['description']) ?></p>
            <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank">
              Voir sur GitHub
            </a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>

  <?php include "includes/footer.php"; ?>
  <script src="assets/js/script.js"></script>
</body>
</html>
