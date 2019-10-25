<?php declare(strict_types = 1);
namespace Eventsourcing;

class Checkout {
    private $eventLog;

    private $isStarted = false;

    public function __construct(EventLog $eventLog) {
        $this->replay($eventLog);
        $this->eventLog = new EventLog();
    }

    public function start(): void {
        $event = new CheckoutStartedEvent();
        $this->eventLog->add($event);

        $this->handleEvent($event);
    }

    public function getChanges(): EventLog {
        return $this->eventLog;
    }

    private function handleEvent(CheckoutStartedEvent $event): void {
        $this->isStarted = true;
    }

    private function replay(EventLog $eventLog): void {
        foreach ($eventLog as $event) {
            $this->handleEvent($event);
        }
    }
}
