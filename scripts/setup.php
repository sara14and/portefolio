<?php
require_once __DIR__ . '/../db/database.php';

$db = Database::getInstance();

$db->exec("DROP TABLE IF EXISTS projects");
$db->exec("DROP TABLE IF EXISTS contacts");

// table for projects
$db->exec("
    CREATE TABLE projects (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title_en TEXT NOT NULL,
        title_fr TEXT NOT NULL,
        description_en TEXT NOT NULL,
        description_fr TEXT NOT NULL,
        link TEXT NOT NULL
    )
");

// table for contacts
$db->exec("
    CREATE TABLE IF NOT EXISTS contacts (
        id           INTEGER PRIMARY KEY AUTOINCREMENT,
        name         TEXT    NOT NULL,
        email        TEXT    NOT NULL,
        message      TEXT    NOT NULL,
        submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

// insert entries
$projects = [
    [
        "Game Shop Web",
        "Site Web de Boutique de Jeux",
        "Co‑built Spring Boot/PostgreSQL web app for video game shop inventory, orders, approvals.",
        "Développement d’une application Spring Boot/PostgreSQL pour gérer l’inventaire, les commandes et les approbations.",
        "https://github.com/McGill-ECSE321-Fall2024/project-group-14"
    ],
    [
        "Fire‑Fighting Robot Prototype",
        "Prototype de Robot Incendie",
        "Co‑built autonomous firefighting robot prototype using Python, sensors, grid navigation.",
        "Création d’un prototype de robot autonome de lutte contre les incendies en Python, capteurs et navigation sur grille.",
        "https://github.com/sjavaheri/SouvlakiSensors"
    ],
    [
        "Arduino Line‑Following Robot",
        "Robot Suiveur de Ligne Arduino",
        "Built Arduino line‑following robot using IR sensors, custom chassis, and code for the ForgeMcGill Hackathon.",
        "Construction d’un robot Arduino suiveur de ligne avec capteurs IR, châssis personnalisé, et code pour le hackathon ForgeMcGill.",
        ""
    ]
];

$stmt = $db->prepare("
    INSERT INTO projects (title_en, title_fr, description_en, description_fr, link)
    VALUES (?, ?, ?, ?, ?)
");

foreach ($projects as $p) {
    $stmt->execute($p);
}

echo "Database seeded with " . count($projects) . " projects.\n";
