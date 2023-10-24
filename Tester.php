<?php 
require_once "DataLayer.php";
require_once "BusinessLayer.php";

    $db = new DB();
    $bl = new BusinessLayer();

    //Test sha256 hashing
    $testPass = "abc123";
    $hashedPass = hash('sha256', $testPass);
    var_dump($hashedPass);

    /*
    //Test Data Layer login
    $data = $db->employeeLogin("Employee1","abc123");
    var_dump($data);

    //Test Business Layer Login Employee
    $var1 = $bl->validateLogin("Employee1","abc123");
    var_dump($var1);
    */

    //Test Business Layer Login Voter
    $var2 = $bl->validateLogin("James Kirk","kirk@starbase12");
    var_dump($var2);
    echo "<br>";

    $empName = $db->getEmpNameAtLogin("je6095",1);
    var_dump($empName);
    echo $empName[0]["Name"];
    echo "<br>";


    
    //$voterName = $db->getVoterNameAtLogin("James Kirk",2);
    //var_dump($voterName);
    //echo $voterName[0]["Name"];


    $getSoc = $db->getSocietyByID(1);
    var_dump($getSoc);
    echo $getSoc[0]["Name"];


    $testInsertVoter = $bl->insertVoter("testuser", "password");

    var_dump($testInsertVoter);

    /*
    $testInsertElection = $bl->insertElection(2,"President Election","2022-05-15","2022-05-20","vote pls","Jason","CJ",0);
    var_dump($testInsertElection);


    $testGetActiveElections = $bl->getActiveElectionsBySocietyID(2);
    var_dump($testGetActiveElections);
    */

    $testGetCandidates = $db->getElectionCandidates(1);
    var_dump($testGetCandidates);


    $testGetQuestion = $db->getQuestion(2);
    var_dump($testGetQuestion);

?>