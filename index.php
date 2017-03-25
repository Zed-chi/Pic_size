<?php
$session_name;
include 'inc/header.php';

if( !isset($_POST["process"]) && isset($_POST["submit"])  ){	
//сохранить файлы,
//переименовать,
    $num = count($_FILES['images']['name']);
    $session_name = time();
    mkdir("Upload/".$session_name);
    
    for($i = 0; $i<$num; $i++){
		$file = $_FILES["images"]["tmp_name"][$i];
		$file_name = $_FILES["images"]["name"][$i];
        
		switch($_FILES["images"]["type"][$i]){
		    case "image/gif":
		        $ext = ".gif";
		        copy($file, "Upload/$session_name/".$file_name.$ext);
		        break;
            case "image/jpeg":
                $ext = ".jpg";
                copy($file, "Upload/$session_name/".$file_name.$ext);
                break;
            case "image/png":
		        $ext = ".png";
		        copy($file, "Upload/$session_name/".$file_name.$ext);
		        break;
		}
	}
//сгенерировать страницу,
//вложить сценарий со страницей
    include 'inc/liner.php';
}

elseif( isset($_POST["process"]) ){
//декодировать json
    $values = json_decode($_POST["process"], true);
//пройтись циклом по файлам
    $files = scandir("Upload/$session_name");
	$count = 0;
//в соответствии с параметрами
//разрезать и сохранить нужные файлы
  	foreach($files as $file){
	    if(substr($file, 0, 1) != "." ){
			$filename = "Upload/$session_name/".$file;
			$size = getimagesize($filename);
			$width = $size[0];
			$height = $size[1];
			$row = $values[$count]["row"];
			$col = $values[$count]["col"];
			$img_width = round(($width/100)*($values[$count]["width"]/$col));
			$img_height = round(($height/100)*($values[$count]["height"]/$row));
			$img_left = round(($width/100)*($values[$count]["left"]));
			$img_top = round(($height/100)*($values[$count]["top"]));
			// Создание изображений
			$src = imagecreatefromjpeg($filename);
			$l = $img_left;
			$t = $img_top;
			mkdir("Upload/".$count);
			for($i=0;$i<$values[$count]["row"]; $i++){
				for($j=0; $j<$values[$count]["col"];$j++){
					$dest = imagecreatetruecolor($img_width, $img_height);
					// Копирование
					imagecopy($dest, $src, 0, 0, $l, $t, $img_width, $img_height);
					// Сохраняем изображение в 'simpletext.jpg'
					imagejpeg($dest, ("Upload/$count/".$i."-".$j.".jpg") );
					imagedestroy($dest);
					$l+=$img_width;
				}
				$t+=$img_height;
				$l = $img_left;
			}						
			//mkdir($d);
		    $count++;
		    imagedestroy($src);
		    unlink($filename);
	    }
		
  	}

	$folders = scandir("Upload");
	$zip = new ZipArchive();
	$filename = "Zips/".time().".zip";

	if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
	    exit("Невозможно открыть <$filename>\n");
	}
	foreach($folders as $folder){
		if(is_dir("Upload/".$folder) && substr($folder, 0, 1) != "."){
			$images = scandir("Upload/".$folder);
			$zip->addEmptyDir($folder);
			foreach($images as $image){
				if(substr($image, 0, 1) != "."){
					$zip->addFile("Upload/$folder/$image","$folder/$image");
				}
			}
		}
		//rmdir("Upload/".$folder);
	}
	echo "numfiles: " . $zip->numFiles . "\n";
	echo "status:" . $zip->status . "\n";
	$zip->close();
	
	foreach($folders as $folder){
		if(is_dir("Upload/".$folder) && substr($folder, 0, 1) != "."){
			$images = scandir("Upload/".$folder);
			foreach($images as $image){
				if(substr($image, 0, 1) != "."){
					unlink("Upload/$folder/$image");
				}
			}
			rmdir("Upload/".$folder);
		}
		
	}	
//заархивировать файлы и отдать пользователю
//удалить все к херам
    
// Будем передавать PDF
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="zippaaa"');
readfile($filename);
unlink($filename);
}

else
{
//Отобразить форму загрузки файла
    include 'inc/loadpage.php';
}

include 'inc/footer.php';