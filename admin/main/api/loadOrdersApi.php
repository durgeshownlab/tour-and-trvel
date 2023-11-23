<?php 
    include("_session_start.php");
    include("_dbconnect.php");

    $output = '';

    $output .='
        <div class="sort-filter-bar-container">
            <div class="filter-button">
                <i class="fa-solid fa-sliders"></i>&nbsp;Filter
                <div class="filter-list-container">
                    <div class="filter-list">

                        <div class="payment-mode-filter">
                            <p class="bg-primary">Payment Mode</p>
                            <div class="filter-item">
                                <input type="checkbox" name="payment-mode[]" id="cod-filter" value="cod">
                                <label for="cod-filter">COD</label>
                            </div>

                            <div class="filter-item">
                                <input type="checkbox" name="payment-mode[]" id="online-filter" value="online">
                                <label for="online-filter">Online</label>
                            </div>
                        </div>

                        <div class="delivery-status-filter">
                            <p class="bg-primary">Payment Status</p>
                            <div class="filter-item">
                                <input type="checkbox" name="payment-status[]" id="payment-placed-filter" value="pending">
                                <label for="payment-placed-filter">Pending</label>
                            </div>
                            <div class="filter-item">
                                <input type="checkbox" name="payment-status[]" id="payment-confirmed-filter" value="success">
                                <label for="payment-confirmed-filter">Success</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="sort-button">
                <i class="fa-solid fa-sort"></i>&nbsp;Sort
                <div class="sort-list-container">
                    <div class="sort-list">
                        <p class="bg-primary">Sort By</p>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="default-sort" value="default" checked>
                            <label for="default-sort">Default</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="newest-first-sort" value="newest first" >
                            <label for="newest-first-sort">Newest First</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="oldest-first-sort" value="oldest first">
                            <label for="oldest-first-sort">Oldest First</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="low-to-high-sort" value="low to high">
                            <label for="low-to-high-sort">Price - Low to High</label>
                        </div>

                        <div class="sort-item">
                            <input type="radio" name="sort-by" id="high-to-low-sort" value="high to low">
                            <label for="high-to-low-sort">Price - High to Low</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="export-button">
                <i class="fa-solid fa-file-arrow-down"></i>&nbsp; Export
            </div>

            <div class="date-range">
                <label for="from">From</label>
                <input type="date" id="from" name="from">
                <label for="to">to</label>
                <input type="date" id="to" name="to">
                <input type="button" value="Get" id="filter-by-date-range">
            </div>
        </div>';

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
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>No of Person</th>
                                    <th>Total Price</th>
                                    <th>Payment Status</th>
                                    <th>Booking Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>';




    $sql="select * from orders order by booking_date desc";
    $result=mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)>0)
    {
        $i=1;
        while($row=mysqli_fetch_assoc($result)){
            $sql2="select name from packages where package_id={$row['package_id']}";
            $result2=mysqli_query($conn, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }
            
            $output .='
            <tr data-order-id="'.$row['order_id'].'">
                <td>
                    <p>'.$i++.'</p>
                </td>

                <td>
                    <p>'.$row['order_id'].'</p>
                </td>

                <td>
                    <p>'.ucwords($row2['name']).'</p>
                </td>

                <td>
                    <p>'.ucwords($row['no_person']).'</p>
                </td>

                <td>
                    <p> &#8377; '.number_format($row['total_price']).'</p>
                </td>

                <td>
                    <p class="badge';
            if($row['payment_status']=='success')
            {
                $output .=' badge-success';
            }        
            else if($row['payment_status']=='pending')
            {
                $output .=' badge-warning';
            }        
                    
            
            $output .='">'.ucwords($row['payment_status']).'</p>
                </td>

                <td>
                    <p>'.ucwords($row['tour_date']).'</p>
                </td>

                <td class="text-right">
                    <button type="button" class="btn btn-primary btn-sm view-order-btn" data-order-id="'.$row['order_id'].'" data-toggle="modal" data-target="#ModalCenter">
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