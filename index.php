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
      <a class="btn-cv hero-cv" href="SaraAndariCV2025.pdf" download>
      <?= htmlspecialchars($t['download_cv']) ?>
      </a>
    </div>
    <div class="hero-right">
  <img id="memoji" src="assets/photos/memoji.png" alt="<?= htmlspecialchars($t['welcome']) ?>">
</div>

    </div>
  </div>
</section>

<!-- global search bar -->
<section id="search-bar">
  <form id="searchForm" method="GET" action="" aria-label="Global search">
    <label for="globalSearch" class="visually-hidden">Search the site</label>
    <input
      type="text"
      name="q"
      id="globalSearch"
      value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>"
      placeholder="Search for anything..."
      aria-describedby="matchCount"
      autocomplete="off"
    >
    <button type="button" id="resetSearch" aria-label="Reset search">×</button>
    <span id="matchCount" class="match-count" aria-live="polite"></span>
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
    <h2><?= htmlspecialchars($t['nav']['contact']) ?></h2>
    <p class="contact-sub"><?= htmlspecialchars($t['contact_message']) ?></p>

    <?php
      // initialize vars
      $name    = $_POST['name']    ?? '';
      $email   = $_POST['email']   ?? '';
      $message = $_POST['message'] ?? '';
      $success = '';
      $error   = '';

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // trim & validate
        $n = trim($name);
        $e = trim($email);
        $m = trim($message);

        if ($n && filter_var($e, FILTER_VALIDATE_EMAIL) && $m) {
          $msg = sprintf($t['contact_success'], htmlspecialchars($n));
          echo '<p class="success">'.$msg.'</p>';
          echo '<script>document.getElementById("contactForm").reset();</script>';
        } else {
          echo '<p class="error">'.htmlspecialchars($t['contact_error']).'</p>';
        }        
      }
    ?>

    <form
      id="contactForm"
      action="#contact"
      method="POST"
      novalidate
    >
      <label>
        <?= htmlspecialchars($t['form']['name']) ?>
        <input
          type="text"
          name="name"
          required
          value="<?= htmlspecialchars($name) ?>"
        >
      </label>

      <label>
        <?= htmlspecialchars($t['form']['email']) ?>
        <input
          type="email"
          name="email"
          required
          value="<?= htmlspecialchars($email) ?>"
        >
      </label>

      <label>
        <?= htmlspecialchars($t['form']['message']) ?>
        <textarea
          name="message"
          required
        ><?= htmlspecialchars($message) ?></textarea>
      </label>

      <button type="submit">
        <?= htmlspecialchars($t['form']['send']) ?>
      </button>
    </form>

    <?php if ($success): ?>
      <div class="form-message success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="form-message error"><?= $error ?></div>
    <?php endif; ?>

  </div>
</section>
