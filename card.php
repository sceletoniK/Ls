<div class="col" id=<?php print($row['id']);?>>
    <div class="card shadow-sm">
        <div class="card-header" role="tab" id="headingOne">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0" id="name_<?php print($row['id']) ?>">
                    <?php print($row['name']); ?>
                </h5>

                <div class="btn-group">
                                            
                    <input type="button" id="btn_ed_<?php print($row['id']); ?>" value="Edit" onclick="EditCard('<?php print($row['id']); ?>')" class="btn btn-sm btn-outline-secondary">
                    <input type="button" id="btn_de_<?php print($row['id']); ?>" value="Delete" name="del" onclick="DeleteCard('<?php print($row['id']); ?>')" class="btn btn-sm btn-outline-secondary">
                                            
                </div>
            </div>
        </div>
        <div class="card-body">
            <textarea class="form-control " id="text_<?php print($row['id'])?>" rows="3" style="resize: none" readonly><?php print($row['description']);?></textarea>
        </div>
    </div>
</div>