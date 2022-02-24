<?php

    session_start();

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]))
    {
        require('connect.php');

        if(isset($_REQUEST["add"]))
        {

            $stmt = $db->prepare("SELECT * FROM card WHERE `id` = ?");
            $stmt->execute([$_REQUEST["l"]]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if($_REQUEST["name"] == "") $_REQUEST["name"] = $row["name"];
            if($_REQUEST["desc"] == "") $_REQUEST["desc"] = $row["description"];

            $stmt = $db->prepare("UPDATE `card` SET `name` = ?, `description` = ? WHERE `card`.`id` = ?;");
            $stmt->execute([$_REQUEST["name"],$_REQUEST["desc"],$_REQUEST["l"]]);
            header("location: index.php");
        }

        $stmt = $db->prepare("SELECT * FROM card WHERE `id` = ?");
        $stmt->execute([$_GET['l']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    else
    {
        die($_SESSION["login"]);
        header("location: index.php");
    }
    require("header.html");
?>
<main>

    <div class="album py-5 text-dark bg-dark">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center">

            <div class="col">
                <div class="card shadow-sm">
                    <form style="margin: 0" method="POST">
                        <div class="card-header" role="tab" id="headingOne">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <input class="form-control" type="text" name="name" placeholder="<?php print($row["name"]); ?>">

                                    <input type="text" name="l" class="d-none" value="<?php print($_GET['l']); ?>">

                                </h5>

                                <div class="btn-group">
                                    <button type="submit" name="add" value="new" class="btn btn-sm btn-outline-secondary">Confirm</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"><a class="text-decoration-none" style="color: inherit" href="main.php">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" style="resize: none;" placeholder="<?php print($row["description"]); ?>"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            </div>
        </div>
    </div>
                   
</main>
<?php
    require("footer.html");
?>