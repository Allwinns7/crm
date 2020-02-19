<?php
   include('includes/auth.inc');
   include('backend/conn.php');
   $suppliers = "SELECT * FROM `suppliers` ORDER BY name ASC";
   $suppliers_exe = $conn->query($suppliers);

   $select_account = "SELECT * FROM `accounts` ORDER BY `name` ASC";
   $select_acc_exe = $conn->query($select_account);

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Purchase</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <style>
         .modal.right .modal-dialog,
         .modal.left .modal-dialog {
      position: fixed;
      margin: auto;
      width: 600px;
      height: 100%;
      -webkit-transform: translate3d(0%, 0, 0);
          -ms-transform: translate3d(0%, 0, 0);
           -o-transform: translate3d(0%, 0, 0);
              transform: translate3d(0%, 0, 0);
   }

   .modal.right .modal-content,
   .modal.left .modal-content {
      height: 100%;
      background: #ececec;
      overflow-y: auto;
}
   .modal.right .modal-body,
   .modal.left .modal-body {
      padding: 15px 15px 80px;
      background: #fff;
   }

        
/*Right*/
   .modal.right.fade .modal-dialog,
   .modal.left.fade .modal-dialog {
      right: -320px;
      -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
         -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
           -o-transition: opacity 0.3s linear, right 0.3s ease-out;
              transition: opacity 0.3s linear, right 0.3s ease-out;
   }
   
   .modal.right.fade.in .modal-dialog,
   .modal.left.fade.in .modal-dialog {
      right: 0;
   }
   .modal-footer{
      background: #fff;
   }
      </style>
   </head>
   <body class="hold-transition sidebar-mini">
      <div id="preloader">
         <div id="status"></div>
      </div>
      <div class="wrapper">
         <?php 
            include('includes/topbar.inc');
            include('includes/sidebar.inc');
         ?> 
         <div class="content-wrapper">
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-usd"></i>
               </div>
               <div class="header-title">
                  <h1>Purchase</h1>
                  <small>New Purchase</small>
               </div>
            </section>
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Add Purchase</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form action="#" class="form-vertical" id="insert_purchase" name="insert_purchase" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="form-group row">
                                       <label for="supplier_sss" class="col-sm-3 col-form-label">Supplier<i class="text-danger">*</i>
                                       </label>
                                       <div class="col-sm-6">
                                          <select name="supplier_id" id="supplier_id" class="form-control " required="" tabindex="1">
                                             <option value=" ">Select One</option>
                                             <?php 
                                                while($all_suppliers = $suppliers_exe->fetch_assoc()){
                                                   echo "<option value='".$all_suppliers['id']."'>".$all_suppliers['name']."</option>";
                                                }
                                             ?>
                                          </select>
                                       </div>
                                       <div class="col-sm-3">
                                          <!--<a href="https://wholesalenew.bdtask.com/newholesale/Csupplier">Add Supplier</a>-->
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group row">
                                       <label for="date" class="col-sm-4 col-form-label">Purchase Date<i class="text-danger">*</i>
                                       </label>
                                       <div class="col-sm-8">
                                          <input type="text" tabindex="2" class="form-control datepicker hasDatepicker" name="purchase_date" value="<?php echo date('Y-m-d');?>" id="date" required="">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-6">
                                    <div class="form-group row">
                                       <label for="invoice_no" class="col-sm-3 col-form-label">Purchase No<i class="text-danger">*</i>
                                       </label>
                                       <div class="col-sm-9">
                                          <input type="text" tabindex="3" class="form-control" name="chalan_no" placeholder="Purchase No" id="invoice_no" required="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group row">
                                       <label for="adress" class="col-sm-4 col-form-label">Details</label>
                                       <div class="col-sm-8">
                                          <textarea class="form-control" tabindex="4" id="adress" name="purchase_details" placeholder=" Details" rows="1"></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="table-responsive" style="margin-top: 10px">
                                 <table class="table table-bordered table-hover" id="purchaseTable">
                                    <thead>
                                       <tr>
                                          <th class="text-center">Item Information<i class="text-danger">*</i></th>
                                          <th class="text-center">In Stock</th>
                                          <th class="text-center">Quantity </th>
                                          <th class="text-center">Rate<i class="text-danger">*</i></th>
                                          <th class="text-center">Total</th>
                                          <th class="text-center">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody id="addPurchaseItem">
                                       <tr>
                                          <td class="span3 supplier_load">
                                             Please Select Supplier                                            <!-- <select class="form-control supplier"></select> -->
                                          </td>
                                          <td>
                                             <input type="text" id="" class="form-control text-right stock_ctn_1" placeholder="Stock/Qnt" readonly="">
                                          </td>
                                          <td class="text-right">
                                             <input type="text" name="product_quantity[]" readonly="readonly" id="total_qntt_1" class="form-control text-right" placeholder="0.00">
                                          </td>
                                          <td class="">
                                             <input type="text" name="product_rate[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" id="price_item_1" class="form-control price_item1 text-right" placeholder="0.00" value="" min="0" tabindex="7">
                                          </td>
                                          <td class="text-right">
                                             <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" tabindex="-1" readonly="readonly">
                                          </td>
                                          <td>
                                             <button style="text-align: right;" class="btn btn-danger red" type="button" value="Delete" onclick="deleteRow(this)" tabindex="8">Delete</button>
                                          </td>
                                       </tr>
                                    </tbody>
                                    <tfoot>
                                       <tr>
                                          <td colspan="2">
                                             <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onclick="addPurchaseInputField('addPurchaseItem');" value="Add New Item" tabindex="9">
                                             <input type="hidden" name="baseUrl" class="baseUrl" value="https://wholesalenew.bdtask.com/newholesale/">
                                          </td>
                                          <td style="text-align:right;" colspan="3"><b>Grand Total:</b></td>
                                          <td class="text-right">
                                             <input type="text" id="grandTotal" tabindex="-1" class="text-right form-control" name="grand_total_price" value="0.00" readonly="readonly">
                                          </td>
                                       </tr>
                                    </tfoot>
                                 </table>
                              </div>
                              <div class="form-group row">
                                 <div class="col-sm-6">
                                    <input type="submit" id="add-purchase" class="btn custom_btn custom_fontcolor btn-large" name="add-purchase" value="Submit" tabindex="10">
                                    <input type="submit" value="Submit And Add Another One" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another" tabindex="11">
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <?php include('includes/footer.inc');?>
      </div>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/tableExport.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jquery.base64.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/html2canvas.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/sprintf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jspdf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/base64.js" type="text/javascript"></script>
      <script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
         $('#supplier_id').on('change',function(){
            var sid = $('#supplier_id').val();
            if(sid!='') {
               $.ajax({
                  type: "POST",
                  url: 'nb/getsupplierproducts.php',
                  data: {sid: sid},
                  cache: false,
                  success: function (datas)
                  {
                     $('.supplier_load').html(datas);
                  }
               });
            }
         });

         function getPrice(tRow) {
            var row = tRow.parentNode.parentNode;
            //var name = row.getElementsByTagName("TD")[0].innerHTML;
            //name.find(':input[type="text"]').val(5);
            //var rs = name.getElementsByTagName("input")[0];
            //console.log(name);
            //console.log(rs);
            var chkOne = $(this).find('td:eq(1)').find(':input').eq(0).prop("value", "1");
            console.log(chkOne);
            var pid = $('#product_id').val();
            if(pid!=''){
               $.ajax({
                  type: "POST",
                  url: 'nb/retrieve_product_data.php',
                  data: {pid: pid},
                  cache: false,
                  success: function (datas)
                  {
                     var details = JSON.parse(datas);
                     $(".stock_ctn_1").val(details[0].quantity);
                     $("#price_item_1").val(details[0].sell_price);

                     $('.'+qnttClass).val(obj.cartoon_quantity);
                      $('.'+priceClass).val(obj.supplier_price);
                      $('.'+stock_ctn).val(obj.total_product);
                      quantity_calculate(cName);
               
                  }
               });
            }
         }

         // Add input field for new Invoice 
    var count = 2;
    var limits = 500;
    // function addPurchaseInputField(divName){
    //     //var param = "$(this).attr(name)";
    //      if (count == limits)  {
    //           alert("You have reached the limit of adding " + count + " inputs");
    //      }
    //      else {
    //           var newdiv = document.createElement('tr');
    //           var tabin="product_name_"+count;
    //           newdiv.innerHTML ="<td><select name='product_id[]' onkeypress='purchase_productList(" + count + ");' required class='form-control product_id_" + count + "' placeholder='Type product name' id='product_name_" + count + "' ></select></td><td><input type='text' id='' class='form-control text-right stock_ctn_" + count + "' placeholder='Stock' readonly/></td><td class='text-right'><input type='text' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' required  id='qty_item_" + count + "' class='form-control text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input type='text' name='cartoon_item[]' value='' readonly='readonly' id='ctnqntt_" + count + "' class='form-control ctnqntt" + count + " text-right' placeholder='Item/Cartoon'/></td><td class='text-right'><input type='text' name='product_quantity[]' readonly='readonly' id='total_qntt_" + count + "' class='form-control text-right' placeholder='0.00' /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='form-control price_item" + count + " text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input class='form-control total_price text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' tabindex='-1' readonly='readonly' /></td><td><button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button></td>";
    //           document.getElementById(divName).appendChild(newdiv);
    //           document.getElementById(tabin).focus();
    //           count++;
    //      }
    // }
     function addPurchaseInputField(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append("<tr>" + t + "</tr>");
        count++;
    }

    //Calcucate Invoice Add Items
    
    function quantity_calculate(item)
    {
        var qnty =$("#qty_item_"+item).val();
        //stockLimit(item,qnty);
        var cnt =$(".ctnqntt"+item).val();
        var rate =$("#price_item_"+item).val();
        
        var total_qnty  = qnty * cnt;
        $("#total_qntt_"+item).val(total_qnty);
        var total_amnt = total_qnty * rate;
        $("#total_price_"+item).val(total_amnt);
        //alert(qnty);
        calculateSum();
    }


    function calculateSum() {
        var e = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
    }

    function deleteRow(e) {
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculateSum();
        count--;
    }
        
    $("body").on("keyup change", ".qty_calculate", function() {
        var cartoon = $(this).val();
        var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();
    });
      </script>
   </body>
</html>