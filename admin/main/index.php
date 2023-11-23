<?php

session_start();
include("header.php");
include("api/_dbconnect.php");

if (!isset($_SESSION['user_type'])) {
    // header("Location: /tapti-final/");
    echo "<script>window.location.href = '/tour-and-travel';  </script>";
} else if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer') {
    // header("Location: /tapti-final/");
    echo "<script>window.location.href = '/tour-and-travel';  </script>";
}

?>


<!-- sidebar -->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Main</li>
            <li><a href="index.php"><i class=" mdi mdi-view-dashboard"></i> <span class="nav-text">Dashboard</span></a>
            </li>

            <li class="nav-label">Controls</li>

            <li>
                <a href="#" id="orders-tab">
                    <i class="mdi mdi-cart"></i>
                    <span class="nav-text">Orders</span>
                </a>
            </li>


            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-clapperboard"></i> <span class="nav-text">Banner</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-banner-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-banner-tab" data-toggle="modal" data-target="#ModalCenter">Add Banner</a>
                    </li>

                </ul>
            </li>


            <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                    <i class="fa-solid fa-mountain-city"></i>
                    <span class="nav-text">Destination State</span>
                    <span class="badge badge-danger nav-badge"></span>
                </a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-destination-state-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-destination-state-tab" data-toggle="modal" data-target="#ModalCenter">Add Destination State</a>
                    </li>

                </ul>
            </li>



            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-product-hunt"></i> <span class="nav-text">Packages</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-packages-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-packages-tab" data-toggle="modal" data-target="#ModalCenter">Add Package</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-folder-open"></i> <span class="nav-text">Category</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-category-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-category-tab" data-toggle="modal" data-target="#ModalCenter">Add Category</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#" id="contact-us-tab">
                    <i class="fa-solid fa-headset"></i>
                    <span class="nav-text">Contact Us</span>
                </a>
            </li>

        </ul>
    </div>
    <!-- #/ nk nav scroll -->
</div>
<!-- #/ sidebar -->
<!-- content body -->
<div class="content-body">
    <div class="fluid-container px-2 py-2">
        <div class="row page-titles">

            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Orders <span class="pull-right"><i class="ion-android-cart f-s-30 text-primary"></i></span></h4>
                        <h6 class="m-t-20 f-s-14 orders-count"></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Packages <span class="pull-right"><i class="fa fa-product-hunt f-s-30 text-success"></i></span></h4>
                        <h6 class="m-t-20 f-s-14 packages-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Category <span class="pull-right"><i class="fa fa-folder f-s-30 text-dark"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 category-count"></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Banners<span class="pull-right"><i class="fa-solid fa-clapperboard f-s-30 text-warning"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 banner-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Destination State<span class="pull-right">
                            <i class="fa-solid fa-mountain-city f-s-30 text-dark"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 destination-state-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4>Contact Us<span class="pull-right">
                            <i class="fa-solid fa-headset f-s-30 text-success"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 contact-us-count"></h6>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <h4 class="card-title pl-3 pt-3">Last 1 Month</h4>
                    <?php
                    // if(mysqli_num_rows($result_op)==0 && mysqli_num_rows($result_oc)==0 && mysqli_num_rows($result_s)==0 && mysqli_num_rows($result_ofd)==0 && mysqli_num_rows($result_d)==0 && mysqli_num_rows($result_c)==0)
                    // { 
                    //     echo '
                    //     <div class="card-body">
                    //     Data Doesn\'t Exist 
                    //     </div> ';
                    // }
                    // else
                    // {
                    //     echo '
                    //     <div class="card-body" id="delivery-pie-chart-for-1-month">

                    //     </div>';
                    // }
                    ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <h4 class="card-title pl-3 pt-3">Last 1 Year</h4>
                    <?php
                    // if(mysqli_num_rows($result_opy)==0 && mysqli_num_rows($result_ocy)==0 && mysqli_num_rows($result_sy)==0 && mysqli_num_rows($result_ofdy)==0 && mysqli_num_rows($result_dy)==0 && mysqli_num_rows($result_cy)==0)
                    // { 
                    //     echo '
                    //     <div class="card-body">
                    //         Data Doesn\'t Exist 
                    //     </div> ';
                    // }
                    // else
                    // {
                    //     echo '
                    //     <div class="card-body" id="delivery-pie-chart-for-1-year">

                    //     </div>';
                    // }
                    ?>
                    
                </div>
            </div>
            
        </div> -->


    </div>
    <!-- #/ container -->
</div>
<!-- #/ content body -->


<?php include("footer.php"); ?>