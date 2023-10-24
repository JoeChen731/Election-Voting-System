<?php 
require_once "BusinessLayer.php";

class PresentationLayer
{
    function getSocietiesAsTable()
    {
        $bl = new BusinessLayer();
        $data = $bl->getAllSocieties();
        if (count($data) > 0)
        {
            $bigString = "<table border='0'>\n
                            <tr><th>ID</th><th>Society Name</th><th>Member Count</th><th>Main Contact</th><th>Edit</th><th>Delete?</th></tr>\n";

            foreach($data as $row)
            {
                $bigString .= "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['NumPeople']}</td>
                        <td>{$row['ContactPerson']}</td>
                        <td><form action='Society.php?SocietyID={$row['ID']}' method='POST'><button type='submit'>View</button></form></td>
                        <td><form action='Admin.php?type=society&deleteID={$row['ID']}' method='POST'><button type='submit'>Delete</button></form></td>
                    </tr>\n";
            } // Ends foreach

            $bigString .= "<tr><td><form action='Modify.php?type=society&action=add' method='POST'><button type='submit'>Add New Society</button></form></td></tr></table>\n";

        } 
        else
        {
            $bigString = "<h2>No Active Societes</h2>
            <td><form action='Modify.php?type=society&action=add' method='POST'><button type='submit'>Add Attendee</button></form>";
        }// Ends if

        return $bigString;
    }

    function getActiveElectionsAsTable($societyID)
    {   
        $bl = new BusinessLayer();
        $data = $bl->getActiveElectionsBySocietyID($societyID);
        if (count($data) > 0)
        {
            $bigString = "<table border='0'>\n
                            <tr><th>Election Name</th><th>Start Date</th><th>End Date</th><th>Instruction</th>
                            <th>Candidate A</th>
                            <th>Candidate B</th></tr>\n";

            foreach($data as $row)
            {
                $bigString .= "<tr>
                        <td>{$row['Name']}</td>
                        <td>{$row['Start_Date']}</td>
                        <td>{$row['End_Date']}</td>
                        <td>{$row['Instruction']}</td>
                        <td>{$row['Candidate_A']}</td>
                        <td>{$row['Candidate_B']}</td>
                        <td><form action='elections.php?electionID={$row['Id']}&SocietyID={$_GET['SocietyID']}' method='POST'><button type='submit'>Participate</button></form></td>
                    </tr>\n";
            } // Ends foreach

            $bigString .= "</table>\n";
        } 
        else
        {
            $bigString = "<h2>You Have No Active Elections</h2>";
        }// Ends if

        return $bigString;
    }


    function getActiveElectionsAdmin($societyID)
    {   
        $bl = new BusinessLayer();
        $data = $bl->getActiveElectionsBySocietyID($societyID);
        if (count($data) > 0)
        {
            $bigString = "<table border='0'>\n
                            <tr><th>Election Name</th><th>Start Date</th><th>End Date</th><th>Instruction</th>
                            <th>Candidate A</th>
                            <th>Candidate B</th></tr>\n";

            foreach($data as $row)
            {
                $bigString .= "<tr>
                        <td>{$row['Name']}</td>
                        <td>{$row['Start_Date']}</td>
                        <td>{$row['End_Date']}</td>
                        <td>{$row['Instruction']}</td>
                        <td>{$row['Candidate_A']}</td>
                        <td>{$row['Candidate_B']}</td>
                    </tr>\n";
            } // Ends foreach

            $bigString .= "</table>\n";
        } 
        else
        {
            $bigString = "<h2>You Have No Active Elections</h2>";
        }// Ends if

        return $bigString;
    }



    function getCompletedElectionsAdmin($societyID)
    {   
        $bl = new BusinessLayer();
        $data = $bl->getCompletedElectionsBySocietyID($societyID);
        if (count($data) > 0)
        {
            $bigString = "<table border='0'>\n
                            <tr><th>Election Name</th><th>Start Date</th><th>End Date</th><th>Instruction</th>
                            <th>Candidate A</th>
                            <th>Candidate B</th>
                            <th>Winner</th></tr>\n";

            foreach($data as $row)
            {
                $bigString .= "<tr>
                        <td>{$row['Name']}</td>
                        <td>{$row['Start_Date']}</td>
                        <td>{$row['End_Date']}</td>
                        <td>{$row['Instruction']}</td>
                        <td>{$row['Candidate_A']}</td>
                        <td>{$row['Candidate_B']}</td>
                        <td>Candidate X</td>
                    </tr>\n";
            } // Ends foreach

            $bigString .= "</table>\n";
        } 
        else
        {
            $bigString = "<h2>You Have No Active Elections</h2>";
        }// Ends if

        return $bigString;
    }


    function getElectionCandidatesTable($societyID)
    {   
        $bl = new BusinessLayer();
        $data = $bl->getElectionCandidates($societyID);
        $question = $bl->getQuestion($societyID);
        if (count($data) > 0)
        {
            $bigString = "<form action ='elections.php?SocietyID=".$_GET['SocietyID']."' method='POST'><h2>".$data[0]['name']."</h2>
                        <div>
                            <h2>".$data[0]['description']."</h2>
                            <input type='radio' name='president' value='candidate_A'>
                            <label for='candidate_A'>".$data[0]['Candidate_A']."</label><br>
                            <input type='radio' name='president' value='candidate_B'>
                            <label for='candidate_B'>".$data[0]['Candidate_B']."</label><br>
                        </div>
                        <div>
                            <h2>Additional Question For Election</h2>
                            <h3>".$question[0]['Text']." </h3>
                            <input type='radio' name='answer' value'Yes'>
                            <label for='Yes'>Yes</label><br>
                            <input type='radio' name='answer' value='No'>
                            <label for='Yes'>No</label><br>
                        </div>
                        <div>
                        <input type='submit' name='submit' />
                        </div>
                        </form>\n";
        } 
        else
        {
            $bigString = "<h2>You Have No Active Elections</h2>";
        }// Ends if

        return $bigString;
    }



    function addSocietyTable()
    {
        $bigString = "<form action ='Modify.php?type=society&action=add' method='POST'><h2>Add Society</h2>
                        <div>
                            <label for='societyName'>New Society Name: </label>
                            <input type='text' name='societyName' size='30'/>
                        </div>
                        <div>
                            <label for='numPeople'>Member Capacity:</label>
                            <input type='text' name='numPeople' size='50' />
                        </div>
                        <div>
                            <label for='contactPerson'>Main Contact:</label>
                            <input type='text' name='contactPerson' size='10' />
                        </div>
                        <div>
                        <input type='submit' name='submit' />
                        </div>
                        </form>\n";
        return $bigString;
    }

    function createElectionTable()
    {
        $bigString = "<form action ='Modify.php?type=election&action=add' method='POST'><h2>Create New Election Society</h2>
                        <div hidden='hidden'>
                            <label for='societyID'>hidden Field </label>
                            <input type='text' name='societyID' value='".$_GET['society']."'/>
                        </div>
                        <div>
                            <label for='electionName'>New Election Name: </label>
                            <input type='text' name='electionName' size='20'/>
                        </div>
                        <div>
                            <label for='startDate'>Election Start Date:</label>
                            <input type='text' name='startDate' size='20' />
                        </div>
                        <div>
                            <label for='endDate'>Election End Date:</label>
                            <input type='text' name='endDate' size='20' />
                        </div>
                        <div>
                            <label for='instruction'>Instructions:</label>
                            <input type='textarea' name='instruction' size='20' />
                        </div>
                        <div>
                            <label for='candidateA'>Candidate A:</label>
                            <input type='textarea' name='candidateA' size='20' />
                        </div>
                        <div>
                            <label for='candidateB'>Candidate B:</label>
                            <input type='textarea' name='candidateB' size='20' />
                        </div>
                        <div>
                        <input type='submit' name='submit' />
                        </div>
                        </form>\n";
        return $bigString;
    }

}