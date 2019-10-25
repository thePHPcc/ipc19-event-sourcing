<?php declare(strict_types = 1);
namespace Eventsourcing;

class CartCheckoutDisplayProjector {

    public function project(CartItemCollection $cartItems): void {
        file_put_contents(
            '/tmp/cart.html',
            \var_export($cartItems, true)
        );
    }
}
