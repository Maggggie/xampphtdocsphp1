<?php
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset="utf8_decode"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Serwis Design</title>
<link rel="stylesheet" href="style.css" type="text/css"/>

</head>

<body>

<div id="container">

	<div id="logo">
		<img src="eikopeiko3.png"/>
	</div>
		
	<div id="topbarmenu">
		<div class="option">Home</div>
		<div class="option">Your adds</div>
		<div class="option">Your likes</div>
		<div class="option">Task To Do</div>
		<div class="option">About me</div>
		<div style="clear:both"></div>
	</div>

	<div id="bigtitle">TASK TO DO</div>

	<div id="tasks">
		<ol>
			<li>
				<select id="choose">
				<option value="work">work</option>
				<option value="home">home</option>
				<option value="priv">priv</option>
				</select>

				<input class="box" type="text" name="task1"/>

				<input type="radio" name="a">done</input>
				<input type="radio" name="a">not done</input>
				<input type="radio" name="a">last</input>
				</li>
	
			<li>
				<select id="choose">
				<option value="work">work</option>
				<option value="home">home</option>
				<option value="priv">priv</option>
				</select>

				<input class="box" type="text" name="task2"/>

				<input type="radio" name="b">done</input>
				<input type="radio" name="b">not done</input>
				<input type="radio" name="b">last</input>
				</li>

			<li>
				<select id="choose">
					<option value="work">work</option>
					<option value="home">home</option>
					<option value="priv">priv</option>
				</select>

				<input class="box" type="text" name="task3"/>

				<input type="radio" name="c">done</input>
				<input type="radio" name="c">not done</input>
				<input type="radio" name="c">last</input>
				</li>

			<li>
				<select id="choose">
					<option value="work">work</option>
					<option value="home">home</option>
					<option value="priv">priv</option>
				</select>

				<input class="box" type="text" name="task4"/>

				<input type="radio" name="d">done</input>
				<input type="radio" name="d">not done</input>
				<input type="radio" name="d">last</input>
				</li>
		</ol>
	</div>

<button>Add new task</button>

<scrip scr="app.js">
</script>

<div class="footer">MaggggiaH</div>

</body>
</html>