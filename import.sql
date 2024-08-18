DROP DATABASE IF EXISTS `appletaart`;
CREATE DATABASE `appletaart`;
USE `appletaart`;

CREATE TABLE `users` (
    userId int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username varchar(25),
    password varchar(255)
);

CREATE TABLE `contact` (
    contactId int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username varchar(25),
    onderwerp varchar(255),
    email varchar(255),
    tel varchar(255)
);

INSERT INTO users (`username`, `password`)
VALUES (
        'admin',
        '$2y$10$vXnbxTSyl6ESSlnDoEdydubJ87qkds05XHjhG2UEnatVWOcAtGWFK'
    );

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL
);

INSERT INTO locations (name, address) VALUES 
('Len Bakkerij', 'Kruseman van Eltenweg 4, 1817 BC Alkmaar'),
('Dudok Rotterdam', 'Meent 88, 3011 JP Rotterdam'),
('Winkel43', 'Noordermarkt 43, 1015 NA Amsterdam'),
('Coffee Corazon', 'Krommestraat 18, 3811 CC Amersfoort'),
('Sweets & Antiques', 'Hekelstraat 8, 1811 BM Alkmaar'),
('Cafe Papeneiland', 'Prinsengracht 2, 1015 DV Amsterdam'),
('De bruine boon', 'Stationsweg 1, 2312 AS Leiden'),
('Expresszo', 'Pottenmarkt 22, 4331 LM Middelburg'),
('Restaurant Noordzee', 'Badweg 200 Strandhotel Noordzee, 1796 AA Den Koog Texel'),
('Eetcafe de Kwikkel', 'Hoogesteeg 1, 16711 HR Medemblik'),
('’t Groene Pandje', 'Gedempte Gracht 77, 1507 CC Zaandam'),
('Limburgia Den Bosch', 'Rompertpassage 22, 5233 AN Den Bosch ’s Hertogenbosch');

CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rating INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    experience TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);