<?php   

    include("_session_start.php");
    include("_dbconnect.php");

    $output='';

    $sql="select packages.name as name, packages.main_image as image, packages.new_price as new_price, packages.old_price as old_price, packages.description as description, packages.banner_image as banner_image, packages.country as country, packages.state as state, packages.city as city, packages.tour_duration as tour_duration, packages.best_month as best_month, packages.included as included, packages.type as type, packages.location_link as location_link, category.name as category from packages join category on category.id=packages.category_id where packages.package_id={$_POST['package_id']} and packages.is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
        // echo json_encode($row);
        $output .='
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">package Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <div class="">
                        <img src="../../images/packages/'.$row['image'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                    </div>
                    <div class="col">
                        <div class="row">
                            <b class="col">Name: </b>
                            <p class="col">'.ucwords($row['name']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Old Price: </b>
                            <p class="col">&#8377; '.number_format($row['old_price']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">New Price: </b>
                            <p class="col">&#8377; '.number_format($row['new_price']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Discount: </b>
                            <p class="col">';
                            
                        if($row['old_price']>0)
                        {
                            $output .= ''. 100 - round(($row['new_price']/$row['old_price'])*100) .' %';
                        }    
                        else
                        {
                            $output .='NA';
                        }
                            
                        $output .=' </p>
                        </div>
                        <div class="row">
                            <b class="col">Package Type: </b>
                            <p class="col">'.ucwords($row['type']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Category: </b>
                            <p class="col">'.ucwords($row['category']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Country: </b>
                            <p class="col">'.ucwords($row['country']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">State: </b>
                            <p class="col">'.ucwords($row['state']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">City: </b>
                            <p class="col">'.ucwords($row['city']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Tour Duration: </b>
                            <p class="col">'.ucwords($row['tour_duration']).' Days</p>
                        </div>
                        <div class="row">
                            <b class="col">Best Month: </b>
                            <p class="col">'.strtoupper($row['best_month']).'</p>
                        </div>
                        <div class="row">
                            <b class="col">Included: </b>
                            <p class="col">'.ucwords($row['included']).'</p>
                        </div>
                    </div>
                </div>
                <br/><hr/>

                <b>Banner Images:</b><br/>
                <div class="container-fluid">
                    <div class="d-flex align-items-start" style="overflow-x: auto">
                            <div class="m-2">
                                <img src="../../images/packages/'.$row['banner_image'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                            </div>';
        
        $output .='
                    </div>
                </div><hr/>
                
                <b>Related Images:</b><br/>
                <div class="container-fluid">
                    <div class="d-flex align-items-start" style="overflow-x: auto">';

                    $sql_image = "select * from package_images where package_id={$_POST['package_id']} and is_deleted=0";
                    $result_image=mysqli_query($conn, $sql_image);

                    if(mysqli_num_rows($result_image)>0)
                    {
                        while($row_image=mysqli_fetch_assoc($result_image))
                        {
                            $output .='
                                <div class="m-2">
                                    <img src="../../images/packages/'.$row_image['image_path'].'" class="img-fluid rounded" alt="" style="width: 200px; height: auto; max-height: 200px; max-width: 200px;">
                                </div>';
                        }
                    }
        
        $output .='
                    </div>
                </div><hr/>

                <b>Location:</b><br/>
                <div class="container-fluid">
                    <div class="">
                        '.$row['location_link'].'
                    </div>
                </div><hr/>

                <b>Discription:</b><br/>
                <div class="container-fluid">
                    <div class="">
                        <p>'.ucwords($row['description']).'</p>
                    </div>
                </div>';

        
        $output .='

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        ';
        echo $output;
    }
    else
    {
        echo 0;
    }

?>