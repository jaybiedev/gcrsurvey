<?php
	 require_once "includes/survey_server.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon_gcr.ico">
    <link rel="stylesheet" href="css/survey.css">
    <title>GCR Questionnaire</title>
</head>
<body>
	<img class="hd_img" src="images/logo_globe_100px.png" height="auto" alt="logo">
    <span class="head">
	
    Grace Communion Richardson Reaches out to You</span>
	
	<div id="survey">
	
		<form method="post" action="/">
			<?php echo $survey ?>
		</form>
	
	</div>
	<video class="herobox" playsinline autoplay muted loop src="videos/GCR_Hero_2bit.mp4"></video>
</body>
</html>
