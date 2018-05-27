function showTaxi() {
    var xmlhttp = new XMLHttpRequest()

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
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
    }

    hr.send(vars);

}

