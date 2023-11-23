<?php 
    include("_session_start.php");
    include("_dbconnect.php");

    $output = '';

    $output .='
    <div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="active-member">
                    <div class="table-responsive">
                        <table class="table table-xs primary-table-bordered destination-state-table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>State</th>
                                    <th>Min Temp</th>
                                    <th>Max Temp</th>
                                     <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>';
    $sql="select * from destination_state where is_deleted=0";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result))
        {
            $output .='
                    <tr>
                        <td>
                            '.$i++.'
                        </td>
                        <td>
                            <img src="../../images/destination_state/'.$row['state_image'].'" class="w-40px rounded m-r-10" alt="">
                        </td>
                        <td>';

                        $sql_state = "select * from states where id={$row['state_id']} and is_deleted=0";
                        $result_state=mysqli_query($conn, $sql_state);
        
                        if(mysqli_num_rows($result_state)==1)
                        {
                            $row_state=mysqli_fetch_assoc($result_state);
                            $output .='<span>'.ucwords($row_state['state_name']).'</span>';
                        }

                $output .='
                        </td>
                        <td>
                            <span>'.ucwords($row['min_temp']).'&deg;</span>
                        </td>
                        <td>
                            <span>'.ucwords($row['max_temp']).'&deg;</span>
                        </td>
                        <td class="text-right">
                            <button type="button" class="btn btn-danger btn-sm delete-destination-state-btn" data-destination-state-id="'.$row['id'].'">
                                <i class="fa-solid fa-trash-can px-2"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm update-destination-state-btn" data-destination-state-id="'.$row['id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-solid fa-pen-to-square px-2"></i>
                            </button>
                            <button type="button" class="btn btn-primary btn-sm view-destination-state-btn" data-destination-state-id="'.$row['id'].'" data-toggle="modal" data-target="#ModalCenter">
                                <i class="fa-regular fa-eye px-2"></i>
                            </button>
                        </td>
                </tr>';
        }
    }

$output .='                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    ';

echo $output;

?>