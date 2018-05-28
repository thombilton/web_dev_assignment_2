function showTaxi() {
    var xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            var table = document.getElementById("table");

            console.log(this.responseText.length);
            console.log(this.responseText);

            if (this.responseText.length == 0) {
                document.getElementById("table").innerHTML = "There are no bookings Available";
            }
            else {
                myObj = JSON.parse(this.responseText);


                var table = document.getElementById("table");
                table.innerHTML = "<tr><th>Reference</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Pickup Suburb</th><th>Destination Suburb</th><th>Pickup Date (y-m-d h:m:s)</th></tr>"

                for (i = 0; i < myObj.length; i++) {

                    var row = table.insertRow();

                    for (var index in myObj[i]) {
                        var cell = row.insertCell();
                        cell.innerHTML = myObj[i][index];
                        console.log(myObj[i][index]);
                    }
                }
            }
        }
    };
    xmlhttp.open("GET", "showTaxi.php", true);
    xmlhttp.send();
}

function assignTaxi() {
    var userIn = document.getElementById("id").value;
    console.log(userIn);
    var hr = new XMLHttpRequest();
    var url = "assignTaxi.php";
    var vars = "userIn=" + userIn;

    console.log(vars);
    hr.open("POST", url, true);
    hr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    hr.onreadystatechange = function (ev) {
        if (hr.readyState == 4 && hr.status == 200) {
            var returnData = hr.responseText;
            document.getElementById("conf").innerHTML = returnData;
        }
    };

    hr.send(vars);

}

