<?php 
namespace App\Services\Facebook;


use \Facebook;


/**
 * Service class to get data from graph API
 */
class FacebookService {



	private   $facebook;
	private   $facebookApp;


	public function __construct($facebook,$facebookApp){

		$this->facebook =$facebook;
		$this->facebookApp =$facebookApp;
	
	}



	public function getPageData($pageId,$accessToken){



	$queryString =array(
	    			
	    			'fields' => 'id,username,link,
	    						picture,
	    						posts.limit(5){from,story,message,likes,picture}' );

	
	$request = new \Facebook\FacebookRequest($this->facebookApp, $accessToken, 'GET', "/{$pageId}/", $queryString);
	
	// Send the request to Graph
	try {


		$response = $this->facebook->getClient()->sendRequest($request);


	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	 
	 //Graph error
	  throw new Exception( $e->getMessage());
	
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  
	  // When validation fails or other local issues
	  throw new Exception( $e->getMessage());
	}

	
	$facebookData =$response->getDecodedBody();

	return $facebookData;
	
	}










}





















 ?>