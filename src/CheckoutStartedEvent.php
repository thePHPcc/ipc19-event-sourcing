<?php declare(strict_types = 1);
namespace Eventsourcing;

class CheckoutStartedEvent implements Event {

    /** @var CartItemCollection */
    private $cartItems;

    public function __construct(CartItemCollection $cartItems) {
        $this->cartItems = $cartItems;
    }

    public function getCartItems(): CartItemCollection {
        return $this->cartItems;
    }

}
