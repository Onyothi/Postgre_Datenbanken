/* a) 1x operator tree and query with EXCEPT/ UNION/ INTERSECT */
/* show sizes, for which we do not have a pattern */
SELECT clsize, agegroup FROM sizes WHERE sizeid IN
((SELECT sizeid FROM sizes)
EXCEPT
(SELECT sizeid FROM hasSize));

/* b) 2x cartesian product or Join */
/* show all categories with subcategories */
SELECT p.name AS category, c.parentid AS catnr, c.name AS subcategory, c.catid AS subcatnr FROM category c, category p WHERE c.parentid = p.catid;

/* show all publication with the patterns they contain */
SELECT publication.name as publication, pattern.name AS pattern FROM pattern, publication WHERE pattern.pubid = publication.pubid;

/* c) 2x with set operators IN, NOT IN, ALL or EXISTS*/
/* select all foreign-language patterns */
SELECT name AS pattern, pieces, difficulty FROM pattern WHERE pubid NOT IN (SELECT pubid FROM publication WHERE language = 'de');
/* select designer who has the pattern with the smallest amount of pieces */
SELECT firstname, designer.name as lastname, shortname
FROM publication, designer, pattern 
WHERE publication.designer = designer.shortname
	AND publication.pubid = pattern.pubid
	AND	pieces <= ALL (SELECT pieces FROM pattern);

/* d) 2x with GROUP BY and aggregation function */
/* list all publications with the number of patterns included */
SELECT publication.name as publication, count(pattern.name) AS patterns FROM pattern, publication WHERE pattern.pubid = publication.pubid GROUP BY publication.name;
/* What is the average number of pieces? */
SELECT avg(pieces)AS average_pieces FROM pattern;

/* e) 1x with HAVING-clause */
/* select all designers, who created 2 or more patterns */
SELECT shortname, count(pattern.patternid) FROM publication, designer, pattern 
WHERE publication.designer = designer.shortname
	AND publication.pubid = pattern.pubid
GROUP BY shortname
HAVING count(pattern.patternid) >= 2;
