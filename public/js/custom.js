$(document).on('click','#new-product',function(){
    $('.create-product-form').show();
});
// function to close parent div for buttons
function closeParent4()
{
    $(this).parent().parent().parent().parent().hide();
}
function closeParent3()
{
    $(this).parent().parent().parent().hide();
}
// 2 parents
function closeParent2()
{
    $(this).parent().parent().hide();
}

// single parent
function closeParent()
{
    $(this).parent().hide();
}

/*$(document).on('click','.close-new-purchase',function(){
    $('.new-purchase-record').hide();
});*/

$('.close-session-msg').on('click',function(){
    $(this).parent().parent().parent().hide();
});

//show more links
function ShowMore(id)
{
    $('#'+id).show();
}

//function close
function Close(cls)
{
    $('.'+cls).hide();
}

// show div
function ShowDiv(cls)
{
    $('.'+cls).show();
}
// hide if not clicked
$(document).mouseup(function(e) 
{
    var container = $(".more");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
    }
});

// search product from the products table
$(document).on('keyup','#search-product',function(){
    var text = $(this).val();
    if(text.length >=1){
        $('.search-results-display').show();
        $.ajax({
            url:'/product/search',
            data:{
                text:text
            },
            dataType:'json',
            beforeSend:function(){
                $('.search-results-display').html('Loading...');
            },
            success:function(res){
                var dataxx='';
                var row ="";
                $.each(res.quantities,function(index,qty)
                {
                    dataxx += 
                    "<div class='header results-list p-2' qty='"+qty.id+"'>"+
                        qty.product_name+" "+
                        qty.product_quantity+" "+qty.product_units+" "+
                        qty.product_price+
                    "</div>";
                   
                })
                $('.search-results-display').html(dataxx);
            }
        });
    }else{
        $('.search-results-display').hide();
    }
})

$(document).on('click','#new-purchase-record',function(){
    $('.new-purchase-record').show();
});

const sales_amount = [];

$(document).on('click','.results-list',function(){
    // show some transaction areas
    $('.sales-balance').show();
    $('.amount-paid').show();
   var id = $(this).attr('qty');
   $('#search-product').val('');
   $('.search-results-display').hide();
   findItem(id);
});

function totAmount(qty,rate)
{
    amount = qty * parseFloat(rate)
    amount = parseFloat(amount);
    //return amount;
    console.log(amount);
}
/**
 * find the item clicked
 */
function findItem(id)
{
    $.ajax({
        url:'/item/load',
        data:{
            id:id
        },
        success:function(res){
            var row ='';
            var price = 0;
            var cost = 0;
            $.each(res.data,function(index,item){
                cost = item.product_cost;
                row = "<tr>"+
                        "<td><input type='hidden' name='product_id[]' value='"+item.product_id+"'>"+item.product_id+"</td>"+
                        "<td><input type='hidden' name='product_name[]' value='"+item.product_name+"'>"+item.product_name+"</td>"+
                        "<td><input type='hidden' name='product_quantity[]' value='"+item.product_quantity+"'>"+item.product_quantity+"</td>"+
                        "<td><input type='text' name='product_multiples[]' class='custom-input multiple' required></td>"+
                        "<td><input type='hidden' value='"+item.product_price+"' class='rate'>"+item.product_price+"</td>"+
                        "<td><input type='hidden' name='product_price[]' class='product_price'><span class='td-amount'>"+item.product_price+"</span></td>"+
                        "<td><input type='hidden' name='product_qty_cost[]' value='"+cost+"'></td>"+
                      "</tr>";
                price = item.product_price;
                
                //alert(cost);
            });
            $('.sales-table-area').append(row);
            sales_amount.push(price);
            // claculate the total amount
           var amount =  sales_amount.reduce(CalculateTotalAmount);
           $('.sales_amount').html(amount.toLocaleString());
           $('#sales_amount').val(amount);// the input to post data
        }
    });
}

// check on entering a multiple value in a table
$(document).on('keyup','.multiple',function(){
    var value = $(this).val();
    var rate = $(this).closest('tr').find('.rate').val();
    var td_amount = $(this).closest('tr').find('.td-amount');
    var amount_val_val = $(this).closest('tr').find('.product_price');

    var calculated = AmountCalculator(rate,value,sales_amount);
    amount_val_val.val(calculated);
    td_amount.html(calculated);// displayed amount in td

    //amount_val.val(AmountCalculator(rate,value,sales_amount));//hidden amount for input submission
});

//Calculate Item amount
function AmountCalculator(rate,multiple,array)
{
    var amount = parseFloat(rate) * multiple;
    var lessamount = parseFloat(amount) - parseFloat(rate);
    array.push(lessamount);
    var totamount =  array.reduce(CalculateTotalAmount);
    $('.sales_amount').html(totamount.toLocaleString());
    $('#sales_amount').val(totamount);// the input to post data
    return parseFloat(amount);
}


function CalculateTotalAmount(total, value, index, array) {
    return total + value;
}

  /**
   * calculate balance
   */
  function CalculateBalance(paid)
  {
      var amount = sales_amount.reduce(CalculateTotalAmount);
      var balance = parseFloat(paid) - parseFloat(amount);
      return balance;
  }

  /**
   * show balance on keyup
   */
  $(document).on('keyup','#amount-paid',function(){
      var paid = $(this).val();
      var amount = sales_amount.reduce(CalculateTotalAmount);
    $('.sales_balance').html(CalculateBalance(paid).toLocaleString());

    // calculate the credtor balance after paying some amount for the sales
      var creditor_balance = parseFloat(amount) - parseFloat(paid);
     $('#balance_unpaid').val(creditor_balance);
  });

 /**
  * calculate total-balance after sales and expenses
  */
  function actualBalance(sales,expense)
  {
      var balance = parseFloat(sales) - parseFloat(expense);
      return balance;
  }

  // calculate product cost price
  $(document).on('blur','#qty',function(){
      var value = $(this).val();
      var unit_cost = $('#product_cost').val();

      var qty_cost = value * unit_cost;
      $('#product_qty_cost').val(qty_cost);
  });

  /**
   * display reports basing on the date selected
   */

  $(document).on('change','#report_start_date',function(){
    var date = $(this).val();
    const total_sales =[];// yo get total sales value
    const total_expenses =[]; // get total expenses
    const credit_sales =[];
    var user_role = $('#user_role').val();

// check user level before producing an alert message

    if(user_role !='') // if user has admin levels
    { 

        xdialog.confirm('<h4>Do you want to get an end date?</h4>',function(){
            // if okay is clicked
            $('.sales-report').html("");
            $('.expense-report').html("");
            $('#day-balance').html("");
            if(user_role)
            {
                $('.admin-report-end-date').show();
                $(document).on('change','#report_end_date',function(){
                    var date2 = $(this).val();
                    fullReport(date,date2,total_sales,total_expenses,credit_sales);// generate full report
                });
            }else{
                xdialog.alert("You don't have the necessary Rights");
            }
            
        },{
            oncancel:function(){ //if cancel has been clicked
                // call a function to generate report
                $('.admin-report-end-date').hide();
                singleReport(date,total_sales,total_expenses,total_expenses,credit_sales);
            }
        });
    }
    
    singleReport(date,total_sales,total_expenses,credit_sales);
});

  // generate a single day report
    function singleReport(date,total_sales,total_expenses,credit_sales)
    {
        
        // send an ajax call
        $.ajax({
            url:'/report/single',
            data:{
                start_date:date
            },
            beforeSend:function(){
                $('.sales-report').html("<h4 class='center'>Loading...</h4>");
                $('.expense-report').html("<h4 class='center'>Loading...</h4>");
            },
            success:function(res){
                var product_name ='';
                credit_sales = [];
                const payments_received =[];
                var row ="<table class='table table-sm table-striped sales-table'>"+
                            "<thead class=''>"+
                                "<tr>"+
                                    "<th>Item Name</th>"+
                                    "<th>Qty</th>"+
                                    "<th colspan='2'>Amount</th>"+
                                "</tr>"
                            "</thead>"+
                        "<tbody>";
                
                if(res.sales !=''){
                    //console.log(res.sales);
                    /**
                     * sales section display
                     */
                    // first empty the array to remove any infomation
                     total_sales =[];
                     var type='';
                    $.each(res.sales,function(index,data){
                            product_name = data.product.product_name;

                            if(data.sale_type =='Credit_sale')
                            {
                                type = data.sale_type;
                            }
                            row +="<tr>"+
                                    "<td>"+product_name+"</td>"+
                                    "<td>"+data.quantity+"</td>"+
                                    "<td>"+data.price+"</td>"+
                                    "<td>"+type+"</td>"+
                                "</tr>";
                            //console.log(data.product.product_name);
                            // check credit sales
                            if(data.sale_type =='Credit_sale')
                            {
                                credit_sales.push(data.price);
                            }

                            total_sales.push(data.price);
                    
                    });

                    // include payments received
                    if(res.payments !='')
                    {
                        $.each(res.payments,function(index,payment){
                            payments_received.push(payment.amount);
                        });
                        row += "<tr>"+
                                    "<td><b>TOTAL SALES</b></td>"+
                                    "<td></td>"+
                                    "<td>"+total_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td><b>Payments Received</b></td>"+
                                    "<td></td>"+
                                    "<td>"+payments_received.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>";
                        // add the amount to sales to get a full total
                        total_sales.push(payments_received.reduce(CalculateTotalAmount));
                        
                    }
                    
                    row += "<tr>"+
                                    "<td><b>TOTAL INCOME</b></td>"+
                                    "<td></td>"+
                                    "<td>"+total_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                            "</tr>"+
                        "</tbody>";
                        $('.sales-report').html(row);
                        
                }else{
                    // include payments received
                    if(res.payments !='')
                    {
                        $.each(res.payments,function(index,payment){
                            payments_received.push(payment.amount);
                        });

                        row += "<tr>"+
                                    "<td><b>Payments Received</b></td>"+
                                    "<td></td>"+
                                    "<td>"+payments_received.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>";

                       // push to sales array         
                        all_sales.push(payments_received.reduce(CalculateTotalAmount));
                        row += "<tr>"+
                                    "<td><b>TOTAL INCOME</b></td>"+
                                    "<td></td>"+
                                    "<td>"+all_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>"+
                            "</tbody>";
                        $('.sales-report').html(row);
                    }

                    $('.sales-report').html("<div class='alert alert-warning'><h5>No data available for the selected date</h5></div>");
                    //xdialog.warn("<h5>No data available for the selected date</h5>");
                }
                /**
                 * expenditure section
                 */
            var rowexp ="<table class='table table-sm table-striped sales-table'>"+
                        "<thead class=''>"+
                            "<tr>"+
                                "<th>Item Name</th>"+
                                "<th>Qty</th>"+
                                "<th>Amount</th>"+
                            "</tr>"
                        "</thead>"+
                    "<tbody>";

                if(res.expenses !=''){
                        
                        /**
                         * expenses section display
                         */
                         total_expenses = []; // empty the arrau to remove any data
                        var item_name ="";
                        $.each(res.expenses,function(index,data){
                                item_name = data.expense_item.item_name;
                                
                                rowexp +="<tr>"+
                                        "<td>"+item_name+"</td>"+
                                        "<td>"+data.description+"</td>"+
                                        "<td>"+data.amount+"</td>"+
                                    "</tr>";
                                //console.log(data.product.product_name);
                                
                                total_expenses.push(data.amount);
                                
                        });
                    
                        //check if credit sales are available
                        if(credit_sales.length >0)
                        {
                            rowexp += "<tr>"+
                                        "<td><b>Credit_sales</b></td>"+
                                        "<td></td>"+
                                        "<td>"+credit_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>";
                        // add sales on credit amounts
                            total_expenses.push(credit_sales.reduce(CalculateTotalAmount));
                        }
                        
                        rowexp += "<tr>"+
                                        "<td><b>TOTAL EXPENSES</b></td>"+
                                        "<td></td>"+
                                        "<td>"+total_expenses.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>"+
                            "</tbody>";
                    
                    $('.expense-report').html(rowexp);

                }else{// if no data is available
                        
                        //xdialog.warn("<h5>No data available for the selected date</h5>");
                        if(total_expenses.length == 0)
                        {
                            total_expenses.push(0);
                        }
                        // check if the total expense array does not have a value
                        if(total_expenses.reduce(CalculateTotalAmount) == 0)
                        {
                            if(credit_sales.length > 0)
                            {
                                rowexp += "<tr>"+
                                            "<td><b>Credit Sales</b></td>"+
                                            "<td></td>"+
                                            "<td>"+credit_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                    "</tr>"+
                                "</tbody>";
                                total_expenses.push(credit_sales.reduce(CalculateTotalAmount)); 

                                $('.expense-report').html(rowexp);
                            }
                                $('.expense-report').html("<div class='alert alert-warning'><h5>No data available for the selected date</h5></div>");
                        }
                        $('.expense-report').html("<div class='alert alert-warning'><h5>No data available for the selected date</h5></div>");
                }

                // get actual balance
                var tot_sales = total_sales.reduce(CalculateTotalAmount);
                var tot_expense = total_expenses.reduce(CalculateTotalAmount);
                var actualBalances = actualBalance(tot_sales,tot_expense);// get the actual balance here
                $('#day-balance').html(actualBalances.toLocaleString()+"/=");
            }
        });
    }

    /**
     * full report for admins
     */

     function fullReport(date1,date2,all_sales,all_expenses,credit_sales)
     {
         // send an ajax call
         $.ajax({
             url:'/report/full',
             data:{
                 start_date:date1,
                 end_date:date2
             },
             beforeSend:function(){
                 $('.sales-report').html("<h4 class='center'>Loading...</h4>");
                 $('.expense-report').html("<h4 class='center'>Loading...</h4>");
             },
             success:function(res){
                var product_name ='';
                credit_sales =[];
                type='';
                const payments_received =[];
                var row ="<table class='table table-sm table-striped sales-table'>"+
                            "<thead class=''>"+
                                "<tr>"+
                                    "<th>Item Name</th>"+
                                    "<th>Qty</th>"+
                                    "<th colspan='2'>Amount</th>"+
                                "</tr>"
                            "</thead>"+
                        "<tbody>";
                
                if(res.sales !=''){
                    
                    /**
                     * sales section display
                     */
                    // first empty the array to remove any infomation
                     all_sales =[];
                    $.each(res.sales,function(index,data){
                            product_name = data.product.product_name;
                            
                            if(data.sale_type =='Credit_sale')
                            {
                                type = data.sale_type;
                            }
                            row +="<tr>"+
                                    "<td>"+product_name+"</td>"+
                                    "<td>"+data.quantity+"</td>"+
                                    "<td>"+data.price+"</td>"+
                                    "<td>"+type+"</td>"+
                                "</tr>";
                            //console.log(data.product.product_name);
                            // check for the credit sales
                            if(data.sale_type =='Credit_sale')
                            {
                                credit_sales.push(data.price);
                            }
                            all_sales.push(data.price);
                    
                    });
                    // include payments received
                    if(res.payments !='')
                    {
                        $.each(res.payments,function(index,payment){
                            payments_received.push(payment.amount);
                        });

                        row += "<tr>"+
                                    "<td><b>Payments Received</b></td>"+
                                    "<td></td>"+
                                    "<td>"+payments_received.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>";
                        // add the amount to sales to get a full total
                            all_sales.push(payments_received.reduce(CalculateTotalAmount));
                    }
                    
                    row += "<tr>"+
                                    "<td><b>TOTAL INCOME</b></td>"+
                                    "<td></td>"+
                                    "<td>"+all_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                            "</tr>"+
                        "</tbody>";
                        $('.sales-report').html(row);
                        
                }else{
                    // include payments received
                    if(res.payments !='')
                    {
                        $.each(res.payments,function(index,payment){
                            payments_received.push(payment.amount);
                        });

                        row += "<tr>"+
                                    "<td><b>Payments Received</b></td>"+
                                    "<td></td>"+
                                    "<td>"+payments_received.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>";
                       // push to sales array         
                        all_sales.push(payments_received.reduce(CalculateTotalAmount));
                        row += "<tr>"+
                                    "<td><b>TOTAL INCOME</b></td>"+
                                    "<td></td>"+
                                    "<td>"+all_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>"+
                            "</tbody>";
                        $('.sales-report').html(row);
                    }
                    
                    $('.sales-report').html("<div class='alert alert-warning'><h5>No data available for the selected date</h5></div>");
                    

                }
                /**
                 * expenditure section
                 */
            var rowexp ="<table class='table table-sm table-striped sales-table'>"+
                        "<thead class=''>"+
                            "<tr>"+
                                "<th>Item Name</th>"+
                                "<th>Qty</th>"+
                                "<th>Amount</th>"+
                            "</tr>"
                        "</thead>"+
                    "<tbody>";

                if(res.expenses !=''){
                        
                        /**
                         * expenses section display
                         */
                         all_expenses = []; // empty the arrau to remove any data
                        var item_name ="";
                        $.each(res.expenses,function(index,data){
                                item_name = data.expense_item.item_name;
                                
                                rowexp +="<tr>"+
                                        "<td>"+item_name+"</td>"+
                                        "<td>"+data.description+"</td>"+
                                        "<td>"+data.amount+"</td>"+
                                    "</tr>";
                                //console.log(data.product.product_name);
                                
                                all_expenses.push(data.amount);
                                
                        });
                        if(credit_sales.length > 0) // check if credit sales array has some values and create a row
                        {
                            rowexp += "<tr>"+
                            "<td><b>Credit_sales</b></td>"+
                                "<td></td>"+
                                "<td>"+credit_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                        "</tr>";
                            all_expenses.push(credit_sales.reduce(CalculateTotalAmount));
                        }
                       
                        rowexp += "<tr>"+
                                        "<td><b>TOTAL EXPENSES</b></td>"+
                                        "<td></td>"+
                                        "<td>"+all_expenses.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                                "</tr>"+
                            "</tbody>";
                    
                    $('.expense-report').html(rowexp);

                }else{// if no data is available
                        $('.expense-report').html("<div class='alert alert-warning'><h5>No data available for the selected date</h5></div>");
                        //xdialog.warn("<h5>No data available for the selected date</h5>");
                        if(all_expenses.length == 0)
                        {
                            all_expenses.push(0);
                        }
                    rowexp += "<tr>"+
                                "<td><b>Credit Sales</b></td>"+
                                "<td></td>"+
                                "<td>"+credit_sales.reduce(CalculateTotalAmount).toLocaleString()+"/=</td>"+
                        "</tr>"+
                    "</tbody>";
                    all_expenses.push(credit_sales.reduce(CalculateTotalAmount));
                    $('.expense-report').html(rowexp);
                }


                // get actual balance
                var tot_sales = all_sales.reduce(CalculateTotalAmount);
                var tot_expense = all_expenses.reduce(CalculateTotalAmount);
                var actualBalances = actualBalance(tot_sales,tot_expense);// get the actual balance here
                $('#day-balance').html(actualBalances.toLocaleString()+"/=");
            
             }
         });
     }

     // show password toggle
     function ShowPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

//filter creditor list
    $("#search-creditor").on("keyup",function() {
        
      var value = $(this).val().toString().toLowerCase();
      $("#creditor-body .nav-link").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  
// payments receiving codes
$(document).on('change','#payment-item-select',function(){
    var value = $(this).val();
    if(value == 'creditor')
    {
        $('.creditors').show();
        $('.others').hide();
        $('#payment_item').val('creditors');
        // call a function to load active creditors
        LoadCreditors();
    }else{
        $('.creditors').hide();
        $('.others').show();
        $('.received_from').show();
        $('#payment_item').val('');
    }
});

function LoadCreditors(){
    $.ajax({
        url:'/creditors/load',
        dataType:'json',
        success:function(res){
            var option ="<option value='' hidden> Select Creditor</option>";
            $.each(res.data,function(index,opt){
                option += "<option value='"+opt.id+"'>"+opt.name+"<span class='right'>"+opt.balance+"</span></option>";
            });
            $('#payment-creditor-select').html(option);
        }
    });
}

// display administrator periodic report
$(document).on('change','#admin_start-date',function(){
    var start_date = $(this).val();
    $('.show-end-date').show();
    
    // load report on clicking the end date
    $(document).on('change','#admin_end_date',function(){
        var end_date = $(this).val();
        AdminGeneralReport(start_date,end_date);
    });
    
});

// generate admin report function
function AdminGeneralReport(date1,date2)
{
    // call ajax function
    $.ajax({
        url:'/general/report',
        data:{
            start_date:date1,
            end_date:date2
        },
        dataType:'json',
        beforeSend:function(){
            $('.admin-general-report').html("<img class='loader' src='/images/loadingspinners.gif'/>");
        },
        success:function(res){
            // check purchases
            var purRow ='';
            $.each(res.purchases,function(index,purchase){
                purRow ="<div class='p-2'>{{"+purchase+"->product->product_name}}</div>";
            });
            $('.admin-general-report').html(purRow);
        }
    });
}

// delete user function
function deleteUser(id)
{
    $.ajax({
        url:"user/delete",
        data:{
            id:id
        },
        success:function(res){
            xdialog.alert('User deleted successfully');
        }
    });
}

// delete user function
function deleteRecord(id,link,redirect)
{
    $.ajax({
        url:link,
        data:{
            id:id
        },
        success:function(res){
            xdialog.alert('Record deleted successfully');
            window.location= redirect;
        }
    });
}

//// delete user function
function deleteChild(parentid,childid,link,redirect)
{
    $.ajax({
        url:link,
        data:{
            parent:parentid,
            child:childid
        },
        success:function(res){
            window.location= redirect;
            xdialog.alert('Record deleted successfully');
        }
    });
}