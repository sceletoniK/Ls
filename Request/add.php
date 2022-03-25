<?php

    require("../connect.php");
    $stmt = $db->prepare("INSERT INTO `card` (`id`, `login`, `name`, `description`, `category`, `stage`) VALUES (?, ?, ?, ?, ?, ?);");
    $stmt->execute([NULL,$_POST["login"],$_POST["name"],$_POST["text"], $_POST["category"], $_POST['stage']]);
    
    $stmt = $db -> prepare("SELECT max(`id`) FROM `card`");
    $stmt->execute([]);
    $row = $stmt->fetch(PDO::FETCH_NUM);
    echo($row[0]);

?>