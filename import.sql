CREATE DATABASE commerce;
USE commerce;
CREATE TABLE IF NOT EXISTS Vendeur
(
	Email_ECE VARCHAR(255) PRIMARY KEY NOT NULL ,
	Pseudo VARCHAR(255),
	Nom VARCHAR(255),
	Prenom VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS ImgVendeur
(
	Nom_vendeur VARCHAR(255) PRIMARY KEY NOT NULL,
	Email_ECE VARCHAR(255),
	isProfil BOOLEAN,
	FOREIGN KEY (Email_ECE) REFERENCES Vendeur(Email_ECE)
);
CREATE TABLE IF NOT EXISTS Admin
(
	Pseudo VARCHAR(255) PRIMARY KEY NOT NULL,
	Password VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Item
(
	Id_item INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	Nom VARCHAR(255),
	Description VARCHAR(255),
	Video VARCHAR(255),
	Categorie ENUM('Livres','Musique','Vetements','Sports'),
	Prix INT,
	Genre BOOLEAN,
	Taille VARCHAR(255),
	Couleur ENUM ('jaune','orange','marron','rose','beige','rouge','violet','bleu','vert','noir','blanche','gris'),
	Quantite INT,
	Vendu INT
);
CREATE TABLE IF NOT EXISTS ImgItem
(
	Nom_img VARCHAR(255) PRIMARY KEY NOT NULL,
	Id_item INT,
	Is_main BOOLEAN,
	FOREIGN KEY (Id_item) REFERENCES Item(Id_item)
);
CREATE TABLE IF NOT EXISTS Client
(
	Email_client VARCHAR(255) PRIMARY KEY NOT NULL,
	Nom VARCHAR(255),
	Prenom VARCHAR(255),
	Password VARCHAR(255),
	Adresse VARCHAR(255),
	Ville VARCHAR(255),
	Code_postal INT,
	Pays VARCHAR(255),
	Telephone VARCHAR(10),
	Type_carte ENUM('Visa','MasterCard','American','PayPal'),
	Numero_carte VARCHAR(19),
	Nom_carte VARCHAR(255),
	Date_carte DATE,
	Code_carte INT
);
CREATE TABLE  IF NOT EXISTS Carte_bancaire
(
	Numero_carte VARCHAR(19) PRIMARY KEY NOT NULL,
	Type_carte ENUM('Visa','MasterCard','American','PayPal'),
	Nom_carte VARCHAR(255),
	Date_carte DATE,
	Code_carte INT
);

CREATE TABLE  IF NOT EXISTS Vendre
(
	Email_ECE VARCHAR(255),
	Id_item INT,
	Quantite_vendeur INT,
	FOREIGN KEY (Email_ECE) REFERENCES Vendeur(Email_ECE),
	FOREIGN KEY (Id_item) REFERENCES Item(Id_item),
	PRIMARY KEY (Email_ECE,Id_item)
);

CREATE TABLE IF NOT EXISTS Panier
(
	Email_client VARCHAR(255),
	Id_item INT,
	Quantite_panier INT,
	FOREIGN KEY (Email_client) REFERENCES CLient(Email_client),
	FOREIGN KEY (Id_item) REFERENCES Item(Id_item),
	PRIMARY KEY (Email_client,Id_item)
);
INSERT INTO Vendeur (Email_ECE,Pseudo,Nom,Prenom)
VALUES 
('louis.deveze@edu.ece.fr','Louloudu14','Deveze','Louis'),
('paul.chasseloup@edu.ece.fr','Gladalle78','Chasseloup','Paul'),
('tom.jouvet@edu.ece.fr','Akane','Jouvet','Tom');

INSERT INTO ImgVendeur (Nom_vendeur, Email_ECE, isProfil)
VALUES
('louis.png','louis.deveze@edu.ece.fr', 1),
('louis_fond.png','louis.deveze@edu.ece.fr', 0),
('paul.png','paul.chasseloup@edu.ece.fr', 1),
('paul_fond.png','paul.chasseloup@edu.ece.fr', 0),
('tom.png','tom.jouvet@edu.ece.fr', 1),
('tom_fond.png','tom.jouvet@edu.ece.fr', 0);
INSERT INTO Admin (Pseudo,Password)
VALUES
('root','root');
INSERT INTO Item (Id_item,Nom,Description,Video,Categorie, Prix,Genre,Taille,Couleur,Quantite,Vendu)
VALUES
(1,'Candide','Un classique interessant, a lire et relire !','https://www.youtube.com/watch?v=_h-fP2nt9fM','Livres',11,null,null,null,20, 234),
(2,'Simplissime','Le livre de cuisine le plus vendu en france','https://www.youtube.com/watch?v=tDgmIjtmOr4','Livres',25,null,null,null,6, 13),
(3,'Dictionnaire Larousse','Contiens 74 000 définitions. Incroyable non ?','https://www.youtube.com/watch?v=PM5iH7XL-Nw','Livres',9,null,null,null,6, 4837),
(4,'Divergent vol.1','le premier volume d\'une trilogie qui fais rêver les adolescents et les grands enfants !','https://www.youtube.com/watch?v=MGpz8Y5dNRY','Livres',20,null,null,null,10, 433),
(5,'L\'encyclopedie','receuil de connaissances de diverses domaines','https://www.youtube.com/watch?v=B333warhGtM','Livres',13,null,null,null,39, 975),
(6,'Eragon','Un classique dans le domaine de la fantaisie !','https://www.youtube.com/watch?v=JXUznp9-fLY','Livres',9,null,null,null,56, 62),
(7,'Le livre des 7 couronnes','Le livre qui a fait naitre la serie mythique "Games Of Thrones" : il n\'a rien a envier a l\'oeuvre de reference de Tolkien dans ce domaine','https://www.youtube.com/watch?v=TZE9gVF1QbA','Livres',10,null,null,null,574, 12537),
(8,'Germinales','Un classique écrit par le grand écrivain Emile Zola','https://www.youtube.com/watch?v=rXfaHDOZ2mA','Livres',19,null,null,null,63, 63),
(9,'The godfather','un livre de Mario Puzo','https://www.youtube.com/watch?v=X-jdl9hcCeg','Livres',16,null,null,null,12, 99),
(10,'Je suis une supermaman !','un livre qui est visiblement destiné aux mamans narcissiques',null,'Livres',3,null,null,null,12, 3),
(11,'Harry Potter vol.1','Probablement le livre le plus lu de l\'histoire après la bible !','https://www.youtube.com/watch?v=Yn_uHvb5vPQ','Livres',17,null,null,null,6666, 6666),
(12,'Hunger Games','devenu très populaire recemment grace a sa sortie au cinema, ce bestseller aura vous faire trembler d\'exitation !','https://www.youtube.com/watch?v=wqUq0lsQ684','Livres',14,null,null,null,100, 17642),
(13,'Les misérables','Le grand classique de Victor Hugo','https://www.youtube.com/watch?v=ql_RjmRJEzw','Livres',12,null,null,null,38, 497),
(14,'Adele','musique pop 2000','https://www.youtube.com/results?search_query=adele+someone+like+you','Musique',10,null,null,null,3, 99),
(15,'Angele','Rap moderne et engagé','https://www.youtube.com/watch?v=Hi7Rx3En7-k','Musique',10,null,null,null,389, 49745),
(16,'Beatles','Bon rock indemodable','https://www.youtube.com/watch?v=2Q_ZzBGPdqE','Musique',10,null,null,null,353, 1745),
(17,'Beyonce','un plaisir visuel... oui c\'est irronique quand on parle de musique','https://www.youtube.com/watch?v=4m1EFMoRFvY','Musique',10,null,null,null,832, 2165),
(18,'Bob Marley','Un icone du reggae','https://www.youtube.com/watch?v=pHlSE9j5FGY','Musique',10,null,null,null,290, 643),
(19,'Daft Punk','Des gens masqués','https://www.youtube.com/watch?v=5NV6Rdv1a3I','Musique',10,null,null,null,970, 35567),
(20,'David Guetta','un dj francais surcoté','https://www.youtube.com/watch?v=5dbEhBKGOtY','Musique',10,null,null,null,90, 567),
(21,'Johnny Halliday','l\'icone francaise du rock','https://www.youtube.com/watch?v=s3O1Xro7oAI','Musique',10,null,null,null,9, 7),
(22,'Jul','une erreur de la nature','https://www.youtube.com/watch?v=pDWVXdiK-p0','Musique',1,null,null,null,1, 1),
(23,'Justin','je suis a court la...','https://www.youtube.com/watch?v=DK_0jXPuIr0','Musique',10,null,null,null,57, 1987),
(24,'Michael Jackson','Star de la pop !','https://www.youtube.com/watch?v=QNJL6nfu__Q','Musique',10,null,null,null,521, 3387),
(25,'Nirvana','Vachement cool !','https://www.youtube.com/watch?v=hTWKbfoikeg','Musique',10,null,null,null,21, 337),
(26,'Queen','de loin le meilleur groupe de tout les temps !','https://www.youtube.com/watch?v=t99KH0TR-J4','Musique',12,null,null,null,2251, 598737),
(27,'Arc d\'entrainement','très bon arc pour débuter','https://www.youtube.com/watch?v=Yekyf-l11wQ','Sports',53,null,null,null,21, 337),
(28,'Armure','Pour les samourais en herbe !','https://www.youtube.com/watch?v=a8v79oql2B0&t=253s','Sports',230,null,null,null,4, 36),
(29,'Balles Ping-Pong','des belles balles oranges','https://www.youtube.com/watch?v=UeG1ftTmLAg','Sports',6,null,null,null,80, 765),
(30,'Canoe','bon canoe entrée de gamme pour debutants','https://www.youtube.com/watch?v=8oOPn1t0Wiw','Sports',99,null,null,null,8, 75),
(31,'Chaise Romaine','Quand la salle ne te suffit plus !','https://www.youtube.com/watch?v=v9qMlin2kS0','Sports',344,null,null,null,3, 29),
(32,'Halteres','Très bon choix pour commencer la musculation','https://www.youtube.com/watch?v=XH2ov50EmgI','Sports',54,null,null,null,8, 70),
(33,'Kayak','un kayak de haut niveau reservé aux experts !','https://www.youtube.com/watch?v=ZJZk_EmtA4c','Sports',498,null,null,null,50, 710),
(34,'Lot d\'haltères','Pour haltérophiles de niveau intermédiaires','https://www.youtube.com/watch?v=vtAFr1khMYA','Sports',263,null,null,null,39, 602),
(35,'Raquette de Ping-Pong','Bonne raquette pour s\'ammuser le weekend','https://www.youtube.com/watch?v=-iOhlbabVS4','Sports',24,null,null,null,321, 502),
(36,'Raquette de tennis','Raquette très polyvalente','https://www.youtube.com/watch?v=bq_RlLnZdCU','Sports',39,null,null,null,78, 472),
(37,'Table de Ping-Pong','Très belle table avec le meilleur rapport qualité prix du marché !','https://www.youtube.com/watch?v=dX4Wl21Pr2c','Sports',199,null,null,null,68, 392),
(38,'Costume femme','Costume de très bonne qualité','https://www.youtube.com/watch?v=65MZQyxvyEU','Vetements',301,0,'S','noir',7, 42),
(39,'Costume homme','Costume très classe pour les hommes les vrais','https://www.youtube.com/watch?v=73CNGkGAR7s','Vetements',300,1,'XL','noir',10, 102),
(40,'Jean coupe slim','en gros c\'est un jean','https://www.youtube.com/watch?v=IhKXP6Tu-Z4','Vetements',58,0,'L','bleu',19, 282),
(41,'Jean coupe strait','En gros c\'est un jean mais different','https://www.youtube.com/watch?v=WwkKmZyflRA','Vetements',54,1,'M','bleu',45, 391),
(42,'Belle Robe','une robe ravisante qui soulignera elegamment vos courbes','https://www.youtube.com/watch?v=86_tK9UzHJY','Vetements',331,0,'M','noir',5, 39),
(43,'Short pour femme','short élégant pour l\'été','https://www.youtube.com/watch?v=mWbEelaymck','Vetements',63,0,'L','bleu',5, 39),
(44,'Short classique','Short avec une coupe classique','https://www.youtube.com/watch?v=T7ECB2i6xIM','Vetements',22,1,'S','bleu',50, 343),
(45,'Short de sport','Idéal pour les sports en interieur ou en exterieur par beau temps','https://www.youtube.com/watch?v=OKdEZFacHQc','Vetements',39,1,'M','violet',57, 301),
(46,'T-shirt blanc','Un beau tshirt blanc','https://www.youtube.com/watch?v=d1K-OrFo7QA','Vetements',38,1,'M','blanc',78, 1750),
(47,'T-shirt gris','Un très joli tshirt gris','https://www.youtube.com/watch?v=fH6oSWBFSg0','Vetements',19,1,'XL','gris',70, 772),
(48,'T-shirt rose','Un très joli tshirt rose avec un chat trop mims','https://www.youtube.com/watch?v=OJ8HeOC7Ono','Vetements',34,0,'XS','rose',7, 49);

INSERT INTO ImgItem(Nom_img,Id_item,Is_main)
VALUES
('Pictures/livres/candide.jpg',1,1),
('Pictures/livres/cuisine.jpg',2,1),
('Pictures/livres/dictionnaire.jpg',3,1),
('Pictures/livres/divergente.jpg',4,1),
('Pictures/livres/encyclopedie.jpg',5,1),
('Pictures/livres/eragon.jpg',6,1),
('Pictures/livres/gamesofthrones.jpg',7,1),
('Pictures/livres/germinales.jpg',8,1),
('Pictures/livres/godfather.jpg',9,1),
('Pictures/livres/guide_maman.jpg',10,1),
('Pictures/livres/harry_potter.jpg',11,1),
('Pictures/livres/hungergames.jpg',12,1),
('Pictures/livres/miserables.jpg',13,1),
('Pictures/musiques/adele.jpg',14,1),
('Pictures/musiques/angele.jpg',15,1),
('Pictures/musiques/beatles.jpg',16,1),
('Pictures/musiques/beyonce.jpg',17,1),
('Pictures/musiques/bob_marley.jpg',18,1),
('Pictures/musiques/daft_punk.jpg',19,1),
('Pictures/musiques/david_guetta.jpg',20,1),
('Pictures/musiques/johnny.jpg',21,1),
('Pictures/musiques/jul.jpg',22,1),
('Pictures/musiques/justin.jpg',23,1),
('Pictures/musiques/michael_jackson.jpg',24,1),
('Pictures/musiques/nirvana.jpg',25,1),
('Pictures/musiques/queen.jpg',26,1),
('Pictures/sports_loisirs/arc.jpg',27,1),
('Pictures/sports_loisirs/armure_kendo.jpg',28,1),
('Pictures/sports_loisirs/balles_pingpong.jpg',29,1),
('Pictures/sports_loisirs/canoe.jpg',30,1),
('Pictures/sports_loisirs/chaise_romaine.jpg',31,1),
('Pictures/sports_loisirs/halteres.jpg',32,1),
('Pictures/sports_loisirs/kayak.jpg',33,1),
('Pictures/sports_loisirs/lot_halteres.jpg',34,1),
('Pictures/sports_loisirs/raquette_pingpong.jpg',35,1),
('Pictures/sports_loisirs/raquette_tennis.jpg',36,1),
('Pictures/sports_loisirs/table_pingpong.jpg',37,1),
('Pictures/vetements/costume_femme.jpg',38,1),
('Pictures/vetements/costume_homme.jpg',39,1),
('Pictures/vetements/jean_femme.jpg',40,1),
('Pictures/vetements/jean_homme.jpg',41,1),
('Pictures/vetements/robe_femme.jpg',42,1),
('Pictures/vetements/short_femme.jpg',43,1),
('Pictures/vetements/short_homme.jpg',44,1),
('Pictures/vetements/short_sport_homme.jpg',45,1),
('Pictures/vetements/tshirt_blanc_femme.jpg',46,1),
('Pictures/vetements/tshirt_gris_homme.jpg',47,1),
('Pictures/vetements/tshirt_rose.jpg',48,1);


INSERT INTO Client(Email_client,Nom,Prenom,Password,Adresse,Ville,Code_postal,Pays,Telephone,Type_carte,Numero_carte,Nom_carte,Date_carte,Code_carte)
VALUES
('tomjouvet@gmail.com','Jouveet','Tooom','toto','3 rue Lieutenant Colonel','Rueil',92500,'France','0667382817','Visa',"5436271829302935",'Tom Jouvet','1998-06-03',333),
('iron.throne@gmail.com','Lannister','Cersei','elephant','3 rue Moineaux','Port Réal',00001,'Westeros','0667389012','PayPal',"5638392018293929",'Tywin Lannister','1789-06-04',666);

INSERT INTO Carte_bancaire(Numero_carte,Type_carte,Nom_carte,Date_carte,Code_carte)
VALUES
("5436271829302935",'Visa','Tom Jouvet','1998-06-03',333);

INSERT INTO Vendre(Email_ECE,Id_item,Quantite_vendeur)
VALUES
('tom.jouvet@edu.ece.fr',4,1),
('paul.chasseloup@edu.ece.fr',2,5),
('louis.deveze@edu.ece.fr',1,2);

INSERT INTO Panier(Email_client,Id_item,Quantite_panier)
VALUES
('tomjouvet@gmail.com',2,3),
('iron.throne@gmail.com',4,1);