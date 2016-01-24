<?php
namespace Gear\ValueObject;

use Gear\ValueObject\AbstractValueObject;

class StandaloneModuleStructure extends BasicModuleStructure
{
	
	
	public function __construct($serviceLocator, $moduleName, $location) 
	{
		$this->serviceLocator = $serviceLocator;
		$this->moduleName = $this->serviceLocator->get('stringService')->str('class', $moduleName);

		if (!is_dir(realpath($location))) {
			throw new \Exception('Location doesn\'t exist');
		}
		
		$this->mainFolder = realpath($location).'/'.$this->serviceLocator->get('stringService')->str('url', $moduleName);
	
		
		unset($this->serviceLocator);
		
		return $this;
		//die('piber');
	}
}