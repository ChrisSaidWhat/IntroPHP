<?php
    session_start();    //  usually the first command on a page

    $display = "";
    $errMsg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inUsername = $_POST['inUsername'];
        $inPassword = $_POST['inPassword'];

        require "dbConnect.php";

        $sql = "SELECT COUNT(*) event_user_name, event_user_password FROM wdv341_event_user_table WHERE event_user_name = :user AND event_user_password = :password";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user', $inUsername);
        $stmt->bindParam(':password', $inPassword);

        $stmt->execute();

        $rowCount = $stmt->fetchColumn();   //  get the number of rows located by the query

        if ($rowCount == 1) {
            $display = "admin";
            //  display the admin page content
            //  AT THIS POINT WE KNOW THIS IS A VALID USER
            //  ALLOW THEM TO SEE ALL PAGES
            $_SESSION["memberStatus"] = "member";
        }
        else {
            $display = "error";
            $errMsg = "Invalid Username or Password";
            //  display form
        }

        //  Did I find 1 or more valid rows for this username/password
        //  if valid display the admin page
        //  else display error message
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
        <h1>Login Page</h1>

        <?php
            if ($display == "admin") {
                //  admin content
                ?>
                <h3>Admin Page</h3>
                <ol>
                    <li><a href="inputEvent.php">Insert New Events</a></li>
                    <li><a href="selectEvents.php">Events</a></li>
                </ol>
                <p><a href="logout.php">Log Out</a></p>
                <?php
            }
            else {
                // display form and error message

                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <p class="errMsg"><?php echo $errMsg; ?></p>

                    <p>
                        <label for="inUsername">Username: </label>
                        <input type="text" id="inUsername" name="inUsername">
                    </p>

                    <p>
                        <label for="inPassword">Password: </label>
                        <input type="password" id="inPassword" name="inPassword">
                    </p>

                    <p>
                        <input type="submit" name="submit">
                        <input type="reset">
                    </p>
                </form>
                <?php
            }
        ?>
    </body>
</html>