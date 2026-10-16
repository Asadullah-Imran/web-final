
let heartRates = []
let sp02s = []
function calculate() {
    let heartRate = parseFloat(document.getElementById('heart_rate').value)
    let spO2 = parseFloat(document.getElementById('oxy_sat').value)


    let riskScore = ((100 - spO2) * 2) + (Math.abs(heartRate - 80) * 0.5)

    heartRates.push(heartRate)
    sp02s.push(spO2)

    let sumHR = 0

    let sumSpO2 = 0

    for (hRate of heartRates) {
        sumHR += hRate
    }
    let avgHR = Math.round((sumHR / heartRates.length),2)

    for (sp of sp02s) {
        sumSpO2 += sp
    }

    let avgSp = (sumSpO2 / sp02s.length).toFixed(2)

    let feedback
    if (riskScore <= 10) {
        feedback = "SAFE"
    } else if (riskScore > 10 && riskScore <= 20) {
        feedback = "WARNING"

    } else if (riskScore > 20) {
        feedback = "Danger"
    }

    document.getElementById('report').innerHTML = "Average Heart Rate: "
        + avgHR + "<br>Average Oxygen Saturation: " + avgSp + "<br>Risk Score: " + riskScore
        + "<br>Feedback: " + feedback

}