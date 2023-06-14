<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch questions
$questionsQuery = "SELECT * FROM questions";
$questionsResult = $conn->query($questionsQuery);

// Fetch options
$optionsQuery = "SELECT * FROM options";
$optionsResult = $conn->query($optionsQuery);

// Store questions and options in arrays
$questions = array();
$options = array();

if ($questionsResult->num_rows > 0) {
    while ($row = $questionsResult->fetch_assoc()) {
        $questions[$row["id"]] = $row["question"];
    }
}

if ($optionsResult->num_rows > 0) {
    while ($row = $optionsResult->fetch_assoc()) {
        $options[$row["question_id"]][$row["id"]] = array(
            "option" => $row["option"],
            "option_value" => $row["option_value"]
        );
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quiz</title>
    <style>
        /* CSS styles for the quiz form */
    </style>
</head>

<body>
    <form action="process.php" method="POST">
        <?php foreach ($questions as $questionId => $question) { ?>
            <p><?php echo $question; ?></p>
            <?php foreach ($options[$questionId] as $optionId => $option) { ?>
                <label>
                    <input type="radio" name="answers[<?php echo $questionId; ?>]" value="<?php echo $option['option_value']; ?>">
                    <?php echo $option['option']; ?>
                </label>
            <?php } ?>
        <?php } ?>
        <input type="submit" value="Submit">
    </form>
</body>

</html>