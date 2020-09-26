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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Search</title>
</head>
<body>
    <h1>Hello <?php echo $_SESSION['nickname'];?></h1>
    <h1>SEARCH PAGE</h1>

    <div class="message">
        <?php 
            if(isset($_POST['submit-search'])){
                $ar_search = mysqli_real_escape_string($db,$_POST['search']);
                $ar_sql = "SELECT * FROM essaitchat WHERE themessage LIKE '%$ar_search%' OR username LIKE '%$ar_search%' OR thedate LIKE '%$ar_search%'";

                $ar_result = mysqli_query($db,$ar_sql);
                $ar_queryResult = mysqli_num_rows($ar_result);
                ?>

                <b><?php echo "$ar_queryResult  results found";?> : </b><br/><br/>
                <?php 
                
                if($ar_queryResult > 0){
                    while($ar_row = mysqli_fetch_assoc($ar_result)){
                        ?>
                        <b><?php echo $ar_row['username'];?> : </b><?php echo $ar_row['themessage'];?><br/><?php echo $ar_row['thedate'];?><br/><br/>
                        <?php
                    }
                }
                else{
                    echo "There are no results matching your search";
                }
            }
        ?>
    </div>
    <a href="history.php">Back to history.php</a>
</body>
</html>
