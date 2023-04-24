<?php
require 'config/connect.php';
require 'templates/header.html';
?>

<body>

  <br>
  <table class="table" style="width: 1000px; margin: 0 auto">
    <tr>
      <th scope="col"> # </th>
      <th scope="col"> Дата </th>
      <th scope="col"> Маршрут </th>
      <th scope="col"> Тип вантажу </th>
    </tr>
    <?php
    $routes = mysqli_query($connect, "select t.Id, t.IdRoute, c.Type, t.TransferDate
    from transfers t 
    left join cargo c on t.IdCargo = c.Id
    left join routes r on t.IdRoute = r.Id;");
    $routes = mysqli_fetch_all($routes);
    foreach ($routes as $route) {
    ?>
      <tr>
        <th scope="row" class="col-xxl-4"><?= $route[0] ?></th>
        <td class="col-xxl-4"><?= $route[3] ?></td>
        <td class="col-xxl-4"><?= $route[1] ?></td>
        <td class="col-xxl-4"><?= $route[2] ?></td>
      </tr>
    <?php
    }
    ?>
  </table>
  <br>
  <br>
  <br>
  <div class="text-center">
    <a href="add-transfer.php">
      <button type="button" class="btn btn-light text-dark me-2">
        Додати перевезення
      </button>
    </a> <br> <br>
    <a href="delete-transfer.php">
      <button type="button" class="btn btn-light text-dark me-2">
        Видалити перевезення, що не мають додаткових станцій
      </button>
    </a><br> <br>

  </div>
</body>

</html>