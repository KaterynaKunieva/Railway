<?php
require 'config/connect.php';
require 'templates/header.html';
?>

<body>

  <br>
  <table class="table" style="width: 1000px; margin: 0 auto">
    <tr>
      <th scope="col"> # </th>
      <th scope="col"> Початкова станція </th>
      <th scope="col"> Кінцева станція </th>
      <th scope="col"> Вартість </th>
      <th scope="col"> Детально </th>
    </tr>
    <?php
    $routes = mysqli_query($connect, "select r.Id, ss.Name, se.Name, rp.RoutePrice
    from routes r 
    right join stations ss on r.IdStart = ss.Id 
    RIGHT JOIN stations se on r.IdEnd = se.Id 
    right join routeprices rp on rp.IdRoute = r.Id
    ORDER BY r.Id;");
    $routes = mysqli_fetch_all($routes);
    foreach ($routes as $route) {
    ?>
      <tr>
        <th scope="row" class="col-xxl-4"><?= $route[0] ?></th>
        <td class="col-xxl-4"><?= $route[1] ?></td>
        <td class="col-xxl-4"><?= $route[2] ?></td>
        <td class="col-xxl-4"><?= $route[3] ?></td>
        <td><a href="route.php?id=<?= $route[0] ?>"> Переглянути </a></td>
      </tr>
    <?php
    }
    ?>
  </table>
  <br>
  <br>
  <div class="text-center">
    <a href="reduce-price.php">
      <button type="button" class="btn btn-light text-dark me-2">
        Зменшити вартість
      </button>
    </a>
  </div>
  <br> <br>
</body>

</html>