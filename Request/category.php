<?php

require('../connect.php');
$stmt = $db->prepare("SELECT * FROM `category`");
$stmt->execute([]);

$result = "";

while($cell = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $result .= $cell['name']."+";
} 
$result = substr($result,0,-1) . "&";


$stmt = $db->prepare("SELECT * FROM `stage`");
$stmt->execute([]);
while($cell = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $result .= $cell['name']."+";
} 

echo(substr($result,0,-1));
?>