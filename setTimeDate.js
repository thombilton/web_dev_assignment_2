
currentDate();
currentTime();


function currentDate() {

    var today = new Date();

    var dd = today.getDate();

    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = yyyy + '-' + mm + '-' + dd;

    var dateInput = document.getElementById("pickupDate");
    dateInput.value = today;
}

function currentTime() {

    var today = new Date();
    console.log(today);

    var hh = today.getHours();
    var mm = today.getMinutes();
    console.log(hh);
    console.log(mm);

    if (hh < 10) {
        hh = '0' + hh;
    }

    if (mm < 10) {
        mm = '0' + mm;
    }

    today = hh + ':' + mm;
    console.log(today);

    var timeInput = document.getElementById("pickupTime");
    timeInput.value = today;

}
