<?php 
session_start();
if(!isset($_SESSION['nickname']) || empty($_SESSION['nickname'])){
    header("location:index.php");
}
require 'connectToDb.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archives</title>
</head>
<body>
    <h1>Hello <?php echo $_SESSION['nickname'];?></h1>
    <h1>ARCHIVES</h1>
    <form action="search.php" method="POST">
        <input type="text" name="search" placeholder="Keyword">
        <button type="submit" name="submit-search">Search</button>
    </form>
    <hr/>
    <h2>All messages :</h2><br/><br/>
    <div class="message">
    <?php
    $ar_sql = "SELECT * FROM essaitchat ORDER BY id DESC";
    $ar_result = mysqli_query($db,$ar_sql);

    while ($ar_row = mysqli_fetch_assoc($ar_result)){
    ?>
    <b><?php echo $ar_row['username'];?> : </b><?php echo $ar_row['themessage'];?><br/><?php echo $ar_row['thedate'];?><br/><br/>
    <?php 
    }
    ?>
    </div>
    <a href="index.php">Retour à Index.php</a>
    
    
</body>
</html>