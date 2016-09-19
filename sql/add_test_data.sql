-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Player (name, password) VALUES ('Antti', 'Antti123');
INSERT INTO Player (name, password) VALUES ('Henri', 'Henri123');

INSERT INTO Category (name) VALUES ('Ostokset');

INSERT INTO Job (name, description, importance, added) VALUES ('Ostoslista', 'maito', 3, NOW());
