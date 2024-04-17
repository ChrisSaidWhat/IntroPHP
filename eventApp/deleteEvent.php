<?php
    //  get the eventID for the selected event

    try {
        $eventID = $_GET['eventID'];    //  get the value

        require "dbConnect.php";

        $sql = "DELETE FROM wdv341_events WHERE events_id = :eventID";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':eventID', $eventID);

        $stmt->execute();
    }
    catch (PDOException $e) {

    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <p>You Have Selected Event ID: <?php echo $eventID ?></p>
        <p>Your Event Has Been Deleted</p>
        <p><a href="selectEvents.php">Return</a></p>
    </body>
</html>
