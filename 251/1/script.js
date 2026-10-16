const targetStrengthScore = 100;
let attempts = 0;

function checkStrength() {
    let password = document.getElementById('password').value;
    let resultLabel = document.getElementById('result');
    let tipsDiv = document.getElementById('tips');

    attempts++;

    let score = 0;
    let len = password.length;

    // Length: +10 points for every 2 characters (minimum 6 characters required)
    if (len >= 6) {
        let pairsBeyondMin = Math.floor((len - 6) / 2);
        score += pairsBeyondMin * 10;
    }

    // Uppercase letters: +15 points if present
    if (/[A-Z]/.test(password)) {
        score += 15;
    }

    // Lowercase letters: +15 points if present
    if (/[a-z]/.test(password)) {
        score += 15;
    }

    // Numbers: +20 points if present
    if (/[0-9]/.test(password)) {
        score += 20;
    }

    // Special characters (!@#$%^&*): +25 points if present
    if (/[!@#$%^&*]/.test(password)) {
        score += 25;
    }

    // Strength levels:
    // Very Weak (0-30), Weak (31-50), Medium (51-70), Strong (71-90), Very Strong (91+)
    let level = "";
    if (score <= 30) {
        level = "Very Weak";
    } else if (score <= 50) {
        level = "Weak";
    } else if (score <= 70) {
        level = "Medium";
    } else if (score <= 90) {
        level = "Strong";
    } else {
        level = "Very Strong";
    }

    // If password reaches 100+ points: "Perfect Password!" and show success message
    if (score >= 100) {
        resultLabel.innerHTML = "<strong>Score: " + score + " (" + level + ") - Perfect Password!</strong> <span style='color:green;'>Success: Your password meets all security benchmarks!</span>";
    } else {
        resultLabel.innerHTML = "<strong>Score: " + score + " - " + level + "</strong> (Attempt: " + attempts + ")";
    }

    // If user makes more than 8 attempts without reaching "Strong" level (score < 71)
    if (attempts > 8 && score < 71) {
        tipsDiv.innerHTML = "<p style='color: red;'><strong>Need practice!</strong></p>" +
            "<p>Tips to strengthen your password:<br>" +
            "- Make it longer (at least 10+ characters)<br>" +
            "- Mix uppercase (A-Z) and lowercase (a-z) letters<br>" +
            "- Include digits (0-9) and special characters (!@#$%^&*)</p>";
    } else if (score >= 71) {
        tipsDiv.innerHTML = "";
    }
}