<?php
require 'vendor/autoload.php';

define("MONGO", "mongodb://127.0.0.1:27017/lab_assessment");

function create_score($id, $title, $score)
{

	$date = new DateTime();
	// Connect to Mongo
	$client = new MongoDB\Client(MONGO);
	// Select Collection
	$collection = $client->demo->scores;
	//Insert new Document
	$result = $collection->insertOne( [ 'id' => $id, 'title' => $title, 'score' => $score ,'timestamp' => $date->format('Y-m-d H:i:s') ] );
	response(200,"New Score Created",$result->getInsertedId());
}

function get_all_scores(){
	// Connect to Mongo
	$client = new MongoDB\Client(MONGO);
	// Select Collection
	$collection = $client->demo->scores;
	$data = array();
	//Find All Documents
	$cursor = $collection->find();
	foreach ($cursor as $doc) {
    	$data[] = ($doc);
	}
	response(200,"Score was not Found",$data);	
}

function get_score($id)
{
	$client = new MongoDB\Client(MONGO);
	// Select Collection
	$collection = $client->demo->scores;
	//Find specific Documnet
	$score = $collection->findOne(array('id' => $id));
	response(200,"Score Found",$score);
}

