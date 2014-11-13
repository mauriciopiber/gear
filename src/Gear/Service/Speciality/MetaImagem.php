<?php
namespace Gear\Service\Speciality;


class MetaImagem extends AbstractSpecialityService
{

    public function getFormElement($var, $name, $id, $label)
    {
       return $this->getTemplateService()->render('template/speciality/metaimagem/form.phtml', array(
        	'var' => $var,
            'name' => $name,
            'id' => $id,
            'label' => $label
        ));
    }

    public function getFilterElement()
    {

    }

    public function getViewFormElement($name)
    {
        return $this->getTemplateService()->render('template/speciality/metaimagem/view-form.phtml', array(
            'name' => $name,
        ));
    }

    public function getViewRowElement()
    {

    }

}
