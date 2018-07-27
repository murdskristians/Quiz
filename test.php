<!-- TESTA JAUTĀJUMU SKATS -->

<?php
    session_start();
    
    


    // Tiek iegūti ārējie php faili
    require_once('databaseConnection.php');
    require_once('queries.php');

    //Pārbauda vai ir testa id un user id, kas nepieciešams testa izpildei.
    if (isset($_SESSION['userID']) && isset($_SESSION['testID']))
    {
        $user_id = $_SESSION['userID'];
        $test_id = $_SESSION['testID'];
        if (!(isset($_SESSION['counter'])))
        {
            $_SESSION['counter']=0;
        }
        else{
            
            $_SESSION['counter']++;
        }

    }

    // Ja kādā veidā nav testa id vai user id, tad atgriež atpakaļ uz sākumu.
    else 
    {
        unset($_SESSION['userID']);
        session_destroy();
        header("Location: ./index.php");
        exit();
    }

    // Izveido queries objektu, lai izvadītu lietotājvārdu.
    $db = new Queries();
    $questions = $db->getQuestions($test_id);
    echo "Lietotāja vārds = " .$db->getUserName($user_id). "<br>";
?>


<!DOCTYPE html>
<html lang="lv">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tests "<?php echo $db->testName($test_id); ?>"</title>
    
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <link rel="stylesheet" type="text/css" href="main.css">

    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $("#button").click(function() {
                $("#question").load("/test.php", {
                   
                }, function() {
                    
                })
            })
        })
    </script>
</head>

<body >
    <div class="container">
        <div id="q-div" class="question">
            <form method="post" action="" ><fieldset>
                <?php
                    $servername = "localhost";
                    $username = "draugiemgroup";
                    $password = "securepassword";
                    $dbname = "draugiemgroup";

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    $conn->set_charset('utf8mb4');
                    $sql = "SELECT * FROM questions WHERE test_id=".$_SESSION['testID'];
                    $result = $conn->query($sql);
                    $total = 0;
                    $q=Array();


                     $qId=Array();

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $qId[$total] = $row["id"];
                            $q[$total] =  $row["text"];

                            $total++;
                        }
                        if($_SESSION['counter']==$total-1)
                        {
                            session_destroy();
                            session_start();
                            $_SESSION['counter']=0;
                            $_SESSION['total']=$total;
                            header("Location: ./finish.php");
                        }
                        echo  "<legend>".$q[$_SESSION['counter']]."</legend><br>";
                    } else {
                        echo "0 results";
                    }

                    $sql = "SELECT * FROM answers WHERE question_id= ".$qId[$_SESSION['counter']];
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<input type="radio" name="answer" value="'.$row["is_correct"].'"><span class="answer">&emsp;'.$row["text"].'</span></input><br>';
                        }

                    } else {
                        echo "0 results";
                    }


                    $conn->close();
                ?>

        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar"
            aria-valuenow=<?php echo $_SESSION['counter']; ?> aria-valuemin="0" aria-valuemax=<?php echo $total; ?> style="width:40%">
            <?php echo ($_SESSION['counter']/$total*100)."%" ; ?>
            </div>
        </div>
        <button type="submit" id="button" class="button" onclick="nextQuestion()">Nākamais Jautājums</button>
        
        <!-- Pagaidu poga nokļūšanai uz sākuma lapu. Alternatīva ir refrešot lapu. -->
        <button class="button button-back" onclick="window.location.href='index.php'">Back</button>
        </fieldset></form>
    </div>
</body>
</html>
