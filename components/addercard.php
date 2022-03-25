<div class="col" id="adder_card_<?= $column['name']; ?>">
    <div class="card shadow-sm">
        <div class="card-header" role="tab" id="headingOne">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="width: 70%">
                    <input type="text" name="name" id="add_name_<?= $column['name'] ?>" style="max-width: 65%">
                </h5>
                <div class="btn-group">
                    <input type="button" name="add" onclick="RequestForCard('<?= $_SESSION['login']; ?>','<?= $column['name'] ?>')" value="Add" class="btn btn-sm btn-outline-secondary">
                </div>
            </div>
        </div>
        <div class="card-body">
            <select class="form-select w-50 form-select-sm mx-auto mb-2" name="category" id="category_<?= $column['name']; ?>">
                <?php
                    $stmt2 = $db2->prepare("SELECT * FROM category");
                    $stmt2->execute([]);
                    while($cell = $stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                        ?>
                        <option value=<?= $cell['name'] ?>><?= $cell['name'] ?> </option>
                        <?php
                    } 
                ?>
            </select>
            <textarea class="form-control" name="desc" id="add_text_<?= $column['name'] ?>" rows="3" style="resize: none;"></textarea>
        </div>
    </div>
</div>