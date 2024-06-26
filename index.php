<?
session_start();
include_once("pages/functions.php");
?>
 
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW223 Travel Agency</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"  
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
 
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="nav col-sm-12 col-md-12 col-lg-12 bg-secondary py-3">
                <div class="container d-flex flex-row">
                    <?
                    include_once("pages/menu.php");
                    ?>
                </div>
            </nav>
        </div>
        <div class="row" style="min-height: 80vh">
            <section class="col-sm-12 col-md-12 col-lg-12">
                <div class="container">
                    <?
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                        switch ($page) {
                            case 1:
                                include_once("pages/home.php");
                                break;
                            case 2:
                                include_once("pages/hotels.php");
                                break;
                            case 3:
                                include_once("pages/comments.php");
                                break;
                            case 4:
                                if (!isset($_SESSION["user"])) {
                                    include_once("pages/registration.php");
                                } else {
                                    include_once("pages/not_found.php");
                                }
                                break;
                            case 5:
                                if (!isset($_SESSION["user"])) {
                                    include_once("pages/login.php");
                                } else {
                                    include_once("pages/not_found.php");
                                }
                                break;
                            case 6:
                                if (isset($_SESSION["admin"])) {
                                    include_once("pages/admin.php");
                                } else {
                                    include_once("pages/not_found.php");
                                }
                                break;
                            case 7:
                                if (isset($_SESSION["admin"])) {
                                    include_once("pages/private.php");
                                } else {
                                    include_once("pages/not_found.php");
                                }
                                break;
                            default:
                                include_once("pages/not_found.php");
                        }
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="row">
            <footer class="col-sm-12 col-md-12 col-lg-12 bg-secondary py-4">
                <div class="container">
                    2024, PW223 Corporation, &copy; All Rights Reserved.
                </div>
            </footer>
        </div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
crossorigin="anonymous"></script>
</body>
 
</html>