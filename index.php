<?php
/**
 * Created by PhpStorm.
 * User: 1033801
 * Date: 12.09.2017
 * Time: 11:21
 */
header('Content-Type: text/html; charset=utf-8');
?>

<html>
<header>
<meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <!-- Custom CSSs -->
    <link rel="stylesheet" href="assets/css/bg.css">
    <link rel="stylesheet" href="assets/css/card.scss">
    <link rel="stylesheet" href="assets/css/flip.css">
    <link rel="stylesheet" href="assets/css/text.css">

	
</header>

<div class="content"></div>
<body scroll="no" style="overflow:hidden">
<div id="card" style="margin-top: -2%;margin-bottom: 1px;">
    <div class="front">
        <div class="paper">
		<img class="poster" src="https://gatewayjuniorstorage.blob.core.windows.net/images/thurgau_db130bb46e0a4d91805eec87b11328dc.jpg"/>

            <h2 style="margin-top: -2%;">. . . .</h2>
            <legend style="font-size= 90%;margin-top: -2%;">Willkommen! Auf dieser Seite können Sie anhand einiger Kriterien Ihre ideale Gemeinde im Kanton Thurgau finden.</legend>

			 
            <div class="form-group">
                <label for="ps" class="col-lg-2 control-label">Stärkste Partei</label>
				

                <select class="form-control" id="ps">
                    <option>Keine Angabe</option>
                    <option>SVP</option>
                    <option>SP</option>
					<option>CVP</option>
					<option>FDP</option>
					<option>EDU</option>
					<option>EVP</option>
					<option>GP</option>
					<option>GLP</option>
					<option>BDP</option>
                </select>
                <br>
            </div>
                <div class="form-group">
                    <label for="age" class="col-lg-2 control-label">Durchschnittsalter</label>

                    <select class="form-control" id="age" name="age">
                        <option>Keine Angabe</option>
                        <option>0</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>30</option>
                        <option>35</option>
                        <option>40</option>
                        <option>45</option>
                        <option>50</option>
                        <option>55</option>
                        <option>60</option>
                        <option>65</option>
                        <option>70</option>
                        <option>75</option>
                        <option>80</option>
                        <option>85</option>
                        <option>90</option>
                    </select>
                    <br>
                </div>
                <div class="form-group">
                    <label for="gs" class="col-lg-2 control-label">Geschlecht</label>
                    <select class="form-control" id=gs>
                        <option>Keine Angabe</option>
                        <option>Männlich</option>
                        <option>Weiblich</option>
                    </select>
                    <br>
                </div>
                <div class="form-group">
                    <label for="sf" class="col-lg-2 control-label">Steuerfuss in %</label>

                    <select class="form-control" id="sf">
                        <option>Keine Angabe</option>
                        <option>0</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                        <option>30</option>
                        <option>35</option>
                        <option>40</option>
                        <option>45</option>
                        <option>50</option>
                        <option>55</option>
                        <option>60</option>
                        <option>65</option>
                        <option>70</option>
                        <option>75</option>
                        <option>80</option>
                        <option>85</option>
                        <option>90</option>
						<option>95</option>
						<option>100</option>
                    </select>
                    <br>
                </div>
            <div class="form-group">
                <div class="form-group">
                    <label for="ewz" class="col-lg-2 control-label">Einwohnerzahl</label>
                    <select class="form-control" id="ewz">
                        <option>Keine Angabe</option>
                        <option>50</option>
                        <option>100</option>
                        <option>250</option>
                        <option>300</option>
                        <option>400</option>
                        <option>500</option>
                        <option>1000</option>
                        <option>1500</option>
                        <option>2000</option>
                        <option>2500</option>
                        <option>3000</option>
                        <option>4000</option>
                        <option>5000</option>
                        <option>7500</option>
                        <option>10000</option>
                        <option>15000</option>
                        <option>20000</option>
                        <option>25000</option>
                    </select>
                    <br>
                    <div class="checkbox">
                        <label><input id="Sa" type="checkbox" value="">Seeanstoss</label>
                    </div>
                </div>
				<a id="go" type="submit" class="btn" >Suchen</a>
          
            </div>
            <p><br></p>
            <div class="space"></div>
        </div>
    </div>
    <div class="back">

        <div class="paper">
            <div class="crop"><img id="tg" class="poster" src="src/test.jpg"/></div>
            <h2>. . . .</h2>
            <a id="gemName" href="">Meine ideale Gemeinde</a>


            <br><br>
            <ul class="list-group">
                <li id="resPs" class="list-group-item"></li>
                <li id="resGs" class="list-group-item"></li>
                <li id="resAge" class="list-group-item"></li>
                <li id="resEinwz" class="list-group-item" id="einw"></li>
                <li id="resSf" class="list-group-item"></li>
                <li id="resSa" class="list-group-item"></li>

            </ul>
            <a id="back" class="btn">Zurück</a>
			<button id="myBtn" class="btn">Auf der Karte</button>
            <p><br></p>
            <div class="space"></div>
        </div>
    </div>
</div>

<div id="myModal" class="modal">
<div class="modal-dialog">


  <div class="modal-content">
    <span class="close"></span>
<iframe
  id="map"
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDBLyNKpZg5QYH6TZKf5rSdp9nQ9X4Oypg
    &q=" allowfullscreen>
</iframe>
	</div>
  </div>
</div>





</body>
<footer></footer>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/jquery.flip.js"></script>
<script>
    $(function ($) {
        $("#card").flip({
            trigger: 'manual'
        });
    });

    $('#back').click(function () {
        $("#card").flip('toggle');
    })

    $('#go').click(function () {
        $("#card").flip('toggle');
    });


    $(document).ready(function(){
        $("#go").click(function(){
            var c=document.getElementById('Sa');
            if(c.checked)
            {
                var sa = 1;
            }
            else
            {
                var sa = 0;
            }
            $.post('DBHandler.php' , 'ps=' + $("#ps").val()+'&age=' + $("#age").val()+'&gs=' + $("#gs").val() + '&Einw=' + $("#ewz").val() + '&sf=' + $("#sf").val() +'&eh=' + $("#eh").val() + '&Sa=' + sa, function(response) {
                //$("#resPs").text(response);
                var array = response.split(',');
                $("#gemName").text("Ihre ideale Gemeinde: "+array[0]);
				var link = document.getElementById("gemName");
				link.setAttribute("href", "https://www.google.ch/maps/place/"+array[0]);


				$("#tg").attr("src","assets/media/"+array[0]+".jpg");
				$("#map").attr("src","https://www.google.com/maps/embed/v1/place?key=AIzaSyDBLyNKpZg5QYH6TZKf5rSdp9nQ9X4Oypg&q="+array[0]+"");
                $("#resPs").text("Parteistärke: "+array[1]);
                $("#resGs").text(array[2]);
                $("#resAge").text(array[3]);
                $("#resEinwz").text("Einwohnerzahl: "+array[4]);
                $("#resSf").text("Steuerfuss: "+array[5]);
                $("#resSa").text(array[6]);
            });
        });
    });
	

var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
</html>
