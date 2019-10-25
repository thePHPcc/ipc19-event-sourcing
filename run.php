<?php declare(strict_types = 1);
namespace Eventsourcing;

require __DIR__ . '/src/autoload.php';

$cartService = new CartService();

$checkout = new Checkout(new EventLog());
$checkout->start(
    $cartService->getCartItems(new SessionId('has4t1glskcktjh4ujs9eet26u'))
);
$checkout->defineBillingAddress(new BillingAddress());

$listOfEvents = $checkout->getChanges();

//\var_dump($listOfEvents);
var_dump($checkout);

