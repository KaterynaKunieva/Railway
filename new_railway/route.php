<?php
require 'config/connect.php';
require 'templates\header.html';
$route_id = $_GET['id'];
$stations = mysqli_query($connect, "select r.Id, s.Name
from routes r
left join routelist rl on rl.IdRoute = r.Id
left join stations s on rl.IdStation = s.Id 
WHERE r.Id = $route_id;");
$stations = mysqli_fetch_all($stations);

$route = mysqli_query($connect, "select r.Id, rp.RoutePrice, re.RouteExpense, r.capacity
from routes r
left join routelist rl on rl.IdRoute = r.Id
left join routeprices rp on rp.IdRoute = r.Id 
left join routeexpenses re on re.IdRoute = r.Id
WHERE r.Id = $route_id
GROUP BY r.Id;");
$route = mysqli_fetch_assoc($route);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Маршрут</title>
</head>

<body>
  <div class="container my-5">
    <div class="bg-light p-5 rounded">
      <div class="col-sm-8 py-5 mx-auto">
        <h1 class="display-5 fw-normal">Маршрут №: <?= $route['Id'] ?></h1>
        <p class="fs-5">Станції:
          <?php
          foreach ($stations as $station) {
            echo $station[1] . ', ';
          }
          ?></p>
        <p>Ціна: <?= $route['RoutePrice'] ?> </p>
        <p>Витрати: <?= $route['RouteExpense'] ?> </p>
        <p>Максимальне навантаження: <?= $route['capacity'] ?> </p>
      </div>
    </div>
  </div>
</body>

</html>