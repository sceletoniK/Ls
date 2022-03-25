<?php
    require("header.php");

    $welcome_message = "Вы не вошли :(";
    
    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        $welcome_message = "Приветствую, ".$_SESSION["login"]."!";

        require('connect.php');
    }
    
?>
<main>
    <div class="card text-white bg-dark mb-3 d-inline-block border-light" style="max-width: 20rem;">
    <div class="card-body">
        <h4 class="card-title">
            <?php print($welcome_message); ?>
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
                <?php
                    $stmt = $db->prepare("SELECT * FROM `stage`");
                    $stmt->execute([]);
                    while($column = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        require("components/column.php");
                    }
            }
            else
            {
                ?>
                </div>
                </div>
                <?php
            }
        ?>
</main>
<?php
    require("footer.html");
?>