<?php

include("_session_start.php");
include("_dbconnect.php");

$payment_method=[];
$payment_status=[];
$sort_by=$_POST['sort_by'];

if(isset($_POST['from_date']) && isset($_POST['to_date']))
{
    $from_date=$_POST['from_date'];
    $to_date=$_POST['to_date'];
}

$output = '';

if(isset($_POST['payment_method']))
{
    $payment_method = $_POST['payment_method'];
}

if(isset($_POST['payment_status']))
{
    $payment_status = $_POST['payment_status'];
}


if(!empty($payment_method) || !empty($payment_status) || !empty($sort_by))
{
    $sql = "SELECT * FROM orders WHERE 1=1 ";

    if(isset($_POST['from_date']) && isset($_POST['to_date']) && !empty($from_date) && !empty($to_date))
    {
        $sql .= " and  (date(booking_date) BETWEEN '{$from_date}' AND '{$to_date}' or DATE(booking_date) BETWEEN '{$to_date}' AND '{$from_date}') ";
    }

    if(!empty($payment_method))
    {
        $sql .= " and payment_type IN ('" . implode("','", $payment_method) . "') ";
    }
    if(!empty($payment_status))
    {
        $sql .= " and payment_status IN ('" . implode("','", $payment_status) . "') ";
    }


    if($sort_by=='default')
    {
        $sql .= " order by booking_date desc";
    }
    else if($sort_by=='newest first')
    {
        $sql .= " order by booking_date desc";
    }
    else if($sort_by=='oldest first')
    {
        $sql .= " order by booking_date asc";
    }
    else if($sort_by=='low to high')
    {
        $sql .= " order by total_price asc";
    }
    else if($sort_by=='high to low')
    {
        $sql .= " order by total_price desc";
    }
    else
    {
        $sql .= " order by order_date desc";
    }
    
        // $sql="select * from orders order by order_date desc";
        $result=mysqli_query($conn, $sql);

        $output .=' <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>No of Person</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Booking Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>';
    
        if(mysqli_num_rows($result)>0)
        {
            $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $sql2="select name from packages where package_id={$row['package_id']}";
                $result2=mysqli_query($conn, $sql2);
                if(mysqli_num_rows($result2)>0)
                {
                    $row2=mysqli_fetch_assoc($result2);
                }
                
                $output .='
                <tr data-order-id="'.$row['order_id'].'">
                    <td>
                        <p>'.$i++.'</p>
                    </td>
    
                    <td>
                        <p>'.$row['order_id'].'</p>
                    </td>
    
                    <td>
                        <p>'.ucwords($row2['name']).'</p>
                    </td>
    
                    <td>
                        <p>'.ucwords($row['no_person']).'</p>
                    </td>
    
                    <td>
                        <p> &#8377; '.number_format($row['total_price']).'</p>
                    </td>
    
                    <td>
                        <p class="badge';
                if($row['payment_status']=='success')
                {
                    $output .=' badge-success';
                }        
                else if($row['payment_status']=='pending')
                {
                    $output .=' badge-warning';
                }        
                        
                
                $output .='">'.ucwords($row['payment_status']).'</p>
                    </td>
    
                    <td>
                        <p>'.ucwords($row['tour_date']).'</p>
                    </td>
    
                    <td class="text-right">
                        <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
                            <i class="fa-regular fa-eye px-2"></i>
                        </button>
                    </td>
                </tr>';
            }
        }

} 
else
{
    $sql="select * from orders order by booking_date desc";
    $result=mysqli_query($conn, $sql);

    $output .=' <thead class="thead-primary">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>No of Person</th>
                        <th>Total Price</th>
                        <th>Payment Status</th>
                        <th>Booking Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>';

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result)){
            $sql2="select name from packages where package_id={$row['package_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'">
                <td>
                    <p>'.$i++.'</p>
                </td>

                <td>
                    <p>'.$row['order_id'].'</p>
                </td>

                <td>
                    <p>'.ucwords($row2['name']).'</p>
                </td>

                <td>
                    <p>'.ucwords($row['no_person']).'</p>
                </td>

                <td>
                    <p> &#8377; '.number_format($row['total_price']).'</p>
                </td>

                <td>
                    <p class="badge';
            if($row['payment_status']=='success')
            {
                $output .=' badge-success';
            }        
            else if($row['payment_status']=='pending')
            {
                $output .=' badge-warning';
            }        
                    
            
            $output .='">'.ucwords($row['payment_status']).'</p>
                </td>

                <td>
                    <p>'.ucwords($row['tour_date']).'</p>
                </td>

                <td class="text-right">
                    <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
                        <i class="fa-regular fa-eye px-2"></i>
                    </button>
                </td>
            </tr>';
        }
    }
}
  
echo $output;
?>