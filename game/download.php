<?php
/* letak folder */
 
if($_POST){
/* nama zipfile yang akan dibuat */
$zipname = "Minecraft-game.rar";
$zipname = "Dark_Souls_III.rar";
$zipname = "titan-fall-game-2.rar";
$zipname = "red_dead_2.rar";
$zipname = "monster-hunter-world.rar";
$zipname = "DOOM_ETERNAL.rar";
$zipname = "Witcher3.rar";
$zipname = "gta_v.rar";
$zipname = "cyberpunk_2077.rar";
/* proses membuat zip file */
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);
 
foreach ($_POST['download'] as $key => $value) {
$zip->addFile($value);
   
}
$zip->close();
/* preses pembuatan zip file selesai disini */
 
/* download file jika eksis*/
if(file_exists($zipname)){
header('Content-Type: application/zip');
header('Content-disposition: attachment; 
filename="'.$zipname.'"');
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);
 
} else{
$error = "Proses mengkompresi file gagal  ";
} //end of if file_exist
}//end of post
?>