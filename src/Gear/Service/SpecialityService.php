<?php
namespace Gear\Service;

class SpecialityService extends \Gear\Service\AbstractJsonService
{
    public function getSpecialityByName($name)
    {
        $data = array('speciality' => $this->factory($name));
        return $data;
    }

    public function factory($name)
    {
        $speciality = null;

        switch($name) {
        	/* case 'SimpleRadiobox':
        	case 'simple-radio':
        	case 'simple-radio-box':
        	case 'simple-radiobox':

        	    $speciality = new \Gear\Service\Speciality\SimpleRadiobox();

        	    break;*/
    	    case 'SimpleCheckbox':
    	    case 'simple-check':
    	    case 'simple-check-box':
    	    case 'simple-checkbox':
    	        $speciality = $this->getServiceLocator()->get('Gear\Speciality\SimpleCheckbox');
    	        break;
        }

        return $speciality;

    }

}
