<?php
session_start();
require_once '../../FPDF/fpdf.php';
$connection = mysqli_connect('localhost', 'root', '', 'fnas');
if (isset($_POST['pdf'])) {
    class myPDF extends FPDF
    {
        function header()
        {
            $this->Image('../../images/logo.png', 10, 10, -2450);
            $this->SetFont('Arial', 'B', 14);
            $this->Cell(275, 5, 'NATURAL AND APPLIED SCIENCE STUDENT ASSOCIATION (NASSA)', 0, 1, 'C');
            $this->SetFont('Arial', '', 12);
            $this->Cell(275, 10, 'LIST OF REGISTERED STUDENT', 0, 1, 'C');
        }
        function footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
        function headerTable()
        {
            $this->SetFont('Arial', 'B', 7);
            $this->Cell(13, 10, 'S/N', 1, 0, 'C');
            $this->Cell(75, 10, 'FULLNAME', 1, 0, 'C');
            $this->Cell(45, 10, 'MATRIC NO/JAMB REG.NO', 1, 0, 'C');
            $this->Cell(45, 10, 'DEPARTMENT', 1, 0, 'C');
            $this->Cell(50, 10, 'COURSE OF STUDY', 1, 0, 'C');
            $this->Cell(21, 10, 'DATE OF BIRTH', 1, 0, 'C');
            $this->Cell(15, 10, 'GENDER', 1, 0, 'C');
            $this->Cell(22, 10, 'CURRENT LEVEL', 1, 0, 'C');
            $this->Ln();
        }
        function viewTable($connection)
        {
            $this->SetFont('Arial', 'B', 7);
            $sql = "SELECT name,jamb_reg,department,course,date_of_birth,gender,current_level FROM userdata WHERE status='1'";
            $query = mysqli_query($connection, $sql);
            $i = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                $this->Cell(13, 10, $i, 1, 0, 'C');
                $this->Cell(75, 10, $row['name'], 1, 0, 'L');
                $this->Cell(45, 10, $row['jamb_reg'], 1, 0, 'L');
                $this->Cell(45, 10, $row['department'], 1, 0, 'L');
                $this->Cell(50, 10, $row['course'], 1, 0, 'L');
                $this->Cell(21, 10, $row['date_of_birth'], 1, 0, 'C');
                $this->Cell(15, 10, $row['gender'], 1, 0, 'C');
                $this->Cell(22, 10, $row['current_level'], 1, 1, 'C');
                $i++;
            }
        }
    }
    $pdf = new myPDF();
    $pdf->SetLeftMargin(5);
    $pdf->AliasNbPages();
    $pdf->SetTitle('LIST OF REGISTERED STUDENT-NASSA');
    $pdf->AddPage('L', 'A4', 0);
    $pdf->headerTable();
    $pdf->viewTable($connection);
    $pdf->Output();
}
