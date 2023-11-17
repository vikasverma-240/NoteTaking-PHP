<?php

//INSERT INTO `notes_php` (`sno`, `title`, `description`, `date`) VALUES (NULL, 'sdfadf', 'aftersdf asdf asdf dswfdf sdfger', current_timestamp());
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "php_note";

$insert = false;
$update = false;
$delete = false;
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check the connection
if (!$conn) {
    die("Failed to connect to the database" . mysqli_connect_error());
}


//..........
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['snoEdit'])) {
        // echo "yes";
        //Update the record....
        $sno = $_POST['snoEdit'];
        $title = $_POST['edittitle'];
        $description = $_POST['editdescription'];


        //sql query to be executed
        $sql = "UPDATE `notes_php` SET `title` = '$title' , `description` = '$description' WHERE `notes_php`.`sno` = $sno";
        $result = mysqli_query($conn, $sql);


        exit();
    } else {


        $title = $_POST['title'];
        $description = $_POST['description'];


        //sql query to be executed
        $sql = "INSERT INTO `notes_php` (`title`, `description`, `date`)VALUES ('$title', '$description', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        //Add a new note in the database

        if ($result) {
            // echo "Record has been added successfully <br>";
            $insert = true;
        } else {
            echo "the record has not been added ------>" . mysqli_error($conn);
        }
    }
}
?>





<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Note Taking</title>


    <!-- Data Tables jquery library -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!--Bootstrap Icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <!-- Edit -->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit Modal
    </button> -->

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="indec.php" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Note Title</label>
                            <input type="text" class="form-control" id="edittitle" name="edittitle">
                        </div>
                        <div class="mb-3">
                            <label for="description">Note Description</label>
                            <textarea class="form-control" id="editdescription" name="editdescription"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP NOTE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Type Of Note
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">IT Services</a></li>
                            <li><a class="dropdown-item" href="#">Marketing</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">New Upcomming Technology</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if ($insert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Added Successfully!</strong> Your note has been added successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($update) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Updated Successfully!</strong> Your note has been updated successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if ($delete) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Deleted Successfully!</strong> Your note has been Deleted successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <div class="container mt-5">
        <h2>Add a Note</h2>
        <form action="index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="description">Note Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container my-5">

        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">SNO</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes_php`";
                $result = mysqli_query($conn, $sql);
                $sno = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $sno = $sno + 1;
                    echo "  <tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['date'] . "</td>
            <td><button class='edit bi bi-pencil-square' id=" . $row['sno'] . "></button></td>
            <td><button class='delete bi bi-trash' id=d" . $row['sno'] . "></button></td>
        </tr>
            ";
                }
                ?>
            </tbody>
        </table>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>


    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ", );
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);

                edittitle.value = title;
                editdescription.value = description;


                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            });
        });


//For Delete query................

        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("delete ", );
                
                sno = e.target.id.substr(1,);

                if(confirm("Press a button!")){
                    console.log("yes");
                    window.location = `index.php?delete=${sno}`;
                }
                else{
                    console.log("no");
                }
            });
        });
    </script>
</body>

</html>