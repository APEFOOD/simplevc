<?php 

namespace Apefood\SimpleVC;

class Audio extends Media 
{
	
	/**
	* Audio bit-rate 
	* 
	* @var string $bitrate 
	*/ 
	protected $bitrate = '320k';  
	
	/**
	* Concrete implementation of the setOutputFiles method 
	* 
	* @param string $mime 
	* @param string $name   
	* @return array $outputFiles  
	*/
	protected function setOutputFiles(String $mime, String $name) 
	{
		
		try 
		{ 
			
			if($this->isAudio($mime)) { 
		
				$this->outputFiles = []; 
		
				// If the original file is already in a web friendly format, set 2 
				// other output files. If not, set 3. 
				switch ($mime) {
			
					case "audio/mp3" || "audio/mpeg": 
				
						$this->outputFiles = [
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'audio/webm', 
								'options' 	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								]	
							], 
					
							'theora' => [ 
								'src' 		=> $name . '.oga', 
								'type' 		=> 'audio/ogg',  
								'options'	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								]	
							]
					
						];
				
					break; 
			
					case "audio/ogg" || "audio/oga": 
				
						$this->outputFiles = [
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'audio/webm', 
								'options' 	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								]	
							], 
					
							'mp3' => [ 
								'src' 		=> $name . '.mp3', 
								'type' 		=> 'audio/mp3', 
								'options' 	=> [ 
									'codec' 	=> 'libmp3lame', 
									'bit-rate' 	=> $this->bitrate
								] 	
							]
					
						];
				
				
					break; 
			
					case "audio/webm": 
				
						$this->outputFiles = [
					
							'mp3' 	=> [ 
								'src' 		=> $name . '.mp3', 
								'type' 		=> 'audio/mp3', 
								'options' 	=> [ 
									'codec' 	=> 'libmp3lame', 
									'bit-rate' 	=> $this->bitrate
								] 
							], 
					
							'theora' => [ 
								'src' 		=> $name . '.oga', 
								'type' 		=> 'audio/ogg', 
								'options' 	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								] 
							]
					
						];
				
					break; 

					default: 
			
						$this->outputFiles = [
					
							'mp3' 	=> [ 
								'src' 		=> $name . '.mp3', 
								'type' 		=> 'audio/mp3', 
								'options' 	=> [ 
									'codec' 	=> 'libmp3lame', 
									'bit-rate' 	=> $this->bitrate
								] 
							],
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'audio/webm', 
								'options' 	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								] 
							], 
					
							'theora' => [ 
								'src' 		=> $name . '.oga', 
								'type' 		=> 'audio/ogg', 
								'options' 	=> [ 
									'codec' 	=> 'libvorbis', 
									'bit-rate' 	=> $this->bitrate 
								] 
							]
					
						];
				
					break; 
			
				} 
				
				return $this->outputFiles; 
		
			} 
		
		} 
		catch (\Exception $e) 
		{
		
			die($e->getMessage());
		
		}
	 
	} 
	
	/**
	* Verify it's an audio file 
	* 
	* @param string $mime 
	* @return bool 
	*/ 
	protected function isAudio($mime) 
	{
		
		if(!preg_match("/\baudio\b/", $mime)) {
			
			throw new \Exception('Invalid file format.');
			
		} 
		
		return true; 
		
	}	
	
	
}

