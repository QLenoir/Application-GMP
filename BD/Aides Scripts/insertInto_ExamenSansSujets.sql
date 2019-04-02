
INSERT INTO `personne` VALUES 
(1,'Dupont','Jean', 'jean.dupont@etu.unilim.fr', 'Dupont07','dd12a0be622525ca9c70087737495a20c41870f7'),
(2,'Poitou','Nicolas', 'nicolas.poitou@etu.unilim.fr', 'Poitou13','d5abe173b1bf9ff8fe318c8744fe236c8a0614f8'),
(3,'Potter','Harry','harry.potter@etu.unilim.fr','Potter01','4c0bc787843c7a78ffe1bccf9761b19c6cd3ec72'),
(4,'McQueen','Flash','flash.mcqueen@etu.unilim.fr','McQueen05','391fbf9ce3238312c7d3f9c5e24e1b06d061de96'),
(5,'Sparrow','Jack','jack.sparrow@etu.unilim.fr','Sparrow54','6e9dcda6d2f78b48a2724b629ddcc96fc9ae8710');

INSERT INTO `eleve` VALUES (1,2018, "Promo 1A 2018"),(3,2018, "Promo 1A 2018"),(4,2018, "Promo 1A 2018"),(5,2018, "Promo 1A 2018");

INSERT INTO `enseignant` VALUES (2);

INSERT INTO `examen` VALUES (1,'Simulation d\'une fusée','En 2016, la fusée Ariane 5 a décollé du Centre Spatial Guyanais en direction de $destinationPlanète$ qui se situe à $distanceDestination$ Kms de notre chère Terre !<br><br>Nous savons que la fusée possède $nbMoteur$ moteur(s), la fusée peut aller à une vitesse de $vitesse$ Km/H et chaque moteur a une consommation de carburant qui vaut $consoCarburantParMoteurs$ Tonnes/1000 Kms !<br><br>A bord de cette fusée, l\'équipage est constitué de $nbPersonne$ personnes et chaque personne consomme $consoNourrituresParPersonneParJour$ Kgs de nourriture, $consoEauParPersonnesParJour$ L d\'eau et $consoO2ParPersonnesParJour$ L d\'O² par jour.','5','2019-01-30 00:00:00',2018);

INSERT INTO `images` VALUES 
(1,'sigma.png');

INSERT INTO `points` VALUES 
(1,1,'nbMoteur', 0,0,0),
(2,1,'vitesse', 0,0,0),
(3,1,'nbPersonne', 1,0,0),
(4,1,'destinationPlanète', 0,0,0),
(5,1,'distanceDestination', 1,1,0),
(6,1,'consoCarburantParMoteurs',0,0,0),
(7,1,'consoEauParPersonnesParJour',0,0,0),
(8,1,'consoNourrituresParPersonneParJour',0,0,0),
(9,1,'consoO2ParPersonnesParJour',0,0,0);

INSERT INTO `valeurs` VALUES 
(1,1,'1',0,'unité',0), /*nbMoteurs*/
(2,1,'2',0,'unité',0),
(3,1,'3',0,'unité',0),
(4,1,'4',0,'unité',0),
(5,1,'5',0,'unité',0),
(6,2,'1000',0,'km/h',0), /*vitesse*/
(7,2,'2000',0,'km/h',0),
(8,2,'3000',0,'km/h',0),
(9,2,'4000',0,'km/h',0),
(10,2,'5000',0,'km/h',0),
(11,3,'3',0,'unité',0), /*nbPersonnes*/
(12,3,'4',0,'unité',0),
(13,3,'5',0,'unité',0),
(14,3,'6',0,'unité',0),
(15,3,'7',0,'unité',0),
(16,3,'8',0,'unité',0),
(17,3,'9',0,'unité',0),
(18,3,'10',0,'unité',0),
(19,3,'11',0,'unité',0),
(20,3,'12',0,'unité',0),
(21,4,'Lune',0,'',0), /*planete*/
(22,4,'Mars',0,'',0),
(23,5,'340',0,'m',6), /*distance*/
(24,5,'350',0,'m',6),
(25,5,'360',0,'m',6),
(26,5,'370',0,'m',6),
(27,5,'380',0,'m',6),
(28,5,'390',0,'m',6),
(29,5,'400',0,'m',6),
(30,5,'410',0,'m',6),
(31,5,'50',0,'m',9),
(32,5,'100',0,'m',9),
(33,5,'150',0,'m',9),
(34,5,'200',0,'m',9),
(35,5,'250',0,'m',9),
(36,5,'300',0,'m',9),
(37,5,'350',0,'m',9),
(38,5,'400',0,'m',9),
(39,6,'100',0,'tonnes/1000km',0), /*ConsoCarburantParMoteurPar1000km*/
(40,7,'1.5',0,'L',0), /*ConsoEau*/
(41,8,'2',0,'g',3), /*ConsoNourriture*/
(42,9,'60',0,'L',0); /*ConsoO2*/

INSERT INTO `dependances` VALUES 
(6,1),
(7,2),
(8,3),
(9,4),
(10,5),

(23,21),
(24,21),
(25,21),
(26,21),
(27,21),
(28,21),
(29,21),
(30,21),

(31,22),
(32,22),
(33,22),
(34,22),
(35,22),
(36,22),
(37,22),
(38,22);

INSERT INTO `question` VALUES
(1,1,"Combien de jours seront nécessaires pour effectuer ce voyage ?",2,95),
(2,1,"Indiquez la quantité d'O2 nécessaire pour effectuer ce voyage ?",2,80),
(3,1,"Indiquez la quantité de carburant nécessaire pour effectuer ce voyage ?",2,80),
(4,1,"Indiquez la quantité de nourriture nécessaire pour effectuer ce voyage ?",2,75),
(5,1,"Indiquez la quantité d'eau nécessaire pour effectuer ce voyage ?",2,80)

