<?php
namespace Gear\Project\Composer;

use GearBase\Util\String\StringServiceTrait;
use Gear\Creator\FileCreatorTrait;
use Gear\Script\ScriptServiceTrait;
use Gear\Edge\ComposerEdgeTrait;
use Gear\Project\Project;
use Gear\Util\Vector\ArrayServiceTrait;

class ComposerService
{
    use ComposerEdgeTrait;

    use StringServiceTrait;

    use FileCreatorTrait;

    use ScriptServiceTrait;

    use ArrayServiceTrait;

    public function __construct($fileCreator, $stringService, $scriptService, $composerEdge, $array)
    {
        $this->fileCreator = $fileCreator;
        $this->stringService = $stringService;
        $this->scriptService = $scriptService;
        $this->composerEdge = $composerEdge;
        $this->arrayService = $array;
    }

    public function createComposer(Project $project)
    {
        $edge = $this->getComposerEdge()->getComposerProject($project->getType());

        return $this->getFileCreator()->createFile(
            'template/project/composer.json.phtml',
            array(
                'project' => $this->getStringService()->str('url', $project->getProject()),
                'require' => $this->getArrayService()->toJson($edge['require'***REMOVED***, 2),
                'requireDev' => $this->getArrayService()->toJson($edge['require-dev'***REMOVED***, 2)
            ),
            'composer.json',
            $project->getProjectLocation()
        );
    }

    public function runComposerUpdate(Project $project)
    {
        return true;

    }


}
