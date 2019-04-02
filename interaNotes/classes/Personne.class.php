<?php
class Personne{
	private $id;
	private $nom;
	private $prenom;
	private $mail;
	private $login;
	private $passwd;

	public function __construct($valeurs){
		if(!empty($valeurs)){
			$this->affecte($valeurs);
		}
	}

	public function affecte($valeurs){
		foreach($valeurs as $attribut => $valeur){

			switch($attribut){
				case 'idPersonne' :
					$this->setIdPersonne($valeur);
					break;

				case 'nom' :
					$this->setNomPersonne($valeur);
					break;

				case 'prenom' :
					$this->setPrenomPersonne($valeur);
					break;
				case 'mail' :
					$this->setMailPersonne($valeur);
					break;

				case 'login' :
					$this->setLoginPersonne($valeur);
					break;

				case 'mdp' :
					$this->setPasswdPersonne($valeur);
					break;
			}
		}
	}

	public function getIdPersonne(){
		return $this->id;
	}

	public function setIdPersonne($id){
		if(is_numeric($id)){
			$this->id = $id;
		}
	}

	public function getNomPersonne(){
		return $this->nom;
	}

	public function setNomPersonne($nom){
		$this->nom = $nom;
	}

	public function getPrenomPersonne(){
		return $this->prenom;
	}

	public function setPrenomPersonne($prenom){
		$this->prenom = $prenom;
	}

	public function getMailPersonne(){
		return $this->mail;
	}

	public function setMailPersonne($mail){
		$this->mail = $mail;
	}

	public function getLoginPersonne(){
		return $this->login;
	}

	public function setLoginPersonne($login){
		$this->login = $login;
	}

	public function getPasswdPersonne(){
		return $this->passwd;
	}

	public function setPasswdPersonne($passwd){
		$this->passwd = $passwd; //createProtectedPassword($passwd);
	}

}
