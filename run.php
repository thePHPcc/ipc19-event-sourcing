<?php declare(strict_types = 1);
namespace Eventsourcing;

require __DIR__ . '/src/autoload.php';

$checkoutService = new CheckoutService(new CartService, new FileSystemEventWriter);
$sessionId = new SessionId('has4t1glskcktjh4ujs9eet26u');


$checkoutService->start($sessionId);
$checkoutService->persist($sessionId);


// ...

$checkoutService->defineBillingAddress(new BillingAddress());
$checkoutService->persist($sessionId);

