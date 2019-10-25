<?php declare(strict_types = 1);
namespace Eventsourcing;

class MyFirstEventListener implements EventListener {

    public function notify(Event $event): void {
        echo "GOT EVENT " . \get_class($event) . "\n";
    }

}
