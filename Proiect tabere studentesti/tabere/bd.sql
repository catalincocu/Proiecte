drop table gc_facultati cascade;
drop table gc_specializari cascade;
drop table gc_departamente cascade;
drop table gc_tipuriactivitati cascade;
drop table gc_studenti cascade;
drop table gc_profesori cascade;
drop table gc_activitati cascade;
drop table gc_note cascade;
drop table gc_credite cascade;
drop table gc_cereri cascade;
drop table gc_tabere cascade;

drop sequence idfacultatesecv;
drop sequence idspecializaresecv;
drop sequence iddepartamentsecv;
drop sequence idtipactivitatesecv;
drop sequence idstudentsecv;
drop sequence idprofesorsecv;
drop sequence idactivitatesecv;
drop sequence idnotasecv;
drop sequence idcreditsecv;
drop sequence idcereresecv;
drop sequence idtabarasecv;

create sequence idfacultatesecv;
create sequence idspecializaresecv;
create sequence iddepartamentsecv;
create sequence idtipactivitatesecv;
create sequence idstudentsecv;
create sequence idprofesorsecv;
create sequence idactivitatesecv;
create sequence idnotasecv;
create sequence idcreditsecv;
create sequence idcereresecv;
create sequence idtabarasecv;

create table gc_facultati(
idfacultate int primary key default nextval('idfacultatesecv'),
denumirefacultate varchar(70));

create table gc_specializari(
idspecializare int primary key default nextval('idspecializaresecv'),
idfacultate int,
denumirespecializare varchar(70));

create table gc_departamente(
iddepartament int primary key default nextval('iddepartamentsecv'),
numedepartament varchar(70));

create table gc_tipuriactivitati(
idtipactivitate int primary key default nextval('idtipactivitatesecv'),
numetipactivitate varchar(120));

create table gc_studenti(
idstudent int primary key default nextval('idstudentsecv'),
nume varchar(30),
prenume varchar(30),
seriebi varchar(2),
nrbi varchar(6),
cnp varchar(13),
localitate varchar(30),
judet varchar(30),
email varchar(40),
idfacultate int,
idspecializare int,
anstudiu int);

create table gc_profesori(
idprofesor int primary key default nextval('idprofesorsecv'),
nume varchar(30),
prenume varchar(30),
iddepartament int,
idfacultate int,
parola varchar(12));

create table gc_activitati(
idactivitate int primary key default nextval('idactivitatesecv'),
numeactivitate varchar(50),
punctaj int,
idstudent int,
idprofesor int,
punctajcomisie int,
idtipactivitate int,
locatie varchar(14));

create table gc_note(
idnota int primary key default nextval('idnotasecv'),
idstudent int,
nota int,
an int);

create table gc_credite(
idcredit int primary key default nextval('idcreditsecv'),
idstudent int,
nr int,
an int);

create table gc_cereri(
idcerere int primary key default nextval('idcereresecv'),
idstudent int,
idtabara int,
datacererii date);

create table gc_tabere(
idtabara int primary key default nextval('idtabarasecv'),
numetabara varchar(100),
adresa varchar(100),
contact varchar(1000),
descriere varchar(920),
numeimgjpg varchar(100));

alter table gc_studenti
add constraint id_facultate_fk 
foreign key (idfacultate) 
references gc_facultati(idfacultate);

alter table gc_studenti
add constraint id_specializare_fk 
foreign key (idspecializare) 
references gc_specializari(idspecializare);

alter table gc_profesori
add constraint id_departament_fk 
foreign key (iddepartament) 
references gc_departamente(iddepartament);

alter table gc_profesori
add constraint id_facultate_prof_fk 
foreign key (idfacultate) 
references gc_facultati(idfacultate);

alter table gc_activitati
add constraint id_student_fk 
foreign key (idstudent) 
references gc_studenti(idstudent);

alter table gc_activitati
add constraint id_profesor_fk 
foreign key (idprofesor) 
references gc_profesori(idprofesor);

alter table gc_cereri
add constraint id_student_cerere_fk 
foreign key (idstudent) 
references gc_studenti(idstudent);

alter table gc_cereri
add constraint id_tabara_cerere_fk 
foreign key (idtabara) 
references gc_tabere(idtabara);

alter table gc_note
add constraint id_student_note_fk 
foreign key (idstudent) 
references gc_studenti(idstudent);

alter table gc_credite
add constraint id_student_credite_fk 
foreign key (idstudent) 
references gc_studenti(idstudent);

grant all on gc_facultati,gc_specializari,gc_departamente,gc_tipuriactivitati,gc_studenti,gc_profesori,gc_activitati,gc_note,gc_credite,gc_cereri,gc_tabere to public_larg;
grant all on idfacultatesecv,idspecializaresecv,iddepartamentsecv,idtipactivitatesecv,idstudentsecv,idprofesorsecv,idactivitatesecv,idnotasecv,idcreditsecv,idcereresecv,idtabarasecv to public_larg;

insert into gc_facultati(denumirefacultate) values('Facultatea de Inginerie Electrica si Stiinta Calculatoarelor');
insert into gc_facultati(denumirefacultate) values('Facultatea de Inginerie Mecanica, Mecatronica si Management');
insert into gc_facultati(denumirefacultate) values('Facultatea de Educatie Fizica si Sport');
insert into gc_facultati(denumirefacultate) values('Facultatea de Inginerie Alimentara');
insert into gc_facultati(denumirefacultate) values('Facultatea de Istorie si Geografie');
insert into gc_facultati(denumirefacultate) values('Facultatea de Litere si stiinte ale Comunicarii');
insert into gc_facultati(denumirefacultate) values('Facultatea de Silvicultura');
insert into gc_facultati(denumirefacultate) values('Facultatea de stiinte Economice si Administratie Publica');
insert into gc_facultati(denumirefacultate) values('Facultatea de stiinte ale Educatiei');

insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Calculatoare');
insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Automatica si informatica aplicata');
insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Electronica aplicata');
insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Energetica industriala');
insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Sisteme electrice');
insert into gc_specializari(idfacultate,denumirespecializare) values(1,'Inginerie economica în domeniul electric, electronic si energetic');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Tehnologia Constructiilor de Masini');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Ingineria si Managementul Calitatii');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Echipamente pentru Procese Industriale');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Mecatronica');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Inginerie Economica în Domeniul Mecanic');
insert into gc_specializari(idfacultate,denumirespecializare) values(2,'Ingineria si Protectia Mediului În Industrie');
insert into gc_specializari(idfacultate,denumirespecializare) values(4,'Ingineria produselor alimentare');
insert into gc_specializari(idfacultate,denumirespecializare) values(4,'Controlul si expertiza produselor alimentare');
insert into gc_specializari(idfacultate,denumirespecializare) values(4,'Protectia consumatorului si a mediului');
insert into gc_specializari(idfacultate,denumirespecializare) values(4,'Inginerie si management in alimentatia publica si agroturism');

insert into gc_departamente(numedepartament) values('Comisia pentru Evaluarea si Asigurarea Calitatii');
insert into gc_departamente(numedepartament) values('Compartimentul Acte de studii');
insert into gc_departamente(numedepartament) values('Departamentul pentru Asigurarea Calitatii');
insert into gc_departamente(numedepartament) values('Departamentul de Relatii Internationale si Programe Comunitare ');
insert into gc_departamente(numedepartament) values('Departamentul pentru Pregatirea Personalului Didactic ');
insert into gc_departamente(numedepartament) values('Departamentul de Comunicatii si Tehnologii Informationale ');
insert into gc_departamente(numedepartament) values('Compartimentul cultural');
insert into gc_departamente(numedepartament) values('Departamentul de Sanatate si Dezvoltare Umana');

insert into gc_tipuriactivitati(numetipactivitate) values('Media');
insert into gc_tipuriactivitati(numetipactivitate) values('Premii obtinute la concursuri');
insert into gc_tipuriactivitati(numetipactivitate) values('Cercetare stiintifica: (co)autor articol publicat,brevet,contract');
insert into gc_tipuriactivitati(numetipactivitate) values('Prezentare de lucrari la manifestari stiintifice sau participarea la concursuri studentesti');
insert into gc_tipuriactivitati(numetipactivitate) values('Organizare manifestari stiintifice,concursuri studentesti');
insert into gc_tipuriactivitati(numetipactivitate) values('Promovarea imaginii facultatii');
insert into gc_tipuriactivitati(numetipactivitate) values('Studenti orfani de ambii parinti');
insert into gc_tipuriactivitati(numetipactivitate) values('Membru cu actiuni realizate in organizatii studentesti.Cu viza organizatiei');
insert into gc_tipuriactivitati(numetipactivitate) values('Membru BCAF/Senat/CAF');
insert into gc_tipuriactivitati(numetipactivitate) values('Credite suplimentare obtinute din cursurile facultative sau operationale recomandate de FIESC.');
insert into gc_tipuriactivitati(numetipactivitate) values('Beneficiar al unei alte tabere de odihna');

insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Mihaileanu','Cristian','SV','423463','1910623334210','Suceava','Suceava','mihaileanucristian@yahoo.com',1,2,3);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Martinescu','Carmen','SV','242563','2910306334543','Suceava','Suceava','martinescucarmen@yahoo.com',1,4,4);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Ivanovici','Cristian','IS','423723','1890323334210','Iasi','Iasi','IvanoviciCristian@yahoo.com',1,2,3);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Filipiuc','Marcel','SV','842563','1910501334543','Suceava','Suceava','FilipiucMarcel@yahoo.com',2,1,4);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Munteanu','Catalin','VS','428563','1890321334210','Vaslui','Vaslui','MunteanuCatalin@yahoo.com',1,2,3);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Dumitrescu','Gabriela','SV','257563','2910604334543','Suceava','Suceava','martinescucarmen@yahoo.com',2,1,2);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Sauciuc','Vasile','TM','264463','1890218334540','Timisoara','Suceava','SauciucVasile@yahoo.com',1,2,3);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Popescu','Mircea','SV','242536','1910416334343','Suceava','Suceava','PopescuMircea@yahoo.com',2,4,3);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Udila','Daniel','SV','424764','1890721334650','Suceava','Suceava','UdilaDaniel@yahoo.com',1,4,2);
insert into gc_studenti(nume,prenume,seriebi,nrbi,cnp,localitate,judet,email,idfacultate,idspecializare,anstudiu) values ('Anghelescu','Ionut','SV','422763','1920811334253','Suceava','Suceava','AnghelescuIonut@yahoo.com',1,2,2);

insert into gc_profesori(nume,prenume,iddepartament,idfacultate,parola) values('Malos','Andrei',1,1,'parola1');
insert into gc_profesori(nume,prenume,iddepartament,idfacultate,parola) values('Martinov','Marcel',2,3,'parola2');
insert into gc_profesori(nume,prenume,iddepartament,idfacultate,parola) values('Ivanovici','Horia',3,2,'parola3');

insert into gc_note(idstudent,nota,an) values(1,8,2);
insert into gc_note(idstudent,nota,an) values(2,9,1);
insert into gc_note(idstudent,nota,an) values(1,7,1);
insert into gc_note(idstudent,nota,an) values(1,6,2);
insert into gc_note(idstudent,nota,an) values(2,7,2);
insert into gc_note(idstudent,nota,an) values(2,9,3);
insert into gc_note(idstudent,nota,an) values(2,6,3);
insert into gc_note(idstudent,nota,an) values(2,7,3);
insert into gc_note(idstudent,nota,an) values(2,5,2);
insert into gc_note(idstudent,nota,an) values(2,7,1);
insert into gc_note(idstudent,nota,an) values(1,9,2);

insert into gc_credite(idstudent,nr,an) values(2,0,1);
insert into gc_credite(idstudent,nr,an) values(2,3,2);
insert into gc_credite(idstudent,nr,an) values(2,0,3);
insert into gc_credite(idstudent,nr,an) values(1,5,1);
insert into gc_credite(idstudent,nr,an) values(1,0,2);

insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('CENTRUL DE VACANTA SOVATA II','str. Trandafirilor nr. 131, Sovata Bai','tel:0751-150112','   Este situat în renumita statiune balneoclimaterica Sovata Bai, central, la o distanta de 400 m de lacul heliotermal Ursu si la o distanta de 6 km de pârtia de schi. Statiunea se afla la o distanta de 65 km de Târgu Mures si la 70 km de Sigisoara în depresiunea Praidului la o altitudine de 520 m, într-o zona deosebit de pitoreasca.','img1.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('BAZA TURISTICA „MURESUL” TÂRGU MURES',' str. Victor Babes nr.11, cod postal 540097',' tel:0265/218841,fax:0265/216026','   Situata în zona rezidentiala a municipiului Târgu Mures, lânga caminele studentesti si Facultatea de Medicina, la o distanta de 10 minute de mers pe jos pâna în centrul orasului unde se pot vizita toate obiectivele turistice importante din oras, este înconjurata de parcuri si zone pline de verdeata. Functioneaza permanent într-o cladire modernizata P+4 etaje, parcare proprie pazita, sistem de supraveghere video pe toate nivelele, din care etajele 3 si 4, functioneaza ca si baza turistica, oferind servicii de cazare permanenta si ocazionala.Etajul 3 dispune de un numar de 20 de camere cu câte 4 paturi, camere mobilate, unele având cablu TV si internet, grupuri sanitare modernizate, apa calda permanent, cabine de dus.','img2.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('CENTRUL DE VACANTA SOVATA I','Str. Stelelor nr. 63','tel. 0265–57531 si 0758-247325','    Este situat în renumita statiune balneoclimaterica Sovata Bai la o distanta de aproximativ 1,5 km de lacul heliotermal Ursu si la o distanta de 5 km de pârtia de schi. Statiunea se afla la o distanta de 65 km de Târgu Mures si la 70 km de Sigisoara în depresiunea Praidului la o altitudine de 520 m.Capacitatea de cazare a centrului este de 86 de locuri si este oferita în 2 cladiri tip vila, în camere cu 2, 3 si 6 paturi. Dispune de o sala de mese de 100 de locuri, cu o curte interioara amenajata si 2 terenuri de sport pentru desfasurarea activitatilor recreative.','img3.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA MEDIELVALA','Str. Stelelor nr. 1','tel. 0265–570891 si 0758-253325','Tabara medievala pentru studentii le promite studentiiilor dumneavoastra o vacanta medievala de neuitat in care sa invete jucandu-se.Locatia taberei medievale pentru studentii este la pensiunea Casa Muntelui situata la 1330 metri altitudine. Pensiunea este amplasata pe soseaua Rucar-Bran, cu un drum de acces de 50 m, in imediata apropiere a platoului Giuvala. ','img4.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA DE SKI','str. Trandafirilor nr. 131, Sovata Bai','tel:0751-150112','Veniti cu noi in tabara de corturi din Apuseni, sau la ski in Poiana Brasov, Austria ori Bulgaria. Exploram impreuna pesteri si paduri, invatam plante si vedem vietatile padurii la ele acasa. Toate impreuna cu Mihai, profesorul de geografie! ','img5.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA INFOSPEED',' str. George Enescu nr.11,cod postal 540097','tel:0751-150112','Taberele Infospeed sunt astfel concepute incat sa ofere un mediu social pozitiv, in care studentiii sa invete mecanisme si abilitati puternice ce le completeaza si le contureaza personalitatea, se leaga prietenii, studentiii modeleaza multe obiceiuri si abilitati de la alti studentiii si traineri.','img6.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA ARMONIA','Str. Stelelor nr. 45','tel. 0265–570891 si 0758-247325','Va propunem o tabara speciala, o tabara in care activitatile desfasurate in aer liber si voia buna sunt ingredientele principale! se vor desfasura intr-o maniera placuta, putandu-se dezvolta simtul pentru sunet, culoare, emotie si miscare in diferite activitati recreative.','img7.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('ABECEDARUL MUNTILOR',' str. Nicolae Balcescu nr.11, cod postal 540097','tel:0751-150112','Tabara studentilor indrazneti Padina 2011 este destinatia ideala pentru un copil care doreste sa ajunga pe Omu - cel mai inalt varf din tara. Vom explora Pestera Ialomicioarei, Cheile Tatarului, Cheile Ursilor si Cheile Horoabei. Vom face impreuna primii pasi de alpinism dar si o multime de jocuri si conursuri interesante.','img8.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA "BOCANCUL ALBASTRU"',' str. Aaron Pumnul nr.11, cod postal 540097','tel. 0265–570891 si 0758-247325','Tabara de vara pentru studenti se desfasoara in Muntii Retezat la Cabana Lolaia, cabana situata la altitudinea de 1035 m. studentiii vor fi parte a unui concurs al micilor iubitori de munte, un concurs la care important este sa participe si sa-si cunoasca colegii, competitorii dar mai ales pe sine!','img9.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA "DACII SI ROMANII"','str. Trandafirilor nr. 131, Sovata Bai','tel:0751-150112','Tabara de vara pentru studenti se desfasoara in Muntii Valcan la Cabana Pasul Valcan. In aceasta tabara, studentiii se vor implica in activitati educative si recreative cu caracter practic in vederea intelegerii civilizatiei daco-romane  in care se va incerca reconstituirea unor scene de viata din perioada daco-romana atat civile cat si de razboi.','img10.jpg');
insert into gc_tabere(numetabara,adresa,contact,descriere,numeimgjpg) values('TABARA "HAPPY FACES"','Str. Stelelor nr. 1','tel. 0265–570891 si 0758-247325','Avand o suprafata de aprox. 5000 mp, cu multa verdeata si posibilitati de distractie, complexul se poate numi astazi una dintre locatiile favorite ale tinerilor, atat din tara cat si din strainatate. Scopul nostru este sa redam studentilor, adolescentilor si chiar si celor mai mari, pofta de a calatori si de a descoperi impreuna locuri superbe, intr-una din zonele incarcate cu istorie si frumusete ale Transilvaniei.','img11.jpg');

//repartizare in functie de punctaj
//la studenti text lista studentilor inscrisi momentan
//la facultati lista facultatilor acceptate 
//mai intai sa introduca numele si prenumele si apoi sa se arate situatia si apoi sa completeze activitatile