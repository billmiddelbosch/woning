<?php

include 'methods.php';
include 'database.php';
$pdo = connectDPO('aanbod');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["datum"])) {

    $x = 11;

    while ($x <= 15000) {
        $returnMess = getData($pdo, $x);
        list($plaats, $straat, $nummer) = explode("/", $returnMess);

        //Save adress
        addAddress($pdo, $plaats, $straat, substr($nummer, 0, 1));

        $x = $x + 4;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nieuw aanbod</title>

</head>

<body>

    <form class="form-align" method="POST">
        <div class="div-align">
            <label for="datum">Datum: </label>
            <input type="text" id="datum" name="datum">
        </div>
        <input type="submit" name="submit" value="Zoek">
    </form>


    <?php if (isset($message)) { ?>
        <h1> <?= $message ?> </h1>
    <?php } ?>


</body>

</html>