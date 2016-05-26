<?php 
    header("Access-Control-Allow-Origin: *");


	if (!empty($_GET['Symbol'])) {
	    $symbol=$_GET['Symbol'];

	    $requestURL = "http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=".$symbol;   //current stock

	    $jsonResult = file_get_contents($requestURL);

	    $accountKey = '0FNB0pjPVwwmOiRmhyms9NVcimU9itFknt/ZzSsOuLU';

	    $context = stream_context_create(array(
	    'http' => array(
	                    'request_fulluri' => true,
	                    'header'  => "Authorization: Basic " . base64_encode($accountKey . ":" . $accountKey)
	              )
	    ));

	    $requestURL2 = 'https://api.datamarket.azure.com/Bing/Search/v1/News?Query=%27'.$symbol.'%27&$format=json'; //news feed
	                    
	    $jsonResult2 = file_get_contents($requestURL2,0, $context);		

	    $arr = array ('market'=>json_decode($jsonResult),'newsfeed'=>json_decode($jsonResult2));
		echo json_encode($arr);
	}







	else if (!empty($_GET['input'])) {
		$input = $_GET['input'];

    	$requestURL2 = "http://dev.markitondemand.com/api/v2/Lookup/json?input=".$input;    // autocomplete


		$jsonResult2 = file_get_contents($requestURL2);

		echo $jsonResult2;
	}


	else {

    	$requestURL3 = 'http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters='.urlencode(($_GET['para']));

    	// echo $requestURL3;

		$jsonResult3 = file_get_contents($requestURL3);

		echo $jsonResult3;		
	}





    			   









?>  