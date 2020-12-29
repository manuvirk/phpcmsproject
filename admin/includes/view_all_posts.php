  
<?php

if(isset($_POST['checkBoxArray'])){


     foreach($_POST['checkBoxArray'] as $checkBoxValue){
   
        echo $bulk_options = $_POST['bulk_option'];
   
        echo $checkBoxValue;

}
}

?>
  

  <form action="" method = "post">
     <table class="table table-bordered table-hover">
     <div id="bulkOptionContainer" class="col-xs-4">
     <select class="form-control" name="bulk_option" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    
     </select>
     
    </div>
     <div id="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class ="btn btn-primary" href="posts.php?source=add_post">Add New</a>

     </div>
            <thead>
            <tr>
                <th><input id="select_all_boxes" type="checkbox" ></th>
                <th>Post_ID</th>
                <th>Post_Category</th>
                <th>Post_title</th>
                <th>Post_author</th>
                <th>Post_date</th>
                <th>Post_image</th>
                <th>Post_content</th>
                <th>Post_tags</th>
                <th>Post_coment_count</th>
                <th>Post_status</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                
              
            </tr>
            </thead>
            <tbody>
            <?php
          
            $query = "SELECT * FROM posts";
            $select_posts = mysqli_query($connection, $query); 

           if(!$select_posts){
             echo"quey failed";}
           

            while($row = mysqli_fetch_assoc($select_posts)){
           

           $Post_ID   = $row['post_id'];   

           $Post_Cat_Id  = $row['post_cat_id'] ;  
           $Post_title = $row['post_title'] ;  
           $Post_author = $row['post_author'];   
           $Post_date = $row['post_date'] ; 
           $Post_image = $row['post_image'] ; 
           $Post_content = $row['post_content'];  
           $Post_tags = $row['post_tags']  ;
           $Post_coment = $row['post_coment_count'];  
           $Post_status = $row['post_status'] ; 
           
            echo"<tr>";
            ?>
           <td> <input class='checkBoxes' id='select_all_boxes' type='checkbox'name='checkBoxArray[]' value='<?php echo $Post_ID; ?>'></td>



            <?php
            echo "<td>$Post_ID</td>";

           $query = "SELECT * FROM categories WHERE cat_Id = {$Post_Cat_Id} ";
                            $edit_categories = mysqli_query($connection, $query); 
                            
                            while($row = mysqli_fetch_assoc($edit_categories)){
                                
                                    $cat_Title = $row['cat_Title'];
                          
     
                            }

            echo "<td>$cat_Title</td>";
            echo "<td>$Post_title</td>";
            echo "<td>$Post_author</td>";
            echo "<td>$Post_date</td>";
            echo "<td><img width = '100'src = '../images/$Post_image' alt ='images'</td>";
            echo "<td>$Post_content</td>";
            echo "<td>$Post_tags</td>";
            echo "<td>$Post_coment</td>";
            echo "<td>$Post_status</td>";
            echo "<td><a href ='../post.php?p_id={$Post_ID}'>View Post</a></td>";
             echo "<td><a href ='posts.php?source=edit_post&p_id={$Post_ID}'>Edit</a></td>";
            

            echo "<td><a href ='posts.php?delete={$Post_ID}'>Delete</a></td>";
           
           echo"</tr>";
          }
          
          ?>
          </tbody>
         
          </table>
  </form>

           <?php 
            if(isset($_GET['delete'])){


              $del_post_id = $_GET['delete'];
              $query = "DELETE FROM posts WHERE post_id = {$del_post_id} ";

              $delete_post_query = mysqli_query($connection,$query);
             // header("Location: view_all_posts.php");

            header("Location: posts.php");
            if(!$delete_post_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

    }
          
           ?>



          

          
