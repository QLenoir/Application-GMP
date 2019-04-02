<?php
class GestionCSV{

  public static function recupererDonneesDeCSV($file){
    $row = 1;
    $handle = fopen("$file", "r");

    while (($data = fgetcsv($handle, 4096, ",")) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c=0; $c < $num; $c++) {
            $tabDonnees[] = $data[0];
        }
    }

    fclose($handle);

    return $tabDonnees;
  }
}
