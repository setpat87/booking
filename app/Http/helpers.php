<?php

function printArray($data) 
{
	echo "<pre>";
		print_r($data);
	echo "</pre>";
}
 
function apiError($message = 'unknown error', $responseCode = 400)
{
    $data = array(
        'message' => $message
    );

    return response($data, $responseCode);
}

function apiErrorCode($data = [], $responseCode = 400)
{
    return response($data, $responseCode);
}

function apiSuccess($data = array())
{
	return $data;
}