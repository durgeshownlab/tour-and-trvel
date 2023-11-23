<?php

include("_session_start.php");
include("_dbconnect.php");

$search_data=$_POST['search_text'];

$output = '';

if(!empty($search_data))
{
    $sql = "SELECT * FROM orders WHERE order_id like '%{$search_data}%' or transaction_id like '%{$search_data}%'";

        $result=mysqli_query($conn, $sql);

        $output .=' <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Order Status</th>
                            <th>Delivery Status</th>
                            <th>Order Date</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>';
    
        if(mysqli_num_rows($result)>0)
        {
            $i=1;
            while($row=mysqli_fetch_assoc($result)){
                $sql2="select product_name from products where product_id={$row['product_id']}";
                $result2=mysqli_query($conn, $sql2);
                if(mysqli_num_rows($result2)>0)
                {
                    $row2=mysqli_fetch_assoc($result2);
                }
                
                $output .='
                <tr data-order-id="'.$row['order_id'].'"';
        $output .='>
                    <td>'.$i++.'</td>
                    <td class="order-id">
                        <p>'.$row['order_id'].'</p>
                    </td>
                    <td class="product-name">
                        <p>'.ucwords($row2['product_name']).'</p>
                    </td>
                    <td class="quantity">
                        <p>'.$row['quantity'].'</p>
                    </td>
                    <td class="total-price">
                        <p>&#8377; '.number_format($row['total_price']).'</p>
                    </td>
                    <td class="quantity">
                        <p ';

        if($row['order_status']=='pending')
        {
            $output .='class="badge badge-warning"';
        }
        else if($row['order_status']=='canceled')
        {
            $output .='class="badge badge-danger"';
        }
        else if($row['order_status']=='confirmed')
        {
            $output .='class="badge badge-primary"';
        }
        else if($row['order_status']=='delivered')
        {
            $output .='class="badge badge-success"';
        }
                        
        $output .='>';

        $output .= ''.ucwords($row['order_status']).'';
        
        $output .='</p>
                    </td>
                    <td class="order-date">
                        <p class="badge ';
        
        if($row['delivery_status']=='delivered')
        {
            $output .=' badge-success';
        }        
        else if($row['delivery_status']=='confirmed')
        {
            $output .=' badge-primary';
        }        
        else if($row['delivery_status']=='placed')
        {
            $output .=' badge-warning';
        }        
        else if($row['delivery_status']=='canceled')
        {
            $output .=' badge-danger';
        }    
        else
        {
                $output .=' badge-secondary';
        }
                        
        $output .='">'.ucwords($row['delivery_status']).'</p>
                    </td>
                    <td class="order-date">
                        <p>'.$row['order_date'].'</p>
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
    $sql="select * from orders order by order_date desc";
    $result=mysqli_query($conn, $sql);

    $output .=' <thead class="thead-primary">
                    <tr>
                        <th>#</th>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>';

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result)){
            $sql2="select product_name from products where product_id={$row['product_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'"';
            
    $output .='>
                <td>'.$i++.'</td>
                <td class="order-id">
                    <p>'.$row['order_id'].'</p>
                </td>
                <td class="product-name">
                    <p>'.ucwords($row2['product_name']).'</p>
                </td>
                <td class="quantity">
                    <p>'.$row['quantity'].'</p>
                </td>
                <td class="total-price">
                    <p>&#8377;'.number_format($row['total_price']).'</p>
                </td>
                <td class="quantity">
                    <p ';

                if($row['order_status']=='pending')
                {
                    $output .='class="badge badge-warning"';
                }
                else if($row['order_status']=='canceled')
                {
                    $output .='class="badge badge-danger"';
                }     
                                
                $output .='>';

                if($row['delivery_status']=='delivered')
                {
                    $output .=''.ucwords($row['delivery_status']).'';
                }
                else
                {
                    $output .= ''.ucwords($row['order_status']).'';
                }

                $output .='</p>
                        </td>

            
                <td class="order-date">
                    <p>'.$row['order_date'].'</p>
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