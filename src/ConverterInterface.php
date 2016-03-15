<?php 

namespace Apefood\SimpleVC; 

interface ConverterInterface  
{

	/**
	* Convert the media file to web friendly formats  
	* 
	* @return string $command 
	*/ 
	public function convert();


}

 