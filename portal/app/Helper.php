<?php

function getImageFile($filename)
	{
		return response()->download(base_path('users_bills\\' . $filename), null, [], null);
	}


?>