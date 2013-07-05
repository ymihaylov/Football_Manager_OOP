<?php
require_once "../Model/Players.php";
$player_obj = new Players;
if ($player_obj->update_player($_POST, $_FILES))
{
    header("Location: ../players.php");
}


