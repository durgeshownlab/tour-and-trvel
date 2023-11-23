<?php 
    include("_session_start.php");
    include("_dbconnect.php");

    $search_data=$_POST['search_text'];

    $output = '';
if(!empty($search_data))
{
    $output .='
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>';       
    $sql="select * from products where product_price like '%{$search_data}%' or product_name like '%{$search_data}%' and is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                    <tr class="';

            if($row['quantity']<3)
            {
                $output .=' table-warning';
            }
                    
            $output .='">
                        <td>
                            '.$i++.'
                        </td>
                        <td>
                            <img src="../../images/products/'.$row['product_image'].'" class="w-40px rounded m-r-10" alt="">
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['product_name'], 0, 30)).'';
                        
                        if(strlen($row['product_name'])>30)
                        {
                            $output .='...';
                        }
                    $output .='
                        </span>
                        </td>
                        <td>&#8377
                        '.number_format($row['product_price']).'
                        </td>
                        <td>
                        '.number_format($row['quantity']).'
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['product_desc'], 0, 25)).'';
                            

                        if(strlen($row['product_desc'])>25)
                        {
                            $output .='...';
                        }

                    $output .='
                        </span>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-danger btn-sm delete-product-btn" data-product-id="'.$row['product_id'].'">
                                <i class="fa-solid fa-trash-can px-2"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm update-product-btn" data-product-id="'.$row['product_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-solid fa-pen-to-square px-2"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm view-product-btn" data-product-id="'.$row['product_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-regular fa-eye px-2"></i>
                            </button>
                        </td>
                    </tr>';
        }
    }

$output .='                               
                            </tbody>';

}
else
{
    $output .='
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>';       
    $sql="select * from products where is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                    <tr class="';

            if($row['quantity']<3)
            {
                $output .=' table-warning';
            }

            $output .='">
                        <td>
                            '.$i++.'
                        </td>
                        <td>
                            <img src="../../images/products/'.$row['product_image'].'" class="w-40px rounded m-r-10" alt="">
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['product_name'], 0, 30)).'';
                        
                        if(strlen($row['product_name'])>30)
                        {
                            $output .='...';
                        }
                    $output .='
                        </span>
                        </td>
                        <td>&#8377
                        '.number_format($row['product_price']).'
                        </td>
                        <td>
                        '.number_format($row['quantity']).'
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['product_desc'], 0, 25)).'';
                            

                        if(strlen($row['product_desc'])>25)
                        {
                            $output .='...';
                        }

                    $output .='
                        </span>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-danger btn-sm delete-product-btn" data-product-id="'.$row['product_id'].'">
                                <i class="fa-solid fa-trash-can px-2"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm update-product-btn" data-product-id="'.$row['product_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-solid fa-pen-to-square px-2"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm view-product-btn" data-product-id="'.$row['product_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-regular fa-eye px-2"></i>
                            </button>
                        </td>
                    </tr>';
        }
    }

$output .='                               
                            </tbody>';
}

echo $output;

?>