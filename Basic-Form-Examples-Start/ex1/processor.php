<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Form Processor</title>
</head>

<body>

    <h1>Processed Data</h1>
    
	<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $url = trim($_POST["url"]);
    $comments = trim($_POST["comments"]);
    
    if (empty($name) || empty($email) || empty($comments)) {
        echo "Please fill in the required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } else {
        echo "Form submitted successfully.";
        // Further processing could happen here
    }
}
?>


</body>
</html>

