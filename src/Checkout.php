<?php declare(strict_types = 1);
namespace Eventsourcing;

class Checkout {

    /** @var array */
    private $eventLog = [];

    /** @var bool */
    private $isStarted = false;

    public function __construct(array $eventLog) {
        $this->replay($eventLog);
    }

    public function start(): void {
        $event = new CheckoutStartedEvent();
        $this->eventLog[] = $event;

        $this->handleEvent($event);
    }

    public function getChanges(): array {
        return $this->eventLog;
    }

    private function handleEvent(CheckoutStartedEvent $event): void {
        $this->isStarted = true;
    }

    private function replay(array $eventLog):void {
        foreach($eventLog as $event) {
            $this->handleEvent($event);
        }
    }

}
