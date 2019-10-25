<?php declare(strict_types = 1);
namespace Eventsourcing;

interface EventReader {

    public function read(SessionId $id): EventLog;

    public function has(SessionId $sessionId): bool;
}
