<?php

use CodeExample\Model\Citizen;
require_once __DIR__ . '/../bootstrap.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    // FIXME - validate user input better!!
    $citizen = $entityManager->find('CodeExample\Model\Citizen', $_GET['id']);
    if (null === $citizen) {
        http_response_code(404);
        exit;
    }

    $contactDetails = array(
        'first_name' => $citizen->getFname(),
        'last_name' => $citizen->getLname(),
        'address' => $citizen->getAddress(),
        'mobile' => $citizen->getMobile(),
    );
    echo json_encode($contactDetails);
} else {
    http_response_code(400);
}