<?php
require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../vendor/autoload.php';

$em = $entityManager;
$q = $em->createQuery('SELECT p FROM CodeExample\Model\Project p WHERE p.date_end < :today')
->setParameter('today', new \DateTime());

$projects = $q->getResult();

echo 'Found '. count($projects) . ' expired projects. Emailing users...'."\n";

foreach ($projects as $p) {
    foreach ($p->getCitizen() as $c) {
        //echo $p->getDateEnd()->format('Y-m-d H:i:s');
        sendStandardMessage($c->getAddress(), $p->getProjID());
    }
}

function sendStandardMessage($address, $projectID)
{
    $to = $address;
    $subject = 'the subject';
    $message = "Hello. Go look at expired project $projectID please";
    $headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
    
    echo $message."\n";
    
    //mail($to, $subject, $message, $headers);
}