<?php 

namespace Apefood\SimpleVC; 

class AudioConverter extends Converter 
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
			
			$cdc = $output['options']['codec'];  
			$br = $output['options']['bit-rate']; 
			$o = $output['src']; 		
			
			$cmd = sprintf(" -map 0:a -c:a %s -b:a %s %s", $cdc, $br, $o); 
			
			$this->command .= $cmd; 
			
		}	
		
		return $this->command; 
		
	}	

	
}		