<?php
// lang/en.php
return [
  // Hero
  'welcome'           => 'Sara Andari',
  'subtitle'          => 'Computer Engineering Student',
  'hello'             => 'Hey there! Welcome to my portfolio.',

  // Navbar
  'nav' => [
    'home'       => 'Home',
    'projects'   => 'Projects',
    'experience' => 'Experience',
    'skills'     => 'Skills',
    'contact'    => 'Contact',
  ],

  // CV button
  'download_cv'       => 'Download my CV',


  // search bar 
  'search_placeholder' => 'Search...',
  'reset_label' => 'Reset search',
  'no_results'   => 'No results found.',
  'match_one'   => '{count} match found.',
  'match_other' => '{count} matches found.',

  // AJAX button labels
  'view_desc'         => 'View description',
  'hide_desc'         => 'Hide description',
  'loading'           => 'Loading…',

  // theme toggle
  'theme_dark_label'  => 'Enable dark mode',
  'theme_light_label' => 'Enable light mode',

  // experience data (used by PHP and AJAX)
  'experience_data' => [
    'atlas' => [
      'role'    => 'Technical Support Intern',
      'company' => 'Atlas Copco Compressors Canada',
      'points'  => [
        'Resolved Level 1 technical support tickets, including special parts and service list requests.',
        'Collaborated with service teams on warranty claims and ECB follow‑ups.',
        'Managed and maintained documentation in internal SharePoint channels.',
      ],
    ],
    'asda' => [
      'role'    => 'R&D Intern',
      'company' => 'Applied Systems Design & Analysis (ASDA)',
      'points'  => [
        'Performed pre‑feasibility analysis and design of the Energy Calculator using Excel, HTML, CODERS DB, and SPINE.',
        'Conducted in‑depth research and formulated architectural proposals.',
        'Assisted in data collection efforts for the energy model.',
      ],
    ],
    'factory' => [
      'role'    => 'General Manager & Communications Lead',
      'company' => 'The Factory - Hardware Design Lab',
      'points'  => [
        'Coordinated and promoted events such as workshops and hackathons.',
        'Managed social media and created marketing materials.',
        'Held weekly office hours to train students on equipment.',
      ],
    ],
  ],

  // skills section heading + items
  'skills'      => 'Skills',
  'skills_data' => [
    [
      'label' => 'Programming Languages',
      'items' => ['Python', 'Java', 'C', 'Unix/Shell scripting', 'HTML', 'CSS', 'ARM Assembly'],
    ],
    [
      'label' => 'IDEs',
      'items' => ['Visual Studio Code', 'IntelliJ', 'Vim', 'PyCharm', 'Arduino', 'Thonny', 'Eclipse'],
    ],
    [
      'label' => 'Collaboration Tools',
      'items' => ['GitHub', 'Airtable', 'PostgreSQL'],
    ],
    [
      'label' => 'Hardware',
      'items' => ['Soldering', '3D Printing', 'PCB milling', 'Raspberry Pi'],
    ],
    [
      'label' => 'Languages',
      'items' => ['English', 'French', 'Krio', 'Arabic'],
    ],
    [
      'label' => 'Soft Skills',
      'items' => ['Adaptable', 'Social', 'Detail‑oriented', 'Creative', 'Determined', 'Efficient'],
    ],
  ],

  // contact section
  'contact_message' => "Any questions? Let's connect!",

  // contact form labels + button
  'form' => [
  'name'        => 'Name',
  'email'       => 'Email',
  'message'     => 'Message',
  'send'        => 'Send',
  'name_req'    => 'Name is required.',
  'email_req'   => 'Valid email is required.',
  'message_req' => 'Message is required.',
  ],
  'contact_success' => 'Thank you, %s!',
  'contact_error'   => 'Please complete all fields correctly.',
];
