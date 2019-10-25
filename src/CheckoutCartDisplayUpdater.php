<?php declare(strict_types = 1);
namespace Eventsourcing;

class CheckoutCartDisplayUpdater implements EventListener {

    /** @var CartCheckoutDisplayProjector */
    private $projector;

    public function __construct(CartCheckoutDisplayProjector $projector) {
        $this->projector = $projector;
    }

    public function notify(Event $event): void {
        if (!$event instanceof CheckoutStartedEvent) {
            return;
        }

        $this->projector->project($event->getCartItems());
    }

}
