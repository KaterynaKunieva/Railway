<?php
require 'config/connect.php';
require 'templates/header.html';
?>
<br>
<br>
<br>
<form method="post">
  <div class="text-center">
    <button type="submit" class="btn btn-light text-dark me-2" name="active-routes">
      Кількість постійно-діючих <br> маршрутів перевезень
    </button>
  </div>
</form>
<?php
if (isset($_POST['active-routes'])) {
  $routes = mysqli_query($connect, "CALL `ActiveRoutes`();");
  $routes = mysqli_fetch_all($routes);
  echo '<br>';
  echo '<table class="table table-bordered" style = "width: 300px; margin: 0 auto">';
  echo '<tr class = "col-xxl-4">';
  foreach ($routes as $route) {
    echo '<td class = "g-3 gutters" style = "text-align:center">' . $route[0] . '</td>';
  }
  echo '</tr>';
  echo '</table>';
}
?>

<br>
<br>
<br>
<form method="post">
  <div class="text-center">
    <button type="submit" class="btn btn-light text-dark me-2" name="low-capacity">
      Кількість маршрутів з <br> навантаженням меншим за 50%
    </button>
  </div>
</form>
<?php
if (isset($_POST['low-capacity'])) {
  $capacities = mysqli_query($connect, "CALL `GetLowCapacityRoutes`();");
  $capacities = mysqli_fetch_all($capacities);
  echo '<br>';
  echo '<table class="table table-bordered" style = "width: 300px; margin: 0 auto">';
  echo '<tr class = "col-xxl-4">';
  foreach ($capacities as $capacity) {
    echo '<td class = "g-3 gutters" style = "text-align:center">' . $capacity[0] . '</td>';
  }
  echo '</tr>';
  echo '</table>';
}
?>

<br>
<br>
<br>
<form method="post">
  <div class="text-center">
    <button type="submit" class="btn btn-light text-dark me-2" name="inoutcomes">
      сума загальних витрат та сума <br> загальних грошових надходжень <br> за вказаний період.
    </button>
  </div>
</form>
<?php
if (isset($_POST['inoutcomes'])) {
  $results = mysqli_query($connect, "CALL `GetInOutcomes`();");
?>
  <br>
  <br>
  <table class="table table-bordered" style="width: 500px; margin: 0 auto">
    <tr style="text-align: center;">
      <th scope="col"> Дата </th>
      <th scope="col"> Доходи </th>
      <th scope="col"> Витрати </th>
    </tr>

  <?php
  while ($result = $results->fetch_assoc()) {
    echo '<tr class = "col-xxl-4" style="text-align: center;">';
    echo '<td class = "g-3 gutters">' . $result["Date"] . '</td>';
    echo '<td class = "g-3 gutters">' . $result["Income"] . '</td>';
    echo '<td class = "g-3 gutters">' . $result["Outcome"] . '</td>';
    echo '</tr>';
  }

  echo '</table>';
  echo '<br>';
}
  ?>