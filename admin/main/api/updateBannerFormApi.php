<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';


$output ='';

$sql="select banners.banner_id as banner_id, banners.package_id as package_id, banners.banner_name as banner_name, banners.banner_image as banner_image, banners.banner_text as banner_text, packages.name as package_name from banners join packages on banners.package_id=packages.package_id where banner_id={$_POST['banner_id']} and banners.is_deleted=0";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Banner</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">banner Name</label>
                    <input type="hidden" value="'.$row['banner_id'].'" name="banner-id" id="banner-id">
                    <input type="text" class="form-control input-flat" placeholder="banner Name" name="banner-name" id="banner-name" value="'.$row['banner_name'].'" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">banner Image</label>
                    <input type="hidden" value="../../../images/banner/'.$row['banner_image'].'" name="existing-banner-image" id="existing-banner-image">
                    <input type="file" class="form-control input-flat" name="banner-image" id="banner-image">
                    <img src="../../images/banner/'.$row['banner_image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Banner Text</label>
                    <input type="text" value="'.$row['banner_text'].'" class="form-control input-flat" placeholder="Banner Text" name="banner-text" id="banner-text" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Package</label>
                    <select class="form-control input-flat" name="banner-package" id="banner-package" required>
                        <option value="'.$row['package_id'].'">'.ucwords($row['package_name']).'</option>';

                    $sql_package = "select package_id, name from packages where package_id!={$row['package_id']} and is_deleted=0 order by name";
                    $result_package=mysqli_query($conn, $sql_package);

                    if(mysqli_num_rows($result_package)>0)
                    {
                        while($row_package=mysqli_fetch_assoc($result_package))
                        {
                            $output .='<option value="'.$row_package['package_id'].'">'.ucwords($row_package['name']).'</option>';
                        }
                    }

                    $output .='
                    </select>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-banner-submit-btn">Save Changes</button>
        </div>
    </div>';

echo $output;
?>