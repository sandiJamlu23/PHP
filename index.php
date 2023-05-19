<?php

session_start();
if(!isset($_SESSION["login"])){
    header("location: login.php");
}

require 'allFunction.php';

if (isset($_POST["submit"])) {
  if (addTodo($_POST) > 0) {
    echo "<script> 
           alert('data berhasil ditambahkan!');
           document.location.href = 'index.php';
         </script>";
  } else {
    echo "<script> 
    alert('data gagal ditambahkan!');    
  </script>";
  }
}

$data = makingQuery("SELECT * FROM todolist");

?>

<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
  <title>To Do List | 215314068</title> 
</head>

<body class="" style="background-color:lightskyblue;">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  
  <div id="myDIV" class="header text-center">
    <h2 style="margin:5px">MY TO DO LIST</h2>   
    <br><br>
    <form action="" method="post">
      <input type="text" id="myInput" placeholder="Input your to do list here" name="kontent">
      <button type="submit" name="submit" class="btn btn-primary btn-lg">Add</button>
    </form>
  </div>
  
  <br>

  <div class="container-md">
    <table class="table table-dark table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">To Do List</th>
          <th scope="col">Button</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data as $dt) : ?>
          <tr>
            <td><?= $i ?></td>
            <td><?= $dt["todo"]; ?></td>
            <td>           
              <a href="update.php?id=<?= $dt["nomor"]; ?>"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</button></a>
              <a href="delete.php?id=<?= $dt["nomor"]; ?>" onclick="return confirm('Apakah anda ingin menghapus to do list ini?');"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
      </tbody>
  </div>
  </table> 

  <br><br>
    <a href="logout.php"><button class="btn btn-success btn-lg">Logout</button></a>
  <br><br>

  <!-- Footer -->
  <div class="footer text-center">
      <p>Created by Puteri Marie Daniella | 215314068 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
      </svg></p>
  </div>
  <!-- end of footer -->

</body>

</html>