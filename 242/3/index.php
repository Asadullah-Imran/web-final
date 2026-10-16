<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Strength Checker</title>
</head>
<body>
    <h2>Password Strength Checker</h2>

    <form method="post" action="">
        <label for="password">Password:</label>
        <input type="text" id="password" name="password" required value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
        <button type="submit" name="check">Check</button>
    </form>

    <?php
    function checkPasswordStrength($password) {
        $len = strlen($password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasLower = preg_match('/[a-z]/', $password);
        $hasDigit = preg_match('/[0-9]/', $password);
        $hasSpecial = preg_match('/[^a-zA-Z0-9]/', $password);
        $endsWithStar = (substr($password, -1) === '*');

        // Strong check
        if ($len >= 10 && $hasUpper && $hasLower && $hasDigit && $hasSpecial && $endsWithStar) {
            return "Strong";
        }

        // Medium check
        if ($len >= 8 && $hasUpper && $hasLower && $hasDigit) {
            return "Medium";
        }

        // Poor check
        if ($len >= 6 && $hasUpper) {
            return "Poor";
        }

        // Very Poor: anything else
        return "Very Poor";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pwd = $_POST['password'] ?? '';
        $strength = checkPasswordStrength($pwd);
        echo "<h3>Result: " . $strength . "</h3>";
    }

    echo "<hr><h4>Sample Test Cases:</h4>";
    echo "aFDF@F1ds* &rarr; " . checkPasswordStrength("aFDF@F1ds*") . " (Expected: Strong)<br>";
    echo "af15f15a4f45af4asas12 &rarr; " . checkPasswordStrength("af15f15a4f45af4asas12") . " (Expected: Very Poor)<br>";
    ?>
</body>
</html>
