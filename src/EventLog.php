<?php declare(strict_types = 1);
namespace Eventsourcing;

class EventLog {

    /** @var Event[] */
    private $events = [];

    public static function fromArray(array $events): EventLog {
        $log = new self();
        foreach($events as $event) {
            $log->add($event);
        }

        return $log;
    }

    public function add(Event $event) {
        $this->events[] = $event;
    }

}
