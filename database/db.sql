
CREATE TABLE pokemons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL,
  extension VARCHAR(100) NOT NULL 
);

INSERT INTO pokemons (image, name, type, extension) VALUES ('bulbizarre','Bulbizarre', 'Plante/Poison', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('papilusion','Papilusion', 'Insecte', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('florizarre','Florizarre', 'Plante/Poison', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('evoli','Évoli', 'Normal', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('octillery','octillery', 'Eau', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('dracaufeu','Dracaufeu', 'Feu/Vol', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('carapuce','Carapuce', 'Eau', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('tyranocif','Tyranocif', 'Roche/Ténèbre', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('pyroli','Pyroli', 'Feu', 'png');
INSERT INTO pokemons (image, name, type, extension) VALUES ('sabelette','Sabelette', 'Terre', 'png');