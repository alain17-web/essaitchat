<?php

/*Ce fichier sert à afficher l'historique des messages. C'est ici qu'il faudra ajouter la pagination. Par défaut, il affiche tous les messages. En rentrant un mot ou une date dans le champ "Search", on est dirigé vers le fichier search.php où on peut retrouver tous les messages qui comportent ce mot ou cette date. */

session_start();//démarrage de la session
if(!isset($_SESSION['nickname']) || empty($_SESSION['nickname'])){
    header("location:index.php");
}/*Un utilisateur ne peut accéder à ce fichier que s'il a rentré un login, sinon il est redirigé vers index.php*/

require 'connectToDb.php';//connection à la DB

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

    <!--Création du formulaire avec le champ "Search"-->
    <form action="search.php" method="GET">
        <input type="search" name="search" id="submit-search" value="" placeholder="Type a keyword">
        <button type="submit" id="submit-search" name="submit-search">Search</button>
    </form>
    <hr/>
    <h2>All messages :</h2><br/><br/>
    <div id="message">
    <?php
    $ar_sql = "SELECT * FROM essaitchat ORDER BY id DESC";/*Requête SQL pour récupérer tous les messages dans la DB. Il faudra ajouter une LIM et une pagination.*/

    $ar_result = mysqli_query($db,$ar_sql);

    while ($ar_row = mysqli_fetch_assoc($ar_result)){
    ?>
    <b><?php echo $ar_row['username'];?> : </b><?php echo $ar_row['themessage'];?><br/><?php echo $ar_row['thedate'];?><br/><br/><!--Affichage des messages-->
    <?php 
    }
    ?>
    </div>
    <a href="index.php">Retour à Index.php</a>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--<script>
        $(document).ready(function(){
            $('#submit-search').keyup(function(){
                $('#message').html();

                var ar_keyword = $(this).val();

                if(ar_keyword !=""){
                    $.ajax({
                        type: 'GET',
                        url: 'search.php',
                        data: 'keyword=' + encodeURIComponent(ar_keyword),
                        success:function(data){
                            if(data !=""){
                                $('#message').append(data);
                            }
                            else{
                                alert('No results found');
                            }
                        }
                        
                    });
                }
                
            });
        });
    
    </script>-->
    
</body>
</html>