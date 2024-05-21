<?php
session_start();
if (!isset($_SESSION['tablename'])) {
    die("<script>alert('Session Expired.');window.location.href='index.php';</script>");
}
require_once('dbconnection.php');
$subjlists = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>
    <link rel="stylesheet" href="index.css">
    <script src="jsfunc.js"></script>
</head>

<body>
    <header>
       <a href="index.php"> <img src="https://www.gitamw.ac.in/media/logo/gitam5.png" alt="College Logo"></a>
    </header>

    <div>
        <?php 
            $tablename = $_SESSION['tablename'];
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
            $subjdetails = mysqli_query($conn,"select * from `".$_SESSION['tablename']."`;");
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
        <table  border="1" align="center" cellpadding="15px" style="border-collapse: collapse;">
            <tr>
                <td>5 - Excellent</td>
                <td>4 - Very Good</td>
                <td>3 - Good</td>
                <td>2 - Average</td>
                <td>1 - Below Average</td>
            </tr>
        </table><br>
        <form method="post" align="center">
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
            <tbody id="fbform">
                <script>createfbform(<?php echo $noOfRows; ?>);</script>
            </tbody>
        </table><br>
        <div style="text-align: center;">
        <textarea name="cmts" placeholder="Comments Here"style="width: 950px; height: 50px;"></textarea><br>
            </div>
        <div style="text-align: center;">
        <button type="submit" name="submitfb">Submit Feedback</button>
    </div>
       
        </form>
    </div>
    <br>
    <?php
    if(isset($_POST['submitfb'])){
        $params = ['Has the Teacher covered entire Syllabus as prescribed by University?', 'Does the teacher come to class in time?', 'Does the teacher have command on the subject?', 'Does the teacher write and draw legibly on black board?', 'Does the teacher speak clearly and audibly?', 'Does the teacher, encourage, compliment and praise originally and creativity displayed by the students?', 'Is the teacher prompt valuing and returning the answer scripts providing feedback on performance?', 'Is the teacher available beyond normal classes to solve doubts?', 'Does the teacher maintain discipline in the classroom?', 'Overall rating of the teacher'];
        $fbratings = array();
        $tablename = $_SESSION['tablename']."-fb";
        for($col=0;$col<$noOfRows;$col++){
            $s = '';
            for($row=0;$row<count($params);$row++){
                $s = $s.$_POST["r".strval($row).strval($col)];
            }
            array_push($fbratings,$s);
        }
        $q = "insert into `".$tablename."` values(";
        foreach($fbratings as $val){
            $q = $q."'".$val."',";
        }
        $q = $q."'".$_POST['cmts']."');";
        $insert = mysqli_query($conn,$q);
        if(!$insert){
            die("<script>alert('Database Error.');window.location.href='index.php';</script>");
        }
        echo("<script>alert('Thanks for giving feedback.');</script>");
        session_unset();
        session_destroy();
        echo("<script>window.location.href='index.php';</script>");
    } 
    ?>
    <footer>
        <p>&copy; Student Feedback form Developed by.</p>
        <p>C.Swarnalatha| M.Sucharitha| K.Rama Dharani| G.Madhavi Latha</p>
    </footer>

</body>
</html