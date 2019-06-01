<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: appliaction/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate Categorypost object
$category = new Category($db);

// Category  query
$result = $category->read();

//Get row count 
$num = $result->RowCount();

//Check if any categrories

if($num > 0){
    //Cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
            'id' => $id,
            'name' => $name,
 
        );
        // push to "data"
        array_push($cat_arr['data'], $cat_item);
    }

    // Turn to json & output
    echo json_encode($cat_arr);
} else {
    //No categories
    echo json_encode(
        array('message' => 'No Categories Found')
    );
}


