CREATE TABLE personne (
  idPersonne INT NOT NULL AUTO_INCREMENT,
  nom varchar(30) NOT NULL,
  prenom varchar(30) NOT NULL,
  mail varchar(30) NOT NULL,
  login varchar(30) NOT NULL,
  mdp varchar(50) NOT NULL,
  PRIMARY KEY (idPersonne)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE enseignant (
    idEnseignant INT NOT NULL,
	FOREIGN KEY (idEnseignant) REFERENCES personne(idPersonne),
    PRIMARY KEY (idEnseignant)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE eleve (
    idEleve INT NOT NULL,
	annee INT(4) NOT NULL,
	nomPromo VARCHAR(30) NOT NULL,
	FOREIGN KEY (idEleve) REFERENCES personne(idPersonne),
    PRIMARY KEY (idEleve)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE examen (
  idExamen INT NOT NULL AUTO_INCREMENT,
  titreExamen VARCHAR(50) NOT NULL,
  consigneExamen TEXT NOT NULL,
  nbEssaiPossible INT NOT NULL,
  dateDepot DATETIME NOT NULL,
  anneeScolaire INT(4) NOT NULL,
  PRIMARY KEY (idExamen)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE question (
  idQuestion INT NOT NULL,
  idExamen INT NOT NULL,
  intituleQuestion TINYTEXT NOT NULL,
  baremeQuestion DECIMAL(4,2) NOT NULL,
  zoneTolerance INT NOT NULL,
  FOREIGN KEY (idExamen) REFERENCES examen(idExamen),
  PRIMARY KEY(idQuestion,idExamen)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE enonce (
  idEnonce INT NOT NULL,
  titre VARCHAR(50) NOT NULL,
  consigne TEXT NOT NULL,
  PRIMARY KEY (idEnonce)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE sujet (
  idSujet INT NOT NULL AUTO_INCREMENT,
  idEnonce INT NOT NULL,
  semestre TINYINT(1) NOT NULL,
  idExamen INT NOT NULL,
  nbEssaiRealise INT NOT NULL,
  FOREIGN KEY (idEnonce) REFERENCES enonce(idEnonce),
  FOREIGN KEY (idExamen) REFERENCES examen(idExamen),
  PRIMARY KEY (idSujet,idEnonce)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE exerciceAttribue (
  idEleve INT NOT NULL,
  idSujet INT NOT NULL,
  FOREIGN KEY (idEleve) REFERENCES eleve(idEleve),
  FOREIGN KEY (idSujet) REFERENCES sujet(idSujet),
  PRIMARY KEY (idEleve,idSujet)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE note (
  idEleve INT NOT NULL,
  idSujet INT NOT NULL,
  note decimal(4,2) NOT NULL,
  FOREIGN KEY (idEleve) REFERENCES eleve(idEleve),
  FOREIGN KEY (idSujet) REFERENCES sujet(idSujet),
  PRIMARY KEY (idEleve,idSujet)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE images (
  idImage INT NOT NULL AUTO_INCREMENT,
  cheminImage TEXT NOT NULL,
  PRIMARY KEY (idImage)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE points (
  idPoint INT NOT NULL,
  idExamen INT NOT NULL,
  nomPoint VARCHAR(50) NOT NULL,
  estDonneesCatia TINYINT(1) NOT NULL,
  idSymboleMathematique INT NOT NULL,
  idFormuleMathematique INT NOT NULL,
  FOREIGN KEY (idExamen) REFERENCES examen(idExamen),
  PRIMARY KEY (idPoint, idExamen)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE valeurs (
  idValeur INT NOT NULL AUTO_INCREMENT,
  idPoint INT NOT NULL,
  valeur VARCHAR(50) NOT NULL,
  exposantValeur INT NOT NULL,
  uniteValeur VARCHAR(30) NOT NULL,
  uniteExposant INT NOT NULL,
  FOREIGN KEY (idPoint) REFERENCES points(idPoint),
  PRIMARY KEY (idValeur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE exerciceGenere (
  idSujet INT NOT NULL,
  idValeur INT NOT NULL,
  FOREIGN KEY (idSujet) REFERENCES sujet(idSujet),
  FOREIGN KEY (idValeur) REFERENCES valeurs(idValeur),
  PRIMARY KEY (idSujet,idValeur)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE resultatsAttendus (
  idSujet INT NOT NULL,
  idQuestion INT NOT NULL,
  resultat DECIMAL(20,2) NOT NULL,
  resultatExposant INT NOT NULL,
  resultatUnite VARCHAR(30) NOT NULL,
  exposantUnite INT NOT NULL,
  FOREIGN KEY (idSujet) REFERENCES sujet(idSujet),
  FOREIGN KEY (idQuestion) REFERENCES question(idQuestion),
  PRIMARY KEY (idQuestion, idSujet)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE resultatsEleves (
  dateResult DATETIME NOT NULL,
  idEleve INT NOT NULL,
  idSujet INT NOT NULL,
  idQuestion INT NOT NULL,
  resultat DECIMAL(20,2) NOT NULL,
  resultatExposant INT NOT NULL,
  resultatUnite VARCHAR(30) NOT NULL,
  exposantUnite INT NOT NULL,
  justification TEXT NOT NULL,
  precisionReponse DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (idEleve) REFERENCES eleve(idEleve),
  FOREIGN KEY (idSujet) REFERENCES sujet(idSujet),
  FOREIGN KEY (idQuestion) REFERENCES question(idQuestion),
  PRIMARY KEY (dateResult, idEleve, idSujet, idQuestion)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE dependances (
    idValeur INT NOT NULL,
	idValeurDependante INT NOT NULL,
	FOREIGN KEY (idValeur) REFERENCES valeurs(idValeur),
	FOREIGN KEY (idValeurDependante) REFERENCES valeurs(idValeur),
    PRIMARY KEY (idValeur, idValeurDependante)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;