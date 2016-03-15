<?php 

require_once('../vendor/autoload.php');

use Apefood\SimpleVC\Video as Video; 
use Apefood\SimpleVC\VideoConverter as Converter; 
use Apefood\SimpleVC\HtmlFactory as HtmlFactory;  

// Input file 
$filename = "media/video1.mp4"; 

// Video file object 
$video = new Video($filename); 
var_dump($video); 

$count = count($video->getOutputFiles()); 
var_dump($count); 

// Video converter object 
$video_converter = new Converter($video);
var_dump($video_converter);

// FFmpeg command: schedule as task to exec(), preferably on a different machine/EC2 instance.  
$command = $video_converter->convert(); 
var_dump($command);   

// HTML object (returns <source> tags) 
$html = new HtmlFactory($video); 
var_dump($html); 

// Source tags: store them in DB or whatever, publish to a web page after FFmpeg command has run 
$source = $html->render(); 
var_dump($source); 


?>