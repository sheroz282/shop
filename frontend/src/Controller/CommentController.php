<?php
include_once __DIR__ . "/../../../common/src/Model/Comments.php";
include_once __DIR__ . "/../../../common/src/Service/UserService.php";

class CommentController 
{
    public function index()
    {
		header("Content-Type: application/json");
	
		$productId = (int)$_GET['product_id'];
        $all = (new Comments())->getByProductId($productId);
		
		print json_encode($all);
		die();
	}
	
	public function create()
    {
		header("Content-Type: application/json");
		
		try{	
			
			$data = $_POST;
		
			(new Comments(
				null,
				(int)$data['product_id'],
				htmlspecialchars($data['username']),
				htmlspecialchars($data['email']),
				htmlspecialchars($data['avatar']),
				htmlspecialchars($data['text'])
			))->save();
			
			print json_encode([
				'result' => 'ok'
			]);

		} catch(Exception $e){
				throw new Exception(json_encode(
				['result' => 'Error', 'message' => $e->getMessage()]), 400);
			}
			
			die();
	}
}
?>