CREATE FUNCTION inregistrare_utilizator(text,text,text) RETURNS text
	AS 'DECLARE
		user_ok integer;
		valabil integer;
		ucod integer;
		numele text;
		prenumele text;
		data_inscriere date;
	BEGIN
	SELECT count(nick) into user_ok FROM tb_utilizatori WHERE nick=$1;
		IF user_ok=0 THEN
			SELECT count(cnp) into valabil FROM tb_elevi WHERE cnp=$3;
			IF valabil=0 THEN
				SELECT count(cnp) into valabil FROM tb_profesori WHERE cnp=$3;
				IF valabil=0 THEN
					SELECT count(cnp) into valabil FROM tb_parinti WHERE cnp=$3;
					IF valabil=0 THEN
						SELECT count(cnp) into valabil FROM tb_administratori WHERE cnp=$3;
						IF valabil=0 THEN
							RETURN ''Nu faci parte din acest liceu'';
						ELSE
							SELECT id_admin,nume_admin,prenume_admin into ucod,numele,prenumele from tb_administratori where cnp=$3;
							SELECT current_date into data_inscriere;
							INSERT INTO tb_utilizatori(nume,prenume,nick,parola,privilegiu,data_inscrierii,cod) VALUES(numele,prenumele,$1,$2,''admin'',data_inscriere,ucod);
							RETURN ''Inregistrare efectuata!'';
						END IF;
					ELSE
						SELECT cod_parinte,nume_parinte,prenume_parinte into ucod,numele,prenumele from tb_parinti where cnp=$3;
						SELECT current_date into data_inscriere;
						INSERT INTO tb_utilizatori(nume,prenume,nick,parola,privilegiu,data_inscrierii,cod) VALUES(numele,prenumele,$1,$2,''parinte'',data_inscriere,ucod);
						RETURN ''Inregistrare efectuata!'';
					END IF;
				ELSE
					SELECT cod_profesor,nume_profesor,prenume_profesor into ucod,numele,prenumele from tb_profesori where cnp=$3;
					SELECT current_date into data_inscriere;
					INSERT INTO tb_utilizatori(nume,prenume,nick,parola,privilegiu,data_inscrierii,cod) VALUES(numele,prenumele,$1,$2,''profesor'',data_inscriere,ucod);
					RETURN ''Inregistrare efectuata!'';
				END IF;
			ELSE
				SELECT id_elev,nume_elev,prenume_elev into ucod,numele,prenumele from tb_elevi where cnp=$3;
				SELECT current_date into data_inscriere;
				INSERT INTO tb_utilizatori(nume,prenume,nick,parola,privilegiu,data_inscrierii,cod) VALUES(numele,prenumele,$1,$2,''elev'',data_inscriere,ucod);
				RETURN ''Inregistrare efectuata!'';
			END IF;
		ELSE
			RETURN ''Numele de utilizator exista deja!'';
		END IF;
	END;'
	LANGUAGE plpgsql;

select inregistrare_utilizator('prelipca','parolaa','1900515325253'); --bun

DROP FUNCTION creare_tabel_info(text,text,text);
---------------------------------user,privilegiu
CREATE FUNCTION creare_tabel_info(text,text,text) RETURNS text
 AS 'DECLARE
	 cod_user integer;
	 nume_view text:=$3;
	 BEGIN
	 EXECUTE ''DROP VIEW IF EXISTS '' || nume_view || '';'';
	 SELECT cod into cod_user FROM tb_utilizatori WHERE nick=$1;
	 IF $2=''elev'' THEN
		EXECUTE ''CREATE VIEW  '' || nume_view || '' AS SELECT a.id_elev,a.nume_elev,a.prenume_elev,a.data_nastere,a.telefon,b.localitate,b.strada,b.nrcasa,b.ap from tb_elevi a,adrese_tb_elevi b where a.id_elev=b.id_elev and a.id_elev='' || cod_user ||'';'';
		RETURN ''ok'';
	 ELSE
		IF $2=''profesor'' THEN
			EXECUTE ''CREATE VIEW  '' || nume_view || '' AS SELECT a.nume_profesor,a.prenume_profesor,a.data_nastere,a.telefon,b.localitate,b.strada,b.nrcasa,b.ap from tb_profesori a,adrese_tb_profesori b where a.cod_profesor=b.cod_profesor and a.cod_profesor='' || cod_user ||'';'';
			RETURN ''ok'';
		ELSE
			IF $2=''parinte'' THEN
			EXECUTE ''CREATE VIEW  '' || nume_view || '' AS SELECT a.cod_elev,a.nume_parinte,a.prenume_parinte,a.telefon,b.nume_elev,b.prenume_elev from tb_parinti a,tb_elevi b where a.cod_elev=b.id_elev and a.cod_parinte='' || cod_user ||'';'';
			RETURN ''ok'';
			END IF;
		END IF;
	 END IF;
	 END;'
	 LANGUAGE plpgsql;

drop function creare_tabel_info(text,text,text);
select creare_tabel_info('prelipca','elev','cp19n');

CREATE FUNCTION vizualizare_colegi(text,text) RETURNS text
AS 'DECLARE
	cod_user integer;
	cod_clasa integer;
	nume_view text:=$2;
	BEGIN
	EXECUTE ''DROP VIEW IF EXISTS '' || nume_view || '';'';
	SELECT cod into cod_user FROM tb_utilizatori where nick=$1;
	SELECT id_clasa into cod_clasa FROM tb_elevi where id_elev=cod_user;
	EXECUTE ''CREATE VIEW  '' || nume_view || '' AS SELECT nume_elev,prenume_elev from tb_elevi where id_clasa='' || cod_clasa || '';'';
	RETURN ''ok'';
	END;'
	LANGUAGE plpgsql;

drop function vizualizare_colegi(text,text)
select vizualizare_colegi('prelipca');

CREATE FUNCTION vizualizare_tb_profesori(text,text) RETURNS text
AS 'DECLARE
	cod_user integer;
	cod_clasa integer;
	nume_view text:=$2;
	BEGIN
	EXECUTE ''DROP VIEW IF EXISTS '' || nume_view || '';'';
	SELECT cod into cod_user FROM tb_utilizatori where nick=$1;
	SELECT id_clasa into cod_clasa FROM tb_elevi where id_elev=cod_user;
	EXECUTE ''CREATE VIEW  '' || nume_view || '' AS SELECT a.nume_profesor,a.prenume_profesor,c.nume_disciplina from tb_profesori a,tb_prof_disc_clasa b,tb_discipline c where b.cod_profesor=a.cod_profesor and c.cod_disciplina=a.cod_disciplina and b.cod_clasa='' || cod_clasa || '';'';
	RETURN ''ok'';
	END;'
	LANGUAGE plpgsql;
	
select vizualizare_tb_profesori('prelipca');

CREATE FUNCTION deconectare(text) RETURNS text
AS 'DECLARE
	nume_view text:=$1;
	BEGIN
	EXECUTE ''DROP VIEW IF EXISTS '' || nume_view || '';'';
	RETURN ''ok'';
	END;'
	LANGUAGE plpgsql;
	
DROP FUNCTION deconectare(text);

CREATE FUNCTION vizualizare_tb_elevi(text) RETURNS text
AS 'DECLARE
	cod_user integer;
	BEGIN
	DROP TABLE IF EXISTS tabel_tb_elevi;
	SELECT cod into cod_user FROM tb_utilizatori where nick=$1;
	EXECUTE ''CREATE TABLE tabel_tb_elevi AS SELECT a.nume_elev,a.prenume_elev FROM tb_elevi a,clase b,prof_disc_clasa c where c.cod_profesor='' || cod_user || '' and c.cod_clasa=b.cod_clasa and b.cod_clasa=a.id_clasa;'';
	RETURN ''ok'';
	END;'
	LANGUAGE plpgsql;

select vizualizare_tb_elevi('amarian');

//sa modific sa incerc sa pun si clasa in tabel
CREATE FUNCTION vizualizare_tb_elevi(text) RETURNS text
AS 'DECLARE
	cod_user integer;
	BEGIN
	DROP TABLE IF EXISTS tabel_tb_elevi;
	SELECT cod into cod_user FROM tb_utilizatori where nick=$1;
	EXECUTE ''CREATE TABLE tabel_tb_elevi AS SELECT a.nume_elev,a.prenume_elev FROM tb_elevi a,clase b,prof_disc_clasa c where c.cod_profesor='' || cod_user || '' and c.cod_clasa=b.cod_clasa and b.cod_clasa=a.id_clasa;'';
	RETURN ''ok'';
	END;'
	LANGUAGE plpgsql;
//
	
returneaza null sau..
select creare_tabel_info('prelipca','elev');
	
	!
	-fara md5
	-data obtinerii notei nu are logica,doar functioneaza
	-sa verific daca profesorul este deja diriginte cand introduc ca administrator datele
	-ora la care e disciplina in prof_disc_clasa
	-orar?