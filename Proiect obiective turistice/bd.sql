drop table t_obiective;
drop table t_utilizatori;
drop table t_datepersonale;
drop table t_comentarii;
drop table t_administratori;
drop table t_evaluari;

drop sequence id_obiectiv_secv;
drop sequence id_usr_secv;
drop sequence id_datepers_secv;
drop sequence id_comentariu_secv;
drop sequence id_adm_secv;
drop sequence id_evaluare_secv;

create sequence id_obiectiv_secv;
create sequence id_usr_secv;
create sequence id_datepers_secv;
create sequence id_comentariu_secv;
create sequence id_adm_secv;
create sequence id_evaluare_secv;

create table t_obiective (
idobiectiv int primary key default nextval('id_obiectiv_secv'),
nume varchar(128),
tip varchar(15),
localitate varchar(32),
descriere varchar(2048),
fotografie1 varchar(32));

create table t_utilizatori(
iduser int primary key default nextval('id_usr_secv'),
nume_utilizator varchar(32),
parola_utilizator varchar(32),
categorie varchar(10),
iddatepersonale integer);

create table t_administratori(
idadministrator int primary key default nextval('id_adm_secv'),
nume_administrator varchar(32),
parola_administrator varchar(32)
);

create table t_datepersonale (
iddatepersonale int primary key default nextval('id_datepers_secv'),
nume varchar(30),
prenume varchar(30),
telefon varchar(15),
localitate varchar(30),
email varchar(30));

create table t_comentarii(
idcomentariu int primary key default nextval('id_comentariu_secv'),
iduser int,
idobiectiv int,
titlu varchar(30),
text varchar(1024),
data date);

create table t_evaluari(
idevaluare int primary key default nextval('id_evaluare_secv'),
idobiectiv int,
nota int,
idutilizator int
);

insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Doroteia','manastire','Frasin','Manastirea Doroteia este situata in judetul Suceava la 7 km sud de localitatea Frasin de pe drumul european E 576, intr-o frumoasa zona impadurita. Accesul se poate face cu automobilul pe drumul ce ajunge pana la manastire sau cu trenul pana la statia Frasin si de acolo cu o masina de ocazie.','doroteia1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Moldovita','manastire','Vatra Moldovitei','Manastirea Moldovita este una din vechile asezari calugaresti, cu un important si glorios trecut istoric, strajuitoare de veacuri la hotarul Moldovei de nord, situata în comuna Vatra Moldovitei la o distanta de circa 15 km de comuna Vama','moldovita1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Sucevita','manastire','Sucevita','Manastirea Sucevita este o manastire din România, situata la 18 km de Radauti (judetul Suceava), înscrisa pe lista patrimoniului cultural mondial UNESCO. Traditia aseaza pe valea râului Sucevita, între dealuri, o biserica din lemn si o schivnicie de pe la începutul veacului al XVI-lea.','sucevita1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Humor','manastire','Gura Humorului','Manastirea Humor (denumita uneori si Manastirea Humorului) este o manastire ortodoxa din România, construita în anul 1530 în satul Manastirea Humorului din comuna omonima (aflata în prezent în judetul Suceava) de catre marele logofat Toader Bubuiog. Biserica manastirii are hramurile Adormirea Maicii Domnului (sarbatorit în fiecare an pe 15 august) si Sfântul Mucenic Gheorghe (sarbatorit la 23 aprilie).','humor1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Voronet','manastire','Gura Humorului','Manastirea Voronet, supranumita „Capela Sixtina a Estului”, este un complex monahal medieval construit în satul Voronet, astazi cartier al orasului Gura Humorului. Manastirea se afla la 36 km de municipiul Suceava si la numai 4 km de centrul orasului Gura Humorului. Ea constituie una dintre cele mai valoroase ctitorii ale lui Stefan cel Mare (1457-1504). Biserica a fost ridicata în anul 1488 în numai 3 luni si 3 saptamâni, ceea ce constituie un record pentru acea vreme.','voronet1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Manastirea Sfantul Ioan cel Nou','manastire','Suceava','Manastirea „Sfântul Ioan cel Nou” este o manastire ortodoxa din România, construita în perioada 1514-1522 în orasul Suceava. Ea se afla situata pe strada Ioan Voda cel Cumplit nr. 2, pe drumul spre Cetatea de Scaun a Sucevei. Biserica manastirii are hramurile Sfântul Gheorghe (sarbatorit în fiecare an pe 23 aprilie) si Sfântul Ioan cel Nou (sarbatorit în fiecare an pe 24 iunie).','ioancelnou1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Pensiunea Vulturul Negru','pensiune','DN 17 Suceava-Gura Humorului','Clasificare: 4 stele<br>-   receptie, salon-bar cu o capacitate de 40 locuri;<br>- ETAJ 1: restaurant modern cu dotari audio-video, salon pentru relaxare, 4 camere duble cu bai proprii si acces balcon si 1 apartament (compus din 2 camere, baie proprie si acces balcon);<br>- ETAJ 2: salon pentru relaxare; 3 camere duble cu bai proprii si acces balcon.<br>Total locuri de cazare: 7 camere si 3 apartamente, cu o capacitate de minim 26 locuri de cazare.<br>- CABLU INTERNET IN FIECARE CAMERA, INCALZIRE CENTRALA, PARCARE PROPRIE, FOISOR, TELEFON, POSIBILITATEA ORGANIZARII UNOR DRUMETII IN ZONELE DE INTERES TURISTIC.','vulturul1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Pensiunea Flori de Bucovina','pensiune','Campulung Moldovenesc','Clasificare: 2 stele <br>- 5 camere din care 2 camere duble, 1 camera cu 3 paturi (tip apartament), 2 camere cu 4 paturi, 3 bai complet echipate la camere cu dus; <br>- bar dotat cu salon si masa de biliard, soba traditionala, terasa acoperita, bai moderne; <br>- sala pentru conferinte si simpozioane, partie de schi dotata cu instalatie de tractare cu cablu, inchirieri echipamente pentru sporturile de iarna;<br>- gratar in aer liber, protap pentru ocazii de neuitat, petreceri in aer liber.<br>Total locuri de cazare: 5 camere cu o capacitate de 12-15 locuri de cazare, incalzire centrala proprie si sobe cu lemne.','flori1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Pensiunea Tamara','pensiune','Vatra Dornei','Clasificare: 3 stele<br> 1.  - RECEPTIE, RESTAURANT SI SEPAREURI CU 50 LOCURI LA MESE;<br>- BAR, MUZICA SI ATMOSFERA INTIMA;<br>- SE POT ORGANIZA PETRECERI SI RECEPTII.<br>2. ETAJ 1 :- 4 CAMERE DIN CARE 1 CU 2 PATURI SINGLE, 2 CU PAT MATRIMONIAL SI 1 CU 3 PATURI, TV SI LADA FRIGORIFICA, BAIE PROPRIE.<br>3. ETAJ 2 :- 1 CAMERA CU 3 LOCURI , 1 CAMERA CU 2 PATURI SINGLE SI 2 CAMERE CU PAT MATRIMONIAL, TV- CABLU.<br>TOTAL LOCURI DE CAZARE: 8 CAMERE CU 18 LOCURI DE CAZARE.<br>- TERASA, INCHIRIERE ATV, SAUNA SI JACUZZI, SALA DE FITNESS, ACCES INTERNET, INCALZIRE CENTRALA, PARCARE, TELEFON.','tamara1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Pensiunea Aristotel','pensiune','Vatra Dornei','Clasificare: 3 stele<br>-   RECEPTIE, SALON SI RESTAURANT CU 60 LOCURI LA MESE; 2 CAMERE DUBLE CU BAIE PROPRIE; BAR SI ATMOSFERA INTIMA;<br>- ETAJ: 6 CAMERE DUBLE SI 1 APARTAMENT CU BAIE PROPRIE; SALON PENTRU RECREERE.<br>TOTAL LOCURI DE CAZARE: 8 CAMERE DUBLE SI 1 APARTAMENT CU O CAPACITATE DE CAZARE DE 20 DE PERSOANE.<br>- TERASA, ACCES INTERNET, INCALZIRE CENTRALA, PARCARE, TELEFON, POSIBILITATEA ORGANIZARII UNOR DRUMETII IN ZONELE DE INTERES TURISTIC;<br>- TV CABLU, FRIGIDER SI BAI IN CAMERE MODERN ECHIPATE; CURTE INTERIOARA CU SPATIU DE RELAXARE SI JOACA PENTRU COPII, GRATAR IN AER LIBER; ACCES INTERNET; LOCURI PENTRU PARCARE.','aristotel1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Bucovina Bogdan Voda','pensiune','Frasin - Molid','Clasificare: 2 stele <br>-   receptie, bar-restaurant cu o capacitate de 50 de locuri si separeu cu o capacitate de 20 persoane; terasa, bucatarie si bai moderne; <br>- Etaj : 5 camere cu balcon cu 2 paturi, 3 bai complet echipate pe etaj cu dus; tv cu cablu, salon de recreere.<br>- Total camere: 5 camere cu o capacitate de 10 locuri de cazare, incalzire centrala proprie.<br>- Casute pentru tabere: 7 casute cu 2 locuri de cazare fiecare; baie comuna cu dus; 14 locuri cazare.<br>Total locuri de cazare casute si pensiune: minim 24 persoane.<br>- Terasa deschisa in perioada verii, teren de sport; bar de zi, bar de noapte, restaurant, teren de joaca pentru copii, locuri pentru parcare.','bogdan1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Bucovina Veverita','pensiune','Frasin - Molid','Clasificare: 3 stele <br>- Demisol: un apartament cu doua camere - 4 locuri de cazare, baie pe hol dotata cu dus si cada, jacuzzi, sauna;<br>-   3 camere cu pat matrimonial din care 2 cu baie proprie si una cu baie pe hol, dotate cu tv, salon pentru servirea mesei cu o capacitate de 16 locuri, bucatarie si baie moderna, un birou care poate fi pus la dipozitia turistilor interesati fiind dotat cu computer si acces internet; in curte este amplasat un gratar in aer liber;<br>- Etaj : 3 camere cu paturi matrimoniale din care 2 cu baie proprie si una cu baie la etaj; tv cu cablu.<br>Total locuri de cazare: 6 camere si 1 apartament cu o capacitate de minim 16 locuri de cazare, incalzire centrala proprie.<br>-Terasa deschisa in perioada verii, teren de joaca pentru copii; locuri pentru parcare.','veverita1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Restaurant Moldova','restaurant','Gura Humorului','Clasificare: restaurant cu autoservire<br>- Etaj: restaurant cu autoservire cu o capacitate de 50 persoane, bucatarie modern dotata, tv cablu, baie;<br>Total locuri: 50.<br>• Aflat in apropierea Primariei statiunii turistice Gura Humorului, Restaurantul Diner are o capacitate de circa 50 de locuri la mese si este recomandat in special turistilor aflati in vizita in Bucovina.<br>• Mancaruri traditionale si specialitati preparate din alimente proaspete, fara potentiatori de aroma.<br>• In meniul Restaurantului Diner sunt incluse specialitati culinare deosebit de gustoase: ciorba radauteana sau de perisoare, parjoale moldovenesti, ciorbe cu afumatura, pulpe de pui la ceaun, preparate din peste, frigarui, muraturi de casa, pizza facuta dupa retete originale, alte delicatese ... ','rmoldova1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Restaurant Autoservire Diner','restaurant','Gura Humorului','Clasificare: 3 stele<br>- Etaj: terasa acoperita cu o capacitate de 50 de locuri, restaurant cu bar cu o capacitate de 200 persoane, bucatarie dotata la cele mai inalte standarde de calitate, tv cablu, telefon, aparatura audio-video, bai modern echipate;<br>Total locuri: 200-250.<br>• Aflat in vecinatatea Primariei statiunii turistice Gura Humorului, cu o capacitate de 250 de locuri - din care 50 pe terasa acoperita - "Moldova" este cel mai mare si dotat restaurant din localitate.<br>• Bucataria traditionala bucovineana, bazata pe prelucrarea produselor alimentare naturale, se completeaza armonios cu dotari tehnice de ultima generatie in domeniul culinar: tonomat computerizat, filtre electrostatice pentru ionizarea aerului si dezumidificatoare.','diner1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Hanul Obcina Voronetului','restaurant','Gura Humorului','Situat la circa 36 km de resedinta de judet, municipiul Suceava, pe traseul Dn 17 Suceava-gura Humorului-voronet, Hanul Obcina Voronetului este plasat intr-un cadru mirific, la doar 200m de Manastirea Voronet, inconjurata de peisaje deosebite precum si de obiective accesibile datorita diverselor trasee turistice.Hanul se prezinta ca locul ideal pentru relaxare in week-end sau in vacante, pentru a vizita aceste locuri minunate bucovinene, pastratoare de traditii.Facilitati cazare: fax, sanie trasa de cai, internet wireless, crama, parcare, gradina/curte, room service, terasa, plata cu cardul, loc amenajat de joaca, bar, restaurantFacilitati camere: internet in camera, baie pe hol, camere cu balcon, incalzire centrala, baie in camera, camera cu TV.','obcinavoronetului1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Hanul Ilisesti','restaurant','Gura Humorului','Situat in inima padurii, pe drumul E576, km 23, dinspre Suceava spre Gura Humorului, Motelul “Han Ilisesti” este locul de plecare catre renumitele manastiri bucovinene. Restaurantul va sta la dispozitie cu un meniu diversificat care contine preparate, atat indigene cat si din bucataria internationala.Capacitatea noastra de cazare este urmatoarea:– 17 camere cu 2 paturi;– 2 camere cu 3 paturi;– restaurant cu o capacitate de 140 de locuri;– sala conferinta de 50 de locuri;– terasa de 50 de locuri;– parcare gratuita si pazita;Pentru organizarea de petreceri , mese festive? nu se percepe nici un tarif de chirie pe nici una din sali (restaurant, sala de conferinte). Barul si bucataria fac fata oricaror cerinte la preturi foarte avantajoase avand in vedere ca practicam un adaos comercial mic, imbatabil.Durata medie a sejurului este de 3 zile cazare, masa.Organizam orice fel de petreceri ( nunti,cumatrii,majorate ) la cele mai avantajoase preturi din oras.Deocamdata pe langa serviciile cunoscute, pentru clientii nostri asiguram, pe langa preluarea de la aeroport, gara sau autogara, excursii la manastirile din Bucovina, precum si alte locatii cum ar fi Stupca (Ciprian Porumbescu), Cacica (salina), muzee , Cetatea de Scaun a Sucevei? cu microbuz, carute sau sanii trase de cai. Organizam deasemenea, partide de paintball, in padurea de langa Hanul Ilisesti','ilisesti1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Muzeul Ctitoriilor Voievodului Petru Rares din Râsca','muzeu','Râsca','Muzeul Ctitoriilor Voievodului Petru Rares din Râsca a fost înfiintat în 2009 într-o casa din lemn construita special cu aceasta destinatie. Are o tinda si doua camere laterale care adapostesc o expozitie mixta, istorico-etnografica. O prima sala, cu expozitie foto-documentara, este destinata istoriei medievale, cu accent pe ctitoriile epocii lui Petru Rares. Tinda este rezervata prelucrarii lemnului, de la taierea arborilor pâna la prelucrarea acestuia (diverse fierastraie, banc de tâmplarie, diverse piese din lemn.','petrurares1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Muzeul de Istorie si Etnografie din Vatra Dornei','muzeu','Vatra Dornei','Muzeul de Istorie si Etnografie din Vatra Dornei a fost înfiintat în 1998, din initiativa locala. Colectiile cuprind arheologie – piese de la neolitic pâna spre sfârsitul evului mediu – chirpic ars, fragmente ceramice, vase, cahle sau diferite obiecte din metal si doua sali destinate etnografiei locale (se remarca razboiul de tesut, costumele populare si diverse piese din lemn). O sala centrala este destinata diferitelor activitati culturale care se desfasoara cu frecventa saptamânala.','etnografie1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Piatra Tibaului','rezervatie','Sucevita','Piatra Tibaului este localizata la confluenta paraului Tibau cu Bistrita Aurie, pe teritoriul comunei Carlibaba si reprezinta un interesant masiv de calcare eocene fosilifere, inalt de 70 m inaltime. Aceasta impresionanta stanca atrage prin masivitatea sa si reprezinta terminatia estica a flisului carpatic.Ca aspect geologic, se remarca conglomerate de gresii dispuse peste sisturi cristaline, atribuite perioadei neocene. Urmeaza marne rosii-galbui si cenusiu-verzui peste care se suprapun calcare stratificate, apoi un alt strat de calcare ce contin si ele fauna eocena.','piatra1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Cheile Lucavei','rezervatie','Obcina Mestecanisului','Cheile Lucavei se afla aproape de extremitatea nordica a Obcinii Mestecanisului. Se poate ajunge în aceste chei daca urmam cale de 33 km DJ 175 plecând din satul Pojorâta si pâna în localitatea Benia. Din capatul din amonte al acestei localitati, în apropiere de urmatorul sat, Moldova-Sulita, se desprinde pe partea stânga daca parcurgem drumul în sensul amintit, un drum forestier ce duce pâna la celebra herghelie de la Lucina. Ne vom înscrie pe acest drum si îl vom parcurge cale de 15 – 20 minute pâna în chei. De fapt se vad de la distanta câteva stânci albe si impresionante. Cheile sunt flancate pe stânga în sensul de mers, de vârful Gaina 1455m','lucavei1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Rezervatia Tinovul Mare','rezervatie','Poiana Stampei','Rezervatia Tinovul Mare se afla în judetul Suceava, pe raza localitatii Poiana Stampei. Este cea mai mare mlastina de turba de la noi din tara. Accesul în rezervatie este facil. Din satul Poiana Stampei, aflat la circa 20 km de orasul Vatra Dornei pe drumul E58 înspre Bistrita, ne abatem pe drumul catre satul Dornisoara circa 4 km pâna la o intersectie de drumuri unde vom remarca pe partea dreapta un panou indicator pe lânga care se face accesul în rezervatie iar pe stânga, dupa un pod, un canton forestier.Înainte de a parcurge drumul amenajat prin rezervatie fotografiem râul Dorna care izovarste din muntii Caliman (foto 1, 2, 3, 4). Ne îndreptam apoi spre panul care ne spune ca de acolo începe Tinovul Mare (foto 5 si 6). Traversam calea ferata ce duce spre satul Dornisoara si intram în minunata lume a rezervatiei (foto 7) Deoarece terenul este mlastinos, a fost contruit un podet de lemn lung de aproape 900 m. Imaginile ulterioare fotografiei 7 ne arata salbaticia locului pe unde omul nu a mai interevnit de foarte mult timp. Din loc în loc sunt ochiuri de apa prin care se vede si stratul de turba.','tinovul1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Stejarul de la Burla','rezervatie','Radauti','În satul Burla aflat la circa 9 km de orasul Radauti, daca urmam drumul de acces prin satul Volovat (foto 1), se afla un stejar multisecular mai putin cunoscut.Coborând dinspre Volovat spre Burla ajungem la o intersectie marcata de o cruce si un mic tun si, tot în coborâre, urmam drumul din dreapta câteva sute de metri. Vom fi atenti ca pe partea stânga, în curtea unei case, foarte aproape de drumul pe care suntem, se afla un copac extrem de interesant. Este un stejar despre care se spune ca are aproape 800 de ani si ca însusi voievodul Stefan cel Mare si-a legat odata calul de acest stejar. De curând acest copac a intrat în atentia padurarilor care vor sa-l ocroteasca si sa-i puna un brâu de sustinere. Oricum copacul este impresionant si  merita de vazut . În fotografiile  2- 19 vedem acest stejar în toate ipostazele si în diverse anotimpuri .','burla1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('Cheile Zugrenilor','rezervatie','Suceava','Cheile Zugrenilor se afla în judetul Suceava la circa 21 km de orasul Vatra Dornei, pe DN 17B în directia Chiril. Sunt spectaculoase prin versantii extrem de abrupti. Peretii stâncosi ating înaltimi de 200 – 300 m. Ca punct de reper de unde putem admira cheile putem alege cabana Zugreni aflata pe o insula în mijlocul râului Bistrita.De pe podul care duce spre aceasta cabana am fotografiat râul Bistrita spre amonte si spre aval. Apoi ne deplasam pe sosea înspre aval. Avem în fata noastra pantele foarte mari care duc spre unul din vârfurile importante din zona, Pietrosul Bistritei, înalt de 1791 m. Spre înapoi vedem pantele finale ale altui munte important, Giumalau .Ne deplasam apoi spre aval fotografiind un canal pe unde se scurg o parte din apele Bistritei. Aproape de drum se zaresc deja câteva stânci impresionante. Peisajul este frumos luminat de soare în lumina diminetii. Zarim si cabana Zugreni printre copaci. Pe partea stânga cum ne deplasam, apar pereti din ce în ce mai înalti. Razele soarelui vor ajunge în câteva ore si aici. Din nou zarim cabana si acel canal de scurgere a apei. Intram apoi într-o zona pe la baza carei Bistrita curge mai navalnic si care are pe partea sa dreapta pereti imensi.','zugrenilor1.jpg');
insert into t_obiective(nume,tip,localitate,descriere,fotografie1) values('','rezervatie','','','1.jpg');

insert into t_utilizatori(nume_utilizator,parola_utilizator,categorie,iddatepersonale) values('cristy','1234','user',1);
insert into t_utilizatori(nume_utilizator,parola_utilizator,categorie,iddatepersonale) values('andrey','1234','user',2);

insert into t_administratori(nume_administrator,parola_administrator) values('anca','1234');

insert into t_datepersonale(nume,prenume,telefon,localitate,email) values('Cristian','Popescu','4324322','Suceava','cristian@yahoo.com');
insert into t_datepersonale(nume,prenume,telefon,localitate,email) values('Andrei','Gavrilache','4432322','Iasi','andrei@yahoo.com');

insert into t_comentarii(iduser,idobiectiv,titlu,text,data) values(1,3,'Frumos','Foarte frumoasa manastirea','2014-06-15');
insert into t_comentarii(iduser,idobiectiv,titlu,text,data) values(1,5,'Interesant','Recomand','2014-03-21');
insert into t_comentarii(iduser,idobiectiv,titlu,text,data) values(2,3,'Frumos','Este foarte frumos acolo!!','2014-01-12');

insert into t_evaluari(idobiectiv,nota,idutilizator) values(1,8,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(2,10,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(3,8,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(4,7,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(5,8,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(6,8,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(7,4,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(8,8,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(9,5,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(1,8,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(11,6,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(12,6,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(13,2,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(7,10,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(8,7,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(9,9,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(1,9,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(1,4,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(11,8,2);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(12,7,1);
insert into t_evaluari(idobiectiv,nota,idutilizator) values(13,3,1);

grant all on t_obiective,t_utilizatori,t_datepersonale,t_comentarii,t_administratori,t_evaluari to public_larg;
grant all on id_obiectiv_secv,id_usr_secv,id_datepers_secv,id_comentariu_secv,id_evaluare_secv to public_larg;