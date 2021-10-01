<?php

$connect = mysqli_connect("localhost", "homestead", "secret", "homestead");

/* if(!$connect){
    die("Connection failed: ".mysqli_connect_error());
} */

$received_data = json_decode(file_get_contents("php://input"));
foreach($received_data->cities as $city){
    /* $data = array(
        'id' => $received_data->id,
        'city' => $city
    ); */
      
    $query = "
        INSERT INTO cities_by_user (user_id, city_name) 
        VALUES (?, ?)
        ";
        
    $statement = $connect->prepare($query);
    $statement->bind_param("ss", $received_data->id, $city);
    $statement->execute();
        
    /* $output = array(
        'message' => 'Data Inserted'
    );
    echo json_encode($output); */
}

?> 