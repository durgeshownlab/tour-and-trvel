<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Sub Category</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control input-flat" name="product-category" id="product-category" required>';

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
                <div class="col form-group">
                    <label class="form-label">Sub Category</label>
                    <input type="text" class="form-control input-flat" name="sub-category-name" id="sub-category-name" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Sub Category Image</label>
                    <input type="file" class="form-control input-flat" name="sub-category-image" id="sub-category-image" required>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="add-sub-category-submit-btn">Add Sub Category</button>
        </div>
    </div>';

echo $output;
?>