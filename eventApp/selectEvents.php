<?php

    session_start();

    if($_SESSION["memberStatus"] == "member") {
        //  we know you are signed on and have access to this page
    }
    else {
        //  you are not a valid user
        header("Location: login.php");
    }

    //  1 connect to database
    //  2 create SQL query
    //  3. prepare your PDO statement
    //  4. bind variables to the PDO statement if any
    //  5. execute the PDO statement - run your SQL against the database
    //  6. process the results from the query
    try {
        require 'dbConnect.php';

        $sql = "SELECT events_id, events_name, events_description, DATE_FORMAT(events_date, '%W %M %e %Y') AS eventsFormatDate FROM wdv341_events";

        $stmt = $conn->prepare($sql);

        $stmt->execute();       //  result of the query is stored in the $stmt variable/object

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

        error_log($e->getMessage());    //  delivers a developer defined error message to the PHP log file
        error_log($e->getLine());
        error_log(var_dump(debug_backtrace()));

        //  clean up any variables or connections that have been left hanging by this error.

        //  header('Location: files/505_error_response_page.php');  //  sends control to a user-friendly page

        echo "<h1>$message</h1>";
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
        <style>

            .flexContainer {
                display: flex;
                justify-content: space-evenly;
            }

            .eventBlock {
                background-color: mistyrose;
                padding: 10px;
                border: #0A0A0A 1px solid;
            }

        </style>

    </head>
    <body>
        <h1>WDV341 Intro PHP</h1>
        <h2>SELECT Demonstration Page</h2>
        <h2>SelectEvents From The WDV341 Database</h2>

        <div class="flexContainer">
            <?php
                while ($row = $stmt->fetch()) {
                    ?>
                    <div class="eventBlock">
                        <p>Event Name: <?php echo $row["events_name"]; ?></p>
                        <p>Event Description: <?php echo $row["events_description"]; ?></p>
                        <p>Event Date: <?php echo $row["eventsFormatDate"]; ?></p>
                        <p><a href="updateEvent.php?eventID=<?php echo $row['events_id']?>"><button>Edit Event</button></a> <a href="deleteEvent.php?eventID=<?php echo $row['events_id']?>"><button>Delete Event</button></a></p>
                    </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
