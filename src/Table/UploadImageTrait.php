<?php
namespace Gear\Table;

use Gear\Table\UploadImage;

/**
 * PHP Version 5
 *
 * @category Trait
 * @package Gear/Table
 * @author Mauricio Piber <mauriciopiber@gmail.com>
 * @license GPL3-0 http://www.gnu.org/licenses/gpl-3.0.en.html
 * @link http://pibernetwork.com
 */
trait UploadImageTrait
{
    protected $uploadImage;

    /**
     * Get Upload Image
     *
     * @return UploadImage
     */
    public function getUploadImage()
    {

        return $this->uploadImage;
    }

    /**
     * Set Upload Image
     *
     * @param UploadImage $uploadImage Upload Image
     *
     * @return UploadImage
     */
    public function setUploadImage(
        UploadImage $uploadImage
    ) {
        $this->uploadImage = $uploadImage;
        return $this;
    }
}
