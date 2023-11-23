<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Package</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Package Name</label>
                    <input type="text" class="form-control input-flat" placeholder="package Name" name="package-name" id="package-name" required>
                </div>
                
                <div class="col form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control input-flat" name="package-category" id="package-category" required>
                        <option value="">Select Category</option>';

                    $sql = "select * from category where is_deleted=0";
                    $result=mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $output .='<option value="'.$row['id'].'">'.ucwords($row['name']).'</option>';
                        }
                    }

                    $output .='
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Old Price</label>
                    <input type="number" class="form-control input-flat" placeholder="Old Price" name="package-base-price" id="package-base-price" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">New Price</label>
                    <input type="number" class="form-control input-flat" placeholder="New Price" name="package-price" id="package-price" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Main Image</label>
                    <input type="file" class="form-control input-flat" name="package-main-image" id="package-main-image" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Other Images</label>
                    <input type="file" class="form-control input-flat" name="package-other-image[]" id="package-other-image" multiple>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Banner Image</label>
                    <input type="file" class="form-control input-flat" name="package-banner-image" id="package-banner-image" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Tour Duration (In Days)</label>
                    <input type="number" class="form-control input-flat" placeholder="Eg. 3" name="package-duration" id="package-duration" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Country</label>
                    <select class="form-control input-flat" name="package-country" id="package-country" required>
                        <option value="India">India</option>
                    </select>
                </div>

                <div class="col form-group">
                    <label class="form-label">State</label>
                    <select class="form-control input-flat" name="package-state" id="package-state" required>
                        <option value="">--- State ---</option>
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
                    <input type="text" class="form-control input-flat" placeholder="Eg. Banglore" name="package-city" id="package-city" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Included</label>
                    <input type="text" class="form-control input-flat" placeholder="Eg. Food, Travel" name="package-included" id="package-included" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Best Month</label>
                    <input type="text" class="form-control input-flat" name="package-best-month" id="package-best-month" placeholder="Eg. Jan-Feb" required>
                </div>

                <div class="col form-group">
                    <label class="form-label">Package Type</label>
                    <select class="form-control input-flat" name="package-type" id="package-type" required>
                        <option value="normal">Normal</option>
                        <option value="special">Special</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Location Link</label>
                    <input type="text" class="form-control input-flat" name="package-location-link" id="package-location-link" placeholder="iFrame Link" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-control h-150px" rows="6" style="height: 55px;" name="package-desc" id="package-desc" placeholder="Eg. Add Description About the Package" required></textarea>
            </div>
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-package-submit-btn">Add Package</button>
        </div>
    </div>';

echo $output;
?>