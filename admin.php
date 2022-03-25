<?php
require("header.php");
require('connect.php');
?>
<main class="px-3">
    <table class="table table-dark px-3 mb-4 text-center w-50 mx-auto">
        <thead>
            <tr>
            <th>Категории</th>
            <th>#</th>
            </tr>
        </thead>
    <tbody id="Category_body">
    <?php
    $stmt = $db->prepare("SELECT * FROM category");
    $stmt->execute([]);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        ?>    
                <tr id="Category_<?= $row['name']; ?>">
                <th scope="row" id="name_<?= $row['name']; ?>"> <?= $row['name']; ?> </th>
                <td><button id="del_<?= $row['name'] ?>" type="button" class="btn btn-secondary" onclick="DeleteCategory('<?= $row['name']; ?>')">Удалить</button></td>
                </tr>
        <?php
    }            
        ?>
    </tbody>
    </table>

    <table class="table table-dark px-3 mb-5 text-center w-50 mx-auto"> 
        <tbody>
            <tr>
                <th class="w-50"><input type="text" id="name_adder_category" class="form-control w-75" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Название"></th>
                <td onclick="AddCategory()"><button type="button" class="btn btn-secondary">Добавить</button></td>
            </tr> 
        </tbody>
    </table>
    

    <table class="table table-dark mt-5 px-3 mb-4 text-center w-50 mx-auto">
        <thead>
            <tr>
            <th>Стадии</th>
            <th>#</th>
            </tr>
        </thead>
    <tbody id="Stage_body">
    <?php
    $stmt = $db->prepare("SELECT * FROM stage");
    $stmt->execute([]);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        ?>    
                <tr id="Stage_<?= $row['name']; ?>">
                <th scope="row" id="name_<?= $row['name']; ?>"> <?= $row['name']; ?> </th>
                <td><button id="del_<?= $row['name'] ?>" type="button" class="btn btn-secondary" onclick="DeleteStage('<?= $row['name']; ?>')">Удалить</button></td>
                </tr>
        <?php
    }            
        ?>
    </tbody>
    </table>

    <table class="table table-dark px-3 mb-4 text-center w-50 mx-auto"> 
        <tbody>
            <tr>
                <th class="w-50"><input type="text" id="name_adder_stage" class="form-control w-75" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Название"></th>
                <td onclick="AddStage()"><button type="button" class="btn btn-secondary">Добавить</button></td>
            </tr> 
        </tbody>
    </table>



    <div class="album my-5 py-3 mx-auto w-75 text-dark bg-dark border border-light rounded">
    <h3 class="text-white text-left w-25">Все карточки:</h3>
    <div class="container">
    <div id="parent_div_admin" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

    <?php
        $stmt = $db->prepare("SELECT * FROM card");
        $stmt ->execute([]);
        while($row = $stmt ->fetch(PDO::FETCH_ASSOC))
        {
            require("components/card.php");
        } 
    ?>

    </div>
    </div>
    </div>

</main>
<?php
require("footer.html");
?>