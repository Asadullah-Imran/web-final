let secretNumer = Math.floor(Math.random() * (5000 - 500 + 1)) + 500;
let count = 0;
const maxAttempts = 5;

function numberGuess() {
    let guessInput = document.getElementById("guess");
    let guess = Number(guessInput.value);

    if (guessInput.value.trim() === "" || isNaN(guess)) {
        document.getElementById("ans").innerText = "Please enter a valid number!";
        return;
    }

    count++;

    if (guess === secretNumer) {
        document.getElementById("ans").innerText = "Correct!";
        guessInput.disabled = true;
        document.getElementById("btnSubmit").disabled = true;
        return;
    } else if (guess > secretNumer) {
        document.getElementById("ans").innerText = "Too high!";
    } else {
        document.getElementById("ans").innerText = "Too low!";
    }

    // If user runs out of guesses (after 5 attempts)
    if (count >= maxAttempts) {
        document.getElementById("ans").innerText = "Out of guesses! The number was " + secretNumer;
        guessInput.disabled = true;
        document.getElementById("btnSubmit").disabled = true;
    }
}

function reset() {
    secretNumer = Math.floor(Math.random() * (5000 - 500 + 1)) + 500;
    count = 0;
    document.getElementById("btnSubmit").disabled = false;
    document.getElementById("guess").disabled = false;
    document.getElementById("guess").value = "";
    document.getElementById("ans").innerText = "";
}
