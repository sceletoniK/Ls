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

        try 
        {
            $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
        } catch (PDOException $e) 
        {
            print "Error!: ".$e->getMessage();
            die();
        }

        if(isset($_REQUEST["add"]))
        {
            $stmt = $db->prepare("INSERT INTO `card` (`id`, `login`, `name`, `description`) VALUES (?, ?, ?, ?);");
            $stmt->execute([NULL,$_SESSION["login"],$_REQUEST["name"],$_REQUEST["desc"]]);
            header("location: main.php");
        }

        if(isset($_REQUEST["del"]))
        {
            $stmt = $db->prepare("DELETE FROM `card` WHERE `card`.`id` = ?");
            $stmt->execute([$_REQUEST["del"]]);
        }

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
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php
                $stmt = $db->prepare("SELECT * FROM card WHERE `login` = ?");
                $stmt->execute([$_SESSION["login"]]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                            <div class="col">
                            <div class="card shadow-sm">
                                <form style="margin: 0">
                                <div class="card-header" role="tab" id="headingOne">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <?php print($row['name']); ?>
                                        </h5>

                                        <div class="btn-group">
                                            
                                            <button type="button" class="btn btn-sm btn-outline-secondary"><a class="text-decoration-none" style="color: inherit" href="edit.php?l=<?php print($row['id']);?>">Edit</a></button>
                                            <button type="submit" name="del" value="<?php print($row['id']);?>" class="btn btn-sm btn-outline-secondary">Delete</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" style="resize: none" readonly><?php print($row['description']);?></textarea>
                                </div>
                                </form>
                            </div>
                            </div>
                    <?php
                } 
                ?>       
                <div class="col">
                <div class="card shadow-sm">
                    <form style="margin: 0" method="POST">
                        <div class="card-header" role="tab" id="headingOne">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <input type="text" name="name">
                                </h5>

                                <div class="btn-group">
                                    <button type="submit" name="add" value="new" class="btn btn-sm btn-outline-secondary">Add</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" style="resize: none;"></textarea>
                        </div>
                    </form>
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