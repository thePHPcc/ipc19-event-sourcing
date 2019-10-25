<?php declare(strict_types = 1);
namespace Eventsourcing;

class EventDispatcher {

    /** @var EventListener[] */
    private $listeners = [];

    public function registerListener(EventListener $listener): void {
        $this->listeners[] = $listener;
    }

    public function notify(Event $event): void {
        foreach($this->listeners as $listener) {
            $listener->notify($event);
        }
    }

}
