function calc(){
    let location = document.getElementById("location").value;
    let ruralArea = document.getElementById("r").checked; // returns true if rural is clicked
    let urbanArea = document.getElementById("u").checked; // returns true if urban is clicked
   
    let bill = Number(document.getElementById("bill").value);

    let ans=0;
    if(location == 'dhk'){
        if(ruralArea == true){
            ans = bill*6.5;
        }
        else{
            // urban er calculation
            ans = bill*7.5;
        }
    }
    else{
        //ctg er calculation
        if(ruralArea == true){
            ans = bill*6;
        }
        else{
            // urban er calculation
            ans = bill*7;
        }
    }

    document.getElementById("ans").innerText = ans;

    
}