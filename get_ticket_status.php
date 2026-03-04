<?php

// Always return JSON
header('Content-Type: application/json');

// Default response values
$defaultFirstName = 'jasper';
$defaultStatus    = 'open';

// Custom ticket overrides (easy to extend)
// ADD YOUR CUSTOMIZED TICKET ID HERE, DO NOT EDIT EXISTING ONES BUT ADD YOUR OWN
$customTickets = [
  // JF - reserved
    '1111' => [
        'firstName'    => 'jasper',
        'ticketStatus' => 'open'
    ],
  // JF - reserved
      '1234' => [
        'firstName'    => 'jasper',
        'ticketStatus' => 'open'
    ],
  // JF - reserved
    '9999' => [
        'firstName'    => 'jasper',
        'ticketStatus' => 'open'
    ],
    '5678' => [
        'firstName'    => 'patrick',
        'ticketStatus' => 'closed'
    ]
];

// Validate input existence
if (!isset($_GET['ticket'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing ticket parameter']);
    exit;
}

$ticket = $_GET['ticket'];

// Validate: must be exactly 4 digits
if (!preg_match('/^\d{4}$/', $ticket)) {
    http_response_code(400);
    echo json_encode(['error' => 'Ticket must be exactly 4 digits']);
    exit;
}

// Determine response values
if (array_key_exists($ticket, $customTickets)) {
    $response = $customTickets[$ticket];
} else {
    $response = [
        'firstName'    => $defaultFirstName,
        'ticketStatus' => $defaultStatus
    ];
}

// Return JSON
echo json_encode($response);
