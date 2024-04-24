<?php

    $errMsg = "";   //  set a default value to this variable

    $recId = $_GET['eventID'];

    if (isset($_POST['submit'])) {
        //  if the submit button has been sent to the server then the user SUBMITTED the form for processing
        //  echo "<h1>Form has been submitted</h1>";
        $display = "confirmation";

        $validForm = true;  //  assume the form data is all good

        $eventName = $_POST['eventName'];       //  get form data into PHP
        $eventDesc = $_POST['eventDesc'];

        //  validation
        //  eventName cannot be blank
        if(empty(trim($eventName))) {
            //  bad data -- invalid form -> display err msg and show form
            $validForm = false;
            $errMsg = "Event name cannot be empty";
            $display = "form";
        }

        if(empty(trim($eventDesc))) {
            //  bad data -- invalid form -> display err msg and show form
            $validForm = false;
            $errMsgDesc = "Event description cannot be empty";
            $display = "form";
        }

        //  if the form data is VALID then UPDATE the database

        if ($validForm) {
            //  update the database
            try {
                require "dbConnect.php";

                $sql = "UPDATE wdv341_events SET events_name = :eventName, events_description = :eventDesc WHERE events_id = :eventID";

                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':eventName', $eventName);
                $stmt->bindParam(':eventDesc', $eventDesc);
                $stmt->bindParam(':eventID', $recId);

                $stmt->execute();

                $display = "confirmation";  //  will display the confirmation msg
            }
            catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    else {
        //  SELECT the data from the database
        //  show the database content on the form
        //  display the form
        $display = "form";

        try {
            require "dbConnect.php";

            $sql = "SELECT events_id, events_name, events_description FROM wdv341_events WHERE events_id = :eventID";

            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':eventID', $recId);

            $stmt->execute();

            //  process the selected data into the form fields
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $row = $stmt->fetch();
        }
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
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
        <h1>WDV341 Intro PHP</h1>
        <h2>UPDATE Event Information</h2>

        <?php
            if ($display == "form") {
                //  display form
                ?>
                <div
                        class="updateForm"
                >
                    <form
                            method="post"
                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?eventID=' . $recId; ?>"
                    >
                        <p>
                            <label
                                    for="eventName"
                            >
                                Event Name:
                            </label>
                            <input
                                    type="text"
                                    size="40"
                                    name="eventName"
                                    id="eventName"
                                    value="<?php
                                        //  if you display the form then echo form data into the value
                                        //  else display the value submitted on the form (err)
                                        if(isset($row['events_name'])) {
                                            echo $row['events_name'];
                                        }
                                        if(isset($eventName)) {
                                            //  this is input from the submitted form -- need to put back on the form
                                            echo $eventName;
                                        }
                                        ?>"
                            >
                            <span
                                    class="errMsg"
                            >
                                <?php  echo $errMsg; ?>
                            </span>
                        </p>

                        <p>
                            <label
                                for="eventDesc"
                            >
                                Event Description:
                            </label>
                            <input
                                type="text"
                                name="eventDesc"
                                id="eventDesc"
                                size="100"
                                value="<?php
                                    //  if you display the form then echo form data into the value
                                    //  else display the value submitted on the form (err)
                                    if(isset($row['events_description'])) {
                                        echo $row['events_description'];
                                    }
                                    if(isset($eventDesc)) {
                                        //  this is input from the submitted form -- need to put back on the form
                                        echo $eventDesc;
                                    }
                                ?>"
                            >
                            <span
                                    class="errMsg"
                            >
                                <?php
                                   if(isset($errMsgDesc)) {
                                       echo $errMsgDesc;
                                   };
                                    ?>
                            </span>
                        </p>

                        <p>
                            <input
                                    type="submit"
                                    name="submit"
                                    value="Update Event"
                            >
                            <input
                                    type="reset"
                            >
                        </p>

                    </form>
                </div>
                <?php
            }
            else {
                //  display confirmation
                ?>
                <div
                        class="confirmationMessage"
                >
                    <h1>Update Successful</h1>
                    <p>
                        <a
                            href="selectEvents.php"
                        >
                            Return to Select
                        </a>
                    </p>
                </div>
                <?php
            }
        ?>

    </body>
</html>
