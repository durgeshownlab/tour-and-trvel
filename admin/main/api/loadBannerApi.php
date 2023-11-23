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
                        <table class="table table-xs primary-table-bordered">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>';
    $sql="select * from banners where is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                    <tr>
                        <td>
                            '.$i++.'
                        </td>
                        <td>
                            <img src="../../images/banner/'.$row['banner_image'].'" class="rounded m-r-10" alt="" style="height: 50px;">
                        </td>
                        <td>
                            <span>'.ucwords(substr($row['banner_name'], 0, 30)).'';
                        
                        if(strlen($row['banner_name'])>30)
                        {
                            $output .='...';
                        }
            $output .='
                    </span>
                    </td>
                    
                    
                    <td class="text-right">
                        <button type="button" class="btn btn-danger btn-sm delete-banner-btn" data-banner-id="'.$row['banner_id'].'">
                            <i class="fa-solid fa-trash-can px-2"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-sm update-banner-btn" data-banner-id="'.$row['banner_id'].'" data-toggle="modal" data-target="#ModalCenter">
                            <i class="fa-solid fa-pen-to-square px-2"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm view-banner-btn" data-banner-id="'.$row['banner_id'].'" data-toggle="modal" data-target="#ModalCenter">
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