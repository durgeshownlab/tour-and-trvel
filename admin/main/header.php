<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <link href="css/style.css" rel="stylesheet">

    <!-- toaster  css  -->
    <link href="../assets/plugins/toastr/css/toastr.min.css" rel="stylesheet">

    <script src="js/modernizr-3.6.0.min.js"></script>


    <!-- font awesome cdn link -->
    <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>
</head>

<body class="v-light vertical-nav fix-header fix-sidebar">

    <!-- code for preloader  -->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <!-- code for modal dialog  -->
    <div class="modal fade show" id="ModalCenter" style="z-index: 99999">
        <div class="modal-dialog modal-lg" role="document">
        </div>
    </div>

    <!-- code for main wrapper  -->
    <div id="main-wrapper">
        <!-- header -->
        <div class="header">
            <div class="nav-header">
                <div class="brand-logo"><a href="index.php"><b><img src="../assets/images/logo.png" alt=""> </b><span class="brand-title"></span></a>
                </div>
                <div class="nav-control">
                    <div class="hamburger"><span class="line"></span> <span class="line"></span> <span class="line"></span>
                    </div>
                </div>
            </div>
            <div class="header-content">
                <div class="header-left">
                    <ul>

                        <li class="icons position-relative"><a href="javascript:void(0)"><i class="icon-magnifier f-s-16"></i></a>
                            <div class="drop-down animated bounceInDown">
                                <div class="dropdown-content-body">
                                    <div class="header-search" id="header-search">
                                        <form action="#">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search" id="search-bar">
                                                <div class="input-group-append"><span class="input-group-text"><i class="icon-magnifier"></i></span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="header-right">
                    <ul class="d-flex">
                        <li class="d-flex mx-2">
                            <b>Hii, &nbsp;</b>
                            <span>
                                <?php
                                // $firstname = explode(' ', $_SESSION['user_name']);
                                // echo $firstname[0];
                                ?>
                                <span>
                        </li>
                        <li class="icons"><a href="javascript:void(0)"><i class="mdi mdi-account f-s-20" aria-hidden="true"></i></a>
                            <div class="drop-down dropdown-profile animated bounceInDown">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a href="../../logout.php"><i class="icon-power"></i> <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #/ header -->