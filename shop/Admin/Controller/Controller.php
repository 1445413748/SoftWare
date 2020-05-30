<?php 


	class Controller{

		public function __construct()
		{

			if( empty($_SESSION['admin']['id']) ){
				header('location: index.php?c=login'); die;
			}


		}
		
	}






