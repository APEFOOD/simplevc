<?php 

namespace Apefood\SimpleVC; 

class HtmlFactory  
{	
	
	/** 
	* Media object 
	* 
	* @var $media 
	*/ 
	protected $media; 
	
	/**
	* Media output files 
	* 
	* @var array $ofiles 
	*/ 
	protected $ofiles = [];
	
	/**
	* <source> tags
	* 
	* @var string $tags 
	*/ 
	protected $tags; 
	
	/**
	* Construct the HTML5 video & audio <source> tag 
	* 
	* @param \Apefood\SimpleVC\Media 
	* @return void 
	*/ 
	public function __construct(Media $media) 
	{
	
		$this->ofiles = $media->getOutputFiles();
		$this->media = $media;  
	
	}	

	/**
	* Render the media file in HTML 
	* 
	* @return string $source    
	*/ 
	public function render() 
	{
		
		$this->tags = ''; 
		
		// If the output files are not equal to 3, that means the original file is already in a 
		// a web friendly format. Append it to the tags string. 
		if (count($this->ofiles) != 3) { 
			
			$this->tags .= sprintf('<source src="%s" type="%s">', $this->media->getFilename(), $this->media->getMimeType()); 
			
		}	
		
		foreach($this->ofiles as $file) {
			
			$this->tags .= sprintf('<source src="%s" type="%s">', $file['src'], $file['type']);
			
		} 
		
		return $this->tags; 
		
	}	
	

}
	