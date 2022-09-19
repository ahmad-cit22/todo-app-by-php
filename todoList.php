<?php
session_start();
$db_connect = mysqli_connect('localhost', 'root', '', 'todo_list');
$taskSelectFromDB = "SELECT * FROM todo_list_table";
$taskViewQry = mysqli_query($db_connect, $taskSelectFromDB);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>To-Do by PHP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="container m-auto pb-4">
    <h1 class="text-center mb-3">TO DO List by PHP</h1>
    <div class="row">
      <div class="taskAddBox col-lg-6 px-5 py-4 m-auto">
        <form action="todoList_post.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Add Task Title</label>
            <input type="text" class="form-control" name="taskTitle" id="exampleInputEmail1" aria-describedby="emailHelp">
            <?php
            if (isset($_SESSION['errMsg1'])) { ?>
              <div id="emailHelp" class="errMsg text-danger form-text"><?= $_SESSION['errMsg1']; ?></div>
            <?php } ?>
          </div>


          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Add Task Description</label>
            <input type="text" class="form-control" name="taskDescription" id="exampleInputPassword1">
            <?php
            if (isset($_SESSION['errMsg2'])) { ?>
              <div id="emailHelp" class="errMsg text-danger form-text"><?= $_SESSION['errMsg2']; ?></div>
            <?php } ?>
          </div>

          <?php
          if (isset($_SESSION['succMsg'])) { ?>
            <div id="emailHelp" class="d-block errMsg succMsg text-info mb-3 form-text"><?= $_SESSION['succMsg']; ?></div>
          <?php } ?>

          <button type="submit" class="btn btn-primary" name="taskSubmit">Submit</button>

        </form>
      </div>
    </div>
  </div>


  <div class="container fs-5 mb-5">
    <div class="row">

      <div class="todoListShow col-lg-9 px-5 py-4 m-auto">
        <h1 class="text-center mb-3">Tasks To Do</h1>
        <a type="button" class="deleteAllBtn mb-2 d-block ms-auto btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete All</a>
        <table class="table table-hover">

          <thead>
            <tr>
              <th scope="col">SL</th>
              <th scope="col">Task Title</th>
              <th scope="col">Task Description</th>
              <th class="text-center" scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="text-light">
            <?php
            foreach ($taskViewQry as $key => $tasks) {
              $_SESSION['taskID'] = $tasks['id'];
            ?>
              <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $tasks['task_title'] ?></td>
                <td><?= $tasks['task_description'] ?></td>
                <td class="text-center">
                  <a data-bs-toggle="modal" data-bs-target="#editTaskModal<?= $key ?>" class="mb-2 btn btn-success">Edit</a>
                  <a href="delete_task_post.php?id=<?= $tasks['id'] ?>" class="mb-2 btn btn-danger">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- delete all modal starts-->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Warning!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure to delete all the tasks?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
          <a href="delete_task_post.php" type="button" class="btn btn-danger">Yes, Delete all!</a>
        </div>
      </div>
    </div>
  </div>
  <!-- delete all modal ends-->


  <!-- edit modal starts-->
  <?php
  foreach ($taskViewQry as $key => $tasks) {
  ?>

    <div class="modal fade" id="editTaskModal<?= $key ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Task Here</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="edit_task_post.php" method="POST">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Edit Task Title :</label>
                <input type="text" class="form-control" id="recipient-name" placeholder="Task Title" value="<?= $tasks['task_title'] ?>" name="taskTitle1">
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Edit Task Description :</label>
                <input class="form-control" id="message-text" placeholder="Task Description" value="<?= $tasks['task_description'] ?>" name="taskDescription">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="edit_task_post.php?id=<?= $tasks['id'] ?>" class="btn btn-primary" type="button">Confirm</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <?php } ?>

  <!-- edit modal ends-->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>

</html>

<?php
session_unset();
?>