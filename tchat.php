<?php

/*Ce fichier sert à insérer les messages du tchat dans la DB et à les afficher sans devoir rafraîchir la page grâce au Jquery. Il comporte un bouton ARCHIVES qui mène vers le fichier history.php*/

//CONTROLLER
session_start();
if(!isset($_SESSION['nickname']) || empty($_SESSION['nickname'])){
    header("location:index.php");
}
require 'connectToDb.php';

if(isset($_POST['message'])){

    
    //MODEL ok
    $ar_nickname = htmlspecialchars(strip_tags(trim($_SESSION['nickname'])),ENT_QUOTES);
    $ar_message = htmlspecialchars(strip_tags(trim($_POST['message'])),ENT_QUOTES);

     

    if(!empty($ar_nickname) && !empty($ar_message)){//CONTROLLER

        $ar_sql = "INSERT INTO essaitchat (username,themessage) VALUES ('$ar_nickname','$ar_message')";//CONTROLLER ? MODEL ( à traduire en fonction)
        $ar_insert = mysqli_query($db,$ar_sql);//CONTROLLER ? MODEL
    }


}
?>

<!--VIEW-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tchat</title>
</head>
<body>
    <!--<h1>Hello <?php //echo $_SESSION['nickname'];?></h1>-->
    <h1>TCHAT</h1>
    <form action=" " method="POST">
        <textarea name="message" cols="30" rows="10" placeholder="Your message"></textarea><br/><br/>

        <input type="submit" value="Send"><br/><br/>
        <button><a href="history.php">Archives</a></button><br/><br/>

    </form>
    
    
    <div id="message">
    <?php
    $ar_sql = "SELECT * FROM essaitchat ORDER BY id DESC";//MODEL
    $ar_allmsg = mysqli_query($db,$ar_sql);//MODEL

    while ($ar_row = mysqli_fetch_assoc($ar_allmsg)){//VIEW
    ?>
    <b><?php echo $ar_row['username'];?> : </b><?php echo $ar_row['themessage'];?><br/><?php echo $ar_row['thedate'];?><br/><br/>
    <?php 
    }
    ?>
    </div>
    <a href="index.php">Retour à Index.php</a> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setInterval('load_messages()', 1500);
        function load_messages(){
            $('#message').load('load_messages.php');
        }
    </script> 
     
</body>
</html>