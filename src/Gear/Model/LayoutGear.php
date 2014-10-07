<?php

namespace Gear\Model;

class LayoutGear extends MakeGear
{
    public function __construct(\Gear\Model\Configuration $configuration)
    {
        parent::setConfig($configuration);
    }

    public function getFinalPath()
    {
        return $this->getLocal().'/module/'.$this->getModule().'/view/layout/';
    }

    public function generate()
    {
        $this->createLayout();
    }

    public function createLayout()
    {
        $b  = $this->getIndent(0).trim('<?php echo $this->doctype(); ?>').PHP_EOL;
        $b .= $this->getIndent(0).trim('<html lang="pt-br">').PHP_EOL;
        $b .= $this->getIndent(1).trim('    <head>').PHP_EOL;
        $b .= $this->getIndent(2).trim('        <meta charset="utf-8">').PHP_EOL;

        $b .= $this->getIndent(3).trim('        <?php echo $this->headTitle($this->translate(\''.$this->str('label',$this->getModule()).'\'))->setSeparator(\' - \')->setAutoEscape(false) ?>').PHP_EOL;
        $b .= $this->getIndent(3).trim('        <?php echo $this->headMeta()->appendName(\'viewport\', \'width=device-width, initial-scale=1.0\') ?>').PHP_EOL;
        $b .= $this->getIndent(3).trim('        <!-- Le styles -->').PHP_EOL;
        $b .= $this->getIndent(3).trim('        <?php echo $this->headLink(array(\'rel\' => \'shortcut icon\', \'type\' => \'image/vnd.microsoft.icon\', \'href\' => $this->basePath() . \'/img/favicon.ico\'))').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependStylesheet($this->basePath() . \'/css/style.css\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                       ->prependStylesheet($this->basePath() . \'/bower_components/jquery-ui/themes/base/jquery-ui.css\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                       ->prependStylesheet($this->basePath() . \'/bower_components/bootstrap/dist/css/bootstrap.min.css\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ?>').PHP_EOL;
        $b .= $this->getIndent(3).trim('        <!-- Scripts -->').PHP_EOL;
        $b .= $this->getIndent(3).trim('        <?php echo $this->headScript()').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/js/html5.js\', \'text/javascript\', array(\'conditional\' => \'lt IE 9\',))').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/js/engine.js\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/bower_components/jquery.validation/dist/jquery.validate.min.js\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/bower_components/bootstrap/dist/js/bootstrap.min.js\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/bower_components/jquery-ui/ui/jquery-ui.js\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ->prependFile($this->basePath() . \'/bower_components/jquery/dist/jquery.min.js\')').PHP_EOL;
        $b .= $this->getIndent(4).trim('                        ?>').PHP_EOL;

        $b .= $this->getIndent(2).trim('        <meta name="viewport" content="width=device-width, initial-scale=1">').PHP_EOL;
        $b .= $this->getIndent(1).trim('    </head>').PHP_EOL;
        $b .= $this->getIndent(1).trim('    <body>').PHP_EOL;
        $b .= $this->getIndent(2).trim('        <div class="container">').PHP_EOL;
        $b .= $this->getIndent(3).trim('		   <div class="row">').PHP_EOL;
        $b .= $this->getIndent(4).trim('			   <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">').PHP_EOL;
        $b .= $this->getIndent(5).trim('			      <?php echo $this->content; ?>').PHP_EOL;
        $b .= $this->getIndent(4).trim('			   </div>').PHP_EOL;
        $b .= $this->getIndent(3).trim('		   </div>').PHP_EOL;
        $b .= $this->getIndent(2).trim('    	</div>').PHP_EOL;
        $b .= $this->getIndent(1).trim('    </body>').PHP_EOL;
        $b .= $this->getIndent(0).trim('</html>').PHP_EOL;

        $this->mkHTML($this->getFinalPath(), 'layout', $b);

    }
}
