// if I want to persist any info, declare globally
let calories = [];
let daily_goal = 2000;

document.getElementById("add_cal").addEventListener("click", function () {
    let calory = Number(document.getElementById("calory").value);

    calories.push(calory);

    let total_calories = 0;
    for (let i = 0; i < calories.length; i++) {
        total_calories += calories[i];
    }

    let entry_count = calories.length;

    let progress = (total_calories / daily_goal) * 100;

    let feedback = "";

    if (entry_count > 10 && total_calories < daily_goal) {
        feedback = "Be cautious of frequent snacking!";
    } else if (total_calories >= 2000) {
        feedback = "Goal reached! Stay mindful!";
    } else if (total_calories >= 1601 && total_calories <= 1999) {
        feedback = "Almost at your limit!";
    } else if (total_calories >= 801 && total_calories <= 1600) {
        feedback = "Good progress, keep it balanced!";
    } else {
        feedback = "You're off to a healthy start!";
    }

    document.getElementById("label").innerHTML = `total calories: ${total_calories} || daily goal progress: ${progress}% || entries: ${entry_count} || feedback: ${feedback}`;
});