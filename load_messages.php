<?php

//Ce fichier est appelé par le code Jquery du fichier tchat.php

require 'connectToDB.php';

    $ar_sql = "SELECT * FROM essaitchat ORDER BY id DESC"; //MODEL
    $ar_allmsg = mysqli_query($db,$ar_sql);//MODEL

    while ($ar_msg = mysqli_fetch_assoc($ar_allmsg)){//VIEW
?>
    <b><?php echo $ar_msg['username'];?> : </b><?php echo $ar_msg['themessage'];?><br/><?php echo $ar_msg['thedate'];?><br/><br/>
<?php 
    }
?>