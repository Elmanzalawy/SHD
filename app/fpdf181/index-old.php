<?php
ob_start();
session_start();

require 'fpdf.php';
$db = new mysqli('localhost','root','','event_register');




class myPDF extends FPDF{
  function header(){
    $eventName = $_SESSION['eventName'];

    $this->SetFont('Arial','B',26);
    $this->Cell(276,15,$eventName,0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',18);
    $this->Cell(276,10,'Registered Users',0,0,'C');
    $this->Ln(20);
  }
  function footer(){
    $this->SetY(-15);
    $this->SetFont('Arial','',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C' );
  }
  function headerTable(){
    $this->SetFont('Times','B',18);
    $this->Cell(20,10,'ID',1,0,'C');
    $this->Cell(40,10,'Username',1,0,'C');
    $this->Cell(120,10,'Email',1,0,'C');
    $this->Cell(90,10,'Date Registered',1,0,'C');

    $this->Ln();
  }
  function viewTable($db){
    $eventName = $_SESSION['eventName'];
    $cleanedEventName = trim($eventName);
    $cleanedEventName = stripslashes($cleanedEventName);
    $cleanedEventName = htmlspecialchars($cleanedEventName);
    $cleanedEventName = str_replace(" ","_",$cleanedEventName);
    $eventId = $_SESSION['eventId'];
    $conn = mysqli_connect('localhost','root','','event_register');
    $sql = "SELECT * FROM register_$cleanedEventName";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

      do{
      $this->Cell(20,10,$row['user_id'],1,0,'C');
      $this->Cell(40,10,$row['username'],1,0,'L');
      $this->Cell(120,10,$row['email'],1,0,'L');
      $this->Cell(90,10,$row['register_date'],1,0,'L');
      $this->Ln();
    }while(($row = mysqli_fetch_array($result)) );
  }

}
$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();

ob_end_flush();

?>
