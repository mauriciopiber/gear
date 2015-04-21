<?php
namespace TestUpload\Filter;

use TestUpload\Filter\AbstractFilter;

class TestUploadImageFilter extends AbstractFilter
{
    public function getInputFilter()
    {
        // File Input
        $fileInput = new \Zend\InputFilter\FileInput('image');
        $fileInput->setRequired(false);
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => \Security\Module::getProjectFolder().'/public/tmpImage/imagetempimg.png',
                'randomize' => true,
            )
        );
        $this->add($fileInput);
        return $this;
    }
}
