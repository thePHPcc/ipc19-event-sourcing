<?php declare(strict_types = 1);
namespace Eventsourcing;

class Factory {

    public function createCheckoutService(SessionId $sessionId): CheckoutService {
        $dispatcher = new EventDispatcher();
        $dispatcher->registerListener(
            new CheckoutCartDisplayUpdater(new CartCheckoutDisplayProjector())
        );


        return new CheckoutService(
            $sessionId,
            new CartService,
            new FileSystemEventWriter,
            new FileSystemEventReader,
            $dispatcher
        );

    }
}
