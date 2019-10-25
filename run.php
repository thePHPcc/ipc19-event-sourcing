<?php declare(strict_types = 1);
namespace Eventsourcing;

require __DIR__ . '/src/autoload.php';

$checkout = new Checkout([]);
$checkout->start();

$listOfEvents = $checkout->getChanges();


$checkout2 = new Checkout($listOfEvents);

var_dump($checkout2);

