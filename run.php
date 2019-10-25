<?php declare(strict_types = 1);
namespace Eventsourcing;

require __DIR__ . '/src/autoload.php';

$sessionId = new SessionId('has4t1glskcktjh4ujs9eet26u');

$dispatcher = new EventDispatcher();
$dispatcher->registerListener(
    new MyFirstEventListener
);

$checkoutService = new CheckoutService(
    $sessionId,
    new CartService,
    new FileSystemEventWriter,
    new FileSystemEventReader,
    $dispatcher
);


$checkoutService->start();

// ...

$checkoutService->defineBillingAddress(new BillingAddress());

