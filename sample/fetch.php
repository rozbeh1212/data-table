 <?php
     //fetch.php  
     include("connection.php");
     //$connect = mysqli_connect("localhost", "fishopp2_ing", "fslhggi@2020", "fishopp2_ing");  
     if (isset($_POST["product_id"])) {
          $query = "SELECT * FROM pish_hikashop_product WHERE product_id = '" . $_POST["product_id"] . "'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_array($result);
          echo json_encode($row);
     }
     ?>