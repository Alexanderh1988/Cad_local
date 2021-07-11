
function mostrar() {

    //        alert("doacciona");

    var x = document.getElementsByClassName("eliminar");
    var i;
    for (i = 0; i < x.length; i++) {

        if (x[i].style.display === "none") {
            //alert("none");
            x[i].style.display = "block";
            // document.getElementsByClassName("eliminar").style.display = "none";

        } else {
            //else if (x[i].style.display === "hidden") {
            // alert("hidden");
            x[i].style.display = "none";
            // document.getElementsByClassName("eliminar").style.display = "hidden";
        }
    }

}

function editar() {

    var y = document.getElementsByClassName("editar");
    var i;
    for (i = 0; i < y.length; i++) {

        if (y[i].style.display === "none") {
            y[i].style.display = "block";
        } else {
            y[i].style.display = "none";

        }
    }
}

//para cambio de formato:
$(function () {
    $(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
});

function callme() {

    $(window).load(function () {
        if (window.location.href.indexOf('reload') == -1) {


            window.location.replace(window.location.href + '?reload');
        }
    });
    location.reload();
}

function getLastPartNumber(){

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("medicionHum").innerHTML = this.responseText;
        }
    };
//    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.open("GET","TablasInfo.php?hum=true",true);
    xmlhttp.send();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("medicionRuido").innerHTML = this.responseText;
        }
    };
//    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.open("GET","TablasInfo.php?ruid=true",true);
    xmlhttp.send();

}




