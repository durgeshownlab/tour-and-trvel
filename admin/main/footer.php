  <!-- footer -->
        <div class="footer ">
            <div class="copyright">
                <p class="copyright">&copy; 2023 Rights Reserved by <a href='https://www.preetholiday.com/'>Preet Holiday</a>. And Designed By <a href='https://www.growbusinessforsure.com/'>GrowbusinessforSURE</a></p>
            </div>
        </div>
        <!-- #/ footer -->
    </div>
    <!-- Common JS -->
    <script src="../assets/plugins/common/common.min.js"></script>
    <!-- Custom script -->
    <script src="js/custom.min.js"></script>
    <!-- Chartjs chart -->
    <script src="../assets/plugins/chartjs/Chart.bundle.js"></script>
    <!-- Toaster js -->
    <script src="../assets/plugins/toastr/js/toastr.min.js"></script>
    <script src="../assets/plugins/toastr/js/toastr.init.js"></script>
    <!-- Custom dashboard script -->
    <script src="js/dashboard-1.js"></script>
  </body>
    <!-- jquery cdn link  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- cdn of google chart  -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $(document).ready(function(){
            console.log('jquery runing...');
            loadOrdersCount();
            loadPackagesCount();
            loadCategoryCount();
            loadBannerCount();
            loadDestinationStateCount();
            loadContactUsCount();
            
// ------------------------------------------------------------------------------
// ----------------------- on click event coding area ---------------------------
// ------------------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for Out of Stack tab ---------------------
            // ---------------------------------------------------------------------

            // code for view out of stack tab 
            $(document).on('click', '#destination-state-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'destination-state');
                console.log('view Destiantion State tab clicked');
                loadDestinationState();
            });


            // ---------------------------------------------------------------------
            // ------------------------ code end for Out of Stack tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for order tab ---------------------
            // ---------------------------------------------------------------------

            // code for view order tab 
            $(document).on('click', '#orders-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'orders');
                console.log('view Orders tab clicked');
                loadOrders();
            });

            //code for view order in pop up
            $(document).on('click', '.view-order-btn', function(e){
                e.preventDefault();
                let order_id=$(this).data('order-id');
                console.log('View order: ', order_id);
                
                $.ajax({
                    url: 'api/viewOrderDetailsApi.php',
                    type: 'POST',
                    data: {order_id: order_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            //####################################################
            // code for updating the delivery status 
            //####################################################
            $(document).on("click", "#update-payment-status-btn", function(e){
                e.preventDefault();
                if(confirm('Do you realy want to update payment status'))
                {
                    let order_id=$(this).attr('data-order-id')
                    console.log(order_id);
                    if(order_id=='')
                    {  
                        // alert("Sorry, can't revert the status");
                        warningMsg(`Something Went Wrong! Please Refresh`);
                    }
                    else
                    {
                        $.ajax({
                            url: "api/updatePaymentStatusApi.php",
                            type: "POST",
                            data: {order_id: order_id},
                            success: function(data){
                                if(data==1)
                                {
                                    loadOrders();
                                    console.log('Payment status changed to Success', order_id);
                                    successMsg(`Payment Status Changed to Success`);
                                    $.ajax({
                                        url: 'api/viewOrderDetailsApi.php',
                                        type: 'POST',
                                        data: {order_id: order_id},
                                        success: function(data){
                                            $('.modal-dialog').html(data);
                                        }
                                    });
                                }
                                else if(data==0)
                                {
                                    errorMsg(`Sorry, Failed to Change the payment Status`);
                                    console.log('failed to changed');
                                }
                                else
                                {
                                    console.log(data);
                                }
                            }
                        });
                    }
                }
            });

            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            // code for confirming or canceling the order as admin
            //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

            // code for cancel order as admin 
            $(document).on("click", "#cancel-order-admin", function(e){
                if(confirm('Do you Really want cancel order'))
                {
                    let order_id=$(this).data('order-id');
                    console.log(order_id);
                    $.ajax({
                        url: "api/cancelOrderApi.php",
                        type: "POST",
                        data: {order_id: order_id},
                        success: function(data) {
                            if(data==1)
                            {
                                loadOrders();
                                console.log('order canceled');
                                successMsg(`Order Canceled`);
                                $.ajax({
                                    url: 'api/viewOrderDetailsApi.php',
                                    type: 'POST',
                                    data: {order_id: order_id},
                                    success: function(data){
                                        $('.modal-dialog').html(data);
                                    }
                                });
                            }
                            else if(data==0)
                            {
                                console.log('order could not be canceled');
                                errorMsg('Order Couldn\'t be Canceled');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            // code for confirming order as admin 
            $(document).on("click", "#confirm-order-admin", function(e){
                if(confirm('Do you Really want Confirm order'))
                {
                    let order_id=$(this).data('order-id');
                    console.log(order_id);
                    $.ajax({
                        url: "api/confirmOrderApi.php",
                        type: "POST",
                        data: {order_id: order_id},
                        success: function(data) {
                            if(data==1)
                            {
                                loadOrders();
                                console.log('order confirmed');
                                successMsg(`Order Confirmed`);
                                $.ajax({
                                    url: 'api/viewOrderDetailsApi.php',
                                    type: 'POST',
                                    data: {order_id: order_id},
                                    success: function(data){
                                        $('.modal-dialog').html(data);
                                    }
                                });
                            }
                            else if(data==0)
                            {
                                console.log('order could not be confirmed');
                                errorMsg('Order Couldn\'t be Confirmed');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

        //  ****************************************************
        //      code  for download the invoice in pdf format
        //  ****************************************************
        $(document).on("click", ".get-invoice-btn", function(e){
            let order_id=$(this).data('order-id');
            console.log(order_id);
            var form = $('<form>', {
            method: 'POST',
            action: 'api/downloadInvoiceApi.php',
            target: '_blank' // Open the PDF in a new tab/window
            });

            // Add hidden input fields for each data item
            form.append($('<input>', {
            type: 'hidden',
            name: 'order_id',
            value: order_id
            }));
            // Append the form to the document and submit it
            form.appendTo(document.body).submit();
        });

        //***************************************************
        //      code for filter 
        //***************************************************

            //code for payment method on change
            $(document).on("change", "input[name=\"payment-mode[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let payment_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="payment-status[]"]:checked').each(function() {
                    payment_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { payment_method: payment_method, payment_status: payment_status, sort_by: sort_by, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(payment_status, payment_method, sort_by, from_date, to_date);
                        $('.orders-table').html(data);
                    }
                });
            });

            //code for delivery status on change
            $(document).on("change", "input[name=\"payment-status[]\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();
                let payment_method = [];
                let payment_status = [];
                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="payment-status[]"]:checked').each(function() {
                    payment_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { payment_method: payment_method, payment_status: payment_status, sort_by: sort_by, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(payment_status, payment_method, sort_by, from_date, to_date);
                        $('.orders-table').html(data);
                    }
                });
            });



            //  ****************************************************
            //      code for sorting the orders in admin pannel
            //  ****************************************************
            $(document).on("change", "input[name=\"sort-by\"]", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let payment_status = [];


                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="payment-status[]"]:checked').each(function() {
                    payment_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: {sort_by: sort_by, payment_method: payment_method, payment_status: payment_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(payment_status, payment_method, sort_by, from_date, to_date);

                        $('.orders-table').html(data);
                    }
                });
            });

            //  ********************************************************************
            //      code for filtering the orders by date range in admin pannel
            //  ********************************************************************
            $(document).on("click", "#filter-by-date-range", function(e){
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let payment_status = [];


                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="payment-status[]"]:checked').each(function() {
                    payment_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/sortFilterOrdersApi.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, payment_status: payment_status, from_date: from_date, to_date: to_date}, 
                    success: function(data) {
                        // console.log(data);
                        console.log(payment_status, payment_method, sort_by, from_date, to_date);

                        $('.orders-table').html(data);
                    }
                });
            });
            
            //  ****************************************************
            //      code for when search in serch bar 
            //  ****************************************************

            // when user will search in orders tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='orders')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchOrderApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.orders-table').html(data);
                        }
                    });
                }
                
            });

            // when user will search in packages tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='package')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchpackageApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.packages-table').html(data);
                        }
                    });
                }
                
            });

            // when user will search in category tab 
            $(document).on('keyup', '#search-bar', function(e){
                e.preventDefault();
                let search_for=$('#search-bar').attr('data-search-for');
                let search_text=$('#search-bar').val();
                if(search_for=='category')
                {
                    console.log(search_for+' :'+search_text);
                    $.ajax({
                        url: 'api/searchCategoryApi.php',
                        type: 'POST',
                        data: {search_text: search_text},
                        success: function(data){
                            $('.category-table').html(data);
                        }
                    });
                }
                
            });


            //  ****************************************************
            //      code  for exporting orders in excel
            //  ****************************************************
            $(document).on("click", ".export-button", function(e){
                let timestamp = new Date().getTime();
                
                let sort_by=$('input[name="sort-by"]:checked').val();

                let payment_method = [];
                let payment_status = [];

                let from_date=$('#from').val();
                let to_date=$('#to').val();

                $('input[name="payment-status[]"]:checked').each(function() {
                    payment_status.push($(this).val());
                });

                $('input[name="payment-mode[]"]:checked').each(function() {
                    payment_method.push($(this).val());
                });

                $.ajax({
                    url: 'api/exportOrdersInExcelApi.php',
                    type: 'POST',
                    data: { sort_by: sort_by, payment_method: payment_method, payment_status: payment_status, from_date: from_date, to_date: to_date}, 
                    success: function(data, status, xhr) {
                        // console.log(data);
                        console.log(payment_status, payment_method, sort_by);
                        let filename = "Orders_"+timestamp+".xls"; // Specify the desired filename here
                        let contentType = xhr.getResponseHeader('Content-Type');

                        // Create a Blob from the response data
                        let blob = new Blob([data], { type: contentType });

                        // Create a temporary anchor element and download the file
                        let link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        link.click();

                    }
                });
            });

            

            // ---------------------------------------------------------------------
            // ------------------------ code end for order tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // -------------------- code start for package tab ---------------------
            // ---------------------------------------------------------------------

            // code for view package tab 
            $(document).on('click', '#view-packages-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'package');
                console.log('view packages tab clicked');
                loadPackages();
            });

            //code for view package in pop up
            $(document).on('click', '.view-package-btn', function(e){
                e.preventDefault();
                let package_id=$(this).data('package-id');
                console.log('View package: ', package_id);
                
                $.ajax({
                    url: 'api/viewPackageDetailsApi.php',
                    type: 'POST',
                    data: {package_id: package_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete package  button 
            $(document).on('click', '.delete-package-btn', function(e){
                e.preventDefault();
                let package_id=$(this).data('package-id');
                console.log('View package: ', package_id);
                if(confirm('You realy want to delete the package'))
                {
                    $.ajax({
                        url: 'api/deletePackageApi.php',
                        type: 'POST',
                        data: {package_id: package_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the package ');
                                errorMsg("Couldn't Delete The package ");
                            }
                            else if(data==1)
                            {
                                console.log('package deleted successfully');
                                loadPackages();
                                successMsg('package Deleted Sucessfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add package form in pop up
            $(document).on('click', '#add-packages-tab', function(e){
                e.preventDefault();
                console.log('add packages tab clicked');
                
                $.ajax({
                    url: 'api/addPackagesFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // when click on add package  btn
            $(document).on("click", "#add-package-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let package_name=$("#package-name").val();
                let package_category=$("#package-category").val();
                let package_base_price=Number($("#package-base-price").val());
                let package_price=Number($("#package-price").val());
                let package_main_image=$("#package-main-image")[0].files[0];
                let package_other_image=$("#package-other-image")[0].files;

                let package_banner_image=$("#package-banner-image")[0].files[0];
                let package_duration=$("#package-duration").val();
                let package_country=$("#package-country").val();
                let package_state=$("#package-state").val();
                let package_city=$("#package-city").val();
                let package_included=$("#package-included").val();
                let package_best_month=$("#package-best-month").val();
                let package_type=$("#package-type").val();

                let package_location_link=$("#package-location-link").val();


                let package_desc=$("#package-desc").val();
                
                if(package_name=='')
                {
                    warningMsg("Please Enter package Name");
                }
                else if(package_category=='')
                {
                    warningMsg("Please Select Category");
                }
                else if(package_base_price=='')
                {
                    warningMsg("Please Enter Old Price");
                }
                else if(!isValidNumber(package_base_price))
                {
                    warningMsg("Please Enter Valid Old Price");
                }
                else if(package_price=='')
                {
                    warningMsg("Please Enter New Price");
                }
                else if(!isValidNumber(package_price))
                {
                    warningMsg("Please Enter Valid New Price");
                }
                else if(package_base_price<package_price)
                {
                    warningMsg("New Price Must be Less Than or Equal to Old price");
                }
                else if(!package_main_image)
                {
                    warningMsg("Please Select Main Image");
                }
                else if(!validateFile(package_main_image))
                {
                    warningMsg("Please Select Valid Main Image");
                }
                else if(package_other_image.length<1)
                {
                    warningMsg("Please Select Other package Image");
                }
                else if(!validateMultipleFile(package_other_image))
                {
                    warningMsg("Please Select Valid Other package Image");
                }
                else if(!package_banner_image)
                {
                    warningMsg("Please Select Banner Image");
                }
                else if(!validateFile(package_banner_image))
                {
                    warningMsg("Please Select Valid Banner Image");
                }
                else if(package_duration=='')
                {
                    warningMsg("Please Enter Tour Duration");
                }
                else if(!isValidNumber(package_duration))
                {
                    warningMsg("Please Enter Valid Tour Duration");
                }
                else if(package_duration<1)
                {
                    warningMsg("Tour Duration Must be Atleast 1 Days");
                }

                else if(package_country=='')
                {
                    warningMsg("Please Select Country");
                }

                else if(package_state=='')
                {
                    warningMsg("Please Select State");
                }
                else if(package_city=='')
                {
                    warningMsg("Please Enter City");
                }
                else if(package_included=='')
                {
                    warningMsg("Please Enter Included");
                }
                else if(package_best_month=='')
                {
                    warningMsg("Please Enter Best Month");
                }
                else if(package_type=='')
                {
                    warningMsg("Please Select Package Type");
                }
                else if(package_location_link=='')
                {
                    warningMsg("Please Enter Location iFrame Link");
                }

                else if(package_desc=='')
                {
                    warningMsg("Please Enter package Description");
                }
                
                else
                {
                    // $('#myform')[0]
                    console.log(package_name, package_price, package_base_price, package_category, package_main_image, package_other_image, package_banner_image, package_duration, package_country, package_state, package_city, package_included, package_best_month, package_type, package_location_link, package_desc);

                    
                    let formData = new FormData();
                    formData.append("package_name", package_name);
                    formData.append("package_category", package_category);
                    formData.append("package_price", package_price);
                    formData.append("package_base_price", package_base_price);
                    formData.append("package_main_image", package_main_image);
                    
                    for (let i = 0; i < package_other_image.length; i++) {
                        formData.append("package_other_image[]", package_other_image[i]);
                    }


                    formData.append("package_banner_image", package_banner_image);
                    formData.append("package_duration", package_duration);
                    formData.append("package_country", package_country);
                    formData.append("package_state", package_state);
                    formData.append("package_city", package_city);
                    formData.append("package_included", package_included);
                    formData.append("package_best_month", package_best_month);
                    formData.append("package_type", package_type);

                    formData.append("package_location_link", package_location_link);

                    formData.append("package_desc", package_desc);
            
                    $("#add-package-submit-btn").html('Saving...');
                    $("#add-package-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addPackageApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-package-submit-btn").html('Add Package');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add package Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add Package');
                                }
                                else if(data==1)
                                {
                                    $("#add-package-submit-btn").html('Add Package');
                                    loadPackages();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Package Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('package added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }

            });

            //code for update package from in pop up
            $(document).on('click', '.update-package-btn', function(e){
                e.preventDefault();
                let package_id=$(this).data('package-id');
                console.log('View package: ', package_id);
                
                $.ajax({
                    url: 'api/updatePackageFormApi.php',
                    type: 'POST',
                    data: {package_id: package_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            //code for when click on delete btn on update package popup
            $(document).on('click', '.image-delete-btn', function(e){
                e.preventDefault();
                let image_id=$(this).data('image-id');
                let package_id=$(this).data('package-id');
                console.log('delete image : ', image_id, 'for package ', package_id);
                
                $.ajax({
                    url: 'api/deletePackageImageApi.php',
                    type: 'POST',
                    data: {image_id: image_id},
                    success: function(data){
                        if(data==1) {

                            $.ajax({
                                url: 'api/loadPackageImageApi.php',
                                type: 'POST',
                                data: {package_id: package_id},
                                success: function(data){
                                    $(".other-images-container").html(data)
                                }
                            });
                        } 
                        else if(data==0) {
                            console.log('couldn\'t delete the image');
                        }
                        else
                        {
                            console.log(data);
                        }
                    }
                });
            });


            // when click on save changes button for updating the entered details
            $(document).on("click", "#update-package-submit-btn", function(e){
                e.preventDefault();
                console.log("update package clicked");
                let package_name=$("#package-name").val();
                let package_base_price=Number($("#package-base-price").val());
                let package_price=Number($("#package-price").val());
                let package_category=$("#package-category").val();
                let package_main_image=$("#package-main-image")[0].files[0];
                let package_other_image=$("#package-other-image")[0].files;
                let package_desc=$("#package-desc").val();
                let existing_package_image_path=$("#existing-package-image-path").val();
                let package_id=$(this).data('package-id');

                let package_banner_image=$("#package-banner-image")[0].files[0];
                let existing_package_banner_image_path=$("#existing-package-banner-image-path").val();
                let package_duration=$("#package-duration").val();
                let package_country=$("#package-country").val();
                let package_state=$("#package-state").val();
                let package_city=$("#package-city").val();
                let package_included=$("#package-included").val();
                let package_best_month=$("#package-best-month").val();
                let package_type=$("#package-type").val();

                let package_location_link=$("#package-location-link").val();
                
                if(package_id=='')
                {
                    errorMsg("Something Went Wrong, Please Refresh the Page");
                }
                else if(package_name=='')
                {
                    warningMsg("Please Enter package Name");
                }
                else if(package_category=='')
                {
                    warningMsg("Please Select Category");
                }
                else if(package_base_price=='')
                {
                    warningMsg("Please Enter Base Price");
                }
                else if(!isValidNumber(package_base_price))
                {
                    warningMsg("Please Enter Valid Base Price");
                }
                else if(package_price=='')
                {
                    warningMsg("Please Enter Price");
                }
                else if(!isValidNumber(package_price))
                {
                    warningMsg("Please Enter Valid Price");
                }
                else if(package_base_price<package_price)
                {
                    warningMsg("Main Price Must be Less Than or Equal to Base price");
                }
                else if(package_main_image && !validateFile(package_main_image))
                {
                    warningMsg("Please Select Valid Main Image");
                }
                else if(package_other_image.length>0 && !validateMultipleFile(package_other_image))
                {
                    warningMsg("Please Select Valid Other package Image");
                }

                else if(package_banner_image && !validateFile(package_banner_image))
                {
                    warningMsg("Please Select Valid Banner Image");
                }
                else if(package_duration=='')
                {
                    warningMsg("Please Enter Tour Duration");
                }
                else if(!isValidNumber(package_duration))
                {
                    warningMsg("Please Enter Valid Tour Duration");
                }
                else if(package_duration<1)
                {
                    warningMsg("Tour Duration Must be Atleast 1 Days");
                }
                else if(package_country=='')
                {
                    warningMsg("Please Select Country");
                }
                else if(package_state=='')
                {
                    warningMsg("Please Select State");
                }
                else if(package_city=='')
                {
                    warningMsg("Please Enter City");
                }
                else if(package_best_month=='')
                {
                    warningMsg("Please Enter Best Month");
                }
                else if(package_included=='')
                {
                    warningMsg("Please Enter Included");
                }
                else if(package_type=='')
                {
                    warningMsg("Please Select Package Type");
                }
                else if(package_location_link=='')
                {
                    warningMsg("Please Enter Google Map iFrame Link");
                }

                else if(package_desc=='')
                {
                    warningMsg("Please Enter package Description");
                }
                else
                {
                    // $('#myform')[0]
                    console.log(package_name, package_price, package_base_price, package_category, package_main_image, package_other_image, package_desc);
                    
                    let formData = new FormData();
                    formData.append("package_id", package_id);
                    formData.append("package_name", package_name);
                    formData.append("package_base_price", package_base_price);
                    formData.append("package_price", package_price);
                    formData.append("package_category", package_category);
                    formData.append("package_main_image", package_main_image);
                    
                    for (let i = 0; i < package_other_image.length; i++) {
                        formData.append("package_other_image[]", package_other_image[i]);
                    }

                    formData.append("package_banner_image", package_banner_image);
                    formData.append("existing_package_banner_image_path", existing_package_banner_image_path);
                    formData.append("package_duration", package_duration);
                    formData.append("package_country", package_country);
                    formData.append("package_state", package_state);
                    formData.append("package_city", package_city);
                    formData.append("package_included", package_included);
                    formData.append("package_best_month", package_best_month);
                    formData.append("package_type", package_type);

                    formData.append("package_location_link", package_location_link);

                    formData.append("package_desc", package_desc);
                    formData.append("existing_package_image_path", existing_package_image_path);
                    
                    $("update-package-submit-btn").html('Saving...');
                    $("update-package-submit-btn").attr('disabled', 'true');
                    $.ajax({
                        url: "api/updatePackageApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("update-package-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update package Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add package');
                                }
                                else if(data==1)
                                {
                                    $("update-package-submit-btn").html('Save Changes');
                                    loadPackages();
                                    // loadOutOfStockNotificationCount();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">package Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('package added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }

            });

            // ---------------------------------------------------------------------
            // ---------------------- code end for package tab ---------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for category tab ---------------------
            // ---------------------------------------------------------------------

            // code for view category tab 
            $(document).on('click', '#view-category-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'category');
                console.log('view package category tab clicked');
                loadCategory();
            });


            //code for view category in pop up
            $(document).on('click', '.view-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('View category: ', category_id);
                
                $.ajax({
                    url: 'api/viewCategoryDetailsApi.php',
                    type: 'POST',
                    data: {category_id: category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete category button 
            $(document).on('click', '.delete-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('delete category click : ', category_id);
                if(confirm('You realy want to delete the Category'))
                {
                    $.ajax({
                        url: 'api/deleteCategoryApi.php',
                        type: 'POST',
                        data: {category_id: category_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the category');
                                errorMsg("Couldn't Delete The Category");
                            }
                            else if(data==1)
                            {
                                console.log('Category deleted successfully');
                                loadCategory();
                                successMsg('Category Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add category form in pop up
            $(document).on('click', '#add-category-tab', function(e){
                e.preventDefault();
                console.log('add category tab clicked');
                
                $.ajax({
                    url: 'api/addCategoryFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // when click on add category  btn
            $(document).on("click", "#add-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add category clicked");
                let category_name=$("#category-name").val();
                let category_image=$("#category-image")[0].files[0];
                let category_icon=$("#category-icon")[0].files[0];
                let category_banner=$("#category-banner")[0].files[0];

                if(category_name==''){
                    warningMsg("Please Enter Category Name");
                }
                else if(!category_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else if(!category_icon){
                    warningMsg("Please Select Icon");
                }
                else if(!validateFile(category_icon)){
                    warningMsg("Please Select Valid Icon");
                }
                else if(!category_banner){
                    warningMsg("Please Select Banner Image");
                }
                else if(!validateFile(category_banner)){
                    warningMsg("Please Select Valid Banner Image");
                }
                else{
                    // $('#myform')[0]
                    console.log(category_name, category_image, category_icon, category_image);
                    
                    let formData = new FormData();
                    formData.append("category_name", category_name);
                    formData.append("category_image", category_image);
                    formData.append("category_icon", category_icon);
                    formData.append("category_banner", category_banner);
                    

                    $("#add-category-submit-btn").html('Saving...');
                    $("#add-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-category-submit-btn").html('Add Category');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Category Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add package');
                                }
                                else if(data==1)
                                {
                                    $("#add-category-submit-btn").html('Add Category');
                                    loadCategory();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Category Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('category added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update category from in pop up
            $(document).on('click', '.update-category-btn', function(e){
                e.preventDefault();
                let category_id=$(this).data('category-id');
                console.log('View Category: ', category_id);
                
                $.ajax({
                    url: 'api/updateCategoryFormApi.php',
                    type: 'POST',
                    data: {category_id: category_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on save changes button for updating the entered category details
            $(document).on("click", "#update-category-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let category_name=$("#category-name").val();
                let category_id=$("#category-id").val();
                let existing_category_image=$("#existing-category-image").val();
                let existing_category_icon=$("#existing-category-icon").val();
                let existing_category_banner=$("#existing-category-banner").val();
                let category_image=$("#category-image")[0].files[0];
                let category_icon=$("#category-icon")[0].files[0];
                let category_banner=$("#category-banner")[0].files[0];
                
                if(category_id==''){
                    errorMsg("Something Went Wrong, Please Refresh The Page");
                }
                else if(category_name==''){
                    warningMsg("Please Enter Category Name");
                }
                else if(category_image && !validateFile(category_image)){
                    warningMsg("Please Select Valid Image");
                }
                else if(category_icon && !validateFile(category_icon)){
                    warningMsg("Please Select Valid Icon");
                }
                else if(category_banner && !validateFile(category_banner)){
                    warningMsg("Please Select Valid Category Banner");
                }
                else
                {
                    console.log(category_name, category_image, category_icon, category_banner);
                    
                    let formData = new FormData();
                    formData.append("category_name", category_name);
                    formData.append("category_image", category_image);
                    formData.append("category_icon", category_icon);
                    formData.append("category_banner", category_banner);
                    formData.append("category_id", category_id);
                    formData.append("existing_category_image", existing_category_image);
                    formData.append("existing_category_icon", existing_category_icon);
                    formData.append("existing_category_banner", existing_category_banner);

                    $("#add-category-submit-btn").html('Saving...');
                    $("#add-category-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateCategoryApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-category-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Category, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update Category');
                            }
                            else if(data==1)
                            {
                                $("update-category-submit-btn").html('Save Changes');
                                loadCategory();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Category Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Category Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ---------------------- code end for category tab --------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for banners tab ---------------------
            // ---------------------------------------------------------------------

            // code for view Banner tab 
            $(document).on('click', '#view-banner-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'banner');
                console.log('view banner tab clicked');
                loadBanner();
            });


            //code for view banner in pop up
            $(document).on('click', '.view-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('View banner: ', banner_id);
                
                $.ajax({
                    url: 'api/viewBannerDetailsApi.php',
                    type: 'POST',
                    data: {banner_id: banner_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete banner button 
            $(document).on('click', '.delete-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('delete banner click : ', banner_id);
                if(confirm('You realy want to delete the Banner'))
                {
                    $.ajax({
                        url: 'api/deleteBannerApi.php',
                        type: 'POST',
                        data: {banner_id: banner_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the banner');
                                errorMsg("Couldn't Delete The Banner");
                            }
                            else if(data==1)
                            {
                                console.log('Banner deleted successfully');
                                loadBanner();
                                successMsg('Banner Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add Banner form in pop up
            $(document).on('click', '#add-banner-tab', function(e){
                e.preventDefault();
                console.log('add banner tab clicked');
                
                $.ajax({
                    url: 'api/addBannerFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });


            // when click on add Banner  btn
            $(document).on("click", "#add-banner-submit-btn", function(e){
                e.preventDefault();
                console.log("add Banner clicked");
                let banner_name=$("#banner-name").val();
                let banner_image=$("#banner-image")[0].files[0];

                let banner_text=$("#banner-text").val();
                let banner_package=$("#banner-package").val();

                if(banner_name==''){
                    warningMsg("Please Enter Banner Name");
                }
                else if(!banner_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(banner_image)){
                    warningMsg("Please Select Valid Image");
                }
                else if(banner_text==''){
                    warningMsg("Please Enter Banner Text");
                }
                else if(banner_package==''){
                    warningMsg("Please Select Package");
                }
                else{
                    // $('#myform')[0]
                    console.log(banner_name, banner_image);
                    
                    let formData = new FormData();
                    formData.append("banner_name", banner_name);
                    formData.append("banner_image", banner_image);

                    formData.append("banner_text", banner_text);
                    formData.append("banner_package", banner_package);
                    

                    $("#add-banner-submit-btn").html('Saving...');
                    $("#add-banner-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addBannerApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-banner-submit-btn").html('Add Banner');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Banner Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add Banner');
                                }
                                else if(data==1)
                                {
                                    $("#add-banner-submit-btn").html('Add Banner');
                                    loadBanner();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Banner Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('banner added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update banner from in pop up
            $(document).on('click', '.update-banner-btn', function(e){
                e.preventDefault();
                let banner_id=$(this).data('banner-id');
                console.log('View Banner: ', banner_id);
                
                $.ajax({
                    url: 'api/updateBannerFormApi.php',
                    type: 'POST',
                    data: {banner_id: banner_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on save changes button for updating the entered Banner details
            $(document).on("click", "#update-banner-submit-btn", function(e){
                e.preventDefault();
                console.log("add clicked");
                let banner_name=$("#banner-name").val();
                let banner_id=$("#banner-id").val();
                let existing_banner_image=$("#existing-banner-image").val();
                let banner_image=$("#banner-image")[0].files[0];
                
                let banner_text=$("#banner-text").val();
                let banner_package=$("#banner-package").val();

                if(banner_id==''){
                    errorMsg("Something Went Wrong, Please Refresh The Page");
                }
                else if(banner_name==''){
                    warningMsg("Please Enter Banner Name");
                }
                else if(banner_image && !validateFile(banner_image)){
                    warningMsg("Please Select Valid Image");
                }
                else if(banner_text==''){
                    errorMsg("Please Enter Banner Text");
                }
                else if(banner_package==''){
                    errorMsg("Please Select Package");
                }
                else
                {
                    console.log(banner_name, banner_image);
                    
                    let formData = new FormData();
                    formData.append("banner_name", banner_name);
                    formData.append("banner_image", banner_image);
                    formData.append("banner_id", banner_id);
                    formData.append("existing_banner_image", existing_banner_image);

                    formData.append("banner_text", banner_text);
                    formData.append("banner_package", banner_package);

                    $("#add-banner-submit-btn").html('Saving...');
                    $("#add-banner-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateBannerApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-banner-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Banner, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update banner');
                            }
                            else if(data==1)
                            {
                                $("update-banner-submit-btn").html('Save Changes');
                                loadBanner();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Banner Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Banner Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ---------------------- code end for banner tab --------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for destination state tab ---------------------
            // ---------------------------------------------------------------------

            // code for view Banner tab 
            $(document).on('click', '#view-destination-state-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'destination-state');
                console.log('view destination state tab clicked');
                loadDestinationState();
            });


            //code for view banner in pop up
            $(document).on('click', '.view-destination-state-btn', function(e){
                e.preventDefault();
                let destination_state_id=$(this).data('destination-state-id');
                console.log('View Destination State: ', destination_state_id);
                
                $.ajax({
                    url: 'api/viewDestinationStateDetailsApi.php',
                    type: 'POST',
                    data: {destination_state_id: destination_state_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // code for user click on delete banner button 
            $(document).on('click', '.delete-destination-state-btn', function(e){
                e.preventDefault();
                let destination_state_id=$(this).data('destination-state-id');
                console.log('delete destination state click : ', destination_state_id);
                if(confirm('You realy want to delete this destination state'))
                {
                    $.ajax({
                        url: 'api/deleteDestinationStateApi.php',
                        type: 'POST',
                        data: {destination_state_id: destination_state_id},
                        success: function(data){
                            if(data==0)
                            {
                                console.log('couldn\'t delete the destination state');
                                errorMsg("Couldn't Delete The Destination State");
                            }
                            else if(data==1)
                            {
                                console.log('Destination State deleted successfully');
                                loadDestinationState();
                                successMsg('Destination State Deleted Successfully');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for add Banner form in pop up
            $(document).on('click', '#add-destination-state-tab', function(e){
                e.preventDefault();
                console.log('add destination state tab clicked');
                
                $.ajax({
                    url: 'api/addDestinationStateFormApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on add Banner  btn
            $(document).on("click", "#add-destination-state-submit-btn", function(e){
                e.preventDefault();
                console.log("add Destination state clicked");

                let destination_state_id=$("#destination-state-id").val();
                let destination_state_text=$("#destination-state-text").val();

                let destination_state_min_temp=$("#destination-state-min-temp").val();
                let destination_state_max_temp=$("#destination-state-max-temp").val();

                let destination_state_image=$("#destination-state-image")[0].files[0];
                let destination_state_banner=$("#destination-state-banner")[0].files[0];


                if(destination_state_id==''){
                    warningMsg("Please Select State Name");
                }
                else if(destination_state_text==''){
                    warningMsg("Please Enter State Text");
                }
                else if(destination_state_min_temp==''){
                    warningMsg("Please Enter Min Temp");
                }
                else if(destination_state_max_temp==''){
                    warningMsg("Please Enter Max Temp");
                }

                else if(!destination_state_image){
                    warningMsg("Please Select Image");
                }
                else if(!validateFile(destination_state_image)){
                    warningMsg("Please Select Valid Image");
                }
                else if(!destination_state_banner){
                    warningMsg("Please Select Banner Image");
                }
                else if(!validateFile(destination_state_banner)){
                    warningMsg("Please Select Valid Banner Image");
                }
                else{
                    // $('#myform')[0]
                    console.log(destination_state_id, destination_state_text, destination_state_min_temp, destination_state_max_temp, destination_state_image, destination_state_banner);
                    
                    let formData = new FormData();
                    formData.append("destination_state_id", destination_state_id);
                    formData.append("destination_state_text", destination_state_text);

                    formData.append("destination_state_min_temp", destination_state_min_temp);
                    formData.append("destination_state_max_temp", destination_state_max_temp);

                    formData.append("destination_state_image", destination_state_image);
                    formData.append("destination_state_banner", destination_state_banner);
                    
                    $("#add-destination-state-submit-btn").html('Saving...');
                    $("#add-destination-state-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/addDestinationStateApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#add-destination-state-submit-btn").html('Add Banner');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Add Destination State Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                    `);
                                    console.log('Failed to Add Destination State');
                                }
                                else if(data==1)
                                {
                                    $("#add-destination-state-submit-btn").html('Add Destination State');
                                    loadDestinationState();
                                    $('.modal-dialog').html(`
                                    <div class="modal-content">
                                    <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Destination State Added Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('destination state added');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });

            //code for loading update banner from in pop up
            $(document).on('click', '.update-destination-state-btn', function(e){
                e.preventDefault();
                let destination_state_id=$(this).data('destination-state-id');
                console.log('View Destination state: ', destination_state_id);
                
                $.ajax({
                    url: 'api/updateDestinationStateFormApi.php',
                    type: 'POST',
                    data: {destination_state_id: destination_state_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            // when click on save changes button for updating the entered Banner details
            $(document).on("click", "#update-destination-state-submit-btn", function(e){
                e.preventDefault();
                console.log("add destination state clicked");


                let destination_state_row_id=$("#destination-state-row-id").val();
                
                let destination_state_id=$("#destination-state-id").val();
                let destination_state_text=$("#destination-state-text").val();

                let destination_state_min_temp=$("#destination-state-min-temp").val();
                let destination_state_max_temp=$("#destination-state-max-temp").val();

                let destination_state_image=$("#destination-state-image")[0].files[0];
                let destination_state_banner=$("#destination-state-banner")[0].files[0];

                let existing_destination_state_image=$("#existing-destination-state-image").val();
                let existing_destination_state_banner=$("#existing-destination-state-banner").val();

                if(destination_state_row_id==''){
                    errorMsg("Something Went Wrong, Please Refresh The Page");
                }
                else if(destination_state_id==''){
                    warningMsg("Please Select State");
                }
                else if(destination_state_text==''){
                    warningMsg("Please Enter State Text");
                }
                else if(destination_state_min_temp==''){
                    warningMsg("Please Enter Min Temp");
                }
                else if(destination_state_max_temp==''){
                    warningMsg("Please Enter Max Temp");
                }

                else if(destination_state_image && !validateFile(destination_state_image)){
                    warningMsg("Please Select Valid State Image");
                }
                else if(destination_state_banner && !validateFile(destination_state_banner)){
                    warningMsg("Please Select Valid State Banner");
                }
                else
                {
                    console.log(destination_state_row_id, destination_state_id, destination_state_text, destination_state_min_temp, destination_state_max_temp, destination_state_image, destination_state_banner, existing_destination_state_image, existing_destination_state_banner);
                    
                    let formData = new FormData();

                    formData.append("destination_state_row_id", destination_state_row_id);

                    formData.append("destination_state_id", destination_state_id);
                    formData.append("destination_state_text", destination_state_text);

                    formData.append("destination_state_min_temp", destination_state_min_temp);
                    formData.append("destination_state_max_temp", destination_state_max_temp);

                    formData.append("destination_state_image", destination_state_image);
                    formData.append("destination_state_banner", destination_state_banner);

                    formData.append("existing_destination_state_image", existing_destination_state_image);
                    formData.append("existing_destination_state_banner", existing_destination_state_banner);


                    $("#add-destination-state-submit-btn").html('Saving...');
                    $("#add-destination-state-submit-btn").attr('disabled', true);

                    $.ajax({
                        url: "api/updateDestinationStateApi.php",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            if(data==0)
                            {
                                $("#update-destination-state-submit-btn").html('Save Changes');
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Failed</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-danger">Failed to Update Destination State, Please Try Again</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Failed to update Destination State');
                            }
                            else if(data==1)
                            {
                                $("update-destination-state-submit-btn").html('Save Changes');
                                loadDestinationState();
                                $('.modal-dialog').html(`
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Successfull</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <h2 class="text-center text-success">Destination State Updated Successfully</h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                `);
                                console.log('Destination State Updated');
                            }
                            else
                            {
                                console.log(data);
                            }
                        }
                    });
                }
            });


            // ---------------------------------------------------------------------
            // ---------------------- code end for destination state tab --------------------
            // ---------------------------------------------------------------------

            // ---------------------------------------------------------------------
            // ---------------------- code start for contact us tab ---------------------
            // ---------------------------------------------------------------------

            // code for view contact us tab 
            $(document).on('click', '#contact-us-tab', function(e){
                e.preventDefault();
                $("#search-bar").attr('data-search-for', 'contact-us');
                console.log('view contact us tab clicked');
                loadContactUs();
            });


            //code for view contact us in pop up
            $(document).on('click', '.view-contact-us-btn', function(e){
                e.preventDefault();
                let contact_us_id=$(this).data('contact-us-id');
                console.log('View Contact Us: ', contact_us_id);
                
                $.ajax({
                    url: 'api/viewContactUsDetailsApi.php',
                    type: 'POST',
                    data: {contact_us_id: contact_us_id},
                    success: function(data){
                        $('.modal-dialog').html(data);
                    }
                });
            });

            


            // ---------------------------------------------------------------------
            // ---------------------- code end for Contact us tab --------------------
            // ---------------------------------------------------------------------

            


// ------------------------------------------------------------------------------
// ----------------------- function coding area --------------------------------- 
// ------------------------------------------------------------------------------
            // function for loading the Orders 
            function loadOrders()
            {
                $.ajax({
                    url: 'api/loadOrdersApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the out of stock  
            function loadOutOfStock()
            {
                $.ajax({
                    url: 'api/loadOutOfStockApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the package 
            function loadPackages()
            {
                $.ajax({
                    url: 'api/loadPackagesApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Category  
            function loadCategory()
            {
                $.ajax({
                    url: 'api/loadCategoryApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Banner  
            function loadBanner()
            {
                $.ajax({
                    url: 'api/loadBannerApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Destination state  
            function loadDestinationState()
            {
                $.ajax({
                    url: 'api/loadDestinationStateApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }

            // function for loading the Contact us  
            function loadContactUs()
            {
                $.ajax({
                    url: 'api/loadContactUsApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.fluid-container').html(data);
                    }
                });
            }


            // function for validating the file wheather it is valid file or not 
            function validateFile(file) {
                // Check file type (for example, allow only images)
                var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/bmp", "image/tiff", "image/jpg"];
                if (!allowedTypes.includes(file.type)) {
                    return false;
                }
                // Check file size (for example, limit it to 2MB)
                var maxSizeMB = 5;
                var maxSizeBytes = maxSizeMB * 1024 * 1024;
                if (file.size > maxSizeBytes) {
                    return false;
                }
                // Additional checks can be added here as needed.
                return true;
            }

            // function for validating the file wheather it is valid file or not 
            function validateMultipleFile(files) {
                // Check file type (for example, allow only images)
                var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp", "image/bmp", "image/tiff", "image/jpg"];

                for (let i = 0; i < files.length; i++) {
                    
                    if (!allowedTypes.includes(files[i].type)) {
                        return false;
                    }
                    // Check file size (for example, limit it to 5MB)
                    var maxSizeMB = 5;
                    var maxSizeBytes = maxSizeMB * 1024 * 1024;
                    if (files[i].size > maxSizeBytes) {
                        return false;
                    }
                    
                }
                return true;
            }
    
            // function for validate the name 
            function validateName(name) {
                // Regular expression to check if the name contains any numbers
                const regex = /\d/;
                if (regex.test(name)) {
                    // Name contains a number, so it is not valid
                    return false;
                }
                // Name does not contain any numbers, so it is valid
                return true;
            }
    
            //finction to validate the num,ber
            function isValidNumber(str) {
                // Regular expression to match a number (integer or decimal)
                // var numberPattern = /@[-+]?\d+(\.\d+)?$/;
                var numberPattern = /^[1-9]\d*$/;
                return numberPattern.test(str);
            }

            // code for sucess toast 
            function successMsg(msg)
            {
                toastr.success(msg, "Success", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            // code for error toast 
            function errorMsg(msg)
            {
                toastr.error(msg, "Error", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            // code for warning toast 
            function warningMsg(msg)
            {
                toastr.warning(msg, "Warning", {
                    positionClass: "toast-top-center",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                });
            }

            
            // function for loading the orders count
            function loadOrdersCount()
            {
                $.ajax({
                    url: 'api/loadOrdersCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.orders-count').html(data);
                    }
                });
            }

            // function for loading the packages count
            function loadContactUsCount()
            {
                $.ajax({
                    url: 'api/loadContactUsCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.contact-us-count').html(data);
                    }
                });
            }

            // function for loading the out of stock count
            function loadDestinationStateCount()
            {
                $.ajax({
                    url: 'api/loadDestinationStateCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.destination-state-count').html(data);
                    }
                });
            }

            // function for loading the packages count
            function loadPackagesCount()
            {
                $.ajax({
                    url: 'api/loadPackagesCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.packages-count').html(data);
                    }
                });
            }

            // function for loading the category count
            function loadCategoryCount()
            {
                $.ajax({
                    url: 'api/loadCategoryCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.category-count').html(data);
                    }
                });
            }

            // function for loading the Banner count
            function loadBannerCount()
            {
                $.ajax({
                    url: 'api/loadBannerCountApi.php',
                    type: 'POST',
                    data: {},
                    success: function(data){
                        $('.banner-count').html(data);
                    }
                });
            }

        });

    
    </script>

</body>

</html>