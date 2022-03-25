<div class="album my-5 py-3 mx-auto w-75 text-dark bg-dark border border-light rounded">
<h3 class="text-white text-left w-25"><?= $column['name'] ?></h3>
<div class="container">
<div id="parent_div_<?= $column['name'] ?>" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

<?php
    require('extra_connect.php');
    $stmt2 = $db2->prepare("SELECT * FROM card WHERE `login` = ? AND `stage` = ?");
    $stmt2 ->execute([$_SESSION["login"], $column['name']]);
    while($row = $stmt2 ->fetch(PDO::FETCH_ASSOC))
    {
        require("card.php");
    } 

    require("addercard.php");
?>

</div>
</div>
</div>