<?php  
include ("connection.php");
//  $connect = mysqli_connect("localhost", "fishopp2_furnit", "fslhggi2020@@@", "fishopp2_furniture");  
//if (!empty($_POST))  

 if(!empty(($_REQUEST($_POST['add']))))
 {  
      $output = '';  
      $message = '';  
      $product_name = $_POST["name"];  
     $product_counting_unit = $_POST["counting"];  
     $product_package_type = $_POST["packagetype"];  
      $product_weight = $_POST["weight"];  
     $product_number_in_package = $_POST["numberinpackage"]; 
     $product_delivery_time = $_POST["deliverytime"];  
      $product_msrp =$_POST["msrp"];  
      $product_sort_price = $_POST["sortprice"];  
     $product_sale_type =$_POST["saletype"]; 
      $product_id=$_POST["product_id"];
      if($product_id != '')  
      {
      

           $sql = "  
           UPDATE pish_hikashop_product   
           SET product_name` ='$product_name',   
           `product_counting_unit` ='$product_counting_unit',   
           `product_package_type` ='$product_package_type',   
           `product_weight` = '$product_weight',   
           `product_number_in_package` = '$product_number_in_package',
           `product_delivery_time`='$product_delivery_time',
           `product_msrp`='$product_msrp',
           `product_sort_price`='$product_sort_price',
           `product_sale_type`='$product_sale_type'
           WHERE product_id='$product_id'";  
            $message = 'Data Updated';  
      }  
      else  
      {
           $sql = "  
           INSERT INTO pish_hikashop_product(`product_name`, `product_counting_unit`,`product_package_type`,`product_weight`,`product_number_in_package`,
           `product_delivery_time`,`product_msrp,product_sort_price`,`product_sale_type`)  
           VALUES('$product_name', '$product_counting_unit', '$product_package_type', '$product_weight', '$product_number_in_package', '$product_delivery_time','$product_msrp', '$product_sort_price', '$product_sale_type');  
           ";  
          
           $message = 'Data Inserted';  
           echo $product_id;
      }  
if(mysqli_query($conn, $sql)) 
{  
          echo 114;
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM pish_hikashop_product where product_id = $product_id";  
           $result = $conn->query($select_query);
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%"> Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';  
           while($row = $result->fetch_assoc())  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["product_name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["product_id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["product_id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;
 }  
 else
 {
     echo 223;
 }
  ?>