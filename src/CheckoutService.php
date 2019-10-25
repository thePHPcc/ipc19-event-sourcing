<?php declare(strict_types = 1);
namespace Eventsourcing;

class CheckoutService {

    /** @var CartService */
    private $cartService;

    /** @var EventWriter */
    private $eventWriter;

    /** @var EventReader */
    private $eventReader;

    /** @var SessionId */
    private $sessionId;

    /** @var EventDispatcher */
    private $dispatcher;

    public function __construct(
        SessionId $sessionId, CartService $cartService, EventWriter $writer,
        EventReader $reader, EventDispatcher $dispatcher
    ) {
        $this->sessionId = $sessionId;
        $this->cartService = $cartService;
        $this->eventWriter = $writer;
        $this->eventReader = $reader;
        $this->dispatcher = $dispatcher;
    }

    public function start(): void {
        $checkout = $this->loadCheckout();
        $checkout->start($this->cartService->getCartItems($this->sessionId));
        $this->persist($checkout->getChanges());
    }

    public function defineBillingAddress(BillingAddress $address): void {
        $checkout = $this->loadCheckout();
        $checkout->defineBillingAddress($address);
        $this->persist($checkout->getChanges());
    }

    private function persist(EventLog $log): void {
        $this->eventWriter->write($this->sessionId, $log);

        foreach($log as $event) {
            $this->dispatcher->notify($event);
        }
    }

    private function loadCheckout(): Checkout {
        if (!$this->eventReader->has($this->sessionId)) {
            return new Checkout(new EventLog);
        }

        $eventLog = $this->eventReader->read($this->sessionId);
        return new Checkout($eventLog);
    }
}
