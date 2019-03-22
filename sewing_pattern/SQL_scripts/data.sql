DELETE FROM designer;
INSERT INTO designer (shortname, name, web) 
	VALUES ('Ottobre', 'Studio Tuumat Oy', 'https://www.ottobredesign.com/de/');
INSERT INTO designer (shortname, name, firstname, web) 
	VALUES ('Schnabelina', 'Pax', 'Roswitha', 'http://schnabelina.blogspot.de/');
INSERT INTO designer (shortname, name, firstname, web) 
	VALUES ('allerlieblichst', 'Schlipf', 'Christiane', 'http://www.allerlieblichst.de');
INSERT INTO designer (shortname, name, firstname, web) 
	VALUES ('klimperklein', 'Dohmen', 'Pauline', 'http://www.klimperklein.com/');

DELETE FROM style;
INSERT INTO style (styleid, name, description)
	VALUES (1, 'sporty', 'sporting clothes');
INSERT INTO style (styleid, name)
	VALUES (2, 'elegant');	
INSERT INTO style (styleid, name)
	VALUES (3, 'cosy');
INSERT INTO style (styleid, name)
	VALUES (4, 'practical');
	
DELETE FROM sizes;
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (6, 'children', '116');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (5, 'children', '104');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (1, 'children', '56');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (7, 'children', '128');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (2, 'children', '68');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (8, 'children', '140');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (3, 'children', '80');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (4, 'children', '92');	
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (9, 'adults', '40');
INSERT INTO sizes (sizeid, agegroup, clsize) 
	VALUES (10, 'other', 'unisize');

DELETE FROM category;
INSERT INTO category (catid, name) 
	VALUES (1, 'skirts');
INSERT INTO category (catid, name) 
	VALUES (2, 'trousers');
INSERT INTO category (catid, name) 
	VALUES (3, 'dresses');
INSERT INTO category (catid, name) 
	VALUES (4, 'bags');
INSERT INTO category (catid, name, parentid) 
	VALUES (5, 'handbags', 4);
INSERT INTO category (catid, name, parentid)  
	VALUES (6, 'purses', 4);
INSERT INTO category (catid, name, parentid) 
	VALUES (7, 'short trousers', 2);
INSERT INTO category (catid, name, parentid) 
	VALUES (8, 'long trousers', 2);
INSERT INTO category (catid, name, parentid) 
	VALUES (9, 'leggings', 2);
INSERT INTO category (catid, name) 
	VALUES (10, 'shirts');
INSERT INTO category (catid, name)  
	VALUES (11, 'bodies and underwear');
	
DELETE FROM publication;
INSERT INTO publication (pubid, name, language, medium, reference, designer)
	VALUES (1, 'Ottobre 4/2012', 'de', 'magazine', '4/2012', 'Ottobre');
INSERT INTO publication (pubid, name, language, medium, reference, designer)
	VALUES (2, 'Ottobre 1/2009', 'fi', 'magazine', '1/2009', 'Ottobre');
INSERT INTO publication (pubid, name, language, medium, designer)
	VALUES (3, 'Bodykleid Luisa', 'de', 'ebook', 'Schnabelina');
INSERT INTO publication (pubid, name, language, medium, designer)
	VALUES (4, 'Eve & Evelinchen', 'de', 'ebook', 'allerlieblichst');
INSERT INTO publication (pubid, name, language, medium, designer)
	VALUES (5, 'Kinderkleid', 'de', 'ebook', 'klimperklein');
INSERT INTO publication (pubid, name, language, medium, reference, designer)
	VALUES (6, 'Kinderleicht - Nähen mit Jersey für Kinder von 0 bis 8', 'de', 'book', '9783772464027', 'klimperklein');
	
DELETE FROM pattern;
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (1, 'Kinderkleid', 5, 'beginner', 5, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (2, 'Eve', 7, 'intermediate', 4, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (3, 'Evelinchen', 7, 'intermediate', 4, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (4, 'Bodykleid Luisa', 6, 'intermediate', 3, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (5, 'Luisa Hose', 6, 'beginner', 3, 9);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (6, 'Rainy Sky', 3, 'beginner', 1, 9);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (7, 'Autumn Bouquet', 3, 'intermediate', 1, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (8, 'Rabbit Jump', 8, 'intermediate', 1, 3);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (9, 'Saimi svetarihousut', 2, 'beginner', 2, 9);
INSERT INTO pattern (patternid, name, pieces, difficulty, pubid, catid)
	VALUES (10, 'Sudoku rimpsuhame', 5, 'beginner', 2, 3);

DELETE FROM hasSize;
INSERT INTO hasSize (patternid, sizeid) VALUES (1, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (2, 9);
INSERT INTO hasSize (patternid, sizeid) VALUES (3, 1);
INSERT INTO hasSize (patternid, sizeid) VALUES (3, 2);
INSERT INTO hasSize (patternid, sizeid) VALUES (3, 3);
INSERT INTO hasSize (patternid, sizeid) VALUES (3, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (4, 1);
INSERT INTO hasSize (patternid, sizeid) VALUES (4, 2);
INSERT INTO hasSize (patternid, sizeid) VALUES (4, 3);
INSERT INTO hasSize (patternid, sizeid) VALUES (4, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (5, 1);
INSERT INTO hasSize (patternid, sizeid) VALUES (5, 2);
INSERT INTO hasSize (patternid, sizeid) VALUES (5, 3);
INSERT INTO hasSize (patternid, sizeid) VALUES (5, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (6, 1);
INSERT INTO hasSize (patternid, sizeid) VALUES (6, 2);
INSERT INTO hasSize (patternid, sizeid) VALUES (6, 3);
INSERT INTO hasSize (patternid, sizeid) VALUES (6, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (7, 1);
INSERT INTO hasSize (patternid, sizeid) VALUES (7, 2);
INSERT INTO hasSize (patternid, sizeid) VALUES (7, 3);
INSERT INTO hasSize (patternid, sizeid) VALUES (7, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (8, 6);
INSERT INTO hasSize (patternid, sizeid) VALUES (8, 7);
INSERT INTO hasSize (patternid, sizeid) VALUES (8, 8);
INSERT INTO hasSize (patternid, sizeid) VALUES (9, 4);
INSERT INTO hasSize (patternid, sizeid) VALUES (9, 5);
INSERT INTO hasSize (patternid, sizeid) VALUES (9, 6);
INSERT INTO hasSize (patternid, sizeid) VALUES (9, 7);
INSERT INTO hasSize (patternid, sizeid) VALUES (9, 8);
INSERT INTO hasSize (patternid, sizeid) VALUES (10, 5);
INSERT INTO hasSize (patternid, sizeid) VALUES (10, 6);
INSERT INTO hasSize (patternid, sizeid) VALUES (10, 7);
INSERT INTO hasSize (patternid, sizeid) VALUES (10, 8);

DELETE FROM hasStyle;
INSERT INTO hasStyle (patternid, styleid) VALUES (1, 4);
INSERT INTO hasStyle (patternid, styleid) VALUES (1, 3);
INSERT INTO hasStyle (patternid, styleid) VALUES (4, 3);
INSERT INTO hasStyle (patternid, styleid) VALUES (5, 3);