<?php
// includes/header.php
?>
<header class="site-header">
  <div class="nav">
    <!-- left side: language switcher -->
    <div class="lang-switch">
      <a href="lang.php?lang=fr">FR</a> |
      <a href="lang.php?lang=en">EN</a>
    </div>

    <!-- centered one page nav -->
    <nav class="main-nav">
      <a href="#hero"><?= htmlspecialchars($t['nav']['home']) ?></a>
      <a href="#projects"><?= htmlspecialchars($t['nav']['projects']) ?></a>
      <a href="#experience"><?= htmlspecialchars($t['nav']['experience']) ?></a>
      <a href="#skills"><?= htmlspecialchars($t['nav']['skills']) ?></a>
      <a href="#contact"><?= htmlspecialchars($t['nav']['contact']) ?></a>
    </nav>

    <!-- right side: theme toggle -->
    <div class="nav-right">
    <button id="menu-toggle" aria-label="Ouvrir le menu">
    <!-- simple hamburger icon: -->
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
    </button>
      <button id="theme-toggle"
              aria-label="<?= htmlspecialchars($t['theme_dark_label']) ?>">
      </button>
    </div>
  </div>
</header>
