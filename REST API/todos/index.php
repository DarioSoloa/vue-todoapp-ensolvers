<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Connection to the data base
$server = "localhost"; $user = "root"; $password = ""; $nameDB = "todo-list";
$connectionDB = new mysqli($server, $user, $password, $nameDB);


// Fetch Todos items by using "id"
if (isset($_GET["consult"])){
    $sqlTodos = mysqli_query($connectionDB,"SELECT * FROM todo WHERE id=".$_GET["consult"]);
    if(mysqli_num_rows($sqlTodos) > 0){
        $todos = mysqli_fetch_all($sqlTodos,MYSQLI_ASSOC);
        echo json_encode($todos);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Removes the selected Todo item
if (isset($_GET["remove"])){
    $sqlTodos = mysqli_query($connectionDB,"DELETE FROM todo WHERE id=".$_GET["remove"]);
    if($sqlTodos){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
// Inserts a new Todo item
if(isset($_GET["insert"])){
    $data = json_decode(file_get_contents("php://input"));
    $title=$data->title;
        if(($title!="")){
            
    $sqlTodos = mysqli_query($connectionDB,"INSERT INTO todo(title) VALUES('$title') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Updates a selected Todo item by using its "id"
if(isset($_GET["update"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["update"];
    $title=$data->title;
    $completed=$data->completed;
    
    $sqlTodos = mysqli_query($connectionDB,"UPDATE todo SET title='$title',completed='$completed' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Toggle the "completed" status of the selected Todo item
if(isset($_GET["toggle"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["toggle"];
    $completed=$data->completed;
    
    $sqlTodos = mysqli_query($connectionDB,"UPDATE todo SET completed='$completed' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Fetch all the Todos items
$sqlTodos = mysqli_query($connectionDB,"SELECT * FROM todo ");
if(mysqli_num_rows($sqlTodos) > 0){
    $todos = mysqli_fetch_all($sqlTodos,MYSQLI_ASSOC);
    echo json_encode($todos);
}
else{ echo json_encode([["success"=>0]]); }


?>
