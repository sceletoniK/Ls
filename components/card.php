<div class="col" id=<?= $row['id'];?>>
    <div class="card shadow-sm">
        <div class="card-header" role="tab" id="headingOne">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" style="width: 70%" id="name_<?= $row['id']; ?>">
                    <?= $row['name']; ?>
                </h5>

                <div class="btn-group">
                                            
                    <input type="button" id="btn_ed_<?= $row['id']; ?>" value="Edit" onclick="EditCard('<?= $row['id']; ?>','<?= $column['name'] ?>')" class="btn btn-sm btn-outline-secondary">
                    <input type="button" id="btn_de_<?= $row['id']; ?>" value="Delete" name="del" onclick="DeleteCard('<?= $row['id']; ?>')" class="btn btn-sm btn-outline-secondary">
                                            
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="category_area_<?= $row['id'];?>" class="d-flex justify-content-center">
                <p id="category_<?= $row['id']?>"><?= $row['category'] ?></p>
            </div>
            <textarea class="form-control " id="text_<?= $row['id'];?>" rows="3" style="resize: none" readonly><?= $row['description'];?></textarea>
        </div>
    </div>
</div>