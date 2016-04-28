<?php 

namespace Apefood\SimpleVC; 

class VideoConverter extends Converter 
{
	
	/**
	* Concrete implementation of the convert() method 
	* 
	* @return string $command 
	*/ 
	public function convert() 
	{
		
		$this->command = sprintf("FFmpeg -i %s", $this->input); 
		
		foreach($this->output as $output) {
			
			$vcdc = $output['options']['video codec']; 
			$acdc = $output['options']['audio codec']; 
			$br = $output['options']['bit-rate']; 
			$o = $output['src']; 		
			
			$cmd = sprintf(" -map 0:v -map 0:a -c:v %s -b:v %s -c:a %s %s", $vcdc, $br, $acdc, $o); 
			
			$this->command .= $cmd; 
			
		}	
		
		return $this->command; 
		
	}	
	
	/**
	* Extract video frames and save to images 
	*
	* @param string $start (i.e "01:00" for "at 1 minutes played") 
	* @param string $end (i.e "03:00" for "stop after 3 minutes") 
	* @param int $frames (per minute) 
	* @param string $format 
	* @return string $command 
	*/ 
	public function extractFrames(string $start = null, string $end = null, int $frames = 2, $format = 'jpeg') 
	{ 
		
		$this->command = sprintf("FFmpeg -i %s", $this->input); 
		
		if (isset($start) && isset($end)) {
			
			$this->command .= sprintf(" -ss %s -t %s", $start, $end); 
			
			
		} 
		
		$name = $this->media->getName(); 
	
		$r = ($frames/60); 
		
		$this->command .= sprintf(" -r %s %s", $r, $name); 
		$this->command .= "-%03d."; 
		$this->command .= sprintf("%s", $format); 
		
		return $this->command; 
		
	}	

	
}