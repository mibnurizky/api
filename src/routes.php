<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/users/list', function (Request $request, Response $response, array $args) {
    $query = $this->db->query("SELECT * FROM users");
    $data = mysqli_fetch_all($query,MYSQLI_ASSOC);
    $row = mysqli_num_rows($query);
    if(mysqli_connect_error()){
        $error_code = 1;
        $error_message = mysqli_connect_error();
    }
    else{
        $error_code = 0;
        $error_message = "";
    }
    return $response->withJson(
        [
            "error_code" => $error_code,
            "error_message" => $error_message,
            "row" => $row,
            "data" => $data
        ],
    200);
});

$app->get('/users/search/{search}', function (Request $request, Response $response, array $args) {
    $search = $args["search"];
    $query = $this->db->query("SELECT * FROM users WHERE username LIKE '%$search%' OR users_nama LIKE '%$search%'");
    $data = mysqli_fetch_all($query,MYSQLI_ASSOC);
    $row = mysqli_num_rows($query);
    $error_code = 0;
    $error_message = "";
    return $response->withJson(
        [
            "error_code" => $error_code,
            "error_message" => $error_message,
            "row" => $row,
            "data" => $data
        ],
    200);
});

$app->post('/member/identitas/', function(Request $request, Response $response){
    $post = $request->getParsedBody();
    $key = $post['key'];
});

$app->delete('/books/:id', function ($id) {
    //Delete book identified by $id
});

$app->put('/books/:id', function ($id) {
    //Update book identified by $id
});