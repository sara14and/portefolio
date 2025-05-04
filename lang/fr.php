<?php
// lang/fr.php
return [
  // Hero
  'welcome'           => 'Sara Andari',
  'subtitle'          => 'Étudiante en génie informatique',
  'hello'             => 'Salut! Bienvenue sur mon portfolio.',

  // Navbar
  'nav' => [
    'home'       => 'Accueil',
    'projects'   => 'Projets',
    'experience' => 'Expérience',
    'skills'     => 'Compétences',
    'contact'    => 'Contact',
  ],

  // CV button
  'download_cv'       => 'Télécharger mon CV',

  // search bar 
  'search_placeholder' => 'Rechercher...',
  'reset_label' => 'Réinitialiser la recherche',
  'no_results'  => 'Aucun résultat trouvé.',
  'match_one'   => '{count} résultat trouvé.',
  'match_other' => '{count} résultats trouvés.',

  // AJAX button labels
  'view_desc'         => 'Voir la description',
  'hide_desc'         => 'Masquer la description',
  'loading'           => 'Chargement…',

  // theme toggle
  'theme_dark_label'  => 'Activer le mode sombre',
  'theme_light_label' => 'Activer le mode clair',

  // experience data
  'experience_data' => [
    'atlas' => [
      'role'    => 'Stagiaire support technique',
      'company' => 'Atlas Copco Compressors Canada',
      'points'  => [
        'Résolution de tickets de support technique de niveau 1, y compris demandes de pièces spéciales et listes de service.',
        'Collaboration avec les équipes de service pour les réclamations sous garantie et suivi des bulletins de modification d’ingénierie (ECB).',
        'Gestion et mise à jour de la documentation dans SharePoint.',
      ],
    ],
    'asda' => [
      'role'    => 'Stagiaire R&D',
      'company' => 'Applied Systems Design & Analysis (ASDA) Inc.',
      'points'  => [
        'Analyse de pré‑faisabilité et conception de l’Energy Calculator via Excel, HTML, CODERS DB et SPINE.',
        'Recherche approfondie et propositions d’architecture pour l’outil.',
        'Assistance à la collecte et à l’analyse des données pour le modèle énergétique.',
      ],
    ],
    'factory' => [
      'role'    => 'Directrice générale & Responsable communication',
      'company' => 'The Factory - Hardware Design Lab',
      'points'  => [
        'Organisation et promotion d’ateliers et de hackathons.',
        'Gestion des réseaux sociaux et création de supports marketing.',
        'Permanences hebdomadaires pour former les étudiants à l’équipement.',
      ],
    ],
  ],

  // skills section
  'skills'      => 'Compétences',
  'skills_data' => [
    [
      'label' => 'Langages de programmation',
      'items' => ['Python', 'Java', 'C', 'Unix/Shell scripting', 'HTML', 'CSS', 'ARM Assembly'],
    ],
    [
      'label' => 'Environnements de développement',
      'items' => ['Visual Studio Code', 'IntelliJ', 'Vim', 'PyCharm', 'Arduino', 'Thonny', 'Eclipse'],
    ],
    [
      'label' => 'Outils collaboratifs',
      'items' => ['GitHub', 'Airtable', 'PostgreSQL'],
    ],
    [
      'label' => 'Matériel',
      'items' => ['Soudure', 'Impression 3D', 'Fraisage de PCB', 'Raspberry Pi'],
    ],
    [
      'label' => 'Langues parlées',
      'items' => ['Anglais', 'Français', 'Krio', 'Arabe'],
    ],
    [
      'label' => 'Compétences non techniques',
      'items' => ['Adaptabilité', 'Esprit d’équipe', 'Souci du détail', 'Créativité', 'Détermination', 'Efficacité'],
    ],
  ],

  // contact section
  'contact_message' => 'Des questions? Contactez‑moi!',

  // contact form
  'form' => [
  'name'        => 'Nom',
  'email'       => 'Email',
  'message'     => 'Message',
  'send'        => 'Envoyer',
  'name_req'    => 'Le nom est requis.',
  'email_req'   => 'Email invalide.',
  'message_req' => 'Le message est requis.',
  ],
  'contact_success' => 'Merci, %s!',
  'contact_error'   => 'Veuillez remplir tous les champs correctement.',
];
