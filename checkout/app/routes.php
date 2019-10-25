<?php
declare(strict_types=1);

use Eventsourcing\BillingAddress;
use Eventsourcing\SessionId;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

require __DIR__ . '/../../src/autoload.php';

return function (App $app) {
    /*
    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
    */

    $app->get('/start', function (Request $request, Response $response) {
        $sessionId = new SessionId('has4t1glskcktjh4ujs9eet26u');

        $checkoutService = (new Eventsourcing\Factory())->createCheckoutService($sessionId);

        $checkoutService->start();

        $response->getBody()->write('Checkout started. <a href="/billingaddress">Set billing address</a>');
        return $response;
    });

    $app->get('/billingaddress', function (Request $request, Response $response) {
        $sessionId = new SessionId('has4t1glskcktjh4ujs9eet26u');

        $checkoutService = (new Eventsourcing\Factory())->createCheckoutService($sessionId);

        $checkoutService->defineBillingAddress(new BillingAddress());

        $response->getBody()->write('Billing Address set');
        return $response;
    });

};
