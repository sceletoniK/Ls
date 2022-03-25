<?php
    require('../connect.php');

    if($_POST['choice'] == "add")
    {
        $stmt = $db->prepare("INSERT INTO `category` (`name`) VALUES (?)");
        $stmt->execute([$_POST['new']]);
        echo('ok');
    }
    else if($_POST['choice'] == "del")
    {
        $stmt = $db->prepare("SELECT * FROM `card` where category = ?");
        $stmt->execute([$_POST['name']]);
        if($stmt->fetch(PDO::FETCH_ASSOC) !== null)
        {
            $stmt = $db->prepare("DELETE FROM `category` WHERE `category`.`name` = ?");
            $stmt->execute([$_POST['name']]);
            echo('ok');
        }
        else
        {
            echo("fk");
        }
    }
?>