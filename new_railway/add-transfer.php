<?php
require 'config/connect.php';
require 'templates/header.html';
?>

<br>
<br>
<h3 style="text-align: center;">Додати нове перевезення</h3>
<br>
<form class="form-group" style="width: 1000px; margin: 0 auto" action="vendor/add.php" method="post">
  <div class="row">
    <div class="col">
      <label for="TransferDate">Дата</label>
      <input class="form-control" type="date" name="TransferDate">
    </div>
  </div> <br>
  <label for="CargoType">Тип вантажу</label>
  <select class="form-control" name="CargoType">
    <?php
    $types = mysqli_query($connect, "select * from cargo;");
    while ($type = $types->fetch_assoc()) {
      echo '<option value=' . $type['Id'] . '>' . $type['Type'] . '</option>';
    }
    ?>
  </select><br>
  <div class="row">
    <div class="col">
      <label for="Route">Вибір маршрута</label>
      <select class="form-control" name="Route">
        <?php
        $routes = mysqli_query($connect, "select r.Id, ss.Name as StartStation, se.Name as EndStation
        from routes r 
        left join stations ss on ss.Id = r.IdStart 
        left join stations se on se.Id = r.IdEnd");
        while ($route = $routes->fetch_assoc()) {
          echo '<option value=' . $route['Id'] . '>' . $route['StartStation'] . ' -- ' . $route['EndStation'] . '</option>';
        }
        ?>
      </select>
    </div>
  </div>
  <br><br>
  <button class="btn btn-primary" type="submit">Додати маршрут</button>
</form>