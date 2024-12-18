<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
</head>
<body>

<h2>Feedback List</h2>
<div class="feedback-container">
    <?php
    // Check if the feedback file exists
    if (file_exists("feedback.txt")) {
        // Read and display the contents of the feedback file
        $feedbackContent = file_get_contents("feedback.txt");
        echo nl2br(htmlspecialchars($feedbackContent));
    } else {
        echo "<p>No feedback available yet.</p>";
    }
    ?>
</div>

</body>
</html>
