DROP TYPE IF EXISTS age, mediumtype, difflevel CASCADE;

CREATE TYPE age AS ENUM ('children', 'adults', 'other', 'dolls');
CREATE TYPE mediumtype AS ENUM ('book', 'ebook', 'magazine', 'other');
CREATE TYPE difflevel AS ENUM ('beginner', 'intermediate', 'professional', 'other');
