<?php
   include('includes/auth.inc');
   include('database_connection.php');
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>CRM | Create Proforma</title>
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <style>
         .add, .cut
{
   border-width: 1px;
   display: block;
   font-size: .8rem;
   padding: 0.25em 0.5em;  
   float: left;
   text-align: center;
   width: 22px;
}

.add, .cut
{
   background: #9AF;
   box-shadow: 0 1px 2px rgba(0,0,0,0.2);
   background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
   background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
   border-radius: 0.5em;
   border-color: #0076A3;
   color: #FFF;
   cursor: pointer;
   font-weight: bold;
   text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -1.5em 8px 0; }

.add:hover { background: #00ADEE; }

.cut { }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
   * { -webkit-print-color-adjust: exact; }
   html { background: none; padding: 0; }
   body { box-shadow: none; margin: 0; }
   span:empty { display: none; }
   .add, .cut { display: none; }
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
                  <i class="fa fa-file-text"></i>
               </div>
               <div class="header-title">
                  <h1>Quotation</h1>
                  <small>Issue New Quotation</small>
               </div>
            </section>
            <div class="content" style="background:#ffffff">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                        <div class="x_content">
                           <div class="row">
                              <?php 
                              $statement = $connect->prepare("
                                SELECT * FROM arm_quote 
                                  WHERE id = :id
                                  LIMIT 1
                              ");
                              $statement->execute(
                                array(
                                  ':id'       =>  $_GET["id"]
                                  )
                                );
                              $result = $statement->fetchAll();
                              foreach($result as $row)
                              {
                              ?>
                              <form method="post" id="invoice_form">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <tr>
                                    <td colspan="2" align="center"><h2 style="margin-top:10.5px">Edit Invoice</h2></td>
                                  </tr>
                                  <tr>
                                      <td colspan="2">
                                        <div class="row">
                                          <div class="col-md-8">
                                            To,<br />
                                              <b>RECEIVER (BILL TO)</b><br />
                                              <input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="Enter Receiver Name" value="<?php echo $row["order_receiver_name"]; ?>" /><br/>
                                              <input type="email" name="order_receiver_email" id="order_receiver_email" class="form-control input-sm" placeholder="Enter Receiver Email" value="<?php echo $row["order_receiver_email"]; ?>" /><br/>
                                              <textarea name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="Enter Billing Address"><?php echo $row["order_receiver_address"]; ?></textarea>
                                          </div>
                                          <div class="col-md-4">
                                            INVOICE NO<br />
                                            <input type="text" name="order_no" id="order_no" value="<?php echo $row["id"]; ?>" class="form-control input-sm" placeholder="Enter Invoice No." /><br/>
                                            <input type="text" name="order_date" id="order_date" class="form-control input-sm" readonly placeholder="Select Invoice Date" value="<?php echo $row["order_date"]; ?>" />
                                          </div>
                                        </div>
                                        <br />
                                        <table id="invoice-item-table" class="table table-bordered">
                                          <tr>
                                            <th width="7%">Sr No.</th>
                                            <th width="20%">Item Name</th>
                                            <th width="5%">Garnet</th>
                                            <th width="5%">GRade</th>
                                            <th width="10%">Actual Amt.</th>
                                            <th width="3%" rowspan="2"></th>
                                          </tr>
                                          <?php
                                          $statement = $connect->prepare("
                                            SELECT * FROM arm_quote_item 
                                            WHERE quote_id = :quote_id
                                          ");
                                          $statement->execute(
                                            array(
                                              ':quote_id'       =>  $_GET["id"]
                                            )
                                          );
                                          $item_result = $statement->fetchAll();
                                          $m = 0;
                                          foreach($item_result as $sub_row)
                                          {
                                            $m = $m + 1;
                                          ?>
                                          <tr>
                                            <td><span id="sr_no"><?php echo $m; ?></span></td>
                                            <td><input type="text" name="item_name[]" id="item_name<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["item_name"]; ?>" /></td>
                                            <td><input type="text" name="order_item_garnet[]" id="order_item_garnet<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_garnet" value = "<?php echo $sub_row["order_item_garnet"]; ?>"/></td>
                                            <td><input type="text" name="order_item_grade[]" id="order_item_grade<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_grade" value="<?php echo $sub_row["order_item_grade"]; ?>" /></td>
                                            <td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_actual_amount" value="<?php echo $sub_row["order_item_actual_amount"];?>" readonly /></td>
                                            
                                            <td></td>
                                          </tr>
                                          <?php
                                          }
                                          ?>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td align="right"><b>Total</td>
                                      <td align="right"><b><span id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2" align="center">
                                        <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
                                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $row["order_id"]; ?>" />
                                        <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-success" value="Update" />
                                      </td>
                                    </tr>
                                </table>
                              </div>
                            </form>
                              <?php 
                              } ?>
      
                           </div>
                        </div>
                     </div>
                     <br><br><br>
                  </div>
               </div>
            </div>
         </div>
        <?php include('includes/footer.inc');?>
      </div>
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>
      <script>
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = "<?php echo $m; ?>";
        
        $(document).on('click', '#add_row', function(){
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';
          html_code += '<td><span id="sr_no">'+count+'</span></td>';
          
          html_code += '<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';
          
          html_code += '<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
          html_code += '<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
          
          html_code += '<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
          html_code += '<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
          html_code += '<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
          html_code += '<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
          html_code += '<td><input type="text" name="order_item_tax3_rate[]" id="order_item_tax3_rate'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_tax3_rate" /></td>';
          html_code += '<td><input type="text" name="order_item_tax3_amount[]" id="order_item_tax3_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_tax3_amount" /></td>';
          html_code += '<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
          html_code += '<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td>';
          html_code += '</tr>';
          $('#invoice-item-table').append(html_code);
        });
        
        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
        });

        function cal_final_total(count)
        {
          var final_item_total = 0;
          for(j=1; j<=count; j++)
          {
            var quantity = 0;
            var price = 0;
            var actual_amount = 0;
            var tax1_rate = 0;
            var tax1_amount = 0;
            var tax2_rate = 0;
            var tax2_amount = 0;
            var tax3_rate = 0;
            var tax3_amount = 0;
            var item_total = 0;
            quantity = $('#order_item_quantity'+j).val();
            if(quantity > 0)
            {
              price = $('#order_item_price'+j).val();
              if(price > 0)
              {
                actual_amount = parseFloat(quantity) * parseFloat(price);
                $('#order_item_actual_amount'+j).val(actual_amount);
                tax1_rate = $('#order_item_tax1_rate'+j).val();
                if(tax1_rate > 0)
                {
                  tax1_amount = parseFloat(actual_amount)*parseFloat(tax1_rate)/100;
                  $('#order_item_tax1_amount'+j).val(tax1_amount);
                }
                tax2_rate = $('#order_item_tax2_rate'+j).val();
                if(tax2_rate > 0)
                {
                  tax2_amount = parseFloat(actual_amount)*parseFloat(tax2_rate)/100;
                  $('#order_item_tax2_amount'+j).val(tax2_amount);
                }
                tax3_rate = $('#order_item_tax3_rate'+j).val();
                if(tax3_rate > 0)
                {
                  tax3_amount = parseFloat(actual_amount)*parseFloat(tax3_rate)/100;
                  $('#order_item_tax3_amount'+j).val(tax3_amount);
                }
                item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
                final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
                $('#order_item_final_amount'+j).val(item_total);
              }
            }
          }
          $('#final_total_amt').text(final_item_total);
        }

        $(document).on('blur', '.order_item_price', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax1_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax2_rate', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.order_item_tax3_rate', function(){
          cal_final_total(count);
        });

        $('#create_invoice').click(function(){
          if($.trim($('#order_receiver_name').val()).length == 0)
          {
            alert("Please Enter Reciever Name");
            return false;
          }

          if($.trim($('#order_no').val()).length == 0)
          {
            alert("Please Enter Invoice Number");
            return false;
          }

          if($.trim($('#order_date').val()).length == 0)
          {
            alert("Please Select Invoice Date");
            return false;
          }

          for(var no=1; no<=count; no++)
          {
            if($.trim($('#item_name'+no).val()).length == 0)
            {
              alert("Please Enter Item Name");
              $('#item_name'+no).focus();
              return false;
            }

            if($.trim($('#order_item_quantity'+no).val()).length == 0)
            {
              alert("Please Enter Quantity");
              $('#order_item_quantity'+no).focus();
              return false;
            }

            if($.trim($('#order_item_price'+no).val()).length == 0)
            {
              alert("Please Enter Price");
              $('#order_item_price'+no).focus();
              return false;
            }

          }

          $('#invoice_form').submit(function(e){
             e.preventDefault();
              var all_res = document.getElementById('invoice_form');
              var form_data = new FormData(all_res);
              console.log(form_data);

              $.ajax({
                  url:"backend/updateinvoice.php",
                  method: "POST",
                  data: form_data,
                  contentType: false,
                  cache: false,
                  processData:false, 
                  async:false,
                  success: function(data){
                      var result = JSON.parse(data);
                      console.log(result);
                      if(result.status=='success') {
                            swal({
                              title: "Success",
                              text: "Invoice Updated successfully!!!",
                              icon: "success",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              window.location.href='quotations.php';
                            });
                      }
                      else {
                          swal({
                              title: "Failed",
                              text: "Failed to Update Invoice!!!",
                              icon: "warning",
                              buttons: true,
                              dangerMode: true,
                            })
                            .then((willDelete) => {
                              window.location.reload();
                            });
                      }
                  },
                  error: function(){
                      console.log("Network Error !!!");
                  }
              });
       });

        });

      });
      </script>
   </body>
</html>