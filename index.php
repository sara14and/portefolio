<?php
$lang = $_GET['lang'] ?? 'fr';
$trans = include "lang/$lang.php";
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <title><?php echo $trans['welcome']; ?></title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <?php include "includes/header.php"; ?>

  <main>
    <section>
      <h2><?php echo $trans['projects']; ?></h2>
      <div class="project">
        <h3>SmartCart</h3>
        <p>Application de gestion d'inventaire et suggestions de recettes pour les courses. Projet Capstone McGill.</p>
        <a href="https://github.com/JMatt26/SmartCart" target="_blank">Voir sur GitHub</a>
      </div>

      <button id="loadMore">Voir plus de projets</button>
      <div id="moreProjects"></div>


      <div class="project">
        <h3>StuddyBuddy</h3>
        <p>Application pour étudiants facilitant la planification de séances d’étude collaboratives.</p>
        <a href="https://github.com/JMatt26/StuddyBuddy" target="_blank">Voir sur GitHub</a>
      </div>
    </section>
  </main>

  <?php include "includes/footer.php"; ?>
  <script src="assets/js/script.js"></script>
</body>
</html>
