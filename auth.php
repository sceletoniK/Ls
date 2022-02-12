<?php

    $l = "d-none";

    if(isset($_REQUEST["login"]) && isset($_REQUEST["password"]))
    {
        
        try 
        {
            $db = new PDO('mysql:host=localhost;dbname=users', 'root', '');
        } catch (PDOException $e) 
        {
            print "Error!: " . $e->getMessage();
            die();
        }

        $stmt = $db->prepare("SELECT * FROM user WHERE `login` = ?");
        $stmt->execute([$_REQUEST["login"]]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null)
        {
            if($_REQUEST["password"] == $row["password"])
            {
                session_start();
                $_SESSION["login"] = $row["login"];
                $_SESSION["password"] = $row["password"];
                Header("Location: main.php");
            }
        }
        $l = "";
    }

    require("header.html");
?>
<main class="px-3">

    <div class="card text-white bg-dark mb-3 d-inline-block border-light" style="max-width: 20rem;">
    <div class="card-header border-light"> <h4 class="card-title">Authorisation</h4></div>
        <div class="card-body">
            <form>
                <div class="form-floating mb-3">
                    <input type="text" name="login" class="form-control rounded-4 bg-secondary text-white" placeholder="aboba" required value="<?php  
                        if(isset($_REQUEST["login"])) print($_REQUEST["login"]);
                    ?>">
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" name="password" class="form-control bg-secondary text-white rounded-4" placeholder="Password" required value="<?php  
                        if(isset($_REQUEST["password"])) print($_REQUEST["password"]);
                    ?>">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary btn-secondary" type="submit">Sign in</button>
            </form>

            <div class="alert alert-danger <?php print($l); ?>" role="alert">
                <strong>Опа!</strong> Неправильный логин или пароль.
            </div>
        </div>
    </div>

</main>
<?php
    require("footer.html");
?>