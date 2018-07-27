<!-- SĀKUMLAPAS SKATS -->

<?php
    session_start();

    // Tiek iegūti ārējie php faili
    require_once('databaseConnection.php');
    require_once('queries.php');

    if ( !isset($_SESSION["userID"])) $_SESSION["userID"] = 0;
    if ( !isset($_SESSION["testID"])) $_SESSION["testID"] = 0;
    $error_message = "";

    // Tiek pārbaudītas ievadītās vērtības
    if (isset($_POST["submit"] ))
    {
        // Ja tiek ierakstīts vārds un izvēlēts tests, tad iegūstam user id
        if ($_POST["name"] != "" && $_POST["select"] != '0')
        {
            $name = $_POST["name"];
            $test_id = $_POST["select"];

            $db = new Queries();
            $check = $db->checkUser($name);

            // Ja lietotājs vēl nepastāv datubāzē, tad izvēidojam jaunu ierakstu.
            if ( $check == '0' ) {
                $_SESSION["userID"] = $db->addUser($name);
            }
            else $_SESSION["userID"] = $check;

            $_SESSION["testID"] = $test_id;

            header('Location: ./test.php');
            exit();
        }
        // Ja nav aizpildīts viens no abiem lauciņiem tad izmet atbilstošo error_message.
        else 
        {
            $_SESSION['userID'] = 0;
            $_SESSION['testID'] = 0;

            if ($_POST["name"] == "") {
                $error_message = "Please enter your full name.";
            }
            else if($_POST["select"] == 0) {
                $error_message = "Please pick a topic.";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="lv">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Tests</title>
</head>

<body>
    <div class="container">
    <h1>Test</h1>
        <div class="form-container">
            <form class="form" name="form-main" method="post">
                <input type="text" name="name" placeholder="Enter full name"> <br>
                <select class="select" name="select">
                    <option value="0" class="center" >Topic</option>
                    <?php 

                        // Iegūstam Testu nosaukumus un to ID un ievietojam sākumlapas izvēlnē.
                        $testi = new Queries();
                        $results = $testi->getTests();

                        foreach ( $results as $result ) {
                            echo $result;
                        }
                        unset($testi);
                    ?>
                </select> <br>
                <?php echo '<p class="error-message">'.$error_message.'</p>'; ?>
                <input id="begin" type="submit" name="submit" value="Start">
            </form>
        </div>
    </div>
</body>
</html>

