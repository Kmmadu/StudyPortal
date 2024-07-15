<?php
return [
    'callback' => 'http://localhost/studenthub/hybridauth.php',
    'providers' => [
        'Google' => [
            'enabled' => true,
            'keys' => [
                'id' => 'YOUR_GOOGLE_CLIENT_ID',
                'secret' => 'YOUR_GOOGLE_CLIENT_SECRET'
            ],
        ],
    ],
];
?>
