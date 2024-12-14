<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Validation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; font-size: 1em; margin-top: 10px; }
        .form-group { margin-bottom: 15px; }
    </style>
    <script>
        function hideMessage() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                    document.getElementById('myForm').reset();
                }, 5000);
            }
        }
    </script>
</head>
<body onload="hideMessage()">

<?php
$errors = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate input fields
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // If no errors, process form
    if (empty($errors)) {
        $successMessage = "Form submitted successfully!";
    }
}
?>

<h1>Sample Form</h1>
<form id="myForm" method="POST" action="">
    <div class="form-group">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="error"><?php echo $errors['name']; ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Email:</label><br>
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
        <?php if (!empty($errors['email'])): ?>
            <div class="error"><?php echo $errors['email']; ?></div>
        <?php endif; ?>
    </div>

    <button type="submit">Submit</button>
</form>

<?php if ($successMessage): ?>
    <div id="successMessage" class="success"><?php echo $successMessage; ?></div>
<?php endif; ?>

</body>
</html>
