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
                        <table class="table table-xs primary-table-bordered orders-table">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Message</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>';




    $sql="select * from contact_us order by timestamp desc";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result)){

            $output .='
            <tr>
                <td>
                    <p>'.$i++.'</p>
                </td>

                <td>
                    <p class="one-line-text">'.ucwords($row['name']).'</p>
                </td>

                <td>
                    <p class="one-line-text">'.$row['email'].'</p>
                </td>

                <td>
                    <p class="one-line-text">'.$row['mobile'].'</p>
                </td>

                <td>
                    <p class="one-line-text">'.ucfirst($row['message']).'</p>
                </td>

                <td class="text-right d-flex">
                    <a href="tel: '.$row['mobile'].'" class="btn btn-success btn-sm mx-1" >
                        <i class="fa-solid fa-phone px-2"></i>
                    </a>

                    <button type="button" class="btn btn-primary btn-sm view-contact-us-btn" data-contact-us-id="'.$row['id'].'" data-toggle="modal" data-target="#ModalCenter">
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