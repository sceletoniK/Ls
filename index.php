<?php
    session_start();
    $welcome_message = "Вы не вошли :(";

    if(isset($_REQUEST["sub"])) 
    {
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        $welcome_message = "Приветствую, ".$_SESSION["login"]."!";

        require('connect.php');

    }
    require("header.html");
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
                    <div class="album py-5 text-dark bg-dark">
                    <div class="container">
                    <div id="parent_div" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $stmt = $db->prepare("SELECT * FROM card WHERE `login` = ?");
                $stmt->execute([$_SESSION["login"]]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    require("card.php");
                } 
                
                    require("addercard.php")
                ?>       
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