drop table tb_utilizatori cascade;
drop table tb_elevi cascade;
drop table adrese_tb_elevi cascade;
drop table tb_profesori cascade;
drop table adrese_tb_profesori cascade;
drop table tb_parinti cascade;
drop table tb_discipline cascade;
drop table tb_profiluri cascade;
drop table tb_clase cascade;
drop table tb_prof_disc_clasa cascade;
drop table tb_situatie_note cascade;
drop table tb_situatie_abs cascade;
drop table tb_administratori cascade;
drop table tb_mesaje cascade;

drop sequence id_elev_secv;
drop sequence cod_prof_secv;
drop sequence cod_disc_secv;
drop SEQUENCE cod_clasa_secv;
drop SEQUENCE cod_profil_secv;
drop sequence cod_repart_secv;
drop sequence cod_parinte_secv;
drop sequence id_user_secv;
drop sequence id_nota_secv;
drop sequence id_abs_secv;
drop sequence id_admin_secv;
drop sequence id_mesaj_secv;

CREATE SEQUENCE id_elev_secv;
CREATE SEQUENCE cod_prof_secv;
CREATE SEQUENCE cod_disc_secv;
CREATE SEQUENCE cod_clasa_secv;
CREATE SEQUENCE cod_profil_secv;
create sequence cod_repart_secv;
create sequence cod_parinte_secv;
create sequence id_user_secv;
create sequence id_nota_secv;
create sequence id_abs_secv;
create sequence id_admin_secv;
create sequence id_mesaj_secv;

create table tb_utilizatori(
id int primary key default nextval('id_user_secv'),
nume varchar(32),
prenume varchar(32),
nick varchar(32),
parola varchar(32),
privilegiu varchar(10),
data_inscrierii date,
ultima_logare date,
cod integer);

CREATE TABLE tb_administratori (
  id_admin int primary key default nextval('id_admin_secv'),
  nume_admin varchar(30),
  prenume_admin varchar(30),
  cnp varchar(13),
  localitate varchar(30),
  strada varchar(30),
  nrcasa int,
  ap int,
  data_nastere date,
  telefon int
);

CREATE TABLE tb_elevi (
  id_elev int primary key default nextval('id_elev_secv'),
  nume_elev varchar(30),
  prenume_elev varchar(30),
  cnp varchar(13),
  id_clasa int,
  data_nastere date,
  telefon int
);

create table adrese_tb_elevi(
id_elev int,
localitate varchar(30),
strada varchar(30),
nrcasa int,
ap int );

create table tb_profesori (
cod_profesor int primary key default nextval('cod_prof_secv'),
cod_disciplina int,
nume_profesor varchar(30),
prenume_profesor varchar(30),
data_nastere date,
cnp varchar(13),
salariu int,
telefon int );

create table adrese_tb_profesori(
cod_profesor int,
localitate varchar(30),
strada varchar(30),
nrcasa int,
ap int );

create table tb_parinti(
cod_parinte int primary key default nextval('cod_parinte_secv'),
cod_elev int,
nume_parinte varchar(30),
prenume_parinte varchar(30),
cnp varchar(13),
telefon int);

create table tb_discipline (
cod_disciplina int primary key default nextval('cod_disc_secv'),
nume_disciplina varchar(50));

create table tb_profiluri (
cod_profil int primary key default nextval('cod_profil_secv'),
nume_profil varchar(50) );

create table tb_clase(
cod_clasa int primary key default nextval('cod_clasa_secv'),
cod_diriginte int,
cod_profil int,
nume_clasa varchar(4),
an_studiu int);

create table tb_prof_disc_clasa(
cod_repartitie int primary key default nextval('cod_repart_secv'),
cod_clasa int,
cod_disciplina int,
cod_profesor int,
nr_ore_sapt int);

create table tb_situatie_note(
id_nota int primary key default nextval('id_nota_secv'),
cod_elev int,
cod_disciplina int,
nota int,
data_nota date,
semestru int);

create table tb_situatie_abs(
id_abs int primary key default nextval('id_abs_secv'),
cod_elev int,
cod_disciplina int,
data_abs date,
semestru int,
motivata varchar(3));

create table tb_mesaje(
id_mesaj int primary key default nextval('id_mesaj_secv'),
data_mesaj date,
de_la_id int,
de_la_func varchar(14),
catre_id int,
catre_func varchar(14),
continut varchar(250));


ALTER TABLE tb_elevi
ADD CONSTRAINT id_clasa_fk 
FOREIGN KEY (id_clasa) 
REFERENCES tb_clase(cod_clasa);

ALTER TABLE adrese_tb_elevi
ADD CONSTRAINT id_adr_elev_fk 
FOREIGN KEY (id_elev) 
REFERENCES tb_elevi(id_elev);

ALTER TABLE adrese_tb_profesori
ADD CONSTRAINT cod_adr_prof_fk 
FOREIGN KEY (cod_profesor) 
REFERENCES tb_profesori(cod_profesor);

ALTER TABLE tb_parinti
ADD CONSTRAINT cod_elev_tb_parinti_fk
FOREIGN KEY (cod_elev)
REFERENCES tb_elevi(id_elev);

ALTER TABLE tb_clase
ADD CONSTRAINT cod_profil_fk 
FOREIGN KEY (cod_profil) 
REFERENCES tb_profiluri(cod_profil);

ALTER TABLE tb_clase
ADD CONSTRAINT cod_dirig_fk 
FOREIGN KEY (cod_diriginte) 
REFERENCES tb_profesori(cod_profesor);

ALTER TABLE tb_prof_disc_clasa
ADD CONSTRAINT cod_clasa_fk 
FOREIGN KEY (cod_clasa) 
REFERENCES tb_clase(cod_clasa);

ALTER TABLE tb_prof_disc_clasa
ADD CONSTRAINT cod_disciplina_fk 
FOREIGN KEY (cod_disciplina) 
REFERENCES tb_discipline(cod_disciplina);

ALTER TABLE tb_prof_disc_clasa
ADD CONSTRAINT cod_profesor_fk 
FOREIGN KEY (cod_profesor) 
REFERENCES tb_profesori(cod_profesor);

ALTER TABLE tb_profesori
ADD CONSTRAINT cod_disc_profesor_fk
FOREIGN KEY (cod_disciplina)
REFERENCES tb_discipline(cod_disciplina);

ALTER TABLE tb_situatie_note
ADD CONSTRAINT cod_elev_situatie_fk 
FOREIGN KEY (cod_elev) 
REFERENCES tb_elevi(id_elev);

ALTER TABLE tb_situatie_note
ADD CONSTRAINT cod_disc_situatie_fk 
FOREIGN KEY (cod_disciplina) 
REFERENCES tb_discipline(cod_disciplina);

ALTER TABLE tb_situatie_abs
ADD CONSTRAINT cod_elev_situatie_fk 
FOREIGN KEY (cod_elev) 
REFERENCES tb_elevi(id_elev);

ALTER TABLE tb_situatie_abs
ADD CONSTRAINT cod_disc_situatie_fk 
FOREIGN KEY (cod_disciplina) 
REFERENCES tb_discipline(cod_disciplina);

insert into tb_tb_utilizatori values(1,'Cocu','Catalin','Catalin','Parola','elev');

INSERT INTO tb_discipline (nume_disciplina) VALUES
('Limba romana si literatura romana'),
('Limba moderna 1'),
('Limba moderna 2'),
('Matematica'),
('Fizica'),
('Chimie'),
('Biologie'),
('Istorie'),
('Geografie'),
('Socio-umane / Educatie pentru societate'),
('Socio-umane'),
('Religie'),
('Educatie muzicala'),
('Educatie plastica'),
('Educatie fizica'),
('Consiliere si orientare'),
('Tehnologia informatiei si a comunicatiilor '),
('Informatica'),
('Educatie antreprenoriala');

INSERT INTO tb_profiluri(nume_profil) values
('Matematica informatica'),
('Stiinte ale naturii'),
('Stiinte sociale'),
('Fiologie'),
('Matematica-Fizica');

INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Anghelescu','Marian',1,'1953-12-06','1531206235043',0,0756653218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Pomohaci','George',5,'1960-05-22','1600522698343',0,0693453218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Ionescu','Vasile',3,'1975-11-14','1751114236853',0,0756349628);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Muha','Dario',6,'1981-09-19','1810919293468',0,0756793218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Panait','Adrian',4,'1979-04-17','1790417293463',0,0759347818);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Marinescu','Marian',12,'1959-12-06','153120623543',0,0756653218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Cojocar','George',13,'1963-05-22','1600526842143',0,0693453218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Bizgan','Vasile',15,'1972-11-14','1751114232363',0,0756349628);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Bihonari','Dario',14,'1984-09-19','1810919293458',0,0756793218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Prisacari','Adrian',11,'1972-04-17','1790437896463',0,0759347818);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Trandafir','Marian',10,'1956-12-06','1531206963043',0,0756653218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Calistrat','George',7,'1963-05-22','1600522132343',0,0693453218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Mironescu','Vasile',8,'1979-11-14','1751114232455',0,0756349628);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Birsan','Dario',9,'1982-09-19','1810919783468',0,0756793218);
INSERT INTO tb_profesori(nume_profesor,prenume_profesor,cod_disciplina,data_nastere,cnp,salariu,telefon) values('Fediuc','Adrian',6,'1971-04-17','1790417264563',0,0759347818);

INSERT INTO tb_clase(cod_diriginte,cod_profil,an_studiu,nume_clasa) values(2,4,9,'9c');
INSERT INTO tb_clase(cod_diriginte,cod_profil,an_studiu,nume_clasa) values(3,1,10,'10a');
INSERT INTO tb_clase(cod_diriginte,cod_profil,an_studiu,nume_clasa) values(1,2,11,'11d');
INSERT INTO tb_clase(cod_diriginte,cod_profil,an_studiu,nume_clasa) values(5,4,10,'10a');
INSERT INTO tb_clase(cod_diriginte,cod_profil,an_studiu,nume_clasa) values(4,5,12,'12f');

INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Prelipcean','Andrei','1900515325253',1,'1990-05-15',0745698532);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Popescu','Stefan','1900716658953',3,'1990-07-16',0746532532);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Moisiuc','Gheorghe','1890426665353',5,'1989-04-26',0746948332);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Martinescu','Lucian','1901224658953',4,'1990-12-24',0746983532);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Mihalescu','Paul','1901121658953',2,'1990-11-21',0746596382);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Manole','Cristian','1900126693753',1,'1990-01-26',0746597632);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Anghelescu','Traian','1910324656733',1,'1990-03-24',0746579346);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Mironescu','Petre','1901224663543',1,'1990-03-24',0746983532);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Mitric','Pevel','1901121879653',1,'1990-08-21',0746596542);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Antonov','Cristian','1900126134253',1,'1990-05-26',0746591322);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Amaritei','Marius','1910324946333',1,'1990-01-23',0746579346);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Grigoriev','Mircea','1901224146325',1,'1990-12-29',0746983532);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Mateiciuc','Nicolae','1901121975953',1,'1990-04-04',0746596382);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Radu','Constantin','1900126613253',1,'1990-06-16',0746597632);
INSERT INTO tb_elevi(nume_elev,prenume_elev,cnp,id_clasa,data_nastere,telefon) values ('Timosciucs','Traian','1910324963733',1,'1990-03-12',0746579346);

INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(1,'Siret','George Popovici',32,21);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(2,'Radauti','Trandafirilor',35,0);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(3,'Siret','Nicolae Balcescu',154,10);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(4,'Radauti','Mihai Viteazu',76,11);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(5,'Fratautii Vechi','-',11,0);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(9,'Adancata','George Popovici',32,41);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(10,'Bosanci','Trandafirilor',55,0);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(11,'Siret','Nicolae Balcescu',11,20);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(12,'Radauti','Mihai Viteazu',26,11);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(13,'Moara','-',5,0);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(14,'Marginea','George Popovici',32,91);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(15,'Radauti','Trandafirilor',35,0);
INSERT INTO adrese_tb_elevi(id_elev,localitate,strada,nrcasa,ap) values(16,'Falticeni','Nicolae Balcescu',154,140);

INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values(1,'Suceava','Mimozei',51,12);
INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values(2,'Radauti','Mihai Viteazu',7,34);
INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values(3,'Suceava','Aleea Jupiter',18,5);
INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values(4,'Adancata','-',23,0);
INSERT INTO adrese_tb_profesori(cod_profesor,localitate,strada,nrcasa,ap) values(5,'Bosanci','-',45,0);

INSERT INTO tb_parinti(cod_elev,nume_parinte,prenume_parinte,cnp,telefon) values(1,'Prelipcean','Marcel','1590512323215',0756364965);
INSERT INTO tb_parinti(cod_elev,nume_parinte,prenume_parinte,cnp,telefon) values(1,'Prelipcean','Angela','1710422396345',0756393485);

INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,5,8,'2012-03-21',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,7,5,'2012-03-13',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(2,5,6,'2012-03-06',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(3,9,9,'2012-05-09',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,5,10,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(4,4,7,'2012-06-17',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(3,2,6,'2012-02-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(4,5,3,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(2,1,10,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(4,4,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(6,1,8,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(4,2,10,'2012-01-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,11,3,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,12,6,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,9,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,8,7,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,7,10,'2012-01-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,10,3,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,6,7,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,4,7,'2012-03-18',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,1,8,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,2,10,'2012-01-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,11,3,'2012-03-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,12,8,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,9,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,8,9,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,7,3,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,10,6,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,6,5,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,4,2,'2012-03-18',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,1,10,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,2,8,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,9,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,17,7,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,16,5,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,15,3,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,14,5,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,13,9,'2012-03-18',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,12,4,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(1,11,8,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,4,3,'2012-03-18',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,1,6,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,2,5,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,11,8,'2012-03-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,12,8,'2012-02-16',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,9,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,8,9,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,7,3,'2012-01-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,10,6,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,6,5,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,4,6,'2012-03-18',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,1,10,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,2,2,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,9,7,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,17,9,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,16,5,'2012-01-11',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,15,3,'2012-03-11',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,14,4,'2012-02-16',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,13,10,'2012-03-18',2);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,12,6,'2012-01-24',1);
INSERT INTO tb_situatie_note(cod_elev,cod_disciplina,nota,data_nota,semestru) values(8,11,7,'2012-01-11',1);

INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,5,'2012-03-21',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,7,'2012-02-13',2,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(2,5,'2011-12-06',2,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(3,9,'2012-01-09',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,5,'2011-09-16',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(4,4,'2012-04-17',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(3,2,'2011-11-24',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(4,5,'2011-12-11',2,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,5,'2012-02-07',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,7,'2012-03-23',2,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(2,5,'2011-11-26',2,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(3,7,'2012-05-10',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,8,'2011-09-04',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(4,5,'2012-01-08',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(3,6,'2011-10-18',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(4,5,'2011-11-21',2,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,5,'2011-11-26',2,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(1,7,'2012-05-10',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(8,8,'2011-09-04',1,'nu');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(8,5,'2012-01-08',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(8,6,'2011-10-18',1,'da');
INSERT INTO tb_situatie_abs(cod_elev,cod_disciplina,data_abs,semestru,motivata) values(8,5,'2011-11-21',2,'da');

INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,1,1,4);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(3,5,2,4);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(3,6,4,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(4,4,5,2);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(5,3,3,3);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(2,5,2,5);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(3,4,5,3);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,5,2,2);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,12,6,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,13,7,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,15,8,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,14,9,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,11,10,2);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,10,11,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,7,12,2);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,8,13,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,6,15,1);
INSERT INTO tb_prof_disc_clasa(cod_clasa,cod_disciplina,cod_profesor,nr_ore_sapt) values(1,7,2,2);

INSERT INTO tb_prof_disc(cod_profesor,cod_disciplina) VALUES(1,2);
INSERT INTO tb_prof_disc(cod_profesor,cod_disciplina) VALUES(2,5);
INSERT INTO tb_prof_disc(cod_profesor,cod_disciplina) VALUES(2,7);
INSERT INTO tb_prof_disc(cod_profesor,cod_disciplina) VALUES(1,2);

INSERT INTO tb_administratori(nume_admin,prenume_admin,cnp,localitate,strada,nrcasa,ap,data_nastere,telefon) values('Craciun','Ioan','1780721396345','Radauti','Dimitrie Leonte',34,12,'1978-07-23',0756393485);
select inregistrare_utilizator('prelipcean','parola','1900515325253');