let targetStrengthScore = 100
let totalScore = 0

function checkStrength() {
    let password = document.getElementById('password').value
    console.log(password)
    if (password.length < 6) {
        alert("password should be minimum 6 character")
        return
    }

    let size = password.length
    totalScore +=(parseInt)(size / 2) * 10
    
    







}