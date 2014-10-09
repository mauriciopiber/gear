<?php
namespace Gear\Repository;

class DanceRepository
{
    public function getEsquerda()
    {
        $version  =  '(•_•)'."\n";
        $version .=  '<) )╯'."\n";
        $version .=  ' / \ '."\n\n";

        return $version;
    }

    public function getDireita()
    {
        $version  =  '(•_•)'."\n";
        $version .=  '\( (>'."\n";
        $version .=  ' / \\'."\n\n";

        return $version;
    }

    public function getAberto()
    {
        $version  =  '(•_•)'."\n";
        $version .=  '/( (╯'."\n";
        $version .=  ' / \\'."\n\n";

        return $version;
    }

    public function getFechado()
    {
        $version  =  '(•_•)'."\n";
        $version .=  '/( (\\'."\n";
        $version .=  ' / \\'."\n\n";

        return $version;
    }

}
