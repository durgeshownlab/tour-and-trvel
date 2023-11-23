<?php 
include("_session_start.php");
include("_dbconnect.php");

$output ='';

$output .= '
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Update Sub Category</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control input-flat" name="product-category" id="product-category" required>';

$sql1="select category.id as category_id, category.name as category_name, sub_category.name as sub_category_name, sub_category.sub_category_image as sub_category_image from category join sub_category on sub_category.category_id=category.id where category.is_deleted=0 and sub_category.is_deleted=0 and sub_category.sub_category_id={$_POST['sub_category_id']}";
$result1=mysqli_query($conn, $sql1);

if(mysqli_num_rows($result1)==1)
{
    $row1=mysqli_fetch_assoc($result1);
    $output .='<option value="'.$row1['category_id'].'">'.ucwords($row1['category_name']).'</option>';
}




$sql = "select * from category where is_deleted=0 and id != {$row1['category_id']}";
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
                    <input type="hidden" class="form-control input-flat" name="sub-category-id" id="sub-category-id" value="'.$_POST['sub_category_id'].'" required>
                    <input type="text" class="form-control input-flat" name="sub-category-name" id="sub-category-name" value="'.$row1['sub_category_name'].'" required>
                </div>
            </div>

            <div class="row">
                <div class="col form-group">
                    <label class="form-label">Sub Category Image</label>
                    <input type="hidden" value="../../../images/sub-category/'.$row1['sub_category_image'].'" name="existing-sub-category-image" id="existing-sub-category-image">
                    <input type="file" class="form-control input-flat" name="sub-category-image" id="sub-category-image">
                    <img src="../../images/sub-category/'.$row1['sub_category_image'].'" class="img-fluid rounded pt-2" alt="" style="width: 100px; height: auto; max-height: 200px; max-width: 200px;">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="update-sub-category-submit-btn">Save Changes</button>
        </div>
    </div>';

echo $output;
?>