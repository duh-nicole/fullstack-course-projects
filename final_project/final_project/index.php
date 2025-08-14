<?php
// require database connection
require_once('database.php');

// Handle form submission for a new assignment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = $_POST['task_name'];
    $points_earned = $_POST['points_earned'];
    $points_possible = $_POST['points_possible'];
    $class_id = $_POST['class_id'];

    // Basic validation to prevent empty submissions
    if (!empty($task_name) && !empty($points_earned) && !empty($points_possible) && !empty($class_id)) {
        $sql_insert = "INSERT INTO assignment (task_name, points_earned, points_possible, class_id)
                       VALUES ('$task_name', '$points_earned', '$points_possible', '$class_id')";
        
        if (mysqli_query($conn, $sql_insert)) {
            // Success, redirect to the results page
            header("Location: results.php");
            exit();
        } else {
            // Error handling
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Assignment</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h1>Insert a New Assignment</h1>
        <div class="form-container">
            <form action="index.php" method="post">
                <label for="class_id">Select Class:</label>
                <select name="class_id" id="class_id" required>
                    <?php
                    // SQL to select all classes for the dropdown
                    $sql_classes_dropdown = "SELECT * FROM class ORDER BY class_id";
                    $result_classes_dropdown = mysqli_query($conn, $sql_classes_dropdown);
                    
                    if (mysqli_num_rows($result_classes_dropdown) > 0) {
                        while ($class_option = mysqli_fetch_assoc($result_classes_dropdown)) {
                            echo "<option value='" . $class_option['class_id'] . "'>"
                                . $class_option['department_code'] . " " . $class_option['course_number'] . " - " . $class_option['course_name']
                                . "</option>";
                        }
                    }
                    ?>
                </select>

                <label for="task_name">Assignment Task Name:</label>
                <input type="text" id="task_name" name="task_name" required>

                <label for="points_earned">Points Earned:</label>
                <input type="number" id="points_earned" name="points_earned" required>

                <label for="points_possible">Points Possible:</label>
                <input type="number" id="points_possible" name="points_possible" required>

                <button type="submit">Add Assignment</button>
            </form>
        </div>
    </div>
</body>
</html>

