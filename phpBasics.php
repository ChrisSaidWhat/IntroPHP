<?php
$assignmentName = "PHP Basics";
$yourName = "Christopher Said";

$number1 = 150;
$number2 = 350;
$total = $number1 + $number2;

$myArray = array("PHP", "HTML", "JavaScript");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2-1:PHP Basics</title>
</head>
<script>
    let myArrayJS = [];

    <?php for ($i = 0; $i < count($myArray); $i++) {
        echo "myArrayJS.push('" . addslashes($myArray[$i]) . "');\n";
    }
    //  code learned and taken from ChatGPT
    ?>

    console.log(myArrayJS);

    function displayArrayContents() {
        for (let i = 0; i < myArrayJS.length; i++) {
            document.write("<li>" + myArrayJS[i] + "</li>");
        }
    }
</script>

<body>

<?php echo "<h1>$assignmentName</h1>"; ?>
<h2>
    <?php echo $yourName ?>
</h2>
<?php echo "<h3> $number1 + $number2 = $total </h3>" ?>

<ol>
    <script>displayArrayContents()</script>
</ol>

</body>

</html>