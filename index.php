<?php
//require_once('formatJson.php');
header('Content-type: application/json');
function getNameFormat($input_line)
	{       
		preg_match("/<(.*)><(.*)><(.*)>/", $input_line, $output_array);
                $name =[
			"first"=>$output_array[1],
			"middle"=>$output_array[2],
			"last"=>$output_array[3]
                         ];
                return $name;
 
	}

function getLocationFormat($input_line)
	{
		preg_match("/<(.*)><<(.*)><(.*)>>/", $input_line, $output_array);
                $location =[
			      "name"=> $output_array[1],
			      "coords" =>["long"=>$output_array[2] ?? '',
					   "lat"=>$output_array[3] ?? ''
					]
				];
               return $location;
	}


 $input_lines='profile|73241232|<Aamir><Hussain><Khan>|<Mumbai><<72.872075><19.075606>>|73241232.jpg**followers|54543342|<Anil><><Kapoor>|<Delhi><<23.23><12.07>>|54543342.jpg@@|12311334|<Amit><><Bansal>|<Bangalore><<><>>|12311334.jpg';

    
        $resultArray=[];
        preg_match_all("/profile(.*)followers/", $input_lines, $profiles);
        $resultCount = count($profiles);
        $lastString =substr($profiles[1][0], -2);
        
        //get Profile

        if($lastString=='**')
        {
            $result = explode("|", $profiles[1][0]);
            $resultArray= [
                "id"=> $result[1],
                "name"=> getNameFormat($result[2]),
                "location"=>getLocationFormat($result[3]),
                "imageId"=> substr($result[4], 0, -2)
            ];
        }
       
        // get followers
        preg_match("/followers(.*)/", $input_lines, $followers);
        preg_match("/(.*)@@(.*)/", $followers[1], $output_array);
        $resultCount = count($output_array);
        $followerArray = [];
        for($i=1; $i<$resultCount; $i++)
       {
                    $result = explode("|", $output_array[$i]);
                $insert= [
                "id"=> $result[1],
                "name"=> getNameFormat($result[2]),
                "location"=>getLocationFormat($result[3]),
                "imageId"=> $result[4]
            ];
         array_push($followerArray,$insert);
       }
       $resultArray =["profiles"=>$resultArray,"followers"=>$followerArray];
       $json=json_encode($resultArray);
       echo ($json);
       return $json;
        
