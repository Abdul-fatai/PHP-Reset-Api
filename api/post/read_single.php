<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: appliaction/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate blog post object
$post = new Post($db);

//GET ID
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET post
$post->read_single();

// Create array 
$post_arr = array(
    'id' => $post->id,
    'title' => $post->title,
    'body' =>  $post->body,
    'author' => $post->author,
    'category_id' => $post->catergory_id,
    'category_name' => $post->category_name,
);

//Make json
print_r(json_encode($post_arr));