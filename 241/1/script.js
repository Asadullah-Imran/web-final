function calculate() {
    let heightCm = parseFloat(document.getElementById("height_cm").value);
    let weightLb = parseFloat(document.getElementById("weight_lb").value);

    if (isNaN(heightCm) || isNaN(weightLb) || heightCm <= 0 || weightLb <= 0) {
        alert("Please enter valid positive values for both height and weight.");
        return;
    }

    // Formula to convert centimetre to metre: metre = centimetre / 100
    let heightM = heightCm / 100;

    // Formula to convert pound to KG: KG = pound / 2.2046
    let weightKg = weightLb / 2.2046;

    // Calculation Result = (Weight in KG) / (Height in metre)^2
    let calcResult = weightKg / (heightM * heightM);

    // Status:
    // > 0 and < 20: "bad"
    // > 20 to 30: "not bad"
    // > 30: "good"
    let status = "";
    if (calcResult > 0 && calcResult < 20) {
        status = "bad";
    } else if (calcResult >= 20 && calcResult <= 30) {
        status = "not bad";
    } else if (calcResult > 30) {
        status = "good";
    }

    document.getElementById("result").innerText = calcResult.toFixed(2);
    document.getElementById("status").innerText = status;
}
