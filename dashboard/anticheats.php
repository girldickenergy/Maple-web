<?php
	require_once "../backend/Database/databaseHandler.php";
	require_once "../backend/Sessions/sessionHandler.php";
	$currentSession = getSession($dbConn);
	if ($currentSession == null)
	{
		header("Location: ../auth/login");
		die();
	}
	
	global $dbConn;
	$user = getUserById($dbConn, $currentSession["UserID"]);
	if ($user == null)
    {
        header("Location: https://maple.software");
        die();
    }

	if (($user["Permissions"] & perm_activated) == 0)
	{
		header("Location: ../auth/pendingActivation");
		die();
	}

    if ($user["Permissions"] & perm_banned)
    {
        header("Location: banned");
        die();
    }

    $anticheats = getAllAntiCheats($dbConn);
    $nanotime = exec('date +%s%N');
	$ticks = number_format((time() * 10000000) + 621355968000000000, 0, '.', '');

    function getDateDiff($time1, $time2)
    {
        if(!is_int($time1))
            $time1 = strtotime($time1);

        if(!is_int($time2))
            $time2 = strtotime($time2);

        $past = true;

        if($time1 > $time2)
        {
            list($time1, $time2) = array($time2, $time1);
            $past = false;
        }

        $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
        $diffs = array();

        foreach($intervals as $interval)
        {
            $ttime = strtotime('+1 '.$interval, $time1);

            $add = 1;
            $looped = 0;

            while ($time2 >= $ttime)
            {
                $add++;
                $ttime = strtotime("+".$add." ".$interval, $time1);
                $looped++;
            }

            $time1 = strtotime("+".$looped." ".$interval, $time1);
            $diffs[$interval] = $looped;
        }

        $count = 0;
        $times = array();
        foreach($diffs as $interval => $value) 
        {
            if($count >= 1)
                break;

            if($value > 0)
            {
                if($value != 1)
                    $interval .= "s";

                $times[] = $value." ".$interval;
                $count++;
            }
        }

        if($past == true)
            $suffix = ' ago';
        else
            $suffix = ' from now';

        return implode(", ", $times).$suffix;
    }
?>
<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/style.css?v=1">
		<link rel="stylesheet" href="../assets/css/dashboard.css?v=1.1">
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
		<script src="../assets/js/bs-init.js"></script>
		<script src="https://kit.fontawesome.com/d1269851a5.js" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		
		<link rel="icon" href="../assets/favicon.png">
		<title>Anticheats - Maple</title>
	</head>

	<style type="text/css">
		.anticheatsTable {
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 30px;
		width: 75%;
		border: 1px solid #262626;
		color: #CCCCCC;
		}

		.anticheatsTable th {
			color: #E85D9B !important;
		}

		.anticheatsTable th, td {
			text-align: center;
			padding: 16px;
		}

		.anticheatsTable th:first-child, td:first-child {
			text-align: left;
		}

		.anticheatsTable tr:nth-child(even) {
			background-color: #262626
		}

		.anticheatsTable tr:nth-child(odd) {
			background-color: #333333
		}

		.statusUndetectedEven {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #00CC00;
			color: #262626;
		}

		.statusUndetectedOdd {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #00CC00;
			color: #333333;
		}

		.statusUnknownEven {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #808080;
			color: #262626;
		}

		.statusUnknownOdd {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #808080;
			color: #333333;
		}

		.statusDetectedEven {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #CC0000;
			color: #262626;
		}

		.statusDetectedOdd {
			border-radius: 5px;
			padding: 5px 5px 5px 5px;
			background-color: #CC0000;
			color: #333333;
		}
	</style>

	<body>
		<nav class="navbar navbar-dark navbar-expand-lg fixed-top">
			<a class="navbar-brand" href="https://maple.software/">
				<img src="../assets/favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Maple
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link" href="../dashboard"><i class="fas fa-user"></i> Profile</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="store"><i class="fas fa-shopping-cart"></i> Store</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="settings"><i class="fas fa-tools"></i> Settings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"><i class="fas fa-shield-alt"></i> Anticheats</a>
					</li>
                    <?php
                        if ($user["Permissions"] & perm_admin)
                            echo '<li class="nav-item"><a class="nav-link" href="adminPanel"><i class="fas fa-tools"></i> Admin Panel</a></li>';
                    ?>
				</ul>
				<span>
					<button type="button" onclick="location.href='../auth/logout';" class="btn btn-outline-primary">Log out</button>
				</span>
			</div>
		</nav>

		<div id="content" class="d-flex flex-column justify-content-center align-items-center" data-aos="zoom-in-down" data-aos-offset="200" data-aos-duration="1000" data-aos-once="true">
			<div class="content-header mx-auto text-center">
				<h2>Anticheats</h2>
				<p>Monitoring anticheat updates 24/7/365</p>
				<p>Last check: <?= getDateDiff($anticheats[0][9], gmdate("Y-m-d H:i:s",time())) ?></p>
			</div>
			<table class="anticheatsTable" data-aos="fade-up" data-aos-duration="1000" data-aos-once="true">
				<tr>
					<th>Game</th>
					<th>Anticheat</th>
					<th>Internal version</th>
					<th style="width: 20%;">Updated at</th>
					<th style="width: 25%;">File hash</th>
					<th>Status</th>
				</tr>
				<?php
					for ($i = 0; $i < count($anticheats); $i++) 
					{
						echo '<tr>';
					    echo '<td><a href="'.$anticheats[$i][7].'"'.'>'.$anticheats[$i][2].'</a></td>';
					    echo '<td>'.$anticheats[$i][1].'</td>';
					    echo '<td>'.$anticheats[$i][3].'</td>';
					    echo '<td>'.getDateDiff($anticheats[$i][4], gmdate("Y-m-d H:i:s",time())).'</td>';
					    echo '<td><a href="'.$anticheats[$i][8].'">'.$anticheats[$i][5].'</a></td>';
					    if ($anticheats[$i][6] == 0)
					    {
					    	if ($i % 2 == 0)
					    		echo '<td><span class="statusUndetectedEven">Undetected</span></td>';
					    	else
					    		echo '<td><span class="statusUndetectedOdd">Undetected</span></td>';
					    }
					    else if ($anticheats[$i][6] == 2)
					    {
					    	if ($i % 2 == 0)
					    		echo '<td><span class="statusDetectedEven">Detected</span></td>';
					    	else
					    		echo '<td><span class="statusDetectedOdd">Detected</span></td>';
					    }
					    else
					    {
					    	if ($i % 2 == 0)
					    		echo '<td><span class="statusUnknownEven">Unknown</span></td>';
					    	else
					    		echo '<td><span class="statusUnknownOdd">Unknown</span></td>';
					    }
					    echo '</tr>';
					}
				?>
			</table>
		</div>

		<footer class="footer mt-auto">
			<div class="footer-container container d-flex justify-content-between">
				<p class="my-auto">Copyright © 2021 maple.software. All rights reserved.</p>
				<ul class="nav flex-column flex-sm-row">
					<li class="nav-item">
						<a class="nav-link" href="../help/contact-us">Contact Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../help/terms-of-service">Terms of Service</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../help/privacy-policy">Privacy Policy</a>
					</li>
				</ul>
			</div>
		</footer>
		<script>
		  AOS.init();
		</script>
	</body>
</html>