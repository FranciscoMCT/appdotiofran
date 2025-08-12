<?php
// config/config.php
require_once __DIR__ . '/database.php';

// Application settings loaded from environment (Azure App Service)
return [
    'db' => [
        'server' => getenv('DB_SERVER') ?: 'seu-servidor.database.windows.net',
        'database' => getenv('DB_DATABASE') ?: 'db-gestao-projetos',
        'username' => getenv('DB_USERNAME') ?: 'sqladmin',
        'password' => getenv('DB_PASSWORD') ?: 'SuaSenhaSegura123!'
    ],
    'app' => [
        'name' => 'Gestão de Projetos',
        'env' => getenv('APP_ENV') ?: 'development',
        'debug' => (getenv('APP_DEBUG') ?: 'true') === 'true'
    ]
];

--- FILE: config/database.php ---
<?php