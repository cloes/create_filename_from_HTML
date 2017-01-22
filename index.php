<?php
require_once("./vendor/autoload.php");

use Zend\Dom\Document\Query;
use Zend\Dom\Document;

file_put_contents('filename.txt','');

$dom = new Query();

$content = file_get_contents("index.html");
$document = new Document($content);

$chapterResults = $dom->execute('.toc .chapter a, .toc .section a, .toc .appendix a',$document,'TYPE_CSS');

foreach ($chapterResults as $result) {
    //echo $result->textContent, "<br/>";

    $pos = strpos($result->textContent,' ');
    $prefix = substr($result->textContent,0,$pos);

    if(!hasDot($prefix)){
        //创建文件夹
        echo $prefix, "<br/>";
        if (is_numeric($prefix)){
            if(strlen($prefix) < 2){
                $prefix = '0'.$prefix;
            }
            $folderName = 'Chapter_'.$prefix;
        }else{
            //var_dump($prefix);
            $folderName = 'Appendix_'.$prefix;
        }
        mkdir('./output/'.$folderName);
        //file_put_contents('filename.txt',$folderName,FILE_APPEND);
        $currentFolder = $folderName;
    }

    $fileName = addZero($result->textContent);
    var_dump($fileName);
    file_put_contents('./output/'.$folderName.'/'.$fileName.".md", "");
    file_put_contents('filename.txt',$fileName."\r\n",FILE_APPEND);
}



function hasDot($num){
    return strpos($num, ".") ? true : false;
}

function addZero($content){
    $content = str_replace(array("\r\n", "\n", "\r", "—"),' ',$content);
    $content = str_replace(array("(", ")"),'',$content);
    $content = str_replace(array(" - "),'-',$content);
    //$content = preg_replace('/ -+ /','-',$content);
    $pos = strpos($content,' ');
    $prefix = substr($content,0,$pos);
    $postfix = substr($content,$pos);

    $prefixArray = explode('.',$prefix);
    foreach ($prefixArray as &$value){
        if(is_numeric($value)){
            if (strlen($value) < 2){
                $value = '0'.$value;
            }
        }
    }

    $i = 0;
    $newContent = "";
    while ($i < 3){
        if (isset($prefixArray[$i])){
            $newContent = $newContent.'.'.$prefixArray[$i];
        }else{
            $newContent = $newContent.".00";
        }
        $i++;
    }
    if ($newContent[0] == '.'){
        $newContent = substr($newContent,1);
    }
    $newContent = $newContent.$postfix;
    $newContent = str_replace(array(' ','/','?',','),'_',$newContent);
    $newContent = preg_replace('/_{2,}/','_',$newContent);

    return $newContent;
}
