<?php
require 'config/connect.php';
mysqli_query($connect, "UPDATE RoutePrices rp 
SET rp.RoutePrice = rp.RoutePrice*0.85 
WHERE rp.IdRoute in 
( SELECT rp.IdRoute 
from routeprices rp 
WHERE rp.IdRoute in ( 
    select rl.IdRoute 
    from routelist rl 
    left join stations s on rl.IdStation = s.Id
    WHERE s.stop = 1
    GROUP BY rl.IdRoute 
    HAVING COUNT(rl.IdRoute)<3));");

header('Location: routes.php');
