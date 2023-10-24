-- create database voting;
-- USE voting;
CREATE TABLE Ballot (
  ID INT PRIMARY KEY,
  name VARCHAR(30),
  description MEDIUMTEXT,
  voting_instructions MEDIUMTEXT,
  society_ID INT,
  voting_format_id INT,
  FOREIGN KEY (society_ID) REFERENCES Society(ID),
  FOREIGN KEY (voting_format_id) REFERENCES Voting_Format(ID)
);

CREATE TABLE Write_In_Option (
  ID INT PRIMARY KEY,
  office_id INT,
  ballot_id INT,
  description TEXT,
  FOREIGN KEY (office_id) REFERENCES Office(ID),
  FOREIGN KEY (ballot_id) REFERENCES Ballot(ID)
);
CREATE TABLE Physical_Ballot (
  Ballot_id INT,
  name VARCHAR(30),
  picture BLOB,
  FOREIGN KEY (Ballot_id) REFERENCES Ballot(ID)
);
CREATE TABLE Office (
  ID INT PRIMARY KEY,
  Name VARCHAR(30),
  Description MEDIUMTEXT,
  Ballot_id INT,
  NumberVote INT,
  FOREIGN KEY (Ballot_id) REFERENCES Ballot(ID)
);

CREATE TABLE Ballot_Office_Candidate (
  ID INT PRIMARY KEY,
  Office_id INT,
  Candidate_id INT,
  FOREIGN KEY (Office_id) REFERENCES Office(ID),
  FOREIGN KEY (Candidate_id) REFERENCES Candidate(ID)
);
CREATE TABLE Society (
  ID INT PRIMARY KEY,
  Name VARCHAR(30),
  NumPeople INT,
  ContactPerson VARCHAR(30)
);

CREATE TABLE Vote (
  ID INT PRIMARY KEY,
  Voter_id INT,
  Ballot_id INT,
  Candidate_id INT,
  Vote_type VARCHAR(10),
  FOREIGN KEY (Voter_id) REFERENCES Voter(ID),
  FOREIGN KEY (Ballot_id) REFERENCES Ballot(ID),
  FOREIGN KEY (Candidate_id) REFERENCES Candidate(ID)
);
CREATE TABLE Voting_Format (
  ID INT PRIMARY KEY,
  Name VARCHAR(30),
  Description MEDIUMTEXT
);
CREATE TABLE Voter_Society (
  Society_id INT,
  Voter_id INT,
  FOREIGN KEY (Society_id) REFERENCES Society(ID),
  FOREIGN KEY (Voter_id) REFERENCES Voter(ID)
);
CREATE TABLE Question (
  ID INT PRIMARY KEY,
  Ballot_id INT,
  Text VARCHAR(25),
  FOREIGN KEY (Ballot_id) REFERENCES Ballot(ID)
);

CREATE TABLE Answer (
  ID INT PRIMARY KEY,
  Question_id INT,
  Text VARCHAR(25),
  Voter_id INT,
  FOREIGN KEY (Question_id) REFERENCES Question(ID),
  FOREIGN KEY (Voter_id) REFERENCES Voter(ID)
);

CREATE TABLE Voter (
  ID INT PRIMARY KEY,
  Username VARCHAR(30),
  Password VARCHAR(30),
  Gender CHAR(1),
  DOB DATE
);

CREATE TABLE Candidate (
  ID INT PRIMARY KEY,
  Name VARCHAR(30),
  BIO MEDIUMTEXT,
  Picture BLOB
);

CREATE TABLE Employee (
  Employee_id INT PRIMARY KEY,
  Username VARCHAR(30),
  Password VARCHAR(30)
);


