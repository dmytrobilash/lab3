var ajax = new XMLHttpRequest();

function ok1() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {
                console.dir(ajax.responseText);
                document.getElementById("result").innerHTML = ajax.response;
            }
        }
    }
    var group = document.getElementById("groups").value;
    ajax.open("get", "firstDB.php?groups=" + group);
    ajax.send();
}

function ok2() {
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4) {
            if (ajax.status === 200) {

                console.dir(ajax);
                let rows = ajax.responseXML.firstChild.children;
                let result = "";
                for (var i = 0; i < rows.length; i++) {
                    result += "<tr>";
                    result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[4].firstChild.nodeValue + "</td>";
                    result += "<td>" + rows[i].children[5].firstChild.nodeValue + "</td>";
                    result += "</tr>";
                }
                document.getElementById("result").innerHTML = result;
            }
        }
    }
    var teacher = document.getElementById("teachers").value;
    ajax.open("get", "secondDB.php?teachers=" + teacher);
    ajax.send();
}

function loadData() {
    let rows = JSON.parse(ajax.responseText);
    console.dir(rows);
    if (ajax.readyState === 4) {
        if (ajax.status === 200) {
            console.dir(ajax);
            
            let result = "";
            for (var i = 0; i < rows.length; i++) {
                result += "<tr>";
                result += "<td>" + rows[i].auditorium + "</td>";
                result += "<td>" + rows[i].week_day + "</td>";
                result += "<td>" + rows[i].lesson_number + "</td>";
                result += "<td>" + rows[i].ID_Lesson + "</td>";
                result += "<td>" + rows[i].disciple + "</td>";
                result += "<td>" + rows[i].type + "</td>";
                result += "</tr>";
            }
            document.getElementById("result").innerHTML = result;
        }
    }
}

function ok3() {
    ajax.onreadystatechange = loadData;
    var auditorium = document.getElementById("auditorium").value;
    ajax.open("get", "thirdDB.php?auditorium=" + auditorium);
    ajax.send();
}