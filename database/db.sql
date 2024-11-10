
CREATE TABLE pokemons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL,
  description TEXT NULL,
  extension VARCHAR(100) NOT NULL
);

CREATE TABLE powers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pokemon_id INT,
    attack_name VARCHAR(255) NOT NULL,
    attack_points INT NOT NULL,
    defense_points INT NOT NULL,
    FOREIGN KEY (pokemon_id) REFERENCES pokemons(id) ON DELETE CASCADE
);

CREATE TABLE weapons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  weapon_name VARCHAR(255) NOT NULL,
  weakness_name VARCHAR(255) NOT NULL,
  weakness_casualties INT NOT NULL,
  strength_name VARCHAR(255) NOT NULL,
  strength_level INT NOT NULL,
  cost INT NOT NULL
);

CREATE TABLE weapon_effects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    weapon_id INT,
    pokemon_id INT,
    defense_loss INT NOT NULL,
    FOREIGN KEY (weapon_id) REFERENCES weapons(id) ON DELETE CASCADE,
    FOREIGN KEY (pokemon_id) REFERENCES pokemons(id) ON DELETE CASCADE
);

-- Updated insertions for the pokemons table with descriptions
INSERT INTO pokemons (image, name, type, description, extension) VALUES 
  ('bulbizarre', 'Bulbizarre', 'Plante/Poison', 'Un Pokémon plante avec une graine sur son dos.', 'png'),
  ('papilusion', 'Papilusion', 'Insecte/Vol', 'Un papillon gracieux avec des ailes colorées.', 'png'),
  ('florizarre', 'Florizarre', 'Plante/Poison', 'Évolution puissante avec une grande fleur sur le dos.', 'png'),
  ('evoli', 'Évoli', 'Normal', 'Un Pokémon mignon capable de multiples évolutions.', 'png'),
  ('octillery', 'Octillery', 'Eau', 'Un Pokémon céphalopode expert en tir de projectiles d''eau.', 'png'),
  ('dracaufeu', 'Dracaufeu', 'Feu/Vol', 'Un dragon cracheur de feu avec des ailes imposantes.', 'png'),
  ('carapuce', 'Carapuce', 'Eau', 'Une petite tortue bleue qui attaque avec des jets d''eau.', 'png'),
  ('tyranocif', 'Tyranocif', 'Roche/Ténèbre', 'Un Pokémon massif, robuste et redouté pour sa force brute.', 'png'),
  ('pyroli', 'Pyroli', 'Feu', 'Une évolution flamboyante d''Évoli avec une crinière ardente.', 'png'),
  ('sabelette', 'Sabelette', 'Sol', 'Un Pokémon fouisseur à la peau dure, résistant aux attaques électriques.', 'png');


INSERT INTO powers (pokemon_id, attack_name, attack_points, defense_points) 
VALUES 
    (1, 'Fouet Lianes', 50, 75),       -- Bulbizarre
    (2, 'Tornade', 60, 70),            -- Papilusion
    (3, 'Tranche Herbe', 55, 80),      -- Florizarre
    (4, 'Charge', 40, 60),             -- Évoli
    (5, 'Pistolet à Eau', 55, 65),     -- Octillery
    (6, 'Lance-Flammes', 70, 85),      -- Dracaufeu
    (7, 'Écume', 45, 70),              -- Carapuce
    (8, 'Mâchouille', 65, 90),         -- Tyranocif
    (9, 'Flammèche', 60, 70),          -- Pyroli
    (10, 'Griffe', 35, 50);            -- Sabelette

INSERT INTO weapons (weapon_name, weakness_name, weakness_casualties, strength_name, strength_level, cost) 
VALUES 
  ('Lance-filet', 'Feu', 5, 'Capture', 60, 300),           -- Pour les Pokémon de type feu
  ('Flèche paralysante', 'Eau', 3, 'Paralysie', 40, 200),  -- Pour les Pokémon de type eau
  ('Rayon de glace', 'Plante', 4, 'Gel', 70, 450),         -- Efficace contre les Pokémon de type plante
  ('Lance-flammes', 'Glace', 6, 'Brûlure', 80, 500),       -- Pour les Pokémon de type glace
  ('Canon à roches', 'Vol', 2, 'Renversement', 50, 350),   -- Conçu pour les Pokémon volants
  ('Piège électrique', 'Eau', 5, 'Étourdissement', 65, 400); -- Pour les Pokémon de type eau

INSERT INTO weapon_effects (weapon_id, pokemon_id, defense_loss) 
VALUES
    -- Lance-filet (id: 1) effects
    (1, 6, 40),   -- Very effective against Dracaufeu (Fire/Flying)
    (1, 9, 35),   -- Effective against Pyroli (Fire)
    (1, 1, 15),   -- Less effective against Bulbizarre
    (1, 2, 20),   -- Moderate effect on Papilusion
    (1, 3, 15),   -- Less effective against Florizarre
    (1, 4, 25),   -- Normal effect on Evoli
    (1, 5, 20),   -- Moderate effect on Octillery
    (1, 7, 20),   -- Moderate effect on Carapuce
    (1, 8, 25),   -- Normal effect on Tyranocif
    (1, 10, 25),  -- Normal effect on Sabelette

    -- Flèche paralysante (id: 2) effects
    (2, 5, 35),   -- Very effective against Octillery (Water)
    (2, 7, 35),   -- Very effective against Carapuce (Water)
    (2, 1, 20),   -- Moderate effect on Bulbizarre
    (2, 2, 25),   -- Normal effect on Papilusion
    (2, 3, 20),   -- Moderate effect on Florizarre
    (2, 4, 25),   -- Normal effect on Evoli
    (2, 6, 20),   -- Less effective against Dracaufeu
    (2, 8, 25),   -- Normal effect on Tyranocif
    (2, 9, 25),   -- Normal effect on Pyroli
    (2, 10, 25),  -- Normal effect on Sabelette

    -- Rayon de glace (id: 3) effects
    (3, 1, 40),   -- Very effective against Bulbizarre (Grass)
    (3, 3, 40),   -- Very effective against Florizarre (Grass)
    (3, 2, 25),   -- Normal effect on Papilusion
    (3, 4, 25),   -- Normal effect on Evoli
    (3, 5, 20),   -- Less effective against Octillery
    (3, 6, 30),   -- Effective against Dracaufeu
    (3, 7, 20),   -- Less effective against Carapuce
    (3, 8, 25),   -- Normal effect on Tyranocif
    (3, 9, 25),   -- Normal effect on Pyroli
    (3, 10, 25),  -- Normal effect on Sabelette

    -- Lance-flammes (id: 4) effects
    (4, 2, 35),   -- Very effective against Papilusion (Bug)
    (4, 1, 35),   -- Very effective against Bulbizarre (Grass)
    (4, 3, 35),   -- Very effective against Florizarre (Grass)
    (4, 4, 25),   -- Normal effect on Evoli
    (4, 5, 20),   -- Less effective against Octillery
    (4, 6, 15),   -- Less effective against Dracaufeu
    (4, 7, 20),   -- Less effective against Carapuce
    (4, 8, 25),   -- Normal effect on Tyranocif
    (4, 9, 15),   -- Less effective against Pyroli
    (4, 10, 25),  -- Normal effect on Sabelette

    -- Canon à roches (id: 5) effects
    (5, 6, 40),   -- Very effective against Dracaufeu (Flying)
    (5, 2, 35),   -- Effective against Papilusion (Flying)
    (5, 1, 25),   -- Normal effect on Bulbizarre
    (5, 3, 25),   -- Normal effect on Florizarre
    (5, 4, 25),   -- Normal effect on Evoli
    (5, 5, 25),   -- Normal effect on Octillery
    (5, 7, 25),   -- Normal effect on Carapuce
    (5, 8, 20),   -- Less effective against Tyranocif (Rock)
    (5, 9, 25),   -- Normal effect on Pyroli
    (5, 10, 25),  -- Normal effect on Sabelette

    -- Piège électrique (id: 6) effects
    (6, 5, 40),   -- Very effective against Octillery (Water)
    (6, 7, 40),   -- Very effective against Carapuce (Water)
    (6, 1, 25),   -- Normal effect on Bulbizarre
    (6, 2, 25),   -- Normal effect on Papilusion
    (6, 3, 25),   -- Normal effect on Florizarre
    (6, 4, 25),   -- Normal effect on Evoli
    (6, 6, 30),   -- Effective against Dracaufeu (Flying)
    (6, 8, 25),   -- Normal effect on Tyranocif
    (6, 9, 25),   -- Normal effect on Pyroli
    (6, 10, 15);  -- Less effective against Sabelette (Ground)