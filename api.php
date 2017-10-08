		<?php
		header("Content-Type:application/json");

		require "data.php";

		function index(){
			//Only Allow user access on  /api and not /api.php
			if( $_SERVER['REQUEST_URI'] == '/api.php'){
				response(403,"Forbidden",NULL);
			}
			
		}

		 function apicall(){
		 	//Retrieve all json values
			$data = json_decode(file_get_contents('php://input'), true);

			//Check if all values are set, if yes create new score
			if(isset($data['id']) && isset($data['title']) && isset($data['score']))
			{
				//Validate all values
				if(is_numeric ($id=$data['id']) && is_string($data['title'])  && is_float ($data['score'])){
					$id=$data['id'];
					$title = $data['title'];
					$score = $data['score'];
					create_score($id,$title, $score);					
				}else{
					//Invalid values send teapot response code :)
					response(418,"Sorry you have not sent correct data",NULL);
				}
			
			}
			else
			{
				//Search for score by id
				if(isset($data['id']))
				{
					$id=$data['id'];
					get_score($id);
				}
				//Search for score without id
				else
				{
					get_all_scores();					
				}
			}
		}


		function response($status,$status_message,$data)
		{
			header("HTTP/1.1 ".$status_message);
			
			$response['status']=$status;
			$response['status_message']=$status_message;
			$response['data']=$data;
			
			$json_response = json_encode($response);
			echo $json_response;
		}

		index();