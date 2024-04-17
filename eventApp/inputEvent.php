<?php

    session_start();
    //  are you a valid user? if yes, then go to work, else deny access and redirect

    if($_SESSION["memberStatus"] == "member") {
        //  we know you are signed on and have access to this page
    }
    else {
        //  you are not a valid user
        header("Location: login.php");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //  form has been submitted
        $validForm = true;
        //  get the data from the POST variable that came from the form
        $eventName = $_POST['eventName'];
        $eventDescription = $_POST['eventDescription'];
//        echo $eventName;
//        echo $eventDescription;

        require "dbConnect.php";

        $sql = "INSERT INTO wdv341_events (events_name, events_description) VALUES (:eventsName, :eventsDesc)";

        $stmt = $conn->prepare($sql);   //  prepare your PDO prepared statement

        $stmt->bindParam(':eventsName', $eventName);
        $stmt->bindParam(':eventsDesc', $eventDescription);

        $stmt->execute();
    }
    else {
        //  display the form
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
        <title>Input Event</title>
    </head>
    <body>
        <h1>WDV341 Intro PHP</h1>
        <h2>Input Event Data Into The Database</h2>

        <?php
            /*
            if(submitted the form){
                //you should display a confirmation message
            }
            else {
                see the form to get the event data
                display the form html
            }
            */

            if ($validForm) {

                ?>
                <h3>"Thank you everything worked!"</h3>

                <?php
            }
            else {

                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <p>
                        <label for="eventName">Event Name: </label>
                        <input type="text" name="eventName" id="eventName">
                    </p>

                    <p>
                        <label for="eventDescription">Event Description: </label>
                        <input type="text" name="eventDescription" id="eventDescription">
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
