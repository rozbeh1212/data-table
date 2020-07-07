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

<head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>فیشاپینگ | اصلاح اطلاعات کالا</title>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

     <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<style>
     .modal-backdrop.fade.in {
          z-index: -1;
     }
</style>




<body>

     <script>
          jQuery(document).ready(function($) {


               $(".modal-backdrop").remove();


          });
     </script>


     <br /><br />
     <div class="container" style="width:100%;">
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
                              <th width="8%">اصلاح</th>
                         </tr>
                         <?php
                         if ($contents && count($contents) > 0) {
                              $index = 0;
                              foreach ($contents as $product) {
                         ?>
                                   <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo $product["product_id"]; ?></td>
                                        <td><img src="<?php echo $product["product_image"]; ?>" /></td>
                                        <td><?php echo $product["product_name"]; ?></td>
                                        <td><input type="button" name="delete" value="حذف" id="<?php echo $product["product_id"]; ?>" class="btn btn-info btn-xs delete_data" /></td>
                                        <td><input type="button" name="edit" value="اصلاح" id="<?php echo $product["product_id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>

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
<div id="add_data_Modal" class="modal fade">
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
<div id="delete_data_Modal" class="modal fade">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">کالا حذف شد. این فرآیند برگشت ناپذیر است.</h4>
               </div>

          </div>
     </div>
</div>
<script>
     $(document).ready(function() {
          $('#add').click(function() {
               $('#insert').val("Insert");
               $('#insert_form')[0].reset();
          });
          $(document).on('click', '.edit_data', function() {
               var product_id = $(this).attr("id");
               $.ajax({
                    url: "http://fishopping.ir/furniture/serverHypernetShowUnion/fetch.php",
                    method: "POST",
                    data: {
                         product_id: product_id
                    },
                    dataType: "json",
                    success: function(data) {
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
          $('#insert_form').on("submit", function(event) {
               event.preventDefault();
               if ($('#name').val() == "") {
                    alert("نام کالا ضروری است");
               } else if ($('#counting').val() == '') {
                    alert("واحد شمارش الزامی است");
               } else if ($('#packagetype').val() == '') {
                    alert("نوع بسته بندی (از قبیل کارت، شرینک و ...) را بنویسید ");
               } else if ($('#weight').val() == '') {
                    alert("وزن بسته را مشخص کنید");
               } else if ($('#numberinpackage').val() == '') {
                    alert("تعداد در بسته چندتاست؟");
               } else if ($('#deliverytime').val() == '') {
                    alert("مدت زمان تحویل مشخص نشده");
               } else if ($('#msrp').val() == '') {
                    alert("لطفا نرخ مصرف کننده را وارد نمایید");
               } else if ($('#sortprice').val() == '') {
                    alert("لطفا نرخ تحویل به فروشگاه را درج نمایید");
               } else if ($('#sortprice').val() == '') {
                    alert("نحوه تسویه حساب (چک، نقد، سایر) را مشخص کنید");
               } else {
                    $.ajax({
                         url: "http://fishopping.ir/furniture/serverHypernetShowUnion/insert.php",
                         method: "POST",
                         data: $('#insert_form').serialize(),
                         beforeSend: function() {
                              $('#insert').val("Inserting");
                         },
                         success: function(data) {
                              $('#insert_form')[0].reset();
                              $('#add_data_Modal').modal('hide');
                         }
                    });
               }
          });
     });
     $(document).on('click', '.delete_data', function() {
          var product_id = $(this).attr("id");
          $.ajax({
               url: "http://fishopping.ir/furniture/serverHypernetShowUnion/delete.php",
               method: "POST",
               data: {
                    product_id: product_id
               },
               dataType: "json",
               success: function(data) {
                    $('#delete_data_Modal').modal('show');
               }
          });
     });
</script>