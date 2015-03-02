/* Création Tables */



CREATE TABLE ADMIN (
ID			NUMBER(6)
UserName	VARCHAR(250)
Password 	VARCHAR(100)
CONSTRAINT Key_ADMIN PRIMARY KEY (ID)
);


CREATE TABLE QUESTIONNAIRE (
IdQuest			NUMBER(6)
Nom				VARCHAR(20)
IdCreateur		NUMBER(6)
DateCreation	DATETIME
CONSTRAINT PART_Key PRIMARY KEY (IdQuest)
);


CREATE TABLE PARTICIPANT (
IdUser		NUMBER(6)
IdQuest		NUMBER(6) 
Note		NUMBER(3)
CONSTRAINT FOREIGN KEY (IdQuest) references QUESTIONNAIRE (IdQuest)
CONSTRAINT PART_Key PRIMARY KEY (IdUser,IdQuest)
);

/*ADMIN*/
INSERT INTO ADMINISTRATEUR VALUES (1,"Marco","test");

/*Exemples questionnaires*/
INSERT INTO QUESTIONNAIRE VALUES (1,"Marco", 1,25/02/2013, "http://localhost/projet_SUS_test/questionnaire.php?nomSysteme=Parions Sport");

/*Utilisateurs*/
INSERT INTO PARTICIPANT VALUES (1,1,50);
