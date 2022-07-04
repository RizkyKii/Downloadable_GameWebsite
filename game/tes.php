<html>
<form method="POST" action="index.php" enctype="multipart/form-data">
	Select File: <input type="file" name="file[]" multiple="multiple" required/>
		<input type="submit" value="Upload">

</form>

</html>

<?php
define('SITE_ROOT', dirname(__FILE__));

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$filesToZip=array();
	foreach ($_FILES['file']['tmp_name'] as $key => $tmp_name) 
	{
		$name=basename($_FILES['file']['name'][$key]);
		$uploads_dir=SITE_ROOT.'/uploads/'.$name;
		array_push($filesToZip, $name);
		move_uploaded_file($_FILES['file']['tmp_name'][$key], "$uploads_dir");
	}
	$zip=new ZipArchive;
	$zip_name=time().'.zip';
	
	if ($zip->open($zip_name,ZipArchive::CREATE) === TRUE) {

		foreach ($filesToZip as $file) {

			$zip->addFile('uploads/'.$file,$file);
		}
		$zip->close();
		header('content-type:application/octet-stream');
		header("content-disposition: attachment; filename=$zip_name");
		readfile($zip_name);
	}
}
 ?>