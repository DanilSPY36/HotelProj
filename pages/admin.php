<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 left">
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

    <div class="col-sm-6 col-md-6 col-lg-6 right">
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
        $res = $link -> query($sel);
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
            $link -> query($ins);
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
</div>