<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$sql="select packages.name as name, packages.main_image as image, packages.new_price as new_price, packages.old_price as old_price, packages.banner_image as banner_image, packages.country as country, packages.state as state, packages.city as city, packages.tour_duration as tour_duration, packages.best_month as best_month, packages.included as included, packages.type as type, packages.description as description, category.id as category_id, category.name as category from packages join category on packages.category_id=category.id where packages.package_id={$_POST['package_id']} and packages.is_deleted=0";

$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)==1)
{
    $row=mysqli_fetch_assoc($result);
}

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Package</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Package Name</label>
                    <input type="text" class="form-control input-flat" placeholder="package Name" name="package-name" id="package-name" value="'.$row['name'].'" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control input-flat" name="package-category" id="package-category" required>
                        <option value="'.$row['category_id'].'">'.$row['category'].'</option>';

                        $sql_for_category = "select * from category where  id != {$row['category_id']} and is_deleted=0";
                        $result_for_category=mysqli_query($conn, $sql_for_category);

                        if(mysqli_num_rows($result_for_category)>0)
                        {
                            while($row_for_category=mysqli_fetch_assoc($result_for_category))
                            {
                                $output .='<option value="'.$row_for_category['id'].'">'.ucwords($row_for_category['name']).'</option>';
                            }
                        }

                        $output .='
                    </select>
                </div>
            </div>
                
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Old Price</label>
                    <input type="number" class="form-control input-flat" placeholder="Old Price" name="package-base-price" id="package-base-price" value="'.$row['old_price'].'" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">New Price</label>
                    <input type="number" class="form-control input-flat" placeholder="New Price" name="package-price" id="package-price" value="'.$row['new_price'].'" required>
                </div>
            </div>
            
            <div class="row">
                <div class="col form-group col-md-6">
                    <label class="form-label">Main Image</label>
                    <input type="hidden" value="'.$row['image'].'" name="existing-package-image-path" id="existing-package-image-path">
                    <input type="file" class="form-control input-flat" name="package-main-image" id="package-main-image" required>
                    <img src="../../images/packages/'.$row['image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>

                <div class="col form-group col-md-6">
                    <label class="form-label">Other Images</label>
                    <input type="file" class="form-control input-flat" name="package-other-image[]" id="package-other-image" multiple>
                    <div class="d-flex align-items-start other-images-container " style="overflow-x: auto">';

                    $sql_image = "select * from package_images where package_id={$_POST['package_id']} and is_deleted=0";
                    $result_image=mysqli_query($conn, $sql_image);

                    if(mysqli_num_rows($result_image)>0)
                    {
                        while($row_image=mysqli_fetch_assoc($result_image))
                        {
                            $output .='
                                <div class="position-relative">
                                    <img src="../../images/packages/'.$row_image['image_path'].'" class="img-fluid rounded p-2" alt="" style="width: auto; height: 100px; max-height: 200px; max-width: 200px;">
                                    <span class="bg-danger p-1 rounded position-absolute image-delete-btn" style="z-index: 9; top: 10px; right: 10%; cursor:pointer;" data-image-id="'.$row_image['id'].'" data-package-id="'.$_POST['package_id'].'">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                </div>';
                        }
                    }

                    $output .='
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col form-group col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="hidden" value="'.$row['image'].'" name="existing-package-banner-image-path" id="existing-package-banner-image-path">
                    <input type="file" class="form-control input-flat" name="package-banner-image" id="package-banner-image" required>
                    <img src="../../images/packages/'.$row['banner_image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>

                <div class="col form-group">
                    <label class="form-label">Tour Duration (In Days)</label>
                    <input type="number" class="form-control input-flat" placeholder="Eg. 3" name="package-duration" id="package-duration" value="'.$row['tour_duration'].'" required>
                </div>

            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Country</label>
                    <select class="form-control input-flat" name="package-country" id="package-country" required>
                        <option value="'.ucwords($row['country']).'">'.ucwords($row['country']).'</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="form-label">State</label>
                    <select class="form-control input-flat" name="package-state" id="package-state" required>
                        <option value="'.ucwords($row['state']).'">'.ucwords($row['state']).'</option>
                        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                        <option value="Andhra Pradesh">Andhra Pradesh</option>
                        <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                        <option value="Assam">Assam</option>
                        <option value="Bihar">Bihar</option>
                        <option value="Chandigarh">Chandigarh</option>
                        <option value="Chhattisgarh">Chhattisgarh</option>
                        <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                        <option value="Delhi">Delhi</option>
                        <option value="Goa">Goa</option>
                        <option value="Gujarat">Gujarat</option>
                        <option value="Haryana">Haryana</option>
                        <option value="Himachal Pradesh">Himachal Pradesh</option>
                        <option value="Jharkhand">Jharkhand</option>
                        <option value="Karnataka">Karnataka</option>
                        <option value="Kerala">Kerala</option>
                        <option value="Lakshadweep">Lakshadweep</option>
                        <option value="Madhya Pradesh">Madhya Pradesh</option>
                        <option value="Maharashtra">Maharashtra</option>
                        <option value="Manipur">Manipur</option>
                        <option value="Meghalaya">Meghalaya</option>
                        <option value="Mizoram">Mizoram</option>
                        <option value="Nagaland">Nagaland</option>
                        <option value="Odisha">Odisha</option>
                        <option value="Puducherry">Puducherry</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Sikkim">Sikkim</option>
                        <option value="Tamil Nadu">Tamil Nadu</option>
                        <option value="Telangana">Telangana</option>
                        <option value="Tripura">Tripura</option>
                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                        <option value="Uttarakhand">Uttarakhand</option>
                        <option value="West Bengal">West Bengal</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control input-flat" placeholder="Eg. Banglore" name="package-city" id="package-city" value="'.$row['city'].'" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Best Month</label>
                    <input type="text" class="form-control input-flat" placeholder="Eg. Jan - Feb" name="package-best-month" id="package-best-month" value="'.$row['best_month'].'" required>
                </div>
            </div>
                
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Included</label>
                    <input type="text" class="form-control input-flat" placeholder="Eg. Food, Travel" name="package-included" id="package-included" value="'.$row['included'].'" required>
                </div>
                <div class="col form-group">
                    <label class="form-label">Package Type</label>
                    <select class="form-control input-flat" name="package-type" id="package-type" required>';
                    if($row['type']=='normal')
                    {
                        $output .='<option value="'.$row['type'].'">'.ucwords($row['type']).'</option>';
                        $output .='<option value="special">Special</option>';

                    }
                    else if($row['type']=='special')
                    {
                        $output .='<option value="'.$row['type'].'">'.ucwords($row['type']).'</option>';
                        $output .='<option value="normal">Normal</option>';

                    }

            $output .='
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Location Link</label>
                    <input type="text" class="form-control input-flat" placeholder="Google Map iFrame Link" name="package-location-link" id="package-location-link" value="'.$row['location_link'].'" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-control h-150px" rows="6" style="height: 55px;" name="package-desc" id="package-desc" required>'.$row['description'].'</textarea>
            </div>';
                  

        $output .='   

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-package-submit-btn" data-package-id="'.$_POST['package_id'].'">Save Changes</button>
        </div>
    </div>';

echo $output;
?>