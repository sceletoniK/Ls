<?php
    session_start();
    $l = "Вы не вошли :(";

    if(isset($_REQUEST["sub"])) 
    {
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        $l = "Приветствую, ".$_SESSION["login"]."!";

        require('connect.php');

    }
    require("header.html");
?>
<main>
    <div class="card text-white bg-dark mb-3 d-inline-block border-light" style="max-width: 20rem;">
    <div class="card-body">
        <h4 class="card-title">
            <?php print($l); ?>
        </h4>

        <?php

            if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
            {
                ?>
                    <form class="form-inline">
                        <div class="d-flex justify-content-around align-items-center">
                            <button type="submit" name="sub" value="del" class="btn btn-primary btn-secondary mb-2">Выйти</button>
                        </div>
                    </form>

                    </div>
                    </div>
                    <div class="album py-5 text-dark bg-dark">
                    <div class="container">
                    <div id="parent_div" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $stmt = $db->prepare("SELECT * FROM card WHERE `login` = ?");
                $stmt->execute([$_SESSION["login"]]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
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
                    <?php
                } 
                
                ?>       
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

                </div>
                <?php
            }
        ?>
    </div>
    </div>
</main>
<?php
    require("footer.html");
?>