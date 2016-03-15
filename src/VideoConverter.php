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

	
}