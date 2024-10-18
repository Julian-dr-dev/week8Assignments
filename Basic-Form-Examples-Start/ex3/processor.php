<?php
// Function to validate email format
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate URL format (optional)
function validate_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL);
}

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Process form submission if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST["name"]);
    $email = sanitize_input($_POST["email"]);
    $url = sanitize_input($_POST["url"]);
    $comments = sanitize_input($_POST["comments"]);

    $errors = [];

    // Validate form fields server-side
    if (empty($name) || strlen($name) < 2) {
        $errors[] = "Name is required and must be at least 2 characters long.";
    }

    if (empty($email) || !validate_email($email)) {
        $errors[] = "A valid email is required.";
    }

    if (!empty($url) && !validate_url($url)) {
        $errors[] = "The website URL is invalid.";
    }

    if (empty($comments) || strlen($comments) < 10) {
        $errors[] = "Comments are required and must be at least 10 characters long.";
    }

    // Check if there are any validation errors
    if (count($errors) > 0) {
        // Display errors to the user
        echo "<h2>There were errors in your form submission:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='index.html'>Go back and correct your input</a>";
    } else {
        // If no errors, process the form (e.g., save to database or send an email)
        echo "<h2>Form Submitted Successfully!</h2>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Website: $url</p>";
        echo "<p>Comments: $comments</p>";

        // Example: Saving form data to a database (this is just a placeholder comment)
        // $db = new PDO('mysql:host=localhost;dbname=form_data', 'username', 'password');
        // $stmt = $db->prepare("INSERT INTO submissions (name, email, url, comments) VALUES (?, ?, ?, ?)");
        // $stmt->execute([$name, $email, $url, $comments]);

        // Example: Sending an email (this is just a placeholder comment)
        // mail($email, "Thank you for your submission", "Your comments: $comments", "From: no-reply@mywebsite.com");
    }
} else {
    echo "<h2>Invalid request method. Please submit the form.</h2>";
}
?>
