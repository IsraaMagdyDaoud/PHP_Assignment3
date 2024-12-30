<!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>Day3</h1>
        <!-- part one -->
        <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Track</th>
        </tr>
        <?php
        $students = [
            ['name' => 'Alaa', 'email' => 'ahmed@test.com', 'track' => 'PHP'],
            ['name' => 'Shamy', 'email' => 'ali@test.com', 'track' => 'CMS'],
            ['name' => 'Youssef', 'email' => 'basem@test.com', 'track' => 'PHP'],
            ['name' => 'Waleid', 'email' => 'farouk@test.com', 'track' => 'CMS'],
            ['name' => 'Rahma', 'email' => 'hany@test.com', 'track' => 'PHP'],
        ];

        foreach ($students as $student) {
            $track_color = $student['track'] === 'CMS' ? "style='color:red'" : '';
            echo "<tr $track_color>
                    <td>{$student['name']}</td>
                    <td>{$student['email']}</td>
                    <td>{$student['track']}</td>
                  </tr>";
        }
        ?>
    </table>
    <!-- part two -->
    <?php
    $name = $email = $group = $classDetails = $gender = $courses = "";
    $nameErr = $emailErr = $genderErr = $coursesErr = $agreeErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } elseif (!preg_match("/^[a-zA-Z\s]*$/", $_POST["name"])) {
            $nameErr = "Invalid Name";
        } else {
            $name = test_input($_POST["name"]);
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $email = test_input($_POST["email"]);
        }
        $group = test_input($_POST["group"] ?? "");
        $classDetails = test_input($_POST["classDetails"] ?? "");
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
        if (isset($_POST["courses"])) {
            $courses = implode(", ", $_POST["courses"]);
        }
        if (empty($_POST["agree"])) {
            $agreeErr = "You must agree to terms";
        }
    }

    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    ?>

    <h2>Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span style="color:red;">* <?php echo $nameErr;?></span>
    <br><br>

    E-mail: <input type="text" name="email"  value="<?php echo $email; ?>">
    <span style="color:red;">* <?php echo $emailErr;?></span>
    <br><br>

    Group #: <input type="text" name="group" value="<?php echo $group; ?>">
    <br><br>

    Class details:<textarea name="classDetails" rows="5" cols="40"><?php echo $classDetails; ?></textarea>
    <br><br>

    Gender:
    <input type="radio" name="gender" value="Female" <?php if ($gender == "Female") echo "checked"; ?>>Female
    <input type="radio" name="gender" value="Male" <?php if ($gender == "Male") echo "checked"; ?>>Male
    <span style="color:red;">* <?php echo $genderErr; ?></span>
    <br><br>

    Select Courses:
    <select name="courses[]" multiple size="5">
        <option value="PHP" <?php echo (isset($_POST["courses"]) && in_array("PHP", $_POST["courses"])) ? "selected" : ""; ?>>PHP</option>
        <option value="JavaScript" <?php echo (isset($_POST["courses"]) && in_array("JavaScript", $_POST["courses"])) ? "selected" : ""; ?>>JavaScript</option>
        <option value="MySQL" <?php echo (isset($_POST["courses"]) && in_array("MySQL", $_POST["courses"])) ? "selected" : ""; ?>>MySQL</option>
        <option value="HTML" <?php echo (isset($_POST["courses"]) && in_array("HTML", $_POST["courses"])) ? "selected" : ""; ?>>HTML</option>
        <option value="CSS" <?php echo (isset($_POST["courses"]) && in_array("CSS", $_POST["courses"])) ? "selected" : ""; ?>>CSS</option>
        <option value="Apache" <?php echo (isset($_POST["courses"]) && in_array("Apache", $_POST["courses"])) ? "selected" : ""; ?>>Apache</option>
    </select>
    <br><br>

    Agree: <input type="checkbox" name="agree" value="1">
    <span style="color:red;">* <?php echo $agreeErr;?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">   
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameErr && !$emailErr && !$genderErr && !$agreeErr) {
        echo "<h2>Your Input:</h2>";
        echo "Name: " . $name . "<br>";
        echo "E-mail: " . $email . "<br>";
        echo "Group #: " . $group . "<br>";
        echo "Class details: " . $classDetails . "<br>";
        echo "Gender: " . $gender . "<br>";
        echo "Courses: " . ($courses ? $courses : "No courses selected") . "<br>";
    }
    ?>
    </body>
</html>
