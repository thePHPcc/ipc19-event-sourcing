<?php declare(strict_types = 1);
namespace Eventsourcing;

class CheckoutService {

    /** @var CartService */
    private $cartService;

    /** @var Checkout */
    private $checkout;

    /** @var EventWriter */
    private $eventWriter;

    public function __construct(CartService $cartService, EventWriter $writer) {
        $this->cartService = $cartService;
        $this->eventWriter = $writer;

        $this->checkout = new Checkout(new EventLog());
    }

    public function start(SessionId $id): void {
        $this->checkout->start($this->cartService->getCartItems($id));
    }

    public function defineBillingAddress(BillingAddress $address): void {
        $this->checkout->defineBillingAddress($address);
    }

    public function persist(SessionId $id): void {
        $listOfEvents = $this->checkout->getChanges();
        $this->eventWriter->write($id, $listOfEvents);
    }
}
