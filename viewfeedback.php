<?php
session_start();
require_once('dbconnection.php');
$subjlists = array();
$params = ['Has the Teacher covered entire Syllabus as prescribed by University?', 'Does the teacher come to class in time?', 'Does the teacher have command on the subject?', 'Does the teacher write and draw legibly on black board?', 'Does the teacher speak clearly and audibly?', 'Does the teacher, encourage, compliment and praise originally and creativity displayed by the students?', 'Is the teacher prompt valuing and returning the answer scripts providing feedback on performance?', 'Is the teacher available beyond normal classes to solve doubts?', 'Does the teacher maintain discipline in the classroom?', 'Overall rating of the teacher'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <header>
        <img src="https://www.gitamw.ac.in/media/logo/gitam5.png" alt="College Logo">
    </header>

    <?php 
        $tablename = $_SESSION['selectedtable'];
        $title = '';
        $tablename = explode(" ",$tablename);
        if($tablename[0]=='1'){
            $title = 'I B.Tech. ';
        }else if($tablename[0]=='2'){
            $title = 'II B.Tech. ';
        }else if($tablename[0]=='3'){
            $title = 'III B.Tech. ';
        }else if($tablename[0]=='4'){
            $title = 'IV B.Tech. ';
        }

        if($tablename[1]=='1'){
            $title = $title.'I-SEM ';
        }else if($tablename[1]=='2'){
            $title = $title.'II-SEM ';
        }

        $title = $title.$tablename[2];

        echo("<h1 align='center'>".$title."</h1>");
    ?>

    <table border="1" align="center" cellpadding="10px" style="border-collapse: collapse;">
        <tr>
            <th>Subject Name</th>
            <th>Faculty Name</th>
        </tr>
        <?php
        $subjdetails = mysqli_query($conn,"select * from `".$_SESSION['selectedtable']."`;");
        $noOfRows = mysqli_num_rows($subjdetails);
        while($subj = mysqli_fetch_array($subjdetails,MYSQLI_ASSOC)){
            array_push($subjlists,$subj['subject']);
            echo("<tr>
            <td>".$subj['subject']."</td>
            <td>".$subj['faculty']."</td>
            </tr>");
        }
        ?>
    </table><br>

    <?php
    $calcfb = array();
    for($j=0;$j<count($subjlists);$j++){
        $sub = array();
        for($i=0;$i<count($params);$i++){
            array_push($sub,0);
        }
        array_push($calcfb,$sub);
    }

    $fbdata = mysqli_query($conn,"select * from `".$_SESSION['selectedtable']."-fb`;");
    $noOfStudents = mysqli_num_rows($fbdata);
    while($data = mysqli_fetch_array($fbdata,MYSQLI_NUM)){
        for($col=0;$col<count($subjlists);$col++){
            for($row=0;$row<count($params);$row++){
                $calcfb[$col][$row] += $data[$col][$row];
            }
        }
    }

    echo("<h4 align='right'><i>Number of Students: </i>".$noOfStudents."</h4>");
    ?>

    <table border="1" align="center" cellpadding="15px" style="border-collapse: collapse;">
        <thead>
        <tr>
            <th></th>
            <?php
            for($i=0;$i<$noOfRows;$i++){
                echo("<th>".$subjlists[$i]."</th>");
            }
            ?>
        </tr>
        </thead>
        <tbody>
        <?php
        for($row=0;$row<count($params);$row++){
            echo("<tr>
            <td>".$params[$row]."</td>
            ");
            for($col=0;$col<count($subjlists);$col++){
                echo("<td>".round(($calcfb[$col][$row]/($noOfStudents*5))*100,2)."</td>");
            }
            echo("</tr>");
        }
        ?>
        </tbody>
    </table>
    <br>
    <h3>Comments:</h3>
    <ul>
    <?php
        $fbdata = mysqli_query($conn,"select comment from `".$_SESSION['selectedtable']."-fb`;");
        while($data = mysqli_fetch_array($fbdata,MYSQLI_NUM)){
            if($data[0]==''){
                continue;
            }
            echo("<li>".$data[0]."</li>");
        }
    ?>
    </ul>

    <button type="button" onclick="window.print()">Print</button>

    <footer>
        <p>&copy; Student Feedback form Developed by.</p>
        <p>C.Swarnalatha| M.Sucharitha| K.Rama Dharani| G.Madhavi Latha</p>
    </footer>
</body>
</html>