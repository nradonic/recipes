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

	$current_path = "./thumbs";
		
	if ($handle = opendir($current_path)) {
		//$entry = readdir($handle);
		$files = scandir($current_path);
		closedir($handle);
		$thumbs = array_filter($files, "foundThumb");

	}

    	

	foreach($thumbs as $r){
		$obj = new Recipe($r);
		array_push($recipes, $obj);
	}

    
	echo "<p>Number of recipes: ".sizeof($thumbs)."</p>";
	
	if (sizeof($thumbs)>0){
		foreach($recipes as $_agendafile){
             
            echo "\n";
            echo "<p class=\"recipe\">";
            // link to big image file, link to thumbnail
            echo "<a href=\"{$current_path}/{$_agendafile->file_name}\"><img src=\"{$current_path}/{$_agendafile->file_thumbname}\" height=\"200px\" style=\"border:solid 1px black\">";
            // name
			echo "<br>{$_agendafile->baseName}</a></p>";
			echo "\n";
		}
	}
	else
	{
		echo "<p>Recipes not found</p>\n";
	}
		
		?>