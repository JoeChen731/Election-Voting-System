<?php 
require_once "DataLayer.php";

class BusinessLayer
{
    //IN USE
    function validateLogin($username,$password)
    {
        if($username != NULL && $password != NULL)
        {
            $db = new DB();
            //$hashedPass = $this->hashPassword($password);
            $data = $db->voterLogin($username,$password);
            if($data != 0)
            {
               return $data+1;
            }

            $data = $db->employeeLogin($username,$password);
            if($data != 0)
            {
                return $data;
            }
            
        }
        else
        {
            return "?error=Unsuccessful Login";
        }
        
    }
    
    //IN USE
    function hashPassword($pass)
    {
        $hashedPass = hash('sha256', $pass);
        return $hashedPass;
    }

    //IN USE
    function getEmpNameAtLogin($userName,$level)
    {   
        if($level == 1)
        {
            $db = new DB();
            $name = $db->getEmpNameAtLogin($userName);
        }
        return $name[0]["Name"];
    }

    //IN USE
    function getVoterData($userName,$level)
    {   
        if($level == 2)
        {
            $db = new DB();
            $data = $db->getVoterData($userName);
        }
        //return $name[0]["Name"];
        return $data;
    }

    //IN USE
    function getQuestion($societyID)
    {
        $db = new DB();
        $data = $db->getQuestion($societyID);
        return $data;
    }

    //IN USE
    function validateDate($date, $format = 'Y-m-d H:i:s')     
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date; 
    }

    //IN USE
    function userExists($userName)
    {
        $db = new DB();
        $data = $db->empExists($userName);
        if($data == 1)
        {
            return true;
        }
        $data = $db->voterExists($userName);
        if($data == 1)
        {
            return true;
        }
        return false;
    }

    //IN USE
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //IN USE
    function getAllSocieties()
    {
        $db = new DB();
        $data = $db->getAllSocieties();
        return $data;
    }

    //IN USE
    function getSocietyByID($societyID)
    {
        $db = new DB();
        $data = $db->getSocietyByID($societyID);
        return $data[0]["Name"];
    }


    //IN USE
    function getElectionCandidates($societyID)
    {
        $db = new DB();
        $data = $db->getElectionCandidates($societyID);
        return $data;
    }

    //IN USE
    function getActiveElectionsBySocietyID($societyID)
    {
        $db = new DB();
        $data = $db->getActiveElectionsBySocietyID($societyID,1);
        return $data;
    }

    //IN USE
    function getCompletedElectionsBySocietyID($societyID)
    {
        $db = new DB();
        $data = $db->getCompletedElectionsBySocietyID($societyID,0);
        return $data;
    }


    //IN USE
    function deleteSocietyByID($societyID)
    {
        $db = new DB();
        $numRows = $db->deleteSocietyByID($societyID);
        if($numRows == 1)
        {
            return $numRows;
        }
        else
        {
            return "Could not delete society";
        }
    }

    //IN USE
    function insertVoter($name,$password,$societyID)
    {
        //$this->validate($name);
        //$this->validate($password);
        $db = new DB();
        //$hashedPass = $this->hashPassword($password);
        $data = $db->insertVoter($name,$password,$societyID);
        if($data = 1)
        {
            return $data;
        }
        else
        {
            return "Error could not insert user";        
        }
    }

    //IN USE
    function insertSociety($societyName,$numPeople,$contactPerson)
    {
        $db = new DB();
        $numRows = $db->insertSociety($societyName,$numPeople,$contactPerson);
        if($numRows == 1)
        {
            return $numRows;
        }
        else
        {
            return "Could not insert new society";
        }
    }



    //IN USE
    function insertElection($societyID,$electionName,$startDate,$endDate,$instruction,$candidateA,$candidateB)
    {
        $db = new DB();
        $numRows = $db->insertElection($societyID,$electionName,$startDate,$endDate,$instruction,$candidateA,$candidateB,0);
        if($numRows == 1)
        {
            return $numRows;
        }
        else
        {
            return "Could not insert new election";
        }
    }


}
?>