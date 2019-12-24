<?php
	class Recipe{
		public $file_name;
		public $basename;
		public $file_thumbname;
		public function __construct($_name){
			$this->file_thumbname = $_name;
			$this->baseName = substr($_name,0,-10);
			$this->file_name = substr($_name,0,-10).".jpg";
		}	
	}
	
	
		
	
    function foundThumb($var){
	    return (false !==strstr($var,"_thumb.jpg"));
    }
    
    $files = array();
	$thumbs = array();
	$recipes = array();

	$thumb_path = "./thumbs";
		
	if ($handle = opendir($thumb_path)) {
		//$entry = readdir($handle);
		$files = scandir($thumb_path);
		closedir($handle);
		$thumbs = array_filter($files, "foundThumb");

	}

    $current_path = "./recipeFiles/";

	foreach($thumbs as $r){
		$obj = new Recipe($r);
		$path0 = $current_path.$obj->file_name;

		if(file_exists($path0)){
// 		  print($path0."<br/>");
          array_push($recipes, $obj);
		} // else {print("Nope: ".$path0."<br/>");}
	}

    
	echo "<p>Number of recipes: ".sizeof($thumbs)."</p>";
	
	if (sizeof($thumbs)>0){
		foreach($recipes as $_displayrecipe){
             
            echo "\n";
            echo "<p class=\"recipe\">";
            // link to big image file, link to thumbnail
            echo "<a href=\"{$current_path}/{$_displayrecipe->file_name}\"><img src=\"{$thumb_path}/{$_displayrecipe->file_thumbname}\" height=\"200px\" style=\"border:solid 1px black\">";
            // name
			echo "<br>{$_displayrecipe->baseName}</a></p>";
			echo "\n";
		}
	}
	else
	{
		echo "<p>Recipes not found</p>\n";
	}
		
		?>