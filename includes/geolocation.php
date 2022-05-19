<?php
    $ip = $_SERVER['REMOTE_ADDR'];
    //si la ip es local 
    if($ip == "::1"){
        $link = 'https://api.ipgeolocation.io/ipgeo?apiKey=eae3ac17b17b41c0bac5061962032512&fields=latitude,longitude,city';
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $link);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $location = curl_exec($ch);
        $location = json_decode($location, true);
        $ip = $location["ip"];
         curl_close($ch);  
    }
    $json = file_get_contents("http://ipinfo.io/$ip/geo");
    $json = json_decode($json, true);
    $city = $json['city'];
    $region = $json['region'];
    $ip = $json["ip"];
    $loc = explode (",",$json["loc"] );
    $lat = floatval($loc[0]);
    $lon = floatval($loc[1]);


    function distancia($latitude1, $longitude1,  $direccion)
      { 
        if($direccion !== ""){
           $direccion = explode (",",$direccion );
           $latitude2 = floatval($direccion[0]);
           $longitude2 = floatval($direccion[1]);

           $lat1 = deg2rad($latitude1);
           $long1 = deg2rad($longitude1);
           $lat2 = deg2rad($latitude2);
           $long2 = deg2rad($longitude2);

           $dlong = $long2 - $long1;
           $dlati = $lat2 - $lat1;
             
           $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
             
           $res = 2 * asin(sqrt($val));
             
           $radius = 6371;
             
           return ($res*$radius);
        }else{
            return 10000;
        }
           
      }
?>

