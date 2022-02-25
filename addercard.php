<div class="col" id="adder_card">
    <div class="card shadow-sm">
        <div class="card-header" role="tab" id="headingOne">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <input type="text" name="name" id="add_name">
                </h5>
                <div class="btn-group">
                    <input type="button" name="add" onclick="RequestForCard('<?php print($_SESSION['login']); ?>')" value="Add" class="btn btn-sm btn-outline-secondary">
                </div>
            </div>
        </div>
        <div class="card-body">
            <textarea class="form-control" name="desc" id="add_text" rows="3" style="resize: none;"></textarea>
        </div>
    </div>
</div>