<?php

include("_session_start.php");
include("_dbconnect.php");

$payment_method=[];
$payment_status=[];
$sort_by=$_POST['sort_by'];

$num_of_cod=0;
$num_of_online=0;

$output = '<table cellpadding=5 border=1 cellspacing=5>';

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
        $sql .= " order by booking_date desc";
    }
    
    // $sql="select * from orders order by booking_date desc";
    $result=mysqli_query($conn, $sql);

    $output .='
                <tr class="table-heading">
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Order ID</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Transaction ID</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Name</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>No. of Person</p>
                    </th> 
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Price for Single Unit</p>
                    </th> 
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Total Price</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Payment Mode</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Delivery Status</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Order Date</p>
                    </th>
                </tr>';

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_assoc($result)){

            if($row['payment_type']=='cod')
            {
                $num_of_cod++;
            }
            if($row['payment_type']=='online')
            {
                $num_of_online++;
            }

            $sql2="select name from packages where package_id={$row['package_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'" style="max-height: 20px;">
                <td class="order-id"';

            if($row['payment_status']=='success')
            {
                $output .='
                    style="background-color: green; color: #fff;"
                ';
            }
                
        $output .='>
                <p>'.''.$row['order_id'].'</p>
                </td>
                
                <td class="transaction-id" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                } 

        $output .='>
                    <p>'.$row['transaction_id'].'</p>
                </td>
                <td class="product-name" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row2['name']).'</p>
                </td>
                <td class="quantity" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['no_person'].'</p>
                </td>
                <td class="price-for-single-unit" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377; '.number_format($row['package_price']).'</p>
                </td>
                <td class="total-price" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377; '.number_format($row['total_price']).'</p>
                </td>
                <td class="payment-method" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row['payment_type']).'</p>
                </td>

                <td class="order-status" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row['payment_status']).'</p>
                </td>

                <td class="order-date" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['booking_date'].'</p>
                </td>
            </tr>';
        }
    }

} 
else
{
    $sql="select * from orders order by booking_date desc";
    $result=mysqli_query($conn, $sql);

    $output .=' <tr class="table-heading">
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Order ID</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Transaction ID</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Name</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>No. of Person</p>
                    </th> 
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Price for Single Unit</p>
                    </th> 
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Total Price</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Payment Mode</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Delivery Status</p>
                    </th>
                    <th style="background-color: #9068be; color: #fff; padding: 10px; height: 40px;">
                        <p>Order Date</p>
                    </th>
                </tr>';

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_assoc($result)){

            if($row['payment_type']=='cod')
            {
                $num_of_cod++;
            }
            if($row['payment_type']=='online')
            {
                $num_of_online++;
            }

            $sql2="select name from products where product_id={$row['product_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'" style="max-height: 20px;">
                <td class="order-id" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                <p>'.''.$row['order_id']." ".'</p>
                </td>

                <td class="transaction-id" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['transaction_id'].'</p>
                </td>
                <td class="product-name" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row2['name']).'</p>
                </td>
                <td class="quantity" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377; '.number_format($row['no_person']).'</p>
                </td>
                <td class="total-price" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>&#8377; '.number_format($row['total_price']).'</p>
                </td>
                <td class="payment-method" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.ucwords($row['payment_type']).'</p>
                </td>
                <td class="order-date" ';

                if($row['payment_status']=='success')
                {
                    $output .='
                        style="background-color: green; color: #fff;"
                    ';
                }
                    
        $output .='>
                    <p>'.$row['booking_date'].'</p>
                </td>
            </tr>';
        }
    }
}

$output .='<tr></tr>';
$output .='<tr>
    <td style="background-color: #9068be; color: #fff; height: 20px; text-align: center;">Total POD</td>
    <td>'.$num_of_cod.'</td>
</tr>';
$output .='<tr>
    <td style="background-color: #9068be; color: #fff; height: 20px; text-align: center;">Total Online</td>
    <td>'.$num_of_online.'</td>
</tr>';
$output .='<tr></tr>';
$output .='<tr>
    <td style="background-color: #9068be; color: #fff; height: 20px; text-align: center;">Total Orders</td>
    <td>'.$num_of_online+$num_of_cod.'</td>
</tr>';


$output .='</table>';

// $filename="Orders_".time().".xls";
header("Content-Type: application/xls");
// header("Content-Disposition:attechment; filename=$filename");

  
echo $output;
?>