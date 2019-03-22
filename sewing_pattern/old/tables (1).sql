CREATE TABLE sizes (
	sizeid int PRIMARY KEY, 
	agegroup age NOT NULL, 
	clsize varchar(7) NOT NULL
);
CREATE TABLE category (
	catid int PRIMARY KEY, 
	name varchar(50),
	parentid int REFERENCES category(catid) ON DELETE SET NULL
);
CREATE TABLE designer (
	shortname varchar(40) PRIMARY KEY,
	name varchar(40) NOT NULL, 
	firstname varchar(40), 
	web text
);

CREATE TABLE style (
	styleid int PRIMARY KEY, 
	name varchar(50),
	description text
);

CREATE TABLE publication (
	pubid int PRIMARY KEY,
	name text NOT NULL,
	language char(2),
	medium mediumtype NOT NULL,
	reference varchar(20),
	price int,
	designer varchar(40) REFERENCES designer(shortname) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE pattern (
	patternid int PRIMARY KEY, 
	name varchar(20) NOT NULL,
	pieces int,
	difficulty difflevel,
	pubid int NOT NULL,
	catid int NOT NULL,
	remark text,
	FOREIGN KEY (pubid) REFERENCES publication(pubid) ON DELETE CASCADE,
	FOREIGN KEY (catid) REFERENCES category(catid) ON DELETE SET NULL ON UPDATE CASCADE
);
CREATE TABLE hasSize (
	patternid int REFERENCES pattern ON DELETE CASCADE, 
	sizeid int REFERENCES sizes, 
	primary key(patternid, sizeid)
);

CREATE TABLE hasStyle (
	patternid int REFERENCES pattern ON DELETE CASCADE, 
	styleid int REFERENCES styleid, 
	primary key(patternid, styleid)
);

SELECT *
FROM pattern as p, publication as pb, category as category
WHERE p.pubid=pb.pubid AND p.catid=pb.catid AND c.name="summer"
GROUP BY pubid, patternid, medium;

SELECT *
FROM hasStyle as hs, style as s,pattern as p
WHERE hs.styleid=s.styleid AND hs.patternid=p.patternid
GROUP BY s.styleid,s.name, p.name;

(SELECT sizeid, patternid FROM sizes,pattern)
EXCEPT
(SELECT sizeid FROM hasSize);  
   
			or

(SELECT sizeid, patternid FROM sizes,pattern)
WHERE sizeid NOT IN
(SELECT sizeid FROM hasSize);               