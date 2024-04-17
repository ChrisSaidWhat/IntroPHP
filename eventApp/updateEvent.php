<?php
    session_start();

    if($_SESSION["memberStatus"] == "member") {
        //  we know you are signed on and have access to this page
    }
    else {
        //  you are not a valid user
        header("Location: login.php");
    }

    //  I need all the data for a selected event displayed to the page
    //  to change it, I need that data in a form to allow me to change what was originally entered
    //  once I make changes, move those changes to the database
    //  then display the updated event OR return Display Events

    //  get the data from the database - SELECT WHERE clause
    //  put the data from the database into each of the form fields
    //  display that form to the user
    //  when the user submits the form, UPDATE the database with the input data
    //  return to Display Events

    //  form will look like the input event form, same data, same validations, same rules

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
        <p>Update Event ID: <?php echo $_GET['eventID']; ?></p>
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
    </body>
</html>
