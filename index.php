<?php 
if(!empty($_POST) && isset($_POST['nickname']) && !empty($_POST['nickname'])){
    session_start();
    $_SESSION['nickname'] = $_POST['nickname'];
    header("location:tchat.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
    <form action="" method="POST">

        <input type="text" name="nickname" placeholder="Your nickname" ><br/><br/>
        
        <input type="submit" value="Go chat">
    </form>


</body>
</html>
