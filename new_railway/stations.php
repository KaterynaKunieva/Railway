<?php
require 'config/connect.php';
require 'templates/header.html';
?>

<body>

  <br>
  <table class="table" style="width: 1000px; margin: 0 auto">
    <tr>
      <th scope="col"> # </th>
      <th scope="col"> Назва </th>
      <th scope="col"> Тип </th>
    </tr>
    <?php
    $stations = mysqli_query($connect, "SELECT * FROM `stations`");
    $stations = mysqli_fetch_all($stations);
    foreach ($stations as $station) {
    ?>
      <tr>
        <th scope="row" class="col-xxl-4"><?= $station[0] ?></th>
        <td class="col-xxl-4"><?= $station[1] ?></td>
        <td class="col-xxl-4"><?= $station[2] ?></td>
        <!-- <td><a href="update.php?id=<?= $route[0] ?>">Update</a></td>
        <td><a style="color: red" href="vendor/delete.php?id=<?= $route[0] ?>">Delete</a></td>
        <td><a href="product.php?id=<?= $route[0] ?>">View</a></td> -->
      </tr>
    <?php
    }
    ?>
  </table>
  <br>
  <br>

  <h5 style="width: 1000px; margin: 0 auto">Станції, через які в день в середньому проходить більше 10 товарних потягів з вантажами хімічної промисловості</h5>
  <br>
  <table class="table" style="width: 1000px; margin: 0 auto">
    <tr>
      <th scope="col"> # </th>
      <th scope="col"> Назва </th>
      <th scope="col"> Кількість </th>
    </tr>
    <?php
    $stations = mysqli_query($connect, "SELECT rl.IdStation, s.Name, count(rl.IdStation)
    from transfers t 
    left join cargo c on t.IdCargo = c.Id 
    left join routelist rl on t.IdRoute = rl.IdRoute
    left join stations s on rl.IdStation = s.Id
    WHERE c.Type = 'Хімічна промисловість' 
    GROUP BY rl.IdStation
    HAVING count(rl.IdStation) > 10;");
    $stations = mysqli_fetch_all($stations);
    foreach ($stations as $station) {
    ?>
      <tr>
        <th scope="row" class="col-xxl-4"><?= $station[0] ?></th>
        <td class="col-xxl-4"><?= $station[1] ?></td>
        <td class="col-xxl-4"><?= $station[2] ?></td>
      </tr>
    <?php
    }
    ?>
  </table>
  <br>
  <br>
  <br>
</body>

</html>