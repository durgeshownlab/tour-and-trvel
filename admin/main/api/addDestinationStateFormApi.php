<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Destination State</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md form-group">
                    <label class="form-label">State</label>
                    <select class="form-control input-flat" name="destination-state-id" id="destination-state-id" required>
                        <option value="">--- Select State ---</option>';

                        $sql = "select * from states where is_deleted=0 order by state_name";
                        $result=mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result)>0)
                        {
                            while($row=mysqli_fetch_assoc($result))
                            {
                                $output .='<option value="'.$row['id'].'">'.ucwords($row['state_name']).'</option>';
                            }
                        }
        $output .='</select>
                </div>
                <div class="col form-group">
                    <label class="form-label">State Text</label>
                    <input type="text" class="form-control input-flat" name="destination-state-text" id="destination-state-text" placeholder="State Text" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Min Temp</label>
                    <input type="number" class="form-control input-flat" name="destination-state-min-temp" id="destination-state-min-temp" placeholder="Eg. 3" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Max Temp</label>
                    <input type="number" class="form-control input-flat" name="destination-state-max-temp" id="destination-state-max-temp" placeholder="Eg. 32" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">State Image</label>
                    <input type="file" accept="image/*" class="form-control input-flat" name="destination-state-image" id="destination-state-image" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">State Banner</label>
                    <input type="file" accept="image/*" class="form-control input-flat" name="destination-state-banner" id="destination-state-banner" required>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-destination-state-submit-btn">Add Destination State</button>
        </div>
    </div>';

echo $output;
?>