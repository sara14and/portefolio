<?php
// index.php

// load translations
require_once __DIR__ . '/lang/trad.php';

// load DB & fetch projects
require_once __DIR__ . '/db/database.php';
$db       = Database::getInstance();
$projects = $db
  ->query("SELECT * FROM projects ORDER BY id ASC")
  ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?=htmlspecialchars($lang)?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?=htmlspecialchars($t['welcome'])?></title>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap"
    rel="stylesheet"
  >
  <link rel="stylesheet" href="assets/css/style.css">
  <script>
    // expose the correct button labels for JS
    const i18n = {
      view_desc: "<?= addslashes($t['view_desc']) ?>",
      hide_desc: "<?= addslashes($t['hide_desc']) ?>",
      loading:   "<?= addslashes($t['loading']) ?>"
    };
  </script>
</head>
<body>

  <!-- fixed header/nav -->
  <?php include __DIR__ . '/includes/header.php'; ?>

  <!-- social sidebar -->
  <div class="social-fixed">
    <a href="mailto:sara.andari@icloud.com" aria-label="Email">
      <img src="assets/icons/email.svg" class="icon" alt="">
    </a>
    <a href="https://www.linkedin.com/in/sara-andari" target="_blank" aria-label="LinkedIn">
      <img src="assets/icons/linkedin.svg" class="icon" alt="">
    </a>
    <a href="https://github.com/sara14and" target="_blank" aria-label="GitHub">
      <img src="assets/icons/github.svg" class="icon" alt="">
    </a>
  </div>

  <section id="hero" class="hero">
  <div class="hero-wrapper">
    <div class="hero-left">
      <h1><?= htmlspecialchars($t['welcome']) ?></h1>
      <p class="hero-subtitle"><?= htmlspecialchars($t['subtitle']) ?></p>
      <p><?= htmlspecialchars($t['hello']) ?></p>
    </div>
    <div class="hero-right">
  <img id="memoji" src="assets/photos/memoji.png" alt="<?= htmlspecialchars($t['welcome']) ?>">
</div>

    </div>
  </div>
</section>

<!-- global search bar -->
<section id="search-bar">
  <form method="GET" action="#projects">
    <input type="text" name="q" id="globalSearch" placeholder="🔍 <?= htmlspecialchars($t['search_placeholder']) ?>" aria-label="Search">
  </form>
</section>


  <!-- projects -->
  <section id="projects">
  <div class="section-wrapper">
    <h2><?= htmlspecialchars($t['nav']['projects']) ?></h2>
    <div class="projects-grid">
      <?php foreach ($projects as $p): ?>
        <div class="card" data-id="<?= $p['id'] ?>">
          <div class="card-content">
            <h3><?= htmlspecialchars($p["title_$lang"]) ?></h3>
            <div class="detail" style="display:none"></div>
            <button class="btn-view-desc" type="button">
              <?= htmlspecialchars($t['view_desc']) ?>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>



  <!-- experience -->
  <section id="experience">
  <div class="section-wrapper">
    <h2><?=htmlspecialchars($t['nav']['experience'])?></h2>
    <div class="projects-grid">
      <?php foreach($t['experience_data'] as $key => $exp): ?>
        <div class="card" data-key="<?=htmlspecialchars($key)?>">
          <div class="card-content">
            <h3><?=htmlspecialchars($exp['role'])?></h3>
            <p><?=htmlspecialchars($exp['company'])?></p>
            <div class="detail" style="display:none"></div>
            <button class="btn-view-desc-exp" type="button">
              <?=htmlspecialchars($t['view_desc'])?>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- skills -->
  <section id="skills">
  <div class="section-wrapper">
    <h2><?=htmlspecialchars($t['skills'])?></h2>
    <div class="projects-grid">
      <?php foreach($t['skills_data'] as $grp): ?>
        <div class="card">
          <div class="card-content">
            <h3><?=htmlspecialchars($grp['label'])?></h3>
            <ul>
              <?php foreach($grp['items'] as $it): ?>
                <li><?=htmlspecialchars($it)?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

 <!-- contact -->
<section id="contact" class="contact">
  <div class="section-wrapper contact-wrapper">
    <h2><?=htmlspecialchars($t['nav']['contact'])?></h2>
    <p class="contact-sub"><?=htmlspecialchars($t['contact_message'])?></p>

    <form id="contactForm" action="#contact" method="POST" novalidate>
      <label>
        <?=htmlspecialchars($t['form']['name'])?>
        <input type="text" name="name" required>
      </label>
      <label>
        <?=htmlspecialchars($t['form']['email'])?>
        <input type="email" name="email" required>
      </label>
      <label>
        <?=htmlspecialchars($t['form']['message'])?>
        <textarea name="message" required></textarea>
      </label>
      <button type="submit"><?=htmlspecialchars($t['form']['send'])?></button>
    </form>

    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $n = trim($_POST['name']    ?? '');
        $e = trim($_POST['email']   ?? '');
        $m = trim($_POST['message'] ?? '');
        if ($n && filter_var($e, FILTER_VALIDATE_EMAIL) && $m) {
          echo '<p class="success">Thank you, '.htmlspecialchars($n).'!</p>';
        } else {
          echo '<p class="error">Please complete all fields correctly.</p>';
        }
      }
    ?>
  </div>
</section>


  <?php include __DIR__.'/includes/footer.php'; ?>
  <script src="assets/js/script.js"></script>
</body>
</html>
