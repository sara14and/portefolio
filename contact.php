<?php
// 1) Load translations & DB (if needed later)
$lang   = $_GET['lang'] ?? 'fr';
$trans  = include "lang/$lang.php";
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($trans['contact']) ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include "includes/header.php"; ?>

  <main>
    <h2><?= htmlspecialchars($trans['contact']) ?></h2>
    <form id="contactForm" action="contact.php?lang=<?= $lang ?>" method="POST" novalidate>
      <label>
        Name:
        <input type="text" name="name" />
      </label>
      <label>
        Email:
        <input type="email" name="email" />
      </label>
      <label>
        Message:
        <textarea name="message"></textarea>
      </label>
      <button type="submit">Send</button>
    </form>
    <?php
    // 3) PHP handling after submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $n = trim($_POST['name'] ?? '');
      $e = trim($_POST['email'] ?? '');
      $m = trim($_POST['message'] ?? '');
      if ($n && filter_var($e, FILTER_VALIDATE_EMAIL) && $m) {
        echo "<p>Thank you, " . htmlspecialchars($n) . "! Your message has been sent.</p>";
        
      } else {
        echo "<p style='color:red;'>Please fill out all fields correctly.</p>";
      }
    }
    ?>
  </main>

  <?php include "includes/footer.php"; ?>
  <script src="assets/js/script.js"></script>
</body>
</html>
