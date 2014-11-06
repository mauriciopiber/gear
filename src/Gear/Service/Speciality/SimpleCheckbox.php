<?php
namespace Gear\Service\Speciality;


class SimpleCheckbox extends AbstractSpecialityService
{

    public function getFormElement($var, $name, $id, $label)
    {
        return $this->getTemplateService()->render('template/speciality/simple-checkbox/form.phtml', array(
        	'var' => $var,
            'name' => $name,
            'id' => $id,
            'label' => $label
        ));

    }

    public function getFilterElement()
    {

    }

    public function getViewFormElement()
    {

    }

    public function getViewRowElement()
    {

    }

}
