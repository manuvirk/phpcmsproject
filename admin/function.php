<?php 

function insert_categories(){
  global $connection;

 if(isset($_POST['submit'])){
               //echo"<h1>HELLO</h1>";
  $cat_Title = $_POST['cat_title']; 

  if($cat_Title == "" || empty($cat_Title)){
  echo "This field should not be empty";

  }else{
      $query = "INSERT INTO categories(cat_Title) ";
      $query .= "VALUE('{$cat_Title}')";
      $creat_category_query = mysqli_query($connection,$query);

      if(!$creat_category_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }
  }
}

 function findallcategories(){

   global $connection;
   $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query); 
    while($row = mysqli_fetch_assoc($select_categories)){
    $cat_Id = $row['cat_Id'];
    $cat_Title = $row['cat_Title'];
    echo"<tr>";
    echo "<td>{$cat_Id}</td>";
    echo "<td>{$cat_Title}</td>";
    echo "<td><a href= 'category.php?delete={$cat_Id}'</a>Delete</td>";
    echo "<td><a href= 'category.php?edit={$cat_Id}'</a>Edit</td>";
    echo"</tr>";
  }
 }

function deletecategories(){

    global $connection;
    if(isset($_GET['delete'])){
    $del_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_Id = {$del_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: category.php");
    
    }
}

function updatecategories(){
   global $connection;

    if(isset($_GET['edit'])){
     $edit_cat_id = $_GET['edit'];
   
    if(isset($_POST['Update'])){
    
    $update_cat_Title = $_POST['cat_title'];
    $query = "UPDATE categories SET cat_title = '{$update_cat_Title}' WHERE cat_Id = {$edit_cat_id}";
    $update_query = mysqli_query($connection,$query);
    if(!$update_query){
        echo"this failed";
        die("QUERY FAILED" . mysqli_error($connection));
        

    }
  }
  }
}

}

?>