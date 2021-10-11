<?php

$gradovi = ['Tirana', 'Andorra la Vella', "Vienna", "Minsk", "Brussels", "Sarajevo", "Sofia", "Zagreb", "Prague", "Copenhagen", "Tallinn",
            "Helsinki", "Paris", "Berlin", "Athens", "Budapest", "Reykjavik", "Dublin", "Rome", "Riga", "Vaduz", "Vilnius", "Luxembourg", "Valletta",
            "Chisinau", "Monaco", "Podgorica", "Amsterdam Haag", "Skopje", "Oslo", "Warsaw", "Lisbon", "Bucharest", "Moscow", "San Marino", "Belgrade",
            "Bratislava", "Ljubljana", "Madrid", "Stockholm", "Bern", "Kiev", "London"];

$sql = "INSERT INTO cities(city_name) VALUES";

foreach ($gradovi as $grad) {
$sql .= "($grad),";
}

echo $sql;
?>

<!-- INSERT INTO city(city_name) VALUES('Tirana'),('Andorra la Vella'),('Vienna'),('Minsk'),('Brussels'),('Sarajevo'),('Sofia'),('Zagreb'),('Prague'),('Copenhagen'),('Tallinn'),('Helsinki'),('Paris'),('Berlin'),('Athens'),('Budapest'),('Reykjavik'),('Dublin'),('Rome'),('Riga'),('Vaduz'),('Vilnius'),('Luxembourg'),('Valletta'),('Chisinau'),('Monaco'),('Podgorica'),('Amsterdam'),('The Hague'),('Skopje'),('Oslo'),('Warsaw'),('Lisbon'),('Bucharest'),('Moscow'),('San Marino'),('Belgrade'),('Bratislava'),('Ljubljana'),('Madrid'),('Stockholm'),('Bern'),('Kiev'),('London') -->
