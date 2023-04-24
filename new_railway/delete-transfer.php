<?php
require 'config/connect.php';
mysqli_query($connect, "DELETE from transfers 
WHERE transfers.IdRoute in 
(select rl.IdRoute
from routelist rl 
GROUP BY rl.IdRoute
HAVING COUNT(rl.IdStation) < 3);");

header('Location: transfers.php');
