<?php declare(strict_types = 1);
namespace Eventsourcing;

class CheckoutCartDisplayUpdater implements EventListener {

    /** @var CartDisplayProjector */
    private $cartDisplayProjector;

    public function notify(Event $event): void {
        // TODO: Implement notify() method.
    }

}
