<?php 

    include("_session_start.php");
    include("_dbconnect.php");

    require("../libraries/fpdf/fpdf.php");

    $order_id=$_POST['order_id'];

    $sql="select * from orders where order_id='{$order_id}' and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
    }
    // Instantiate and use the FPDF class 
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(50, 10, 'Preet Holiday', 1, 0, 'C');
    $pdf->cell(70);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(70, 8, 'Order ID: '.$row['order_id'], 0, 1, 'L');
    $pdf->cell(120);
    $pdf->Cell(60, 8, 'Payment Method: '.strtoupper($row['payment_type']), 0, 1, 'L');
    $pdf->cell(120);
    $pdf->Cell(60, 8, 'Booking Date: '.$row['booking_date'], 0, 1, 'L');
    $pdf->cell(120);
    $pdf->Cell(60, 8, 'Tour Date: '.$row['tour_date'], 0, 1, 'L');
    

    $pdf->SetFont('Arial', 'B', 12);
    


    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'Packages', 0, 1, 'L');

    $pdf->Cell(120, 10, 'Package Name', 1, 0, 'C');
    $pdf->Cell(35, 10, 'No of Person', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Package Price', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);

    // code for geting the product details from product tables
    $sql_for_package="select * from packages where package_id={$row['package_id']}";
    $result_for_package=mysqli_query($conn, $sql_for_package);
    if(mysqli_num_rows($result_for_package)>0)
    {
        $row_for_package=mysqli_fetch_assoc($result_for_package);
    }

    $pdf->Cell(120, 10, $row_for_package['name'], 1, 0, 'L');
    $pdf->Cell(35, 10, $row['no_person'], 1, 0, 'C');
    $pdf->Cell(35, 10, number_format($row['package_price']), 1, 1, 'C');

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Subtotal', 0, 0, 'L');
    $pdf->Cell(35, 10, number_format($row['no_person']*$row['package_price']), 0, 1, 'C');


    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Tax', 0, 0, 'L');
    $pdf->Cell(35, 10, '0', 0, 1, 'C');

    $pdf->Line(130, 83, 200, 83);

    $pdf->Cell(120, 10, '', 0, 0, 'L');
    $pdf->Cell(35, 10, 'Total', 0, 0, 'L');
    $pdf->Cell(35, 10, number_format($row['no_person']*$row['package_price']), 0, 0, 'C');

    $pdf->Line(10, 93, 200, 93);

    $pdf->Output($row['order_id'].".pdf", 'D');
    // ob_end_flush();
    
?>