<?php
$projects = [
  [
    'title'       => 'Independent Game Shop Web',
    'description' => 'Co‑built Spring Boot/PostgreSQL web app for an independent game shop with customer shopping, inventory management, and approval workflows.',
    'link'        => 'https://github.com/McGill-ECSE321-Fall2024/project-group-14'
  ],
  [
    'title'       => 'Fire‑Fighting Robot Prototype',
    'description' => 'Co‑built autonomous firefighting robot prototype using Python, sensors, and grid navigation.',
    'link'        => 'https://github.com/sjavaheri/SouvlakiSensors'
  ]
];

foreach ($projects as $project) {
  echo "<div class='project'>";
  echo "<h3>" . htmlspecialchars($project['title']) . "</h3>";
  echo "<p>"  . htmlspecialchars($project['description']) . "</p>";
  echo "<a href='" . htmlspecialchars($project['link']) . "' target='_blank'>Voir sur GitHub</a>";
  echo "</div>";
}
