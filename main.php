<?php

    $l = "Вы не вошли :(";
    session_start();

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        $l = "Приветствую, ".$_SESSION["login"]."!";
    }

    require("header.html");
?>
<main class="px-3">
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
                        <button type="submit" value="del" class="btn btn-primary btn-secondary mb-2">Выйти</button>
                    </form>
                <?php
            }
        ?>
    </div>
    </div>
</main>
<?php
    require("footer.html");
?>