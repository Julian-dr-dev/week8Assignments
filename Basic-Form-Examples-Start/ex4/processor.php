<?php
// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to validate email format
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate URL format (optional)
function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST["name"]);
    $email = sanitize_input($_POST["email"]);
    $url = sanitize_input($_POST["url"]);
    $comments = sanitize_input($_POST["comments"]);

    // Server-side validation
    $errors = [];

    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long.";
    }

    if (empty($email) || !validate_email($email)) {
        $errors[] = "Please provide a valid email address.";
    }

    if (!empty($url) && !validate_url($url)) {
        $errors[] = "Please provide a valid URL.";
    }

    if (empty($comments) || strlen($comments) < 10) {
        $errors[] = "Comments must be at least 10 characters long.";
    }

    // Check for errors and display them
    if (count($errors) > 0) {
        echo "<h2>There were errors in your submission:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='index.html'>Go back and correct your input</a>";
    } else {
        // If no errors, display submitted data (further processing could be done here)
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Website: $url</p>";
        echo "<p>Comments: $comments</p>";

        // Example: You can send the form data to an email or store it in a database
        // mail($email, "Thank you for your submission", "Your comments: $comments", "From: no-reply@mywebsite.com");
        // $db = new PDO('mysql:host=localhost;dbname=form_data', 'username', 'password');
        // $stmt = $db->prepare("INSERT INTO submissions (name, email, url, comments) VALUES (?, ?, ?, ?)");
        // $stmt->execute([$name, $email, $url, $comments]);
    }
} else {
    echo "<h2>Invalid request method. Please submit the form.</h2>";
}
?>
