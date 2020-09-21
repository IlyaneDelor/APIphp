<?php
  include("function.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Request a delivery</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>

		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

		<link rel="stylesheet" type="text/css" href="../css/util.css">

		<link rel="stylesheet" type="text/css" href="../css/main.css">

    <link href="http://localhost/projetA/ProjetA/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/projetA/ProjetA/css/carousel.css" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="http://localhost/projetA/ProjetA/css/index.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<script src="../jquery/jquery-3.2.1.min.js"></script>
</head>
<body>

<header id="header"></header>

<div class="limiter">
		<div class="login">
			<div class="wrap-login p-l-50 p-r-50 p-t-77 p-b-30">
				<div class="login-form validate-form">

					<span class="login-form-title p-b-55">
						Request a delivery
					</span>


					<div class="wrap-input validate-input m-b-16">
						<input class="input" name="title" type="text" id="title" placeholder="Request's title" >
						<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-pencil"></span>
						</span>
					</div>
					<div class="wrap-input validate-input m-b-16">
			<!--			<select class="form-control" value="" onchange="document.getElementById('domainTitle').value = this.options[selectedIndex].value; displayDomainSubtileId('subtileDomainDiv', 'domainTitle')">
		        -->    	<select type="text" class="input" name="service" id="serviceList">

                 			<option value="">Service needed</option>
              		 	<?php
//              			$serviceName = displayServices();
//                 			for ($i=0; $i < count($serviceName) ; $i++) {
//                  				echo "<option value='" . $serviceName[$i][0] . "'>" . $serviceName[$i][0] . "</option>";
//                			}
                		?>
              			</select>
              			<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-magic-wand"></span>
						</span>
            		</div>




					<div class="wrap-input validate-input m-b-16" data-validate = "Address is required">
						<input class="input" type="text" id="address" placeholder="Service's address" name="address">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-home"></span>
						</span>
					</div>

                    <div class="wrap-input validate-input m-b-16" data-validate = "Postal code is required">
                        <input class="input" type="text" id="cityCode" placeholder="Service's postal code" name="postalCode">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
							<span class="lnr lnr-home"></span>
						</span>
                    </div>

                    <div class="wrap-input validate-input m-b-16" data-validate = "City is required">
                        <input class="input" type="text" id="city" placeholder="Service's city" name="address">
                        <span class="focus-input"></span>
                        <span class="symbol-input">
							<span class="lnr lnr-home"></span>
						</span>
                    </div>



					<div class="wrap-input validate-input m-b-16" data-validate = " Date is required">
						<input class="input" name="serviceDate" type="date" id="serviceDate" >
						<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-calendar-full"></span>
						</span>
					</div>

					<div class="wrap-input validate-input m-b-16" data-validate = " Correct hour is required">
             			<input type="time" name="serviceHour" class="input" id="serviceHour" placeholder="Heure de la prestation">
             			<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-history"></span>
						</span>
           			 </div>

					<div class="wrap-input validate-input m-b-16">
						<input class="input" name="duration" type="number" id="duration" placeholder="Service's duration in hours">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-history"></span>
						</span>
					</div>



					<div style="margin-left: 25%" class="wrap-input validate-input m-b-16">
						<textarea  name="detail "placeholder="Description" class="input p-b-50" id="detail" rows="1"></textarea>

<!--                        <input class="input" type="text">-->
						<span class="focus-input"></span>
						<span class="symbol-input">
							<span class="lnr lnr-history"></span>
						</span>
					</div>

						<div class="container-login-form-btn p-t-25">
						<button onclick="validateRequest()" class="login-form-btn">
							Réserver
						</button>
                            <button onclick="test()" class="login-form-btn">
                                Réserver
                            </button>
					</div>

					</div>
				</div>
			</div>
		</div>





<script src="http://localhost/projetA/ProjetA/js/isCo.js">
</script>

	<script type="text/javascript">

        window.onload = function() {


            var option = {
                url: "../../pomocServicesAPI/api/service/getServiceValide.php",
                dataType: "text",
                type: "POST",
                data: {},
                success: function(data, status, xhr){
                    let serviceInfo = JSON.parse(xhr.responseText);
                    let optionElement;
                    for ( let i = 0; i < serviceInfo.length; i++){
                        optionElement = document.createElement("option");
                        optionElement.setAttribute( "value", serviceInfo[i]['id']);
                        optionElement.innerHTML = serviceInfo[i]['jobs'];
                        console.log(serviceInfo[i]['jobs']);
                        $('#serviceList').append(optionElement);
                    }
                    console.log();
                },
                error: function( xhr, status, error ){

                }
            };
            $.ajax(option);
        };

        function test(){
            console.log($('#serviceList').val());
        }

		function validateRequest(){
			let data = {
			    title: $('#title').val(),
                service:  $('#serviceList').val(),
                address: $('#address').val(),
                cityCode: $('#cityCode').val(),
                city: $('#city').val(),
                serviceDate: $('#serviceDate').val(),
                serviceHour: $('#serviceHour').val(),
                duration: $('#duration').val(),
                detail: $('#detail').val()
            };

			let option = {
			    url: "../../pomocServicesAPI/api/intervention/addIntervention.php",
                datatype: 'text',
                type: 'POST',
                data: {data: JSON.stringify(data)},
                success: function (data, status, xhr) {

                },
                error: function (xhr, status, error) {
                    if( status == 402){
                        window.location.replace("http://localhost/projetA/ProjetA/php/index.php")
                    }
                }

            };
			$.ajax(option);
    }
	</script>

</body>
</html>