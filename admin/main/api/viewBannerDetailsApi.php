<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $output='';

    
    $sql="select banners.banner_id as banner_id, banners.package_id as package_id, banners.banner_name as banner_name, banners.banner_image as banner_image, banners.banner_text as banner_text, packages.name as package_name from banners join packages on banners.package_id=packages.package_id where banner_id={$_POST['banner_id']} and banners.is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Banner Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-md">
                        <p style="font-weight: 500;">Banner Name</p>
                        <b class="col" style="font-size: 16px;">'.ucwords($row['banner_name']).'</b>
                    </div>

                    <div class="col-md">
                        <p style="font-weight: 500;">Banner Text</p>
                        <b class="col" style="font-size: 16px;">'.ucwords($row['banner_text']).'</b>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md">
                        <p style="font-weight: 500;">Package Name</p>
                        <b class="col" style="font-size: 16px;">'.ucwords($row['package_name']).'</b>
                    </div>

                    <div class="col-md">
                        <p style="font-weight: 500;">Banner Image</p>
                        <img src="../../images/banner/'.$row['banner_image'].'" class="img-fluid rounded" alt="" style="width: 100%; height: auto; max-height: 100px; max-width: 100%;">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>';
        echo $output;
    }
    else
    {
        echo 0;
    }

?>