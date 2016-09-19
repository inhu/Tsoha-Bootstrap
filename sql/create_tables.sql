-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Player(
id SERIAL PRIMARY KEY,
name varchar(50) NOT NULL,
password varchar(50) NOT NULL
);

CREATE TABLE Category(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
name varchar(50) NOT NULL
);

CREATE TABLE Job(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
category_id INTEGER REFERENCES Category(id),
name varchar(50) NOT NULL,
done boolean DEFAULT FALSE,
description varchar(400),
importance INTEGER,
added DATE
);
