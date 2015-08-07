<?php
include('class.upload.php');

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  utf8_decode(str_replace('//','/',$targetPath) . $_FILES['Filedata']['name']);

	$file_id = md5($_FILES["Filedata"]["tmp_name"] + rand()*100000 + time());

	$handle = new Upload($_FILES['Filedata']);
		if ($handle->uploaded) {
			$handle->file_src_name_body      = time().$file_id; // hard name
			//$handle->file_overwrite = true;
			//$handle->file_auto_rename = false;
			$handle->image_resize            = true;
			$handle->image_ratio_y           = true;
			$handle->image_x                 = 600; //size of picture
			$handle->file_max_size = '512000'; // max size
			$handle->Process($targetPath.'/');
			// $handle-> Clean();
			
			
			//thumbnail creation:
			$handle->file_src_name_body      = time().$file_id; // hard name
			//$handle->file_overwrite = true;
			//$handle->file_auto_rename = false;
			$handle->image_resize            = true;
			//$handle->image_ratio_y           = true;
			$handle->image_ratio_x           = true;
			$handle->image_y                 = 70; //size of picture
			$handle->file_max_size = '512000'; // max size
			$handle->Process($targetPath.'/'.'thumbs/');
			
			$handle-> Clean();
			echo "1";
		} else {
		}
}	
?>