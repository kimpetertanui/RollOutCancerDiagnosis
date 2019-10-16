<?php

 	require_once '../header_rest.php';
 	$controllerRest = new ControllerRest();

  	$api_key = "";
    if(!empty($_GET['api_key']))
        $api_key = $_GET['api_key'];

    $lat = 0;
    if(!empty($_GET['lat']))
        $lat = str_replace(",", ".", $_GET['lat']);

    $lon = 0;
    if(!empty($_GET['lon']))
        $lon = str_replace(",", ".", $_GET['lon']);

    $radius = 0;
    if(!empty($_GET['radius']))
        $radius = $_GET['radius'];

    $get_categories = 0;
    if(!empty($_GET['get_categories']))
        $get_categories = $_GET['get_categories'];

    $default_to_find_distance = 10;
    if(!empty($_GET['default_to_find_distance']))
        $default_to_find_distance = $_GET['default_to_find_distance'];

    if(Constants::API_KEY != $api_key) {
        $arrayJSON = array('status' => array('status_code' => '3', 'status_text' => 'Invalid Access.') );
        echo json_encode($arrayJSON);
        return;
    }

    $arrayJSON = array('status' => array('status_code' => '-1', 'status_text' => 'Success') );
    if($lat != 0 && $lon != 0 && $radius > 0) {
        $results = $controllerRest->getRestaurantsNearbyResults($lat, $lon, $radius);
        $arrayJSON['restaurants'] = getArrayRestaurants($results);
    }
    if($lat != 0 && $lon != 0 && $radius == 0 && $default_to_find_distance > 0) {
        $results = $controllerRest->getRestaurantsNearbyResultsAtCount($lat, $lon, $default_to_find_distance);
        $arrayJSON['restaurants'] = getArrayRestaurants($results);
    }

  
    $max_distance = $controllerRest->getMaxDistanceFound($lat, $lon);
    $default_distance = $controllerRest->getMaxDistanceFoundDefault($lat, $lon, $default_to_find_distance);

    $arrayJSON['max_distance'] = $max_distance;
    $arrayJSON['default_distance'] = $default_distance;

    if($get_categories == 1) {
        $results = $controllerRest->getCategoriesResult();
        $arrayJSON['categories'] = getArray($results);
    }

    echo json_encode($arrayJSON);

    function getArray($results) {
        $ind = 0;
        $arrayObjs = array();
        foreach ($results as $row) {
            $arrayObj = array();
            foreach ($row as $columnName => $field) {
                if(!is_numeric($columnName)) {
                    $arrayObj[$columnName] = $field;
                }
            }
            $arrayObjs[$ind] = $arrayObj;
            $ind += 1;
        }
        return $arrayObjs;
    }

    function getArrayRestaurants($results) {
    	$controllerRest = new ControllerRest();
        $ind = 0;
        $arrayObjs = array();
        foreach ($results as $row) {
            $arrayObj = array();
            foreach ($row as $columnName => $field) {
                if(!is_numeric($columnName)) {
                    $arrayObj[$columnName] = $field;
                }
            }

            if(!empty($arrayObj['restaurant_id'])) {
                $resultPhotos = $controllerRest->getPhotosByRestaurantIdResult($arrayObj['restaurant_id']);
                $arrayObj['photos'] = getArray($resultPhotos);
            }

            $arrayObjs[$ind] = $arrayObj;
            $ind += 1;
        }
        return $arrayObjs;
    }

?>