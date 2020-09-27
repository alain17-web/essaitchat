<?php 

/*Ce fichier sert à effectuer une recherche par mot-clé et à afficher les résultats. On peut aussi y ajouter une pagination*/
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
    <style>span.surlign1{font-style:italic;background-color:yellow;}</style>
    <title>Search</title>
</head>
<body>
    <h1>Hello <?php echo $_SESSION['nickname'];?></h1>
    <h1>SEARCH PAGE</h1>

    <div class="message">
        <?php 
            if(isset($_GET['submit-search'])){
                $ar_search = mysqli_real_escape_string($db,$_GET['search']);

                

                $ar_sql = "SELECT * FROM essaitchat WHERE themessage LIKE '%$ar_search%' OR username LIKE '%$ar_search%' OR thedate LIKE '%$ar_search%'";

                
                $ar_result = mysqli_query($db,$ar_sql);

                function highlightWords($ar_text, $ar_search){
                    $ar_text = preg_replace('#'. preg_quote($ar_search) .'#i', '<span style="background-color: #F9F902;">\\0</span>', $ar_text);
                    return $ar_text;
                    
                }
                $ar_queryResult = mysqli_num_rows($ar_result);
                ?>

                <b><?php echo "$ar_queryResult  results found";?> : </b><br/><br/>
                <?php 

                
                
                if($ar_queryResult > 0){
                    while($ar_row = mysqli_fetch_assoc($ar_result)){
                        $ar_user = !empty($ar_search)?highlightWords($ar_row['username'],$ar_search):$ar_row['username'];
                        $ar_message = !empty($ar_search)?highlightWords($ar_row['themessage'],$ar_search):$ar_row['themessage'];
                        $ar_date = !empty($ar_search)?highlightWords($ar_row['thedate'],$ar_search):$ar_row['thedate'];


                        
                        ?>
                        <b><?php echo $ar_user;?> : </b><?php echo $ar_message;?><br/><?php echo $ar_date;?><br/><br/>
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
