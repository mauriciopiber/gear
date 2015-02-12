<?php
namespace AcceptanceTester;

class DeleteSteps extends \AcceptanceTester
{

    public function verifyCanViewBeforeDelete($class, $label, $idToView)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ViewPage', $class);
        $instanceEdit = new $editPage;

        $I->amOnPage(\Teste\Pages\EmailViewPage::$URL.'/'.$idToView);
        $I->seeCurrentUrlEquals(\Teste\Pages\EmailViewPage::$URL.'/'.$idToView);
        $I->see('Visualizar '.$label.' - '.$idToView);
    }

    public function verifyFilterInstanceBeforeDelete($class, $numberReference)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ListPage', $class);
        $instance = new $editPage;

        $I->amOnPage($instance::$URL);
        $I->see('Email');

        $I->click('Exibir Filtro');
        $I->fillField('#likeField', $numberReference);
        $I->click('Pesquisar');
        $I->seeNumberOfElements($instance::$tableBodyRow, 1);
        $I->see($numberReference, $instance::getTableBodyRowByIndex(1));
    }

    public function verifyDeleteSuccessfulFromTableIndex($class, $label)
    {
        $I = $this;
        $editPage = str_replace('DeletePage', 'ListPage', $class);
        $instance = new $editPage;

        $I->click($instance::getTableBodyRowColumnByIndex(1, 6).' form > a');
        $I->waitForElement('.modal-title', 3);
        $I->see('Deletar '.$label, '.modal-title');
        $I->see('Desejas realmente deletar '.$label.'?', '.modal-body p');

        $I->click('Delete');
        $I->see('Sucesso! Deletado.');

        $I->amOnPage($instance::$URL);
    }

}
