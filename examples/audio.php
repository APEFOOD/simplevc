<?php 

require_once('../vendor/autoload.php');

use Apefood\SimpleVC\Audio as Audio; 
use Apefood\SimpleVC\AudioConverter as Converter; 
use Apefood\SimpleVC\HtmlFactory as HtmlFactory; 

// Input file 
$filename = 'media/audio.mp3'; 

// Audio file object 
$audio = new Audio($filename); 
var_dump($audio); 

var_dump($audio->getOutputFiles()); 

// Audio converter object 
$audio_converter = new Converter($audio);
var_dump($audio_converter);

// FFmpeg command: schedule as task to exec(), preferably on a different machine/EC2 instance.  
$command = $audio_converter->convert(); 
var_dump($command);   

// HTML object (returns <source> tags) 
$html = new HtmlFactory($audio); 
var_dump($html); 

// Source tags: store them in DB or whatever, publish to a web page after FFmpeg command has run 
$source = $html->render(); 
var_dump($source); 

?>