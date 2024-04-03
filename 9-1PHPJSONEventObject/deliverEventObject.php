<?php

    require "Event.php";

    $outputObj = new Event();

    try {
        require 'dbConnect.php';

        $eventID = 1;

        $sql = "SELECT events_id, events_name, events_description, events_presenter, events_date, events_time, DATE_FORMAT(events_date, '%W %M %e %Y') AS eventsFormatDate, events_date_inserted, events_date_updated FROM wdv341_events WHERE events_id = :eventID";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":eventID", $eventID);

        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

        error_log($e->getMessage());
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));

        echo "<h1>$message</h1>";
    }


    $row = $stmt->fetch();

    $outputObj->set_event_id($row["events_id"]);
    $outputObj->set_event_name($row["events_name"]);
    $outputObj->set_event_description($row["events_description"]);
    $outputObj->set_event_presenter($row["events_presenter"]);
    $outputObj->set_event_date($row["events_date"]);
    $outputObj->set_event_time($row["events_time"]);

    var_dump($outputObj);

    $eventJSON = json_encode($outputObj);

    echo "<p>$eventJSON</p>";