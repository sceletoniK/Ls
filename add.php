<?php

    require("connect.php");
    $stmt = $db->prepare("INSERT INTO `card` (`id`, `login`, `name`, `description`) VALUES (?, ?, ?, ?);");
    $stmt->execute([NULL,$_POST["login"],$_POST["name"],$_POST["text"]]);
    
    $stmt = $db -> prepare("SELECT max(`id`) FROM `card`");
    $stmt->execute([]);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    echo($row[0]);

?>