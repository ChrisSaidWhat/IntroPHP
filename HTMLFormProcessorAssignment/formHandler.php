<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Submission Received</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');

        body {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: .5fr 1fr .5fr;
            font-family: "Roboto Slab", serif;
            background-color: #003DA7;
            color: #FFFFFF;
            align-content: center;
            height: 100vh;
            margin: 0px;
        }

        h1 {
            font-size: xxx-large;
            text-align: center;
            grid-row: 1/2;
        }

        main {
            display: grid;
            grid-template-rows: 1fr;
            justify-content: center;
            grid-row: 2/3
        }

        .part1 {
            grid-column: 1/2;
            grid-row: 1/3;
            font-size: 1.2rem;
        }

        section {
            grid-column: 1/2;
            grid-row: 2/3;
            max-width: 70ch;
            border: #FFFFFF 2px solid;
            border-radius: 20px;
            padding: 50px;
        }

        section > div {
            margin-left: 50px;
        }

        .comments {
            background-color: #44C6E7;
            border-radius: 20px;
            padding: 10px;
            border: #FFFFFF 2px solid;
        }

        .part2 {
            font-size: 1.2rem;
        }

        .logoContainer {
            text-align: center;
            margin-top: 32px;
            grid-row: 3/4;
        }

        .logo {
            width: 10%;
        }

    </style>
</head>

<body>
    <?php
        $firstName = $_POST["first_name"];
        $lastName = $_POST["last_name"];
        $schoolName = $_POST["school_name"];
        $customerEmail = $_POST["customer_email"];
        $academicStanding = $_POST["academic_standing"];
        $selectProgram = $_POST["selectProgram"];
        $sendProgramInfo = $_POST["sendProgramInfo"];
        $contactProgramAdvisor = $_POST["contactProgramAdvisor"];
        $userComments = $_POST["userComments"];
    ?>

    <h1>Submission Received!</h1>
    <main>

        <section>
            <p class="part1">Dear <?php echo $firstName ?>,</p>
            <div>
                <p>Thank you for your interest in <?php echo $schoolName ?>.
                   We have you listed as a(n) <?php echo $academicStanding ?> starting this fall.
                   You have declared <?php echo $selectProgram ?> as your major.</p>
                <p>Based upon your responses we will provide the following information in our confirmation email to you
                   at <?php echo $customerEmail ?></p>
                <ul>
                    <li><?php echo $sendProgramInfo ?></li>
                    <li><?php echo $contactProgramAdvisor ?></li>
                </ul>
                <p>You have shared the following comments which we will review: </p>
                <p class="comments"><?php echo $userComments ?></p>
                <p>We look forward to getting to know you!</p>
            </div>
            <p class="part2">DMACC Admissions</p>
        </section>

    </main>
    <div class="logoContainer">
        <img class="logo" src="dmaccLogo.png" alt="DMACC logo">
    </div>
</body>
</html>