
CREATE TABLE pokemons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL
);

INSERT INTO pokemons (image, name, type) VALUES ('bulbizarre','Bulbizarre', 'Plante/Poison');
INSERT INTO pokemons (image, name, type) VALUES ('herbizarre','Herbizarre', 'Plante/Poison');
INSERT INTO pokemons (image, name, type) VALUES ('florizarre','Florizarre', 'Plante/Poison');
INSERT INTO pokemons (image, name, type) VALUES ('evoli','Évoli', 'Normal');
INSERT INTO pokemons (image, name, type) VALUES ('octillery','octillery', 'Eau');
INSERT INTO pokemons (image, name, type) VALUES ('dracaufeu','Dracaufeu', 'Feu/Vol');
INSERT INTO pokemons (image, name, type) VALUES ('carapuce','Carapuce', 'Eau');
INSERT INTO pokemons (image, name, type) VALUES ('tyranocif','Tyranocif', 'Roche/Ténèbre');
INSERT INTO pokemons (image, name, type) VALUES ('pyroli','Pyroli', 'Feu');
INSERT INTO pokemons (image, name, type) VALUES ('sabelette','Sabelette', 'Terre');