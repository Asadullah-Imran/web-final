let secretNumer = Math.floor(Math.random()*(5000-500+1)) + 500;
let count = 0;

function numberGuess(){
    count++;
    let guess = Number(document.getElementById("guess").value);

    if(guess==secretNumer){
        document.getElementById("ans").innerText = "Correct!";
        document.getElementById("guess").disabled = true;
    }
    else if(guess > secretNumer){
        document.getElementById("ans").innerText = "Too High!";
    }
    else if(guess < secretNumer){
        document.getElementById("ans").innerText = "Too Low!";
    }

    if(count > 5){
        document.getElementById("ans").innerText = "Out of guesses!";
        document.getElementById("btn").disabled = true;
        document.getElementById("guess").disabled = true;
    }
}


function reset(){
    count = 0;
    document.getElementById("btn").disabled = false;
    document.getElementById("guess").disabled = false;
    document.getElementById("ans").innerText = "";
    document.getElementById("guess").value = "";
}