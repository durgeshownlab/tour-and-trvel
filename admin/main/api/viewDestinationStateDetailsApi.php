<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $output='';

    
    $sql="select * from destination_state where id={$_POST['destination_state_id']} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Destination State Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="row mt-4">
                    <div class="col-md">
                        <b style="font-size: 14px;">State Name</b>';

                $sql_state = "select * from states where id={$row['state_id']} and is_deleted=0";
                $result_state=mysqli_query($conn, $sql_state);

                if(mysqli_num_rows($result_state)==1)
                {
                    $row_state=mysqli_fetch_assoc($result_state);
                    $output .='<p style="font-weight: 500;">'.ucwords($row_state['state_name']).'</p>';
                }

                    
                        
        $output .='</div>

                    <div class="col-md">
                        <b style="font-size: 14px;">State Text</b>
                        <p style="font-weight: 500;">'.ucwords($row['state_text']).'</p>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md">
                        <b style="font-size: 14px;">Min Temp</b>
                        <p style="font-weight: 500;">'.ucwords($row['min_temp']).'&deg;</p>
                    </div>

                    <div class="col-md">
                        <b style="font-size: 14px;">Max Temp</b>
                        <p style="font-weight: 500;">'.ucwords($row['max_temp']).'&deg;</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md">
                        <b style="font-size: 14px;">Image</b><br/>
                        <img src="../../images/destination_state/'.$row['state_image'].'" class="img-fluid rounded bg-dark" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>

                    <div class="col-md">
                        <b style="font-size: 14px;">Banner Image</b><br/>
                        <img src="../../images/destination_state/'.$row['banner_image'].'" class="img-fluid rounded bg-dark" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
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