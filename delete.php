<?php

    require("connect.php");

    $stmt = $db->prepare("DELETE FROM `card` WHERE `card`.`id` = ?");
    $stmt->execute([$_POST['id']]);
?>