<?php
require('FPDF.class.php');

class PDF extends FPDF
{

    protected $hauteur;
// En-tête
    function Header($idSujet)
    {
    // Logo
        $this->Image('../../image/board.png',10,6,30);
    // Police Arial gras 15
        $this->SetFont('Arial','B',15);
    // Décalage à droite
        $this->Cell(80);
    // Titre
        $this->Cell(30,10,'Sujet N° '.$idSujet,0,0,'C');
    // Saut de ligne
        $this->Ln(20);
    }

// Pied de page
    function Footer()
    {
    // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
    // Police Arial italique 8
        $this->SetFont('Arial','I',8);
    // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function AddTitre($titre){
        $this->SetFont('Arial','B',12);
        $this->Cell(37,10,"Titre de l'énoncé : ",0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$titre,0,1);
    }

    function AddDate($date){
        $this->SetFont('Arial','B',12);
        $this->Cell(25,10,"Date de fin : ",0,0);
        $this->SetFont('Arial','',12);
        $this->Cell(0,10,$date,0,1);
        $this->hauteur=60;
    }

    function AddEnonce($enonce){
        $this->SetFont('Arial','BU',12);
        $this->Cell(25,10,"Enoncé : ",0,1);
        $this->SetFont('Arial','',12);
        $enonce=str_replace("<br>","
            ",$enonce);
        $this->MultiCell(0,10,$enonce,0,1);
    }

    function AddQuestion($question){
        $this->SetFont('Arial','BU',12);
        $this->Cell(25,10,"Questions : ",0,1);
        $this->SetFont('Arial','',12);
        $this->MultiCell(0,10,$question,0,1);
    }

     function AddImages($image1,$image2){
        $this->SetFont('Arial','BU',12);
        $this->Cell(25,10,"Images : ",0,0);
        $this->Image('../../'.$image1,50,$this->y,30);
        $this->Image('../../'.$image2,125,$this->y,30);
    }


}
