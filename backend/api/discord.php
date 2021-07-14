<?php
	if (isset($_GET["t"]))
	{
		if ($_GET["t"] == 1)
		{
			$ret = array(
				'UID' => '1',
				'test' => '1337'
			);

			echo json_encode($ret);
		}
	}
?>