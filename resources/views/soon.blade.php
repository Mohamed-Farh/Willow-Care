<!DOCTYPE HTML>
<HTML>
<style>
	/* body {
		background-image: url('images/clinic.jpg');
		background-position: center;
		height: 100vh;
		background-size: 100% 96%;
	} */
    html {
        background: url('images/clinic.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        }


    .Tech {
        top: 38%;
        left: 47%;
        position: absolute;
        transform: translate(-50%, -50%);
        color: rgb(0 0 0);
        text-align: center;
        font-size: 20px;
        font-weight: 900 !important;

    }

	#Release {
		color: rgb(0 0 0);
		font-size: 40px;
		word-spacing: 10px;
	}
</style>

<head>
	<link href="style.css"
		rel="stylesheet"
		type="text/css">
</head>

<BODY>
	<header>
		<div class="Tech">
			<h2>COMING SOON</h2>

			<p id="Release"></p>

		</div>
	</header>

	<script>
		// Set the date of launching
		var RemainingTime = new Date("Jan 01, 2022 00:00:00");

		var RemainingTime = RemainingTime.getTime();

		// Update the count down every second
		var x = setInterval(function() {

			// Get current date and time
			var now = new Date().getTime();
			var distance = RemainingTime - now;

			// Days, hours, minutes and seconds time calculations
			var days_remaining =
				Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours_remaining =
				Math.floor(days_remaining / (1000 * 60 * 60));
			var x1 = distance % (1000 * 60 * 60);
			var minutes = Math.floor(x1 / (1000 * 60));
			var x2 = distance % (1000 * 60);
			var seconds = Math.floor(x2 / 1000);

			// Display the results
			document.getElementById("Release").innerHTML =
				days_remaining +
				" : " + hours_remaining + " : " + minutes +
				" : " + seconds;

			// Text after count down is over
			if (distance < 0) {
				clearinterval(x);
				document.getElementById("Release").
				innerHTML = "Welcome";
			}

		}, 1000);
	</script>
</BODY>

</HTML>
