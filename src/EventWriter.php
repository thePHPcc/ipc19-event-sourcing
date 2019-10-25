<?php declare(strict_types = 1);
namespace Eventsourcing;

interface EventWriter {

    public function write(SessionId $id, EventLog $listOfEvents): void;

}
