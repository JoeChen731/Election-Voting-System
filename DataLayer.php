<?php
class DB
{
    private $conn;
    function __construct()
    {
        $this->conn = new mysqli($_SERVER['DB_SERVER'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD'],$_SERVER['DB']);

        if($this->conn->connect_error)
        {
            echo "connect failed: ".mysqli_connect_error();
            die();
        }
    }//constructor

    //IN USE
    function employeeLogin($username, $password)
    {
        $query = "SELECT * FROM Employee WHERE Username = ? AND Password = ?";
        $data;
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($Employee_id,$Username,$Password);
            $data = $stmt->num_rows;
        }
        return $data;
    }

    //IN USE
    function voterLogin($username, $password)
    {
        $query = "SELECT * FROM Voter WHERE Username = ? AND Password = ?";
        $data;
        
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID,$Society_id,$Username,$Password,$Gender,$DOB);
            $data = $stmt->num_rows;
        }
        return $data;
    }

    //IN USE
    function getEmpNameAtLogin($username)
    {
        $query = "SELECT Name FROM Employee WHERE Username = ?";

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($Name);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'Name' => $Name
                    ];
                }//while
            }//num_rows
        }   
        return $data;
    }

    

    //IN USE
    function getVoterData($username)
    {
        $query = "SELECT * FROM Voter WHERE Username = ?";

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID,$Society_id,$Name,$Password,$Gender,$DOB);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'ID' => $ID,
                        'Society_id' => $Society_id,
                        'Name' => $Name,
                        'Password' => $Password,
                        'Gender' => $Gender,
                        'DOB' => $DOB
                    ];
                }//while
            }//num_rows
        }   
        return $data;
    }



    //IN USE
    function getQuestion($societyID)
    {
        $query = "SELECT * FROM Question WHERE Ballot_id = ?";

        $data;
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("i", intval($societyID));
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID,$Ballot_id,$Text);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'ID' => $ID,
                        'Ballot_id' => $Ballot_id,
                        'Text' => $Text
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    //IN USE
    function getElectionCandidates($societyID)
    {
        $query = "SELECT Ballot.name, Ballot.description, Ballot.voting_instructions, Elections.Candidate_A AS Candidate_A_Name, Elections.Candidate_B AS Candidate_B_Name
                  FROM Ballot
                  LEFT JOIN Elections ON Ballot.Id = Elections.id
                  WHERE Ballot.society_ID = ?";
        $data;
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("i", intval($societyID));
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($name,$description,$voting_instructions,$Candidate_A,$Candidate_B);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'name' => $name,
                        'description' => $description,
                        'voting_instructions' => $voting_instructions,
                        'Candidate_A' => $Candidate_A,
                        'Candidate_B' => $Candidate_B
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    //IN USE
    function empExists()
    {
        $query = "SELECT Username FROM Employee WHERE Username = ? AND Password = ?";
        $data;
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($Username);
            $data = $stmt->num_rows;
        }
        return $data;
    }

    //IN USE
    function voterExists()
    {
        $query = "SELECT Username FROM Employee WHERE Username = ? AND Password = ?";
        $data;
        if($stmt = $this->conn->prepare($query))
        {    
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $stmt->store_result();
            $data = $stmt->num_rows;
        }
        return $data;
    }


    //IN USE
    function getAllSocieties()
    {
        $query = "SELECT * FROM Society";
        $data = [];

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID,$Name,$NumPeople,$ContactPerson);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'ID' => $ID,
                        'Name' => $Name,
                        'NumPeople' => $NumPeople,
                        'ContactPerson' => $ContactPerson
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    //IN USE
    function getSocietyByID($societyID)
    {
        $query = "SELECT * FROM Society WHERE ID = ?";
        $data = [];

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->bind_param("i", intval($societyID));
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($ID,$Name,$NumPeople,$ContactPerson);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'ID' => $ID,
                        'Name' => $Name,
                        'NumPeople' => $NumPeople,
                        'ContactPerson' => $ContactPerson
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    //IN USE
    function getActiveElectionsBySocietyID($societyID,$active)
    {
        $query = "SELECT * FROM Elections WHERE Society_id = ? AND Active = ?";
        $data = [];

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->bind_param("ii", intval($societyID),intval($active));
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($Id,$Society_id,$Name,$Start_Date,$End_Date,$Instruction,$Candidate_A,$Candidate_B,$Active);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'Id' => $Id,
                        'Society_id' => $Society_id,
                        'Name' => $Name,
                        'Start_Date' => $Start_Date,
                        'End_Date' => $End_Date,
                        'Instruction' => $Instruction,
                        'Candidate_A' => $Candidate_A,
                        'Candidate_B' =>$Candidate_B,
                        'Active' => $Active
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    //IN USE
    function getCompletedElectionsBySocietyID($societyID,$active)
    {
        $query = "SELECT * FROM Elections WHERE Society_id = ? AND Active = ?";
        $data = [];

        if($stmt = $this->conn->prepare($query))
        {   
            $stmt->bind_param("ii", intval($societyID),intval($active));
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($Id,$Society_id,$Name,$Start_Date,$End_Date,$Instruction,$Candidate_A,$Candidate_B,$Active);

            if($stmt->num_rows > 0)
            {
                while ($stmt->fetch())
                {
                    $data[] = [
                        'Id' => $Id,
                        'Society_id' => $Society_id,
                        'Name' => $Name,
                        'Start_Date' => $Start_Date,
                        'End_Date' => $End_Date,
                        'Instruction' => $Instruction,
                        'Candidate_A' => $Candidate_A,
                        'Candidate_B' =>$Candidate_B,
                        'Active' => $Active
                    ];
                }//while
            }//num_rows
        }
        return $data;
    }

    function deleteSocietyByID($societyID)
    {
        $query = "DELETE FROM Society WHERE ID = ?";
        $numRows = 0;
    
        if($stmt = $this->conn->prepare($query))
        {
            $stmt->bind_param("i", intval($societyID));
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
        }
        return $numRows;    
    }


    //IN USE
    function insertVoter($name,$password,$societyID)
    {
        $query = "INSERT INTO Voter (Username, Password, Society_id) VALUES (?,?,?);";
        $numRows = 0;
        
        if($stmt = $this->conn->prepare($query))
        {
            $stmt->bind_param("ssi", $name,$password,intval($societyID));
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
        }
        return $numRows;
    }

    //IN USE
    function insertSociety($societyName,$numPeople,$contactPerson)
    {
        $query = "INSERT INTO Society (Name, NumPeople, ContactPerson) VALUES (?,?,?);";
        $numRows = 0;
        
        if($stmt = $this->conn->prepare($query))
        {
            $stmt->bind_param("sis",$societyName,intval($numPeople),$contactPerson);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
        }
        return $numRows;
    }

    //IN USE
    function insertElection($societyID,$electionName,$startDate,$endDate,$instruction,$candidateA,$candidateB,$active)
    {
        $query = "INSERT INTO Elections (Society_id,Name,Start_Date,End_Date,Instruction,Candidate_A,Candidate_B,Active) VALUES (?,?,?,?,?,?,?,?);";
        $numRows = 0;
        
        if($stmt = $this->conn->prepare($query))
        {
            $stmt->bind_param("issssssi",intval($societyID),$electionName,$startDate,$endDate,$instruction,$candidateA,$candidateB,$active);
            $stmt->execute();
            $stmt->store_result();
            $numRows = $stmt->affected_rows;
        }
        return $numRows;
    }
}      

?>