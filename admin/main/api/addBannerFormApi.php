<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Banner</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Banner Name</label>
                    <input type="text" class="form-control input-flat" placeholder="Banner Name" name="banner-name" id="banner-name" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Banner Image</label>
                    <input type="file" class="form-control input-flat" name="banner-image" id="banner-image" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Banner Text</label>
                    <input type="text" class="form-control input-flat" placeholder="Banner Text" name="banner-text" id="banner-text" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Package</label>
                    <select class="form-control input-flat" name="banner-package" id="banner-package" required>
                        <option value="">Select Package</option>';

                    $sql = "select * from packages where is_deleted=0 order by name";
                    $result=mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $output .='<option value="'.$row['package_id'].'">'.ucwords($row['name']).'</option>';
                        }
                    }

                    $output .='
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-banner-submit-btn">Add Banner</button>
        </div>
    </div>';

echo $output;
?>