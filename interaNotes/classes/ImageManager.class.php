<?php
class ImageManager{

  private $db;

  public function __construct($db){
		$this->db = $db;
	}

  public function ajouterImage($cheminImage){
    $sql = "INSERT INTO images (cheminImage) VALUES (:cheminImage);";

    $requete = $this->db->prepare($sql);
    $requete->bindValue(':cheminImage', $cheminImage);
    $resultat = $requete->execute();
    $requete->closeCursor();

    return $resultat;
  }

  public function getAllImages(){
    $sql = "SELECT idImage, cheminImage FROM images";

    $requete = $this->db->prepare($sql);
    $requete->execute();

    while($image = $requete->fetch(PDO::FETCH_OBJ)){
			$listeImages[] = new Image($image);
		}
    $requete->closeCursor();

    return $listeImages;
  }

  public function supprimerImage($idImage){

    $sql = "UPDATE `points` SET `idFormuleMathematique` = '0' WHERE idFormuleMathematique=:idImage";
    $requete = $this->db->prepare($sql);
    $requete->bindValue(':idImage', $idImage);
    $requete->execute();
    $requete->closeCursor();

    $sql = "UPDATE `points` SET `idSymboleMathematique` = '0' WHERE idSymboleMathematique=:idImage";
    $requete = $this->db->prepare($sql);
    $requete->bindValue(':idImage', $idImage);
    $requete->execute();
    $requete->closeCursor();

    $sql = "DELETE FROM `images` WHERE `images`.`idImage` = :idImage;";
    $requete = $this->db->prepare($sql);
    $requete->bindValue(':idImage', $idImage);
    $requete->execute();
    $requete->closeCursor();
  }
}
