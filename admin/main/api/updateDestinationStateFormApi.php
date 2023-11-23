<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$sql="select * from destination_state where id={$_POST['destination_state_id']} and is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Destination State</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">State</label>
                    <select class="form-control input-flat" name="destination-state-id" id="destination-state-id" required>';

                    $sql_state = "select * from states where id={$row['state_id']} and is_deleted=0";
                    $result_state=mysqli_query($conn, $sql_state);

                    if(mysqli_num_rows($result_state)==1)
                    {
                        while($row_state=mysqli_fetch_assoc($result_state))
                        {
                            $output .='<option value="'.$row_state['id'].'">'.ucwords($row_state['state_name']).'</option>';
                        }
                    }

                    $sql_state = "select * from states where id!={$row['state_id']} and is_deleted=0 order by state_name";
                    $result_state=mysqli_query($conn, $sql_state);

                    if(mysqli_num_rows($result_state)>0)
                    {
                        while($row_state=mysqli_fetch_assoc($result_state))
                        {
                            $output .='<option value="'.$row_state['id'].'">'.ucwords($row_state['state_name']).'</option>';
                        }
                    }

            $output .='</select>
                </div>

                <div class="col form-group">
                    <label class="form-label">State Text</label>
                    <input type="hidden" class="form-control input-flat" name="destination-state-row-id" id="destination-state-row-id" value="'.$row['id'].'">
                    <input type="text" class="form-control input-flat" name="destination-state-text" id="destination-state-text" value="'.$row['state_text'].'">
                </div>
            </div>

            <div class="row">

                <div class="col form-group">
                    <label class="form-label">Min temp</label>
                    <input type="text" class="form-control input-flat" name="destination-state-min-temp" id="destination-state-min-temp" value="'.$row['min_temp'].'">
                </div>

                <div class="col form-group">
                    <label class="form-label">Max Temp</label>
                    <input type="text" class="form-control input-flat" name="destination-state-max-temp" id="destination-state-max-temp" value="'.$row['max_temp'].'">
                </div>
            
            </div>

            <div class="row">

                <div class="col form-group">
                    <label class="form-label">State Image</label>
                    <input type="hidden" value="../../../images/destination_state/'.$row['state_image'].'" name="existing-destination-state-image" id="existing-destination-state-image">
                    <input type="file" class="form-control input-flat" name="destination-state-image" id="destination-state-image">
                    <img src="../../images/destination_state/'.$row['state_image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>

                <div class="col form-group">
                    <label class="form-label">State Banner</label>
                    <input type="hidden" value="../../../images/destination_state/'.$row['banner_image'].'" name="existing-destination-state-banner" id="existing-destination-state-banner">
                    <input type="file" class="form-control input-flat" name="destination-state-banner" id="destination-state-banner">
                    <img src="../../images/destination_state/'.$row['banner_image'].'" class="img-fluid rounded pt-2 bg-dark" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-destination-state-submit-btn">Save Changes</button>
        </div>
    </div>';

echo $output;
?>