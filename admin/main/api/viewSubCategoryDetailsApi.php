<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $output='';

    $sql="select sub_category.sub_category_id as sub_category_id, sub_category.name as sub_category_name, sub_category.category_id as category_id, sub_category.sub_category_image as sub_category_image, category.name as category_name, category.image as category_image from sub_category join category on sub_category.category_id=category.id where sub_category.sub_category_id={$_POST['sub_category_id']} and sub_category.is_deleted=0 and category.is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sub Category Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="col">
                        <div class="">
                            <b class="">Category</b> <br/>
                            <span class="text-center" style="font-size: 15px;">'.ucwords($row['category_name']).'</span><br/><br/>
                            <img src="../../images/category/'.$row['category_image'].'" class="img-fluid rounded" alt="" style="width: 100px; height: auto; max-height: 100px; max-width: 100px;">
                        </div>
                    </div>
                    <div class="col">
                        <div class="">
                            <b class="">Sub Category</b> <br/>
                            <span class="" style="font-size: 15px;">'.ucwords($row['sub_category_name']).'</span><br/><br/>
                            <img src="../../images/sub-category/'.$row['sub_category_image'].'" class="img-fluid rounded" alt="" style="width: 100px; height: auto; max-height: 100px; max-width: 100px;">
                        </div>
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