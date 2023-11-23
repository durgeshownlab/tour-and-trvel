<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $output='';

    
    $sql="select * from category where id={$_POST['category_id']} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md mt-4 text-center">
                        <p style="font-weight: 500;">Category Name</p><br/>
                        <b class="col" style="font-size: 20px;">'.ucwords($row['name']).'</b>
                    </div>

                    <div class="col-md mt-2 text-center">
                        <p style="font-weight: 500;">Image</p>
                        <img src="../../images/category/'.$row['image'].'" class="img-fluid rounded" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md mt-2 text-center">
                        <p style="font-weight: 500;">Icon</p>
                        <img src="../../images/category/'.$row['icon'].'" class="img-fluid rounded bg-dark" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>

                    <div class="col-md mt-4 text-center">
                        <p style="font-weight: 500;">Banner</p>
                        <img src="../../images/category/'.$row['banner'].'" class="img-fluid rounded bg-dark" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
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