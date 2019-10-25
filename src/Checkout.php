<?php declare(strict_types = 1);
namespace Eventsourcing;

use RuntimeException;

final class Checkout extends EventSourced {

    /** @var null|CartItemCollection */
    private $cartItems;

    private $isStarted = false;

    /** @var null|BillingAddress */
    private $billingAddress;

    public function start(CartItemCollection $cartItems): void {
        $event = new CheckoutStartedEvent($cartItems);
        $this->processEvent($event);
    }

    public function defineBillingAddress(BillingAddress $address): void {
        if ($this->cartItems === null) {
            throw new RuntimeException('Not started yet!');
        }

        $event = new BillingAddressDefinedEvent($address);
        $this->processEvent($event);
    }

    protected function handleEvent(Event $event): void {
        if ($event instanceof CheckoutStartedEvent) {
            $this->handleStartedEvent($event);
            return;
        }

        if ($event instanceof BillingAddressDefinedEvent) {
            $this->handleBillingAddressDefinedEvent($event);
        }
    }

    private function handleStartedEvent(CheckoutStartedEvent $event): void {
        $this->cartItems = $event->getCartItems();
        $this->isStarted = true;
    }

    private function handleBillingAddressDefinedEvent(BillingAddressDefinedEvent $event) {
        $this->billingAddress = $event->getAddress();
    }

}
