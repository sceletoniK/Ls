<?php

    require("../connect.php");

    $stmt = $db->prepare("UPDATE `card` SET `name` = ?, `description` = ? WHERE `card`.`id` = ?");
    $stmt->execute([$_POST['name'],$_POST['text'],$_POST['id']]);

?>