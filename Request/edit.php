<?php

    require("../connect.php");

    $stmt = $db->prepare("UPDATE `card` SET `name` = ?, `description` = ?, `category` = ?, `stage` = ? WHERE `card`.`id` = ?");
    $stmt->execute([$_POST['name'],$_POST['text'],$_POST['category'],$_POST['stage'],$_POST['id']]);
?>