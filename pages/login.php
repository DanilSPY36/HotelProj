<h1 class="text-center my-4">Login page</h1>

<?php

if(isset($_POST["logbtn"])) {
    if(login($_POST["login"], $_POST["password1"]))
    {
        echo "<script>window.location.href='index.php?page=1'</script>"; // перезагрузка страницы при заходе на аккаунт пользователем.
    }
}
else
{
    ?>
    <form action="index.php?page=5" method="post">
        <div class="form-group my-2">
            <label for="login" class="form-label">Login: </label>
            <input type="text" name="login" id="login" class="form-control">
        </div>
        <div class="form-group my-2">
            <label for="password1" class="form-label">Password: </label>
            <input type="password" name="password1" id="password1" class="form-control">
        </div>
        <button type="submit" class="btn btn-outline-primary my-2" name="logbtn">Зарегистрироваться</button>
    </form>
    <a href="index.php?page=5" class="nav-link text-center my-3">Нет учетной записи?</a>
    <?php
}


?>