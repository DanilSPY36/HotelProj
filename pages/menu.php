<a class="nav-link text-light" href="index.php?page=1">Home</a>
<a class="nav-link text-light" href="index.php?page=2">Hotels</a>
<a class="nav-link text-light" href="index.php?page=3">Comments</a>

<?php
if(!isset($_SESSION["user"]))
{?>
<a class="nav-link text-light" href="index.php?page=4">Registration</a>
<a class="nav-link text-light" href="index.php?page=5">Login</a>
<?php}
if(!isset($_SESSION["user"]))
{?>
<a class="nav-link text-light" href="index.php?page=6">Admin</a>
<a class="nav-link text-light" href="index.php?page=7">Private</a>
<?php}?>


<?
if (isset($_SESSION["user"])) {
    echo "<form class='d-flex ms-auto' action='index.php";
    if (isset($_GET["page"])) echo "?page=" . $_GET["page"];
    echo "' method='post'>";
    echo "<a class='nav-link text-light fw-bold'>Привет, " . $_SESSION["user"] . "</a>";
    echo "<button type='submit' class='btn btn-outline-danger ms-2' name='exit'>Выйти</button>";
    echo "</form>";
}
if (isset($_POST["exit"])) {
    unset($_SESSION["user"]);
    unset($_SESSION["admin"]);
    echo "<script>window.location = 'index.php?page=5'</script>";
}
?>