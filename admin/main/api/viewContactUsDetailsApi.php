<?php

include("_session_start.php");
include("_dbconnect.php");

$output ='';

$sql = "select * from contact_us where id='{$_POST['contact_us_id']}'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}



$output .='
<div class="modal-content">
    <!-- form header  -->
    <div class="modal-header align-items-center">
        <div class="form-title">View Contact Us Details</div>';


$output .='
        <div class="form-close-btn">
            <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
        </div>
    </div>

    <div class="modal-body">

        <div class="row mt-4">
            <div class="col-md">
                <b style="font-size: 14px;">Name</b>
                <p style="font-weight: 500;">'.ucwords($row['name']).'</p>
            </div>

            <div class="col-md">
                <b style="font-size: 14px;">Email</b>
                <p style="font-weight: 500;">'.ucwords($row['email']).'</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md">
                <b style="font-size: 14px;">Mobile</b>
                <p style="font-weight: 500;">'.ucwords($row['mobile']).'</p>
            </div>

            <div class="col-md">
                <b style="font-size: 14px;">Date And Time</b>
                <p style="font-weight: 500;">'.ucwords($row['timestamp']).'</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md">
                <b style="font-size: 14px;">Message</b>
                <p style="font-weight: 500;">'.ucwords($row['message']).'</p>
            </div>
        </div>

    </div>


    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>

';

echo $output;

?>