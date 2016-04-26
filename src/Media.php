<?php 

namespace Apefood\SimpleVC; 

abstract class Media
{
	
	/**
	* File name 
	* 
	* @var string $filename 
	*/
	protected $filename; 
	
	/**
	* File name, without the extension 
	* 
	* @var string $name 
	*/ 
	protected $name; 
	
	/**
	* This property is added because some video 
	* and audio formats share a file extension 
	* (i.e. A .WebM file could be either audio or video)
	* 
	* @var string $mime 
	*/ 
	protected $mime; 
	
	/**
	* File extension 
	* 
	* @var string $extension 
	*/ 
	protected $extension; 
	
	/** 
	* Output files 
	*
	* @var array $outputFiles
	*/ 
	protected $outputFiles; 
	
	/** 
	* Construct the media object
	*
	* @param string $filename /path/to/media/file 
	* @return void 
	*/ 
	public function __construct(String $filename) 
	{
		$this->filename = $filename; 
		
		// Verify that this is a media file 
		try 
		{
			// This right here is either bad programming or paranoia. Or both. 
			if ($this->isMediaFile($this->filename)) {
				
				$this->mime = mime_content_type($this->filename);
				$this->extension = substr($filename, -3); 
				
				// WebM files have a longer file extension 
				if (preg_match("/\bwebm\b/", $this->mime)) {
					$this->name = substr($filename, 0, -5); 
				} else {	
					$this->name = substr($filename, 0, -4);
				}
				
				$this->outputFiles = $this->setOutputFiles($this->mime, $this->name); 
				
			}	
			
		} 
		catch (\Exception $e) 
		{
			
			die($e->getMessage());
		
		}
		
	} 
	
	/**
	* Vetting the input file 
	* 
	* @param string $filename 
	* @param string $mime 
	* @return bool 
	*/ 
	protected function isMediaFile($filename) 
	{	
		
		// Does the supposed file exist? 
		if (!file_exists($filename)) {
			throw new \Exception('No file detected ****'); 
		}	
		
		// Is it a file? 
		if(!is_file($filename)) {
			throw new \Exception('Invalid input'); 
		} 
	
		return true; 
	}
	
	/**
	* Abstract method for determining the right output files 
	* 
	* @param string $mime 
	* @param string $name 
	* @return array $outputFiles  
	*/ 
	abstract protected function setOutputFiles(String $mime, String $name); 
	
	/** 
	* Getter method for the $outputFiles array 
	* 
	* @return array $outputFiles 
	*/ 
	public function getOutputFiles() 
	{
	
		return $this->outputFiles; 
	
	}	
	
	/**
	* Getter method for $filename 
	* 
	* @return string $filename 
	*/ 
	public function getFilename() 
	{
		
		return $this->filename; 
		
	} 
	
	/**
	* Getter method for the file name (without the extension) 
	* 
	* @return string $name 
	*/ 
	public function getName() 
	{
		
		return $this->name; 
		
	}	
	
	/**
	* Getter method for $mime 
	* 
	* @return string $mime 
	*/ 
	public function getMimeType() 
	{
		
		return $this->mime; 
		
	}	
	
}	
	
	
	
	
	
	