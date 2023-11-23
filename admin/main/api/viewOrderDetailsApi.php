<?php

include("_session_start.php");
include("_dbconnect.php");

$output ='';

$sql = "select * from orders where order_id='{$_POST['order_id']}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$sql_for_package="select name, main_image, description from packages where package_id={$row['package_id']}";
$result_for_package = mysqli_query($conn, $sql_for_package);
if(mysqli_num_rows($result_for_package)>0)
{
    $row_for_package=mysqli_fetch_assoc($result_for_package);
}



$output .='
<div class="modal-content">
    <!-- form header  -->
    <div class="modal-header align-items-center">
        <div class="form-title">View Order Details</div>
        <div>
            <div class="get-invoice-btn btn btn-success btn-sm" data-order-id="'.$_POST['order_id'].'">Get Invoice</div>
        </div>';

// if($row['is_canceled'] == 0 && $row['order_status'] == 'pending')
// {

    // $output .='<div class="admin-operation-container">';
    // $output .='<button class="btn btn-danger btn-sm m-1" id="cancel-order-admin" data-order-id="'.$row['order_id'].'">Cancel Order</button>';
    // $output .='<button class="btn btn-success btn-sm m-1" id="confirm-order-admin" data-order-id="'.$row['order_id'].'">Confirm Order</button>';
    // $output .='</div>';
// }


$output .='
        <div class="form-close-btn">
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
    </div>

    <div class="modal-body">
        <input type="hidden" name="order-id" value="'.$row['order_id'].'">
        <div class="col">
            <div class="row">
                <div class="col">
                    <img src="../../images/packages/'.$row_for_package['main_image'].'" alt="" style="width: 100%; height: auto;">
                </div>

                <div class="col">
                    <div class="product-name-desc-container">
                        <div class="product-name mb-3">
                            <b>'.ucwords($row_for_package['name']).'</b>
                        </div>
                        <div class="product-desc mb-3">
                            <span class="three-line-text">'.$row_for_package['description'].'</span>
                        </div>
                    </div>

                    <div class="product-price-quantity-container">
                        <div class="product-price mb-3">
                            <b>&#8377;</b> '.number_format($row['package_price']).'
                        </div>
                        <div class="product-quantity mb-3">
                            <b>No. of Person: </b>'.$row['no_person'].'
                        </div>
                    </div>

                    <div class="product-total-price-container mb-3">
                        <div class="product-total-price">
                            <b>Total Price: </b><span>&#8377; '.number_format($row['total_price']).'</span>
                        </div>
                    </div>

                    <div class="product-total-price-container">
                        <div class="product-total-price">
                            <b>Tour Date: </b><span>'.$row['tour_date'].'</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="card-payment-details col d-flex flex-column">
                    <div class="d-flex flex-column mb-3">
                        <b>Transaction ID: </b>
                        <span>'.$row['transaction_id'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Order ID: </b>
                        <span>'.$row['order_id'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Payment Type</b>
                        <span>'.$row['payment_type'].'</span>
                    </div>
                    <div class="col">
                        <b class="row">Payment Status </b>';
                    if($row['is_canceled']==0)
                    {
                        if($row['payment_status']=='pending')     
                        {
                            
                            $output .='<span class="row badge badge-warning">pending</span>';


                            $output .='
                                <button class="btn btn-success btn-sm ml-4" id="update-payment-status-btn" data-order-id="'.$row['order_id'].'">Update</button>';
                        }
                        else
                        {
                            $output .='<span class="row badge badge-success">success</span>';
                        }
                    }
                    else
                    {
                        $output .='<span class="row badge badge-danger">Canceled</span>';
                    }
        
                    $output .='
                    </div>
                </div>

                <div class="card-payment-details col d-flex flex-column">
                    <div class="d-flex flex-column mb-3">
                        <b>Name: </b>
                        <span>'.$row['name'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Mobile: </b>
                        <span>'.$row['mobile'].'</span>
                    </div>
                    <div class="d-flex flex-column mb-3">
                        <b>Email</b>
                        <span>'.$row['email'].'</span>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="delivery-status-event-container">';
        
        // $order_event=json_decode($row['order_event'], true);
    
        // for($i=0; $i<count($order_event); $i++)
        // {
        //     if($order_event[$i]['event_name']!='order canceled')
        //     {
        //         $output .='
        //         <div class="delivery-status-order-confirmed ">
        //             <div class="delivery-status-text">
        //                 <span>'.$order_event[$i]['event_name'].'</span>
        //             </div>
        //             <div class="delivery-status-date-time">
        //                 <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
        //             </div>
        //         </div>';
        //     }   
        //     else
        //     {
        //         $output .='
        //         <div class="delivery-status-order-canceled ">
        //             <div class="delivery-status-text">
        //                 <span>'.$order_event[$i]['event_name'].'</span>
        //             </div>
        //             <div class="delivery-status-date-time">
        //                 <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
        //             </div>
        //         </div>';
        //     }
    
        // }
    
        $output .='
        </div>
    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>

';

echo $output;

?>