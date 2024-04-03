<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['firstName'])) {


            $validForm = true;

            $eventName = $_POST['eventName'];
            $eventDescription = $_POST['eventDescription'];
            $eventPresenter = $_POST['eventPresenter'];
            $eventDate = $_POST['eventDate'];
            $eventTime = $_POST['eventTime'];

            require "dbConnect.php";

            $sql = "INSERT INTO wdv341_events (events_name, events_description, events_presenter, events_date, events_time) VALUES (:eventsName, :eventsDesc, :eventsPresenter, :eventsDate, :eventsTime)";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':eventsName', $eventName);
            $stmt->bindParam(':eventsDesc', $eventDescription);
            $stmt->bindParam('eventsPresenter', $eventPresenter);
            $stmt->bindParam('eventsDate', $eventDate);
            $stmt->bindParam('eventsTime', $eventTime);

            $stmt->execute();
        }
        else {
            $validForm = false;
        }
    }
    else {
        $validForm = false;
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Self Posting Events Form</title>
    </head>
    <body>

        <?php
            if ($validForm) {
                ?>
                <h1>SUBMISSION SUCCESSFULLY ADDED TO DATABASE!</h1>

                <?php
            }
            else {

                ?>

                <form id="selfPostingForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="firstName" style="display: none;">First Name: </label>
                    <input name="firstName" type="text" id="firstName" style="display: none;">

                    <p>
                        <label for="eventName">Event Name: </label>
                        <input type="text" name="eventName" id="eventName">
                    </p>

                    <p>
                        <label for="eventDescription">Event Description: </label>
                        <input type="text" name="eventDescription" id="eventDescription">
                    </p>

                    <p>
                        <label for="eventPresenter">Event Presenter: </label>
                        <input type="text" name="eventPresenter" id="eventPresenter">
                    </p>

                    <p>
                        <label for="eventDate">Event Date: </label>
                        <input type="date" name="eventDate" id="eventDate">
                    </p>

                    <p>
                        <label for="eventTime">Event Time: </label>
                        <input type="time" name="eventTime" id="eventTime">
                    </p>

                    <p>
                        <input type="submit" name="submit" value="Submit">
                        <input type="reset" value="Reset">
                    </p>
                </form>

                <?php
            }

        ?>

    </body>
</html>
