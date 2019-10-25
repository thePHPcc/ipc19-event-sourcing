<?php declare(strict_types = 1);
namespace Eventsourcing;

class FileSystemEventReader implements EventReader {

    public function read(SessionId $id): EventLog {
        $filename = '/tmp/' . $id->asString();

        $log = new EventLog();
        foreach(file($filename) as $event) {
            $log->add( \unserialize($event) );
        }

        return $log;
    }

    public function has(SessionId $sessionId): bool {
        return \file_exists('/tmp/' . $sessionId->asString());
    }

}
