<?php
// process.php

// Get user answers from the form submission
$userAnswers = $_POST['answers'];

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch correct answers from the database
$correctAnswers = array();
$correctAnswersQuery = "SELECT id, correct_answer FROM questions";
$correctAnswersResult = $conn->query($correctAnswersQuery);

if ($correctAnswersResult->num_rows > 0) {
    while ($row = $correctAnswersResult->fetch_assoc()) {
        $correctAnswers[$row["id"]] = $row["correct_answer"];
    }
}

// Calculate the score
$score = 0;
foreach ($userAnswers as $questionId => $userAnswer) {
    if (isset($correctAnswers[$questionId]) && $userAnswer === $correctAnswers[$questionId]) {
        $score++;
    }
}

$conn->close();
?>

<?php
// result

echo "<h2>Your Score: " . $score . "</h2>";

echo "<h3>Correct Answers:</h3>";
echo "<ul>";
    foreach ($correctAnswers as $questionId => $correctAnswer) {
    echo "<li>Question " . $questionId . ": " . $correctAnswer . "</li>";
    }
    echo "</ul>";

?>