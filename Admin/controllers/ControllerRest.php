<?php

 
class ControllerRest
{
 
    private $db;
    private $pdo;
    function __construct() 
    {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }
 
    function __destruct() { }
 
    public function getRestaurantsResult() 
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tbl_restaurants_restaurants WHERE is_deleted = 0');

        $stmt->execute();
        return $stmt;
    }

    public function getCategoriesResult() 
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tbl_restaurants_categories WHERE is_deleted = 0');
        $stmt->execute();
        return $stmt;
    }

    public function getPhotosResult() 
    {
        $stmt = $this->pdo->prepare('SELECT * 
                                        FROM tbl_restaurants_photos 
                                        INNER JOIN tbl_restaurants_restaurants 
                                        ON tbl_restaurants_photos.restaurant_id = tbl_restaurants_restaurants.restaurant_id 
                                        WHERE tbl_restaurants_restaurants.is_deleted = 0 AND tbl_restaurants_photos.is_deleted = 0');
        $stmt->execute();
        return $stmt;
    }

    public function getRestaurantsNearbyResultsAtCount($lat, $lon, $max) {
        $stmt = $this->pdo->prepare('SELECT 
                                        *,    
                                        COALESCE(( 6371 * acos( cos( radians(:lat_params) ) *  cos( radians( tbl_restaurants_restaurants.lat ) ) * 
                                        cos( radians( tbl_restaurants_restaurants.lon ) - radians(:lon_params) ) + sin( radians(:lat_params1) ) * 
                                        sin( radians( tbl_restaurants_restaurants.lat ) ) ) ), 0) AS distance 
                                            
                                    FROM tbl_restaurants_restaurants 
                                    WHERE tbl_restaurants_restaurants.is_deleted = 0 
                                    ORDER BY distance ASC
                                    LIMIT 0, :max');

        $stmt->execute( array('lat_params' => $lat, 'lon_params' => $lon, 'lat_params1' => $lat, 'max' => $max ));
        return $stmt;
    }

    public function getRestaurantsNearbyResults($lat, $lon, $radius) {
        $stmt = $this->pdo->prepare('SELECT 
                                        *,    
                                        COALESCE(( 6371 * acos( cos( radians(:lat_params) ) *  cos( radians( tbl_restaurants_restaurants.lat ) ) * 
                                        cos( radians( tbl_restaurants_restaurants.lon ) - radians(:lon_params) ) + sin( radians(:lat_params1) ) * 
                                        sin( radians( tbl_restaurants_restaurants.lat ) ) ) ), 0) AS distance 
                                            
                                    FROM tbl_restaurants_restaurants 
                                    WHERE tbl_restaurants_restaurants.is_deleted = 0 
                                    HAVING distance <= :radius 
                                    ORDER BY distance ASC');

        $stmt->execute( array('lat_params' => $lat, 'lon_params' => $lon, 'lat_params1' => $lat, 'radius' => $radius ));
        return $stmt;
    }

    public function getMaxDistanceFound($lat, $lon) 
    {
        $stmt = $this->pdo->prepare('SELECT COALESCE(( 6371 * acos( cos( radians(:lat_params) ) *  cos( radians( tbl_restaurants_restaurants.lat ) ) * 
                                            cos( radians( tbl_restaurants_restaurants.lon ) - radians(:lon_params) ) + sin( radians(:lat_params1) ) * 
                                            sin( radians( tbl_restaurants_restaurants.lat ) ) ) ), 0) AS distance 
                                            
                                    FROM tbl_restaurants_restaurants 
                                    ORDER BY distance DESC
                                    LIMIT 0, 1');

        $stmt->execute( array('lat_params' => $lat, 'lon_params' => $lon, 'lat_params1' => $lat) );
        foreach ($stmt as $row) {
            return $row['distance'];
        }
        return 0;
    }

    public function getMaxDistanceFoundDefault($lat, $lon, $default_to_find_distance) 
    {
        $stmt = $this->pdo->prepare('SELECT COALESCE(( 6371 * acos( cos( radians(:lat_params) ) *  cos( radians( tbl_restaurants_restaurants.lat ) ) * 
                                            cos( radians( tbl_restaurants_restaurants.lon ) - radians(:lon_params) ) + sin( radians(:lat_params1) ) * 
                                            sin( radians( tbl_restaurants_restaurants.lat ) ) ) ), 0) AS distance 
                                            
                                    FROM tbl_restaurants_restaurants 
                                    ORDER BY distance DESC
                                    LIMIT 0, :default_to_find_distance');

        $stmt->execute( array('lat_params' => $lat, 'lon_params' => $lon, 'lat_params1' => $lat, 'default_to_find_distance' => $default_to_find_distance) );
        foreach ($stmt as $row) {
            return $row['distance'];
        }
        return 0;
    }

    public function getPhotosByRestaurantIdResult($restaurant_id) 
    {
        $stmt = $this->pdo->prepare('SELECT * 
                                        FROM tbl_restaurants_photos 
                                        WHERE tbl_restaurants_photos.restaurant_id = :restaurant_id AND tbl_restaurants_photos.is_deleted = 0');
        
        $stmt->execute( array('restaurant_id' => $restaurant_id) );
        return $stmt;
    }

}
 
?>