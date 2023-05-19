<?php

//Connect to database
$conn = mysqli_connect("localhost", "root", "", "platformphp");

function makingQuery($query){
    global $conn;
    $result = mysqli_query($conn, $query); 
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//Function untuk menambahkan to do list
function addTodo($data){
    $kontent = htmlspecialchars($data["kontent"]);

    global $conn;

    $query = "INSERT INTO todolist VALUES ('', '$kontent','')";
    mysqli_query($conn, $query);
   
    return (mysqli_affected_rows($conn));
}

//Function untuk menghapus to do list
function deleteTodo($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM todolist WHERE nomor = $id");
    return (mysqli_affected_rows($conn));
}

//Function untuk mengubah/mengupdate to do list
function changeTodo($data){
    $id = $data["id"];
    $dataContent = htmlspecialchars($data["list"]);   
    global $conn;
    $query = "UPDATE todolist SET todo = '$dataContent' WHERE nomor = $id";
    mysqli_query($conn,$query);            
    return (mysqli_affected_rows($conn));
}

//Function untuk registrasi/sign up
function registrasi($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_escape_string($conn, $data["confirmPassword"]);

    $hasil =  mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($hasil)){
        echo "<script>alert('Username ini telah digunakan')</script>";
        return false;
    }

    if($password != $password2){
        echo "<script>alert('Password doesn't match!')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);    

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}