<?php 
    include("_session_start.php");
    include("_dbconnect.php");

    $output = '';

    $output .='
    <div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-xs primary-table-bordered packages-table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>';
    $sql="select * from packages where is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                    <tr class="';
                    
                    
            $output .='
                    ">
                        <td>
                            '.$i++.'
                        </td>
                        <td>
                            <img src="../../images/packages/'.$row['main_image'].'" class="w-40px rounded m-r-10" alt="">
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['name'], 0, 30)).'';
                        
                        if(strlen($row['name'])>30)
                        {
                            $output .='...';
                        }
                    $output .='
                        </span>
                        </td>
                        <td>&#8377
                        '.number_format($row['new_price']).'
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['description'], 0, 25)).'';
                            

                        if(strlen($row['description'])>25)
                        {
                            $output .='...';
                        }

                    $output .='
                        </span>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-danger btn-sm delete-package-btn" data-package-id="'.$row['package_id'].'">
                                <i class="fa-solid fa-trash-can px-2"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm update-package-btn" data-package-id="'.$row['package_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-solid fa-pen-to-square px-2"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm view-package-btn" data-package-id="'.$row['package_id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-regular fa-eye px-2"></i>
                            </button>
                        </td>
                    </tr>';
        }
    }

$output .='                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    ';

echo $output;

?>