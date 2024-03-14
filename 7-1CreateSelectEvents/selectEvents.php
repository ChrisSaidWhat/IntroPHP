<?php
    //  1 connect to database
    //  2 create SQL query
    //  3. prepare your PDO statement
    //  4. bind variables to the PDO statement if any
    //  5. execute the PDO statement - run your SQL against the database
    //  6. process the results from the query
    try {
        require 'dbConnect.php';

        $sql = "SELECT events_name, events_description, events_presenter, DATE_FORMAT(events_date, '%W %M %e %Y') AS eventsFormatDate, TIME_FORMAT(events_time, '%h:%i %p') AS eventsFormatTime, DATE_FORMAT(events_date_inserted, '%W %M %e %Y') AS eventsInsertedFormatDate, DATE_FORMAT(events_date_updated, '%W %M %e %Y') AS eventsUpdatedFormatDate FROM wdv341_events";

        $stmt = $conn->prepare($sql);

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
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Web Development Events</title>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap');

            :root {
                --brightText: #FBFBFF;
                --darkText: #040F16;
                --eventEven: #0B4F6C;
                --rowEvenB: #01BAEF;
                --rowOddB: #0685AE;
                --eventOdd: #B80C09;
                --rowEvenR: #8D1D22;
                --rowOddR: #622E3B;
            }

            body {
                background-color: var(--brightText);
            }

            h1 {
                font-family: "IBM Plex Sans", sans-serif;
                font-weight: 700;
                font-style: normal;
                color: var(--darkText);
            }

            .outputContainer {
                display: grid;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr;
                gap: 20px;
                font-family: "IBM Plex Sans", sans-serif;
                font-weight: 500;
                font-style: normal;
            }

            .outputContainer div:nth-child(even) {
                background-color: var(--eventEven);
                padding: 20px;
                grid-column: 2/3;
                grid-row: 1/2;
                border: var(--darkText) 2px solid;
            }

            .outputContainer div:nth-child(even) p:nth-child(even) {
                background-color: var(--rowEvenB);
                color: var(--darkText);
                padding: 10px;
                margin: 0;
            }

            .outputContainer div:nth-child(even) p:nth-child(odd) {
                background-color: var(--rowOddB);
                color: var(--brightText);
                padding: 10px;
                margin: 0;
            }

            .outputContainer div:nth-child(odd) {
                background-color: var(--eventOdd);
                padding: 20px;
                grid-column: 1/2;
                grid-row: 1/2;
                border: var(--darkText) 2px solid;
            }

            .outputContainer div:nth-child(odd) p:nth-child(even) {
                background-color: var(--rowEvenR);
                color: var(--darkText);
                padding: 10px;
                margin: 0;
            }

            .outputContainer div:nth-child(odd) p:nth-child(odd) {
                background-color: var(--rowOddR);
                color: var(--brightText);
                padding: 10px;
                margin: 0;
            }
        </style>
    </head>
    <body>
        <h1>Web Development All Events Schedule</h1>
        <div class="outputContainer">
            <?php
                while ($row = $stmt->fetch()) {
                    ?>
                    <div>
                        <p>Event Name: <?php echo $row["events_name"]; ?></p>
                        <p>Event Description: <?php echo $row["events_description"]; ?></p>
                        <p>Event Presenter: <?php echo $row["events_presenter"]; ?></p>
                        <p>Event Date: <?php echo $row["eventsFormatDate"]; ?></p>
                        <p>Event Time: <?php echo $row["eventsFormatTime"]; ?></p>
                        <p>Event Added: <?php echo $row["eventsInsertedFormatDate"]; ?></p>
                        <p>Event Last Updated: <?php echo $row["eventsUpdatedFormatDate"]; ?></p>
                    </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
