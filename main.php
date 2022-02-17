<?php

    $l = "Вы не вошли :(";
    session_start();

    if(isset($_REQUEST["sub"])) 
    {
        session_unset();
        session_destroy();
    }

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        $l = "Приветствую, ".$_SESSION["login"]."!";
    }


    require("header.html");
?>
<main >
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
                            <button type="submit" name="add" value="new" class="btn btn-primary btn-secondary mb-2">Добавить</button>
                        </div>
                    </form>

                    </div>
                    </div>
                    <div class="album py-5 text-dark bg-dark">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                            
                            <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-header" role="tab" id="headingOne">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            Aboba
                                        </h5>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" style="resize: none;" readonly></textarea>
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