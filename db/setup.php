<?php
// Include my database connection class
require 'database.php';

// Get the PDO instance to work with SQLite
$db = Database::getInstance();

// Ensure the projects table exists (create it if needed)
$db->exec("
    CREATE TABLE IF NOT EXISTS projects (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT NOT NULL,
        link TEXT NOT NULL
    )
");

// Clear out the table to avoid duplicates on repeated runs
$db->exec("DELETE FROM projects");

// Define the projects I want to feature in my portfolio
$projects = [
    [
      "Independent Game Shop Web",
      "Co‑built Spring Boot/PostgreSQL web app for video game shop inventory, orders, approvals.",
      "https://github.com/McGill-ECSE321-Fall2024/project-group-14"
    ],
    [
      "Fire‑Fighting Robot Prototype",
      "Co‑built autonomous firefighting robot prototype using Python, sensors, grid navigation.",
      "https://github.com/sjavaheri/SouvlakiSensors"
    ],
    [
      "Arduino Line‑Following Robot",
      "Built Arduino line‑following robot using IR sensors, custom chassis, and code.",
    ]
];

// Prepare the insert statement once for efficiency
$stmt = $db->prepare("INSERT INTO projects (title, description, link) VALUES (?, ?, ?)");

// Insert each project into the database
foreach ($projects as $p) {
    $stmt->execute($p);
}

// All set: the database now contains my projects
echo "Database ready with " . count($projects) . " projects.\n";
?>
