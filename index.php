<?php
  $db = mysqli_connect("localhost", "root", "", "ourtime");
  
  if ($db){
    //  echo "connection establish success ";
  }else{
    echo "Database Connection Error ";
  }
ob_start();
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <!-- left side -->
        <div class="card">
          <div class="card-header">
            <h4>All Category List</h4>
          </div>
          <div class="card-body">
            <table class="table">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Category Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- face information database -->
                <?php 
                //step 1 : read Operation 
                $sql = "SELECT * FROM wp_category";
                 //step 2 : sql to Database
                $result = mysqli_query($db, $sql);
                $count = 0;
                while($row = mysqli_fetch_assoc($result)){
                  $c_id = $row ['c_id'];
                  $name = $row ['c_name'];
                  $desc = $row['c_des'];
                  $count++;

                  ?>
                <tr>
                  <td><?php echo $count ?></td>
                  <td><?php echo $name;  ?></td>
                  <td><?php echo $desc;  ?></td>
                  <td>
                    <!-- <a href="#" class="badge bg-primary">Delete</a> -->
                    <span class="badge btn"><a href=" index.php?deleteId=<?php echo $c_id; ?>">Delete</a></span>
                  </td>
                </tr>
                <?php
                }
                
                ?>



              </tbody>
            </table>
          </div>
        </div>

      </div>
      <div class="col-md-6">
        <!-- right side -->
        <div class="card">
          <div class="card-header">
            <h4>Add New Category</h4>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="form-group">
                <input type="text" name="cat_name" placeholder="Name" required="required" class="form-control" id="">
              </div>
              <div class="form-group">
                <input type="text" name="cat_desc" placeholder="Description" required="required" class="form-control"
                  id="">
              </div>
              <button type="submit" name="cat_submit" value="" class="btn btn-danger btn-md">Confirm</button>
            </form>
          </div>
        </div>
      </div>


      <!-- Insert data in to data base -->

      <?php 
      if (isset($_POST['cat_submit'])){
        $cat_name = $_POST['cat_name'];
        $cat_desc = $_POST['cat_desc'];
        
        //3step
        // sql sql=>database  feedback
      
       $query = "INSERT INTO wp_category(c_name,c_des) VALUES ('$cat_name','$cat_desc')";
        $result = mysqli_query($db, $query);

        if ($result){
          header('Location: index.php');

        }else{
          echo "Category insert Error";
        }
      }
      
    
      ?>

    </div>
    <!-- delete operation  -->
    <?php 
if(isset($_GET['deleteId'])){
  $delete_id = $_GET['deleteId'];

      $query = "DELETE FROM wp_category WHERE  c_id='$delete_id'";
      $result = mysqli_query($db, $query);
  if ($result){
        header("Location: index.php");
   }else{
    echo "Data Delete Error";
   }
}

?>
  </div>
  <?php
ob_end_flush();
?>
</body>

</html>