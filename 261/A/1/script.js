let totalHours = 0
let sessions = 0;
let subjects = []


function addStudy() {

    let subject = document.getElementById("subject").value;
    let hours = parseFloat(document.getElementById("hours").value);

    if (subject.trim() === "" || isNaN(hours) || hours <= 0 || document.getElementById("hours").value === "") {
        alert("Enter a valid subject name and study hours.");
        return;
    }

    totalHours += hours;
    subjects.push(subject)
    sessions++;

    let average = totalHours / sessions

    let feedback;
    if (totalHours <= 5) {
        feedback = "Start studying regularly!";
    } else if (totalHours <= 12) {
        feedback = "Good progress!";
    } else if (totalHours < 20) {
        feedback = "Almost ready!";
    } else {
        feedback = "Weekly goal reached!";
    }

    // Check the additional condition
    if (sessions > 7 && totalHours < 20) {
        feedback = "Increase your study time!";
    }


    // display 

    document.getElementById("result").innerHTML =
        "Total: " + totalHours + " hours<br>" +
        "Average: " + average + " hours <br>" +
        "Subjects: [" + subjects.join(", ") + "]<br>" +
        "Feedback: " + feedback;

    // Clear inputs for the next session
    document.getElementById("subject").value = "";
    document.getElementById("hours").value = "";



}