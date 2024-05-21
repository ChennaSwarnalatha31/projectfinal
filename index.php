<?php
session_start();
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
    <div class="container">
        <h2>Student Feedback Form</h2>
        <form method="post">
            <div class="form-group">
                <label for="year">Year:</label>
                <select id="year" name="year" required>
                    <option value="">Select Year</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" required>
                    <option value="">Select Semester</option>
                    <option value="1">1st Semester</option>
                    <option value="2">2nd Semester</option>
                </select>
            </div>
            <div class="form-group">
                <label for="branch">Branch:</label>
                <select id="branch" name="branch" required>
                    <option value="">Select Branch</option>
                    <option value="CSE">Computer Science & Engineering</option>
                    <option value="ECE">Electronics & Communication Engineering</option>
                    <option value="EEE">Electrical & Electronics Engineering</option>
                    <option value="AI&ML">AI&ML</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <select id="section" name="section" required>
                    <option value="">Select Section</option>
                    <option value="1">Section 1</option>
                    <option value="2">Section 2</option>
                    <option value="NA">NA</option>
                </select>
            </div>
            
            <div class="submit-button">
                <button type="submit" name="givefeedback">Submit</button>
            </div>
        </form>
        <?php
        if(isset($_POST['givefeedback'])){
            $tablename = '';
            if($_POST['section']=='NA'){
                $tablename = $_POST['year']." ".$_POST['semester']." ".$_POST['branch'];
            }else{
                $tablename = $_POST['year']." ".$_POST['semester']." ".$_POST['branch']."-".$_POST['section'];
            }
            $_SESSION['tablename'] = $tablename;
            header("Location: givefeedback.php");
        }
        ?>
    </div>

    <footer>
        <p>&copy; Student Feedback form Developed by.</p>
        <p>C.Swarnalatha| M.Sucharitha| K.Rama Dharani| G.Madhavi Latha</p>
    </footer>

    <div class="admin-button">
    <form id="adminlogin" action="adminlogin.php" method="post">
        <button type="submit">Admin Login</button>
    </form>
    </div>
    <script src="index.js"></script>  
</body>

</html>