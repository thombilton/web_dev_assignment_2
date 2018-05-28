
function openModal() {
    $("#conf").modal();
}

function validateForm() {

    var pickupDate = document.getElementById("pickupDate").value;
    console.log(pickupDate);
    var pickupTime = document.getElementById("pickupTime").value;
    var userDay = pickupDate.substring(8);
    console.log(userDay);
    var userMon = pickupDate.substring(5, 7);
    console.log(userMon);

    var userYr = pickupDate.substring(0, 4);
    console.log(userYr);

    var userHr = pickupTime.substring(0, 2);
    var userMin = pickupTime.substring(3);

    var myDate = new Date(userYr, userMon - 1, userDay, userHr, userMin);


    var todaytemp = new Date();
    var today = new Date(todaytemp.getFullYear(), todaytemp.getMonth(), todaytemp.getDate(), todaytemp.getHours(), todaytemp.getMinutes(), 0);
    console.log(today);
    console.log(myDate);

    if (myDate > today || myDate == today) {
        post();
        openModal();
        return true;
    }

    else {
        alert("Please ensure your pickup date is not a date that has already been");
        return false;

    }

}


function post() {

    var hr = new XMLHttpRequest();

    var url = "process.php";
    var fname = document.getElementById("fname").value;
    console.log(fname);
    var lname = document.getElementById("lname").value;
    var pnumber = document.getElementById("pnumber").value;
    var unit = document.getElementById("unit").value;
    var streetNo = document.getElementById("streetNo").value;
    var streetName = document.getElementById("streetName").value;
    var suburbPickUp = document.getElementById("suburbPickUp").value;
    var suburbDest = document.getElementById("suburbDest").value;
    var pickupDate = document.getElementById("pickupDate").value;
    var pickupTime = document.getElementById("pickupTime").value;

    var id = fname + lname + (Math.floor(Math.random() * 9999));

    var vars = "id=" + id + "&fname=" + fname + "&lname=" + lname + "&pnumber=" + pnumber + "&unit=" + unit + "&streetNo=" + streetNo + "&streetName=" + streetName + "&suburbPickUp=" + suburbPickUp + "&suburbDest=" + suburbDest + "&pickupDate=" + pickupDate + "&pickupTime=" + pickupTime;


    console.log(vars);
    hr.open("POST", url, true);
    hr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    hr.onreadystatechange = function (ev) {
        if (hr.readyState == 4 && hr.status == 200) {
            var returnData = hr.responseText;
        }
    };

    hr.send(vars);

    var successMessage = "Thank you! Your booking reference number is " + id + ". You will be picked up in front of your provided address at: " + pickupTime + " on " + pickupDate + ".";

    document.getElementById("successMessage").innerText = successMessage;
}

