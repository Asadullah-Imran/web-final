function calc() {
    let location = document.getElementById("location").value;
    let urbanChecked = document.getElementById("urban").checked;
    let ruralChecked = document.getElementById("rural").checked;
    let unitInput = document.getElementById("unit").value;
    let unit = parseFloat(unitInput);

    // 1. Validation: Ensure location is selected
    if (!location || location.trim() === "") {
        alert("Validation Error: Please select a location.");
        return;
    }

    // 2. Validation: Ensure an area is chosen (can't select both, radio handles mutual exclusion)
    if (!urbanChecked && !ruralChecked) {
        alert("Validation Error: Please select an area type (Urban or Rural).");
        return;
    }

    // 3. Validation: Positive number for units consumed
    if (unitInput.trim() === "" || isNaN(unit) || unit <= 0) {
        alert("Validation Error: Unit Consumed must be a positive number.");
        return;
    }

    // Location rates:
    // Dhaka: 7.5 urban, 6.5 rural
    // Chattogram: 7.0 urban, 6.0 rural
    // Other: 6.5 urban, 5.5 rural
    let isRural = ruralChecked;
    let rate = 0;

    if (location === "Dhaka") {
        rate = isRural ? 6.5 : 7.5;
    } else if (location === "Chattogram") {
        rate = isRural ? 6.0 : 7.0;
    } else {
        rate = isRural ? 5.5 : 6.5;
    }

    let baseBill = unit * rate;

    // Surcharge tiers:
    // Under 500: No surcharge
    // 500 - 1000: 5%
    // Over 1000: 10%
    let surcharge = 0;
    if (baseBill >= 500 && baseBill <= 1000) {
        surcharge = baseBill * 0.05;
    } else if (baseBill > 1000) {
        surcharge = baseBill * 0.10;
    }

    let totalBill = baseBill + surcharge;
    let formattedBill = totalBill.toFixed(2);

    // Display final amount in an alert box rounded to two decimal places
    alert("Total Bill: " + formattedBill + " taka");

    let ansLabel = document.getElementById("ans");
    if (ansLabel) {
        ansLabel.innerText = "Calculated Total: " + formattedBill + " Taka (Base: " + baseBill.toFixed(2) + " + Surcharge: " + surcharge.toFixed(2) + ")";
    }
}