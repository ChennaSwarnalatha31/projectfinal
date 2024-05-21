<?php
session_start();
require("dbconnection.php");

// Validate session
if (!isset($_SESSION['loginid']) || !isset($_SESSION['loginpwd'])) {
    die("<script>alert('Session Expired. Please Login Again.');window.location.href='adminlogin.php';</script>");
}

// Validate admin credentials
$q = "SELECT * FROM admin WHERE adminid='".$_SESSION['loginid']."' AND adminpwd='".$_SESSION['loginpwd']."';";
$result = mysqli_query($conn, $q);

if (mysqli_num_rows($result) != 1) {
    die("<script>alert('Invalid Login ID or Password. Please Login Again.');window.location.href='adminlogin.php';</script>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="adminhome.css">
    <script src="adminhome.js"></script>

</head>
<body>
    <header>
        <div class="main">
            <div class="header-content">
                <img src="https://www.gitamw.ac.in/media/logo/gitam5.png" alt="college logo">
            </div>
        </div>
        <form action="logout.php">
            <button type="submit" id="logoutBtn" class="form1">Logout</button>
        </form>
    </header>

    <div class="container">
        <h2>Welcome! Department of <?php echo $_SESSION['loginid']; ?></h2>
        <div class="buttons">
            <!-- Create Feedback button -->
            <a name="createfb" href="adminhome.php?createfb=true" id="createFeedbackBtn">Create Feedback</a>
            <!-- View Feedback button -->
            <a name="viewfb" href="adminhome.php?viewfb=true" id="viewFeedbackBtn">View Feedback</a>
        </div>
    </div>

    <?php
    if(isset($_GET['createfb'])){
    ?>
    <div id="createFeedbackForm">
        
        <form id="feedbackForm" method="post">
        <h3>Create Feedback Form</h3>
            <label for="year">Year:</label>
            <select id="year" name="year">
                <option value="">Select Year</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester">
                <option value="">Select Semester</option>
                <option value="1">1st Semester</option>
                <option value="2">2nd Semester</option>
            </select>

            <label for="branch">Branch:</label>
            <select id="branch" name="branch" required>
                <option value="">Select Branch</option>
                <option value="CSE">Computer Science & Engineering</option>
                <option value="ECE">Electronics & Communication Engineering</option>
                <option value="EEE">Electrical & Electronics Engineering</option>
                <option value="AIML">AI & Machine Learning</option>
            </select>

            <label for="numSections">Number of Sections:</label>
            <select name="numSections" id="numSections" required>
                <option value="">--Number of Sections--</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>

            <label for="numSubjects">Number of Subjects:</label>
            <input type="number" id="numSubjects" name="numSubjects" min="1">

            <label for="numLabs">Number of Labs:</label>
            <input type="number" id="numLabs" name="numLabs" min="1">

            <!-- Add Subjects & Labs button -->
            <button type="button" id="addSubjectsBtn" onclick="addSubjects()">Add Subjects & Labs</button>
            <table>
                <tbody id="addsubjects"></tbody>
                <tfoot id="createbtn"></tfoot>
            </table>
        </form>
    </div>
    <?php
    if(isset($_POST['createbtn'])){
        $year = $_POST['year'];
        $sem = $_POST['semester'];
        $branch = $_POST['branch'];
        $sec = intval($_POST['numSections']);
        $subj = intval($_POST['numSubjects']);
        $labs = intval($_POST['numLabs']);
        $tablename = $year.' '.$sem.' '.$branch;
        if($sec==1){
            $q = "insert into ".$_SESSION['loginid']." values('".$tablename."');";
            mysqli_query($conn,$q);
            $q = "create table `".$tablename."`(subject varchar(100),faculty varchar(100));";
            $create = mysqli_query($conn,$q);
            if(!$create){
                die("<script>alert('Database Error. Try Again.');window.location.href='adminhome.php';</script>");
            }
            for($i=1;$i<=$subj;$i++){
                $q = "insert into `".$tablename."` values('".$_POST['s'.strval($i)]."','".$_POST['f'.strval($i)]."');";
                $insert = mysqli_query($conn,$q);
            }
            for($i=1;$i<=$labs;$i++){
                $q = "insert into `".$tablename."` values('".$_POST['l'.strval($i)]."','".$_POST['lf'.strval($i)]."');";
                $insert = mysqli_query($conn,$q);
            }
            $q = "create table `".$tablename."-FB`(";
            for($i=1;$i<=$subj;$i++){
                $q = $q."subject".strval($i)." varchar(100),";
            }
            for($i=1;$i<=$labs;$i++){
                $q = $q."lab".strval($i)." varchar(100),";
            }
            $q = $q."comment varchar(300));";
            $create2 = mysqli_query($conn,$q);
            if(!$create2){
                die("<script>alert('Database Error. Try Again.');window.location.href='adminhome.php';</script>");
            }
            echo("<script>alert('Feedback Created Successfully.');window.location.href='adminhome.php';</script>");
        }else{
            for($j=1;$j<=$sec;$j++){
                $tablenamewithsec = $tablename."-".$j;
                $q = "insert into ".$_SESSION['loginid']." values('".$tablenamewithsec."');";
                mysqli_query($conn,$q);
                $q = "create table `".$tablenamewithsec."`(subject varchar(100),faculty varchar(100));";
                $create = mysqli_query($conn,$q);
                if(!$create){
                    die("<script>alert('Database Error. Try Again.');window.location.href='adminhome.php';</script>");
                }
                for($i=1;$i<=$subj;$i++){
                    $q = "insert into `".$tablenamewithsec."` values('".$_POST['s'.strval($i)]."','".$_POST['f'.strval($i)]."');";
                    $insert = mysqli_query($conn,$q);
                }
                for($i=1;$i<=$labs;$i++){
                    $q = "insert into `".$tablenamewithsec."` values('".$_POST['l'.strval($i)]."','".$_POST['lf'.strval($i)]."');";
                    $insert = mysqli_query($conn,$q);
                }
                $q = "create table `".$tablenamewithsec."-FB`(";
                for($i=1;$i<=$subj;$i++){
                    $q = $q."subject".strval($i)." varchar(100),";
                }
                for($i=1;$i<=$labs;$i++){
                    $q = $q."lab".strval($i)." varchar(100),";
                }
                $q = $q."comment varchar(300));";
                $create2 = mysqli_query($conn,$q);
                if(!$create2){
                    die("<script>alert('Database Error. Try Again.');window.location.href='adminhome.php';</script>");
                }
                echo("<script>alert('Feedback Created Successfully.');window.location.href='adminhome.php';</script>");
            }
        }
    }
    }

    if(isset($_GET['viewfb'])){
        $tables = mysqli_query($conn,"select * from `".$_SESSION['loginid']."`;");
        echo("<center><form method='post'>
        <select name='selectedtable' required style='width: 400px'>
        <option value='' disabled selected>--Select--</option>
        ");
        while($t = mysqli_fetch_array($tables,MYSQLI_NUM)){
            echo("
            <option value='".$t[0]."'>".$t[0]."</option>
            ");
        }
        echo("</select>
        <button type='submit' name='view'>Submit</button>
        </form>
        </center>");
        if(isset($_POST['view'])){
            $_SESSION['selectedtable']=$_POST['selectedtable'];
            header("Location: viewfeedback.php");
        }
    }
    ?>

    <footer>
        <p>&copy; Student Feedback Form Developed by:</p>
        <p>C.Swarnalatha | M.Sucharitha | K.Rama Dharani | G.Madhavi Latha</p>
    </footer>
</body>
</html>
