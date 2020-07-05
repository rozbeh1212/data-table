<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
$current_user = JFactory::getUser();
$url = "http://fishopping.ir/furniture/serverHypernetShowUnion/GetBrandsProductsWhenClickedBrandsName.php";
$post = [
'user_id' => $current_user->id
];

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);
if (curl_errno($ch)) {
$error_msg = curl_error($ch);
}
curl_close($ch);
$contents = json_decode($output, true);
?>
 <!DOCTYPE html>  
 <html>  
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
           <title>فیشاپینگ | اصلاح اطلاعات کالا</title>  
  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>


      </head>  
<!-- <style type="text/css"> -->
/////////////////////////////////////////////commented l 36-49
/* .modal-backdrop.in {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1020;
    background-color: #000;
}
.modal-backdrop.in {
    filter: alpha(opacity=50);
    opacity: .5;
} */

<!-- </style> -->
  <body>  

   <br /><br />  
           <div class="container" style="width:700px;"  >  
                <h3 align="center">اصلاح اطلاعات کالا</h3>  
                <br />  
                <div class="table-responsive">  
                     
                     <br />  
                     <div id="employee_table">  
                          <table class="table table-bordered">  
                               <tr>
                                    <th width="8%">ردیف</th>
									<th width="8%">کد کالا</th>
									<th width="28%">تصویر کالا</th>
									<th width="40%">نام کالا</th>  						
                                    <th width="8%">نمایش</th>  
                                    < th width="8%">اصلاح</th>  
                               </tr>  
                               <?php 
if($contents && count($contents) > 0){
$index = 0;
foreach($contents as $product) {							   
                                 ?>  
                               <tr>  
                                    <td><?php echo $index+1; ?></td>
									<td><?php echo $product["product_id"]; ?></td>
									<td><img src="<?php echo $product["product_image"]; ?>" /></td>
                                    <td><?php echo $product["product_name"]; ?></td>									
                                    <td><button name="view" id="<?php echo $product["product_id"]; ?>" onclick="handleBoxClick(<?=$index?>)" class="btn btn-info btn-xs">نمایش</button></td>  
   <td><input type="button" name="edit" value="اصلاح" data-dismiss="modal"  id="<?php echo $product["product_id"]; ?>" class="btn btn-info btn-xs edit_data" data-backdrop="false" /></td> 


                                 </tr>  
                               <?php
$index++;
}
} else {
?>

<h4 style="text-align:center;width: 100%;"> موردی پیدا نشد. </h4>
<?php
}
?>
                          </table>  
                     </div>  
                </div>  
           </div>  
      </body>  
 </html> 
 

 <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">جزئیات کالا</h4>  
                </div>  
                <div class="modal-body" id="product_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  

 <div id="add_data_Modal" class="modal fade" data-backdrop="false">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">در صورتیکه میخواهید اطلاعات کالا را تغییر دهید، فیلدهای مربوطه را اصلاح کنید</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>نام محصول را وارد نمایید</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />  
                          <label>واحد شمارش محصول چیست؟</label>  
                          <textarea type="text" name="counting" id="counting" class="form-control"></textarea>  
                          <br />  
                          <label>نوع بسته بندی</label>    
                          <input type="text" name="packagetype" id="packagetype" class="form-control" /> 
                          </select>  
                          <label>وزن بسته</label>  
                          <input type="text" name="weight" id="weight" class="form-control" />
						  <br />  
                           <label>تعداد در بسته</label>  
                          <input type="text" name="numberinpackage" id="numberinpackage" class="form-control" />						  
                          <br />
                          <label>مدت زمان تحویل</label>  
                          <input type="text" name="deliverytime" id="deliverytime" class="form-control" />						  
                          <br />	
                           <label>نرخ مصرف کننده</label>  
                          <input type="text" name="msrp" id="msrp" class="form-control" />						  
                          <br />	
                          <label>نرخ سوپرمارکت</label>  
                          <input type="text" name="sortprice" id="sortprice" class="form-control" />						  
                          <br />
                          <label>نحوه تسویه حساب</label>  
                          <input type="text" name="saletype" id="saletype" class="form-control" />						  
                          <br />						  
                          <input type="hidden" name="product_id" id="product_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 <!-- The Modal -->
<div id="myModal" class="modal">
<!-- Modal content -->
<div class="modal-content">
<div style="display: flex; flex-direction: column;">
<div style="display: flex; flex-direction: column;align-items: center">
<img id="prod_image" style="max-width:100px;max-height:140px;" />
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نام برند:</p>
<p id="prod_brand" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نام محصول:</p>
<p id="prod_name" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">واحد شمارش: </p>
<p id="prod_counter" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">وزن بسته بندی: </p>
<p id="prod_weight" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">تعداد در بسته بندی:</p>
<p id="prod_count" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نوع بسته بندی:</p>
<p id="prod_type" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">مدت زمان تحویل:</p>
<p id="prod_time" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نرخ مصرف کننده (تومان):</p>
<p id="prod_consumer" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نحوه تسویه حساب:</p>
<p id="prod_equal" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">نرخ سوپرمارکت:</p>
<p id="prod_supermarket" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p style="margin-left: 20px;">کد کالا:</p>
<p id="prod_id" style="font-weight: bold;"></p>
</div>
<div style="display: flex; flex-direction: row;">
<p class="close" >بستن</p>

</div>
</div>
</div>
</div>
</div>


 <script>
var products = <?php echo json_encode($contents); ?>;
var selected_index = 0;
var selected_product = {};
// Get the modal
var modal = document.getElementById("myModal");
// Get the button that opens the modal
//var productBoxs = document.getElementsByClassName("prodBox");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on the button, open the modal 
function handleBoxClick(id) {
selected_index = id;
selected_product = products[id];
document.getElementById("prod_image").src = selected_product['product_image'];
document.getElementById("prod_brand").innerHTML = selected_product['category_name'];
document.getElementById("prod_name").innerHTML = selected_product['product_name'];
document.getElementById("prod_counter").innerHTML = 'عدد';
document.getElementById("prod_weight").innerHTML = selected_product['product_weight'];
document.getElementById("prod_count").innerHTML = selected_product['product_quantity'];
document.getElementById("prod_type").innerHTML = '';
document.getElementById("prod_time").innerHTML = '';
document.getElementById("prod_consumer").innerHTML = selected_product['product_msrp'];
document.getElementById("prod_equal").innerHTML = '';
document.getElementById("prod_supermarket").innerHTML = selected_product['product_sort_price'];
document.getElementById("prod_id").innerHTML = selected_product['product_id'];
modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
console.log("yes");
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
}
}


  $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var product_id = $(this).attr("id");  
           $.ajax({  
                url:"http://fishopping.ir/furniture/serverHypernetShowUnion/fetch.php",  
                method:"POST",  
                data:{product_id:product_id},  
                dataType:"json",  
                success:function(data){  
                     $('#name').val(data.product_name);  
                     $('#counting').val(data.product_counting_unit);  
                     $('#packagetype').val(data.product_package_type);  
                     $('#weight').val(data.product_weight);  
                     $('#numberinpackage').val(data.product_number_in_package); 
                     $('#deliverytime').val(data.product_delivery_time);
                     $('#msrp').val(data.product_msrp); 
                     $('#sortprice').val(data.product_sort_price);
                 	 $('#saletype').val(data.product_sale_type); 
                     $('#product_id').val(data.product_id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#name').val() == "")  
           {  
                alert("نام کالا ضروری است");  
           }  
           else if($('#counting').val() == '')  
           {  
                alert("واحد شمارش الزامی است");  
           }  
           else if($('#packagetype').val() == '')  
           {  
                alert("نوع بسته بندی (از قبیل کارت، شرینک و ...) را بنویسید ");  
           }  
		   else if($('#weight').val() == '')  
           {  
                alert("وزن بسته را مشخص کنید");  
				 }
				else if($('#numberinpackage').val() == '')  
           {  
                alert("تعداد در بسته چندتاست؟"); 
           }  
		   else if($('#deliverytime').val() == '')  
           {  
                alert("مدت زمان تحویل مشخص نشده"); 
           }  
		   else if($('#msrp').val() == '')  
           {  
                alert("لطفا نرخ مصرف کننده را وارد نمایید"); 
           }  
           else if($('#sortprice').val() == '')  
           {  
                alert("لطفا نرخ تحویل به فروشگاه را درج نمایید");  
           }  
		   else if($('#sortprice').val() == '')  
           {  
                alert("نحوه تسویه حساب (چک، نقد، سایر) را مشخص کنید");  
           }  
           else  
           {  
                $.ajax({  
                     url:"http://fishopping.ir/furniture/serverHypernetShowUnion/insert.php",  
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                     }  
                });  
           }  
      });  
    });  
 </script>
