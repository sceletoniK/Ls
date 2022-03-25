<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Евангелион №13</title>
    <script src="script.js"></script>
</head>
<body class=" text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <h1>Работяжненький сайтег</h1>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse justify-content-md-center">
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="index.php">Main</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="reg.php">Registration</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="auth.php">Authorisation</a>
                      </li>
                      <?php
                      session_start();

                        if(isset($_REQUEST["sub"])) 
                        {
                          session_unset();
                          session_destroy();
                        }

                        if(isset($_SESSION['login']) && $_SESSION['login'] == "admin")
                        {
                          ?>
                          <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                          </li>
                          <?php
                        }
                      ?>
                    </ul>
                </div>
            </div> 
        </nav>

    </header>

    