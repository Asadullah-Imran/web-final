
let calory_goal = 2000;
let totalCalory = 0;
let entries = 0;

function addcalories() {

    let calory = parseInt(
        document.getElementById("calory-id").value
    );

    // Validate input
    if (isNaN(calory) || calory <= 0) {
        alert("Please enter valid calories!");
        return;
    }

    // a) Add calories to running total
    totalCalory += calory;

    // d) Count number of entries
    entries++;

    // b) Display total calories
    document.getElementById("result").innerHTML =
        "Total Calories: " + totalCalory;

    // Display daily goal progress
    let progress = (totalCalory / calory_goal) * 100;

    document.getElementById("progress").innerHTML =
        "Daily Goal Progress: " + progress.toFixed(1) + "%";

    // c) Feedback based on total calories
    if (totalCalory <= 800) {
        document.getElementById("feedback").innerHTML =
            "You're off to a healthy start!";
    }
    else if (totalCalory <= 1600) {
        document.getElementById("feedback").innerHTML =
            "Good progress, keep it balanced!";
    }
    else if (totalCalory < 2000) {
        document.getElementById("feedback").innerHTML =
            "Almost at your limit!";
    }
    else {
        document.getElementById("feedback").innerHTML =
            "Goal reached! Stay mindful!";
    }

    // d) Display number of entries
    document.getElementById("entries").innerHTML =
        "Number of Entries: " + entries;

    // e) Warning for frequent entries before reaching goal
    if (entries > 10 && totalCalory < calory_goal) {
        document.getElementById("feedback").innerHTML =
            "Be cautious of frequent snacking!";
    }

    // Clear input after adding
    document.getElementById("calory-id").value = "";
}
