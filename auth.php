<?php

    

    require("header.html");
?>
<main class="px-3">

    <div class="card text-white bg-dark mb-3 d-inline-block border-light" style="max-width: 20rem;">
        <div class="card-body">
            <form>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control rounded-4 bg-secondary text-white" placeholder="aboba" required>
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control bg-secondary text-white rounded-4" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary btn-secondary" type="submit">Sign in</button>
            </form>

            <div class="alert alert-danger d-none" role="alert">
                <strong>Опа!</strong> Неправильный логин или пароль.
            </div>
        </div>
    </div>

</main>
<?php
    require("footer.html");
?>