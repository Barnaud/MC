<?php
    require __DIR__ . '/src/MinecraftQuery.php';
    require __DIR__ . '/src/MinecraftQueryException.php';

    use xPaw\MinecraftQuery;
    use xPaw\MinecraftQueryException;

    $Query = new MinecraftQuery();

    try
    {
        $Query->Connect( 'localhost', 25566 );

        $req=$Query->GetPlayers();
        if(!$req){
            echo'Désolé mais il n\'y a personne :-/';
        }
        else{
            echo'<p>Il y a actuellement '.count($req).' joueurs sur le serveur!<br>A savoir:</p><table>';
            foreach ($req as $joueur) {
                echo'<tr><td>- '. $joueur.'</td></tr>';;
            }
            echo '</table>';
        }
        
        

    }
    catch( MinecraftQueryException $e )
    {
        echo 'Le serveur semble fermé :\'(';
    }
?>