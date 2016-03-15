<?php 

namespace Apefood\SimpleVC;

class Video extends Media 
{
	
	/**
	* Video bit-rate 
	* 
	* @var string 
	*/
	protected $bitrate = '2M';
	
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
			
			if($this->isVideo($mime)) { 
		
				$this->outputFiles = []; 
		
				// If the original file is already in a web friendly format, set 2 
				// other output files. If not, set 3. 
				switch ($mime) {
			
					case "video/mp4": 
				
						$this->outputFiles = [
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'video/webm', 
								'options' 	=> [ 
									'video codec' 	=> 'libvpx', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							], 
					
							'theora' => [ 
								'src' 		=> $name . '.ogv', 
								'type' 		=> 'video/ogv',  
								'options'	=> [ 
									'video codec' 	=> 'libtheora', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							]
					
						];
				
					break; 
			
					case "video/ogv": 
				
						$this->outputFiles = [
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'video/webm', 
								'options' 	=> [ 
									'video codec' 	=> 'libvpx', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							], 
					
							'mp4' => [ 
								'src' 		=> $name . '.mp4', 
								'type' 		=> 'video/mp4', 
								'options' 	=> [ 
									'video codec' 	=> 'libx264', 
									'audio codec' 	=> 'libmp3lame', 
									'bit-rate' 		=> $this->bitrate
								] 	
							]
					
						];
				
				
					break; 
			
					case "video/webm": 
				
						$this->outputFiles = [
					
							'mp4' => [ 
								'src' 		=> $name . '.mp4', 
								'type' 		=> 'video/mp4', 
								'options' 	=> [ 
									'video codec' 	=> 'libx264', 
									'audio codec' 	=> 'libmp3lame', 
									'bit-rate' 		=> $this->bitrate
								] 	
							],  
					
							'theora' => [ 
								'src' 		=> $name . '.ogv', 
								'type' 		=> 'video/ogv',  
								'options'	=> [ 
									'video codec' 	=> 'libtheora', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							] 
					
						];
				
					break; 

					default: 
			
						$this->outputFiles = [
					
							'mp4' => [ 
								'src' 		=> $name . '.mp4', 
								'type' 		=> 'video/mp4', 
								'options' 	=> [ 
									'video codec' 	=> 'libx264', 
									'audio codec' 	=> 'libmp3lame', 
									'bit-rate' 		=> $this->bitrate
								] 	
							], 
					
							'webm' 	=> [ 
								'src' 		=> $name . '.webm', 
								'type' 		=> 'video/webm', 
								'options' 	=> [ 
									'video codec' 	=> 'libvpx', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							],  
					
							'theora' => [ 
								'src' 		=> $name . '.ogv', 
								'type' 		=> 'video/ogv',  
								'options'	=> [ 
									'video codec' 	=> 'libtheora', 
									'audio codec' 	=> 'libvorbis', 
									'bit-rate' 		=> $this->bitrate 
								]	
							]
					
						];
				
					break; 
			
				} 
		
			} 
			
			return $this->outputFiles; 
		
		} 
		catch (\Exception $e) 
		{
		
			die($e->getMessage());
		
		}
	
	}
	
	/**
	* Verify it's a video file 
	* 
	* @param string $mime 
	* @return bool 
	*/ 
	protected function isVideo($mime) 
	{
		
		if(!preg_match("/\bvideo\b/", $mime)) {
			
			throw new \Exception('Invalid file format.'); 
		} 
		
		return true; 
		
	}	
	
	
}

