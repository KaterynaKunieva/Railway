<?php
require '../config/connect.php';
$TransferDate = date('Y-m-d', strtotime($_POST['TransferDate']));
print(date('Y-m-d', strtotime($_POST['TransferDate'])));
$CargoType = $_POST['CargoType'];
$Route = $_POST['Route'];
mysqli_query($connect, "INSERT INTO `transfers` (`Id`, `IdCargo`, `IdRoute`, `TransferDate`) 
VALUES (NULL, '$CargoType', '$Route', '$TransferDate')");
header('Location: ../transfers.php');
