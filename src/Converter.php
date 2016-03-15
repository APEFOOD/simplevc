<?php 

namespace Apefood\SimpleVC;  

abstract class Converter implements ConverterInterface 
{
	/** 
	* Input file 
	* 
	* @var string $input 
	*/ 
	protected $input; 
	
	/** 
	* Output files 
	* 
	* @var array $output 
	*/ 
	protected $output; 
	
	/**
	* FFmpeg command 
	* 
	* @var string $command 
	*/
	protected $command = ''; 
	
	protected $media; 
	
	/**
	* Construct the converter 
	* 
	* @param \Apefood\SimpleVC\Media 
	* @return void 
	*/ 
	public function __construct(Media $media) 
	{	
		
		$this->media = $media; 
		$this->input = $media->getFilename(); 
		$this->output = $media->getOutputFiles(); 
		
	}
	
	/** 
	* Abstract convert() method  
	* 
	* @return string $command 
	*/ 
	abstract public function convert();
	
}	

	
	
	
	
	
	