<?php declare(strict_types = 1);
namespace Eventsourcing;

class FileSystemEventWriter implements EventWriter {

    public function write(SessionId $id, EventLog $listOfEvents): void {
        $filename = '/tmp/' . $id->asString();

        foreach($listOfEvents as $event) {
            file_put_contents($filename, \serialize($event) . "\n", FILE_APPEND);
        }

    }

}
