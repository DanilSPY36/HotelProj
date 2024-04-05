<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 mt-3 left">
        <!-- Страны -->
        <h3 class="text-center mb-3">Страны</h3>
        <?
        $link = connect();
        $sel = "select * from countries order by id";
        $res = $link->query($sel);
        echo "<form action='index.php?page=6' method='post'>";
        echo "<div class='form-group my-3'>";
        echo "<input type='text' class='form-control' name='country' id='country' placeholder='Введите название страны...'>";
        echo "</div>";
        echo "<button class='btn btn-outline-primary' type='submit' name='addcountry'>Сохранить</button>";

        echo "<table class='table table-striped table-hover my-3 text-center align-middle'>";
        echo "<thead><tr><th>ID</th><th>Название</th><th>Действия</th></tr></thead>";
        echo "<tbody>";
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "<td><input type='checkbox' name='cb" . $row["id"] . "' class='form-check mx-auto' /></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "<button class='btn btn-outline-danger' type='submit' name='delcountry'>Удалить</button>";
        echo "</form>";

        if (isset($_POST["addcountry"])) {
            $country = trim(htmlspecialchars($_POST["country"]));
            if ($country == "") exit();

            $ins = "insert into countries(country) values('$country')";
            $link->query($ins);
            echo "<script>document.location = document.URL</script>";
        }

        if (isset($_POST["delcountry"])) {
            foreach ($_POST as $key => $value) {
                //проверяем, что ключ относится к отмеченной стране
                if (substr($key, 0, 2) == "cb") {
                    $idc = substr($key, 2);
                    $del = "delete from countries where id='$idc'";
                    $link->query($del);
                }
            }
            echo "<script>document.location = document.URL</script>";
        }
        ?>
    </div>

    <div class="col-sm-12 col-md-6 col-lg-6 mt-3 right">
        <!-- Города -->
        <h3 class="text-center mb-3">Города</h3>
        <?
        $link = connect();

        $sel = "select * from countries order by country";
        $res = $link->query($sel);
        echo "<form action='index.php?page=6' method='post'>";
        echo "<div class='form-group my-3'>";
        echo "<select name='countryname' class='form-select'>";
        echo "<option disabled selected>Выберите страну...</option>";
        foreach ($res as $row) {
            echo "<option value='" . $row["id"] . "'>" . $row["country"] . "</option>";
        }
        echo "</select>";
        echo "</div>";
        echo "<div class='form-group my-3'>";
        echo "<input type='text' class='form-control' name='city' id='city' placeholder='Введите название города...'>";
        echo "</div>";
        echo "<button class='btn btn-outline-primary' type='submit' name='addcity'>Сохранить</button>";

        $sel = "select ci.id, ci.city, co.country from countries co, cities ci where ci.countryid=co.id order by ci.id";
        $res = $link->query($sel);
        echo "<table class='table table-striped table-hover my-3 text-center align-middle'>";
        echo "<thead><tr><th>ID</th><th>Город</th><th>Страна</th><th>Действия</th></tr></thead>";
        echo "<tbody>";
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "<td><input type='checkbox' name='ci" . $row["id"] . "' class='form-check mx-auto' /></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "<button class='btn btn-outline-danger' type='submit' name='delcity'>Удалить</button>";
        echo "</form>";

        if (isset($_POST["addcity"])) {
            $city = trim(htmlspecialchars($_POST["city"]));
            if ($city == "") exit();
            $countryid = $_POST["countryname"];
            $ins = "insert into cities(city, countryid) values('$city', '$countryid')";
            $link->query($ins);
            echo "<script>document.location = document.URL</script>";
        }

        if (isset($_POST["delcity"])) {
            foreach ($_POST as $key => $value) {
                //проверяем, что ключ относится к отмеченной стране
                if (substr($key, 0, 2) == "ci") {
                    $idcity = substr($key, 2);
                    $del = "delete from cities where id='$idcity'";
                    $link->query($del);
                }
            }
            echo "<script>document.location = document.URL</script>";
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 my-5">
        <!-- Отели -->
        <h3 class="text-center mb-3">Отели</h3>

        <?
        $link = connect();
        echo "<form action='index.php?page=6' method='post' style='position: relative;'>";
        $sel = "select ci.id as cityid, ci.city, co.id as countryid, co.country from countries co, cities ci where ci.countryid=co.id";
        $res = $link->query($sel);

        echo "<div class='form-group my-2'>";
        echo "<select name='hcity' class='form-select mb-4'>";
        echo "<option disabled selected>Выберите город...</option>";
        foreach ($res as $row) {
            echo "<option value='" . $row["cityid"] . "'>" . $row["city"] . ", " . $row["country"] . "</option>";
        }
        echo "</select>";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<label class='form-label' for='hotelname'>Название отеля: </label>";
        echo "<input type='text' class='form-control' name='hotelname' id='hotelname' />";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<label class='form-label' for='hotelinfo'>Описание отеля: </label>";
        echo "<textarea class='form-control' name='hotelinfo' id='hotelinfo' rows='3'></textarea>";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<label class='form-label' for='hotelcost'>Цена за ночь: </label>";
        echo "<input type='number' min='0' class='form-control' name='hotelcost' id='hotelcost' />";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<label class='form-label' for='hotelrate'>Рейтинг: </label>";
        echo "<input type='number' min='0' max='10' class='form-control' name='hotelrate' id='hotelrate' />";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<label class='form-label' for='hotelstars'>Звезды: </label>";
        echo "<input type='number' min='1' max='5' class='form-control' name='hotelstars' id='hotelstars' />";
        echo "</div>";

        echo "<button class='btn btn-outline-primary mt-2' type='submit' name='addhotel'>Сохранить</button>";

        $sel = "select ci.id, ci.city, ci.countryid, ho.id as hotelid, ho.hotel, ho.cityid, ho.cost, ho.rate, ho.stars, ho.info, co.id, co.country from countries co, cities ci, hotels ho where ci.countryid=co.id and ho.cityid=ci.id";
        $res = $link->query($sel);
        echo "<table class='table table-striped table-hover my-4 text-center align-middle'>";
        echo "<thead><tr><th>ID</th><th>Город</th><th>Страна</th><th>Отель</th><th>Цена</th><th>Рейтинг</th><th>Звезды</th><th>Описание</th><th>Действия</th></tr></thead>";
        echo "<tbody>";
        foreach ($res as $row) {
            echo "<tr>";
            echo "<td>" . $row["hotelid"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "<td>" . $row["hotel"] . "</td>";
            echo "<td>" . $row["cost"] . "</td>";
            echo "<td>" . $row["rate"] . "</td>";
            echo "<td>" . $row["stars"] . "</td>";
            echo "<td><button type='button' class='btn nav-link' data-bs-toggle='modal' data-bs-target='#exampleModal' data-bs-whatever='" . $row['info'] . "'>Показать описание</button></td>";
            echo "<td><input type='checkbox' name='ht" . $row["hotelid"] . "' class='form-check mx-auto' /></td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "<button class='btn btn-outline-danger' type='submit' name='delhotel'>Удалить</button>";
        echo "</form>";

        if (isset($_POST["addhotel"])) {
            $hotel = trim(htmlspecialchars($_POST["hotelname"]));
            $cost = floatval(trim(htmlspecialchars($_POST["hotelcost"])));
            $stars = intval(trim(htmlspecialchars($_POST["hotelstars"])));
            $rate = intval(trim(htmlspecialchars($_POST["hotelrate"])));
            $info = trim(htmlspecialchars($_POST["hotelinfo"]));

            if ($hotel == "" || $cost == "" || $stars == "" || $rate == "" || $info == "") exit();

            $cityid = $_POST["hcity"];

            $ins = "insert into hotels(hotel, cityid, cost, stars, rate, info) values('$hotel', '$cityid', '$cost', '$stars', '$rate', '$info')";
            $link->query($ins);

            echo "<script>document.location = document.URL</script>";
        }

        if (isset($_POST["delhotel"])) {
            foreach ($_POST as $key => $value) {
                //проверяем, что ключ относится к отмеченной стране
                if (substr($key, 0, 2) == "ht") {
                    $idhotel = substr($key, 2);
                    $del = "delete from hotels where id='$idhotel'";
                    $link->query($del);
                }
            }
            echo "<script>document.location = document.URL</script>";
        }
        ?>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-12 my-5">
        <!-- Фото отелей -->
        <h3 class="text-center mb-3">Загрузка фотографий отелей</h3>

        <?
        $link = connect();
        $sel = "select ho.id as hotelid, ho.hotel, co.country, ci.city from countries co, cities ci, hotels ho where co.id=ci.countryid and ci.id=ho.cityid order by co.country";
        $res = $link->query($sel);

        echo "<form action='index.php?page=6' method='post' enctype='multipart/form-data'>";
        echo "<div class='form-group my-2'>";
        echo "<select class='form-select' name='ihotel'>";
        echo "<option disabled selected>Выберите отель...</option>";
        foreach ($res as $row) {
            echo "<option value='" . $row["hotelid"] . "'>" . $row["hotel"] . ", " . $row["city"] . ", " . $row["country"] . "</option>";
        }
        echo "</select>";
        echo "</div>";

        echo "<div class='form-group my-2'>";
        echo "<input class='form-control' type='file' name='file[]' multiple accept='image/*'/>";
        echo "</div>";
        echo "<button class='btn btn-outline-primary mt-2' name='addimages' type='submit'>Загрузить изображения</button>";
        echo "</form>";

        if (isset($_REQUEST["addimages"])) {
            foreach ($_FILES["file"]["name"] as $key => $value) {
                if ($_FILES["file"]["error"][$key] != 0) {
                    echo "<script>alert('Ошибка загрузки файлов: " . $value . "')</script>";
                    continue;
                }
                if (move_uploaded_file($_FILES["file"]["tmp_name"][$key], "images/$value")) {
                    $ins = "insert into images(hotelid, imagepath) values('" . $_REQUEST["ihotel"] . "', 'images/$value')";
                    $link->query($ins);
                }
            }
            echo "<script>alert('Файлы успешно загружены')</script>";
        }
        ?>
    </div>


    <!-- *****************************Модальное окно****************************************** -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="info">
                    <script>
                        var exampleModal = document.getElementById('exampleModal')
                        exampleModal.addEventListener('show.bs.modal', function(event) {
                            var button = event.relatedTarget;
                            var info = button.getAttribute('data-bs-whatever');
                            var modalInfo = exampleModal.querySelector('#info');
                            modalInfo.textContent = info;
                        })
                    </script>
                    <?php
                    ?>
                </div>
            </div>
        </div>