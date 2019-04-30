CREATE TABLE IF NOT EXISTS Vendeur
(
	Email_ECE VARCHAR(255) PRIMARY KEY NOT NULL ,
	Pseudo VARCHAR(255),
	Nom VARCHAR(255),
	Prenom VARCHAR(255)
);
CREATE TABLE IF NOT EXISTS ImgVendeur
(
	Nom VARCHAR(255) PRIMARY KEY NOT NULL,
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
	Id_item INT PRIMARY KEY NOT NULL ,
	Nom VARCHAR(255),
	Video VARCHAR(255),
	Categorie ENUM('Livres','Musique','Vetements','Sports'),
	Prix INT,
	Genre BOOLEAN,
	Taille VARCHAR(255),
	Couleur ENUM ('jaune','orange','marron','rose','beige','rouge','violet','bleu','vert','noir','blanche','gris'),
	Quantite INT
);
CREATE TABLE IF NOT EXISTS ImgItem
(
	Nom VARCHAR(255) PRIMARY KEY NOT NULL,
	Id_item INT,
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
	Quantite INT,
	FOREIGN KEY (Email_ECE) REFERENCES Vendeur(Email_ECE),
	FOREIGN KEY (Id_item) REFERENCES Item(Id_item),
	PRIMARY KEY (Email_ECE,Id_item)
);

CREATE TABLE IF NOT EXISTS Panier
(
	Email_client VARCHAR(255),
	Id_item INT,
	Quantite INT,
	FOREIGN KEY (Email_client) REFERENCES CLient(Email_client),
	FOREIGN KEY (Id_item) REFERENCES Item(Id_item),
	PRIMARY KEY (Email_client,Id_item)
);
INSERT INTO Vendeur (Email_ECE,Pseudo,Nom,Prenom)
VALUES 
('louis.deveze@edu.ece.fr','Louloudu14','Deveze','Louis'),
('paul.chasseloup@edu.ece.fr','Gladalle78','Chasseloup','Paul'),
('tom.jouvet@edu.ece.fr','Akane','Jouvet','Tom');

INSERT INTO ImgVendeur (Nom, Email_ECE, isProfil)
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
INSERT INTO Item (Id_item,Nom, Video,Categorie, Prix,Genre,Taille,Couleur,Quantite)
VALUES
(1, 'Rickroll','https://www.youtube.com/watch?v=dQw4w9WgXcQ','Musique',4,null,null,null,3),
(2, 'Harry Potter et les gilets jaunes','https://www.youtube.com/watch?v=OZ6KaQXykQE','Livres',20,null,null,null,6),
(3, 'Tshirt bordeau UNICLO','https://www.youtube.com/watch?v=sogkfan2VHw','Vetements',15,1,'M','rouge',10),
(4, 'Barre de traction','https://www.youtube.com/watch?v=RLDlqbumvW0','Sports',21,null,null,null,2);
INSERT INTO ImgItem(Nom,Id_item)
VALUES
('rick.png',1),
('roll.png',1),
('harry.png',2),
('volda.png',2),
('demission.png',2),
('unispastrop.png',3),
('muscu.png',4),
('pompe.png',4),
('tract.png',4),
('mort.png',4);

INSERT INTO Client(Email_client,Nom,Prenom,Password,Adresse,Ville,Code_postal,Pays,Telephone,Type_carte,Numero_carte,Nom_carte,Date_carte,Code_carte)
VALUES
('tomjouvet@gmail.com','Jouveet','Tooom','toto','3 rue Lieutenant Colonel','Rueil',92500,'France','0667382817','Visa',"5436271829302935",'Tom Jouvet','1998-06-03',333),
('iron.throne@gmail.com','Lannister','Cersei','elephant','3 rue Moineaux','Port Réal',00001,'Westeros','0667389012','PayPal',"5638392018293929",'Tywin Lannister','1789-06-04',666);

INSERT INTO Carte_bancaire(Numero_carte,Type_carte,Nom_carte,Date_carte,Code_carte)
VALUES
("5436271829302935",'Visa','Tom Jouvet','1998-06-03',333);

INSERT INTO Vendre(Email_ECE,Id_item,Quantite)
VALUES
('tom.jouvet@edu.ece.fr',4,1),
('paul.chasseloup@edu.ece.fr',2,5),
('louis.deveze@edu.ece.fr',1,2);

INSERT INTO Panier(Email_client,Id_item,Quantite)
VALUES
('tomjouvet@gmail.com',2,3),
('iron.throne@gmail.com',4,1);