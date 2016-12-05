<?php 

namespace App\Services\Aws;
use Aws\S3\S3Client;

class AmazonService{


	private $s3Client;
	public function __construct(){

		$s3 = S3Client::factory([
        		'key'    => getenv('AWS_ACCESS_KEY_ID'),
        		'secret' => getenv('AWS_SECRET_ACCESS_KEY'),
        		'region'=>"ap-southeast-2",
        		'version'=>'latest'
    	]);

		$this->s3Client =$s3;
	}

	



	/**
	 * [getAWS description]
	 * @return [type] [description]
	 */
	public function uploadObject($objectKey,$tempLocation){

		try {
      
      	$handle = fopen($tempLocation, 'rb');
      	$this->s3Client->putObject([

        'Bucket'=>getenv('AWS_BUCKET'),
        'Key'=>$objectKey,
        'Body'=>$handle,
        'ACL'=>'public-read'
        ]);

      fclose($handle);
      
      
      unlink($tempLocation);

    } catch (S3Exception $e) {
      
     echo $e->getMessage();
     die();
		
	}

}
	public function DeleteObject($objectKey){


		//delete image
       $this->s3Client->deleteObject(array(
    	'Bucket' => getenv('AWS_BUCKET'),
    	'Key'    => $objectKey,
	));

}

}