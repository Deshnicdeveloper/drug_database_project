<?php
$nomduserveur = "localhost";
$nomdutilisateur = "root";
$passeword = " ";
$nomdubd = "drug_database";
$connect = new mysqli($nomduserveur, $nomdutilisateur, $passeword, $nomdubd);
if ($connect->connect_error) {
    
}
