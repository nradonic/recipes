<?php
	class Recipe{
		public $file_name_jpg = "";
		public $basename = "";
		public $file_thumbname = "";
		public $file_name_pdf = "";
		public $recipe_name = "";
		public function __construct($_name){
			$this->file_thumbname = $_name;
			$this->baseName = substr($_name,0,-10);
			$this->file_name_jpg = $this->baseName.".jpg";
			$this->file_name_pdf = $this->baseName.".pdf";

		}	
	}
	
	
		
	
    function foundThumb($var){
	   // return (false !==strstr($var,"_thumb.jpg"));
	    return strstr($var,"_thumb.jpg");
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
// 		print("thumbs: " . $r . "<br/>");

		if(file_exists($current_path . $obj->file_name_pdf)){
			$obj->recipe_name = $obj->file_name_pdf;
			array_push($recipes, $obj);
// 			print("PDF: " . $obj->file_name_pdf . "<br/>");
		} 
		if(!file_exists($current_path . $obj->file_name_pdf) && file_exists($current_path . $obj->file_name_jpg)){
// 		  print($path0."<br/>");
			$obj->recipe_name = $obj->file_name_jpg;
			array_push($recipes, $obj);
// 			print("JPG: " . $obj->file_name_jpg . "<br/>");

		} // else {print("Nope: ".$path0."<br/>");}
	}

    
	echo "<p>Number of recipes: ".sizeof($thumbs)."</p>";
	
	if (sizeof($thumbs)>0){
		foreach($recipes as $_displayrecipe){
//             print("Recipe name: " . $_displayrecipe->recipe_name);
            echo "\n";
            echo "<p class=\"recipe\">";
            // link to big image file, link to thumbnail
            echo "<a href=\"{$current_path}{$_displayrecipe->recipe_name}\"><img src=\"{$thumb_path}/{$_displayrecipe->file_thumbname}\" height=\"200px\" style=\"border:solid 1px black\">";
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