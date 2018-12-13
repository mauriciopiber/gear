<?php
namespace GearTest\IntegrationTest\ComponentTest\GearFileTest;

use PHPUnit\Framework\TestCase;
use Gear\Integration\Component\GearFile\GearFile;
use Gear\Util\String\StringService;
use Symfony\Component\Yaml\Yaml;
use Gear\Integration\Suite\Src\SrcMinorSuite;
use Gear\Integration\Suite\Mvc\MvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMinorSuite;
use Gear\Integration\Suite\SrcMvc\SrcMvcMajorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMinorSuite;
use Gear\Integration\Suite\ControllerMvc\ControllerMvcMajorSuite;
use Gear\Integration\Suite\Controller\ControllerMinorSuite;
use Gear\Schema\Src\SrcTypesInterface;
use Gear\Integration\Util\Columns\Columns;
use Gear\Integration\Util\Columns\ColumnsTrait;
use Gear\Integration\Util\ResolveNames\ResolveNamesTrait;
use Gear\Integration\Util\ResolveNames\ResolveNames;

/**
 * @group Service
 */
class GearFileTest extends TestCase
{
    use ColumnsTrait;

    public function setUp()
    {
        parent::setUp();

        $this->persist = $this->prophesize('Gear\Integration\Util\Persist\Persist');
        $this->stringService = new StringService();

        $this->service = new GearFile(
            $this->persist->reveal(),
            $this->stringService
        );

        $this->suite = $this->prophesize('Gear\Integration\Suite\MinorSuiteInterface');
        $this->suite->isUsingLongName()->willReturn(true);

        $this->columns = new Columns();
        $this->resolveNames = new ResolveNames($this->stringService);
    }

    /**
     * @group x1
     */
    public function testCreateGearfileSrc()
    {

        $template = <<<EOS
src: {  }

EOS;
        $expected = 'src-repository.yml';

        $minor = $this->prophesize(SrcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-repository')->shouldBeCalled();

        $this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->assertEquals($expected, $this->service->createSrcGearfile($minor->reveal(), [***REMOVED***));
    }

    /**
     * @group fixThisShit
     * @group x9
     */
    public function testCreateGearFileMvc()
    {

        $template = <<<EOS
db:
    -
        table: MvcTest
        user:
            - all
        namespace: MvcTest
        service: factories
        columns: {  }
src: {  }

EOS;
        $expected = 'mvc-test.yml';



        $minor = $this->prophesize(MvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('mvc-test')->shouldBeCalled();
        $minor->getTableAlias()->willReturn('MvcTest')->shouldBeCalled();
        $minor->getUserType()->willReturn(['all'***REMOVED***)->shouldBeCalled();
        $minor->getColumns()->willReturn([
            'mycolumn'
        ***REMOVED***)->shouldBeCalled();

        $minor->getForeignKeys()->willReturn(null)->shouldBeCalled();
        $minor->getTableAssoc()->willReturn(null)->shouldBeCalled();


        $this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->assertEquals($expected, $this->service->createMvcGearfile($minor->reveal()));
    }

    /**
     * @group pp2
     */
    public function testCreateGearFileSrcMvcEntityWithConstraint()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcComplete
        type: Entity
        db: SrcMvcComplete
        user: all
        columns:
            column_text_html_complete: html
            column_decimal_money_complete: money-pt-br
            column_boolean_checkbox_complete: checkbox
            column_int_checkbox_complete: checkbox
            column_datetime_ptbr_complete: datetime-pt-br
            column_date_ptbr_complete: date-pt-br
            column_varchar_password_verify_complete: password-verify
            column_varchar_upload_image_complete: upload-image
            column_varchar_url_complete: url
            column_varchar_unique_id_complete: unique-id
            column_varchar_telephone_complete: telephone
            column_varchar_email_complete: email
    -
        name: ColumnIntForeign
        type: Entity
        db: ColumnIntForeign

EOS;
        $expected = 'src-mvc-entity.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-entity')->shouldBeCalled();
        $minor->getType()->willReturn('Entity')->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc')->shouldBeCalled();

        $tables = [***REMOVED***;
        $minorSuiteOne = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::ENTITY, 'complete', 'all', null, null, true
        );

        $columnsSuffix = $this->resolveNames->format($minorSuiteOne, 'url');

        $minorSuiteOne->setForeignKeys($this->columns->getForeignKeys($minorSuiteOne->getColumnType()));
        $minorSuiteOne->setColumns($this->columns->getColumns($minorSuiteOne, $columnsSuffix));

        $tables[***REMOVED*** = $minorSuiteOne;
        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());
    }

    /**
     * @group x11
     */
    public function testCreateGearFileSrcMvcEntityWithoutConstraint()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcBasic
        type: Entity
        db: SrcMvcBasic
        user: all
        columns: {  }

EOS;
        $expected = 'src-mvc-entity.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-entity')->shouldBeCalled();
        //$minor->getType()->willReturn('Entity')->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc')->shouldBeCalled();

        $tables = [***REMOVED***;
        $tables[0***REMOVED*** = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::ENTITY, 'basic', 'all', null, null, true
        );

        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());
    }

    /**
     * @group 30
     */
    public function testCreateGearFileSrcMvcFixtureWithConstraint()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcCompleteFixture
        type: Fixture
        db: SrcMvcComplete
        user: all
        columns:
            column_text_html_complete: html
            column_decimal_money_complete: money-pt-br
            column_boolean_checkbox_complete: checkbox
            column_int_checkbox_complete: checkbox
            column_datetime_ptbr_complete: datetime-pt-br
            column_date_ptbr_complete: date-pt-br
            column_varchar_password_verify_complete: password-verify
            column_varchar_upload_image_complete: upload-image
            column_varchar_url_complete: url
            column_varchar_unique_id_complete: unique-id
            column_varchar_telephone_complete: telephone
            column_varchar_email_complete: email
    -
        name: ColumnIntForeignFixture
        type: Fixture
        db: ColumnIntForeign

EOS;
        $expected = 'src-mvc-entity.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-fixture')->shouldBeCalled();
        $minor->getType()->willReturn('Fixture')->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc')->shouldBeCalled();

        $tables = [***REMOVED***;
        $minorSuiteOne = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::FIXTURE, 'complete', 'all', null, null, true
        );

        $columnsSuffix = $this->resolveNames->format($minorSuiteOne, 'url');

        $minorSuiteOne->setForeignKeys($this->columns->getForeignKeys($minorSuiteOne->getColumnType()));
        $minorSuiteOne->setColumns($this->columns->getColumns($minorSuiteOne, $columnsSuffix));

        $tables[***REMOVED*** = $minorSuiteOne;
        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());
    }

    /**
     * @group x1x1
     */
    public function testCreateGearFileSrcMvcFixtureWithConstraintShortName()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcCmpFixture
        type: Fixture
        db: SrcMvcCmp
        user: all
        columns:
            clm_txt_htl_cmp: html
            clm_dec_mny_cmp: money-pt-br
            clm_boo_chb_cmp: checkbox
            clm_int_chb_cmp: checkbox
            clm_dtt_pt_cmp: datetime-pt-br
            clm_dat_pt_cmp: date-pt-br
            clm_vrc_pas_ver_cmp: password-verify
            clm_vrc_upl_img_cmp: upload-image
            clm_vrc_url_cmp: url
            clm_vrc_uni_id_cmp: unique-id
            clm_vrc_tel_cmp: telephone
            clm_vrc_eml_cmp: email
    -
        name: ColumnIntForeignFixture
        type: Fixture
        db: ColumnIntForeign

EOS;
        $expected = 'src-mvc-entity.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-fixture')->shouldBeCalled();
        $minor->getType()->willReturn(SrcTypesInterface::FIXTURE)->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc')->shouldBeCalled();

        $tables = [***REMOVED***;
        $minorSuiteOne = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::FIXTURE, 'complete', 'all', null, null, false
        );

        $columnsSuffix = $this->resolveNames->format($minorSuiteOne, 'url');

        $minorSuiteOne->setForeignKeys($this->columns->getForeignKeys($minorSuiteOne->getColumnType()));
        $minorSuiteOne->setColumns($this->columns->getColumns($minorSuiteOne, $columnsSuffix));


        $tables[***REMOVED*** = $minorSuiteOne;
        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());
    }

    /**
     * @group ppp
     */
    public function testCreateGearFileSrcMvcFixtureWithoutConstraint()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcBasicFixture
        type: Fixture
        db: SrcMvcBasic
        user: all
        columns: {  }

EOS;
        $expected = 'src-mvc-fixture.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-fixture')->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc')->shouldBeCalled();

        $tables = [***REMOVED***;
        $tables[0***REMOVED*** = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::FIXTURE, 'basic', 'all', null, null, true
        );
        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());
    }

    public function testCreateGearFileMvcWithConstraint()
    {

    }


    /**
     * @group x21
     */
    public function testCreateGearFileSrcMvc()
    {
        $template = <<<EOS
src:
    -
        name: SrcMvcRepositoryBasicRepository
        type: Repository
        db: SrcMvcRepositoryBasic
        user: all
        columns: {  }
        service: factories
        namespace: SrcMvcRepositoryBasic\Repository
        dependency:
            doctrine.entitymanager.orm_default: \Doctrine\ORM\EntityManager
            0: \GearBase\Repository\QueryBuilder

EOS;
        $expected = 'src-mvc-repository.yml';



        $minor = $this->prophesize(SrcMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('src-mvc-repository')->shouldBeCalled();

        $major = $this->prophesize(SrcMvcMajorSuite::class);
        $major->getSuite()->willReturn('src-mvc-repository')->shouldBeCalled();

        $tables = [***REMOVED***;
        $tables[0***REMOVED*** = new SrcMvcMinorSuite(
            $major->reveal(), SrcTypesInterface::REPOSITORY, 'basic', 'all', null, null, true
        );

        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createSrcMvcGearfile($minor->reveal(), $tables);

        $this->assertEquals($template, $this->service->getCode());
    }

    /**
     * @group x5
     */
    public function testCreateGearfileController()
    {

        $template = <<<EOS
src: {  }
controller: {  }

EOS;
        $expected = 'controller-action.yml';



        $minor = $this->prophesize(ControllerMinorSuite::class);
        //$minor->getType()->willReturn(SrcTypesInterface::REPOSITORY)->shouldBeCalled();
        $minor->getSuiteName()->willReturn('controller-action')->shouldBeCalled();
        /*
         $minor->getSuiteName()->willReturn('mvc-test')->shouldBeCalled();
         $minor->getTableAlias()->willReturn('MvcTest')->shouldBeCalled();
         $minor->getUserType()->willReturn(['all'***REMOVED***)->shouldBeCalled();
         $minor->getColumns()->willReturn([
         'mycolumn'
         ***REMOVED***)->shouldBeCalled();

         $minor->getForeignKeys()->willReturn(null)->shouldBeCalled();
         $minor->getTableAssoc()->willReturn(null)->shouldBeCalled();
         */


        $this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->assertEquals($expected, $this->service->createControllerGearfile($minor->reveal(), [***REMOVED***));
    }

    /**
     * @group x1x1
     */
    public function testCreateGearfileControllerMvcShortName()
    {
        $template = <<<EOS
controller:
    -
        db: SrcMvcBsc
        type: Action
        name: SrcMvcBscController
        user: all
        columns: {  }
        service: factories
        namespace: SrcMvcBasic\Controller
        dependency:
            - SrcMvcBasic\Service\SrcMvcBscService
            - SrcMvcBasic\Form\SrcMvcBscForm
            - SrcMvcBasic\SearchForm\SrcMvcBscSearchForm
        actions:
            - { name: Create, role: admin }
            - { name: Edit, role: admin }
            - { name: List, role: admin }
            - { name: View, role: admin }
            - { name: Delete, role: admin }

EOS;
        $expected = 'controller-mvc.yml';



        $minor = $this->prophesize(ControllerMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('controller-mvc')->shouldBeCalled();
        //$minor->getTableAlias()->willReturn('MvcTest')->shouldBeCalled();
        //$minor->getUserType()->willReturn(['all'***REMOVED***)->shouldBeCalled();
        //$minor->getColumns()->willReturn([
        //    'mycolumn'
        //***REMOVED***)->shouldBeCalled();

        //$minor->getForeignKeys()->willReturn(null)->shouldBeCalled();
        //$minor->getTableAssoc()->willReturn(null)->shouldBeCalled();
        $major = $this->prophesize(ControllerMvcMajorSuite::class);
        $major->getSuite()->willReturn('controller-mvc')->shouldBeCalled();


        $tables = [***REMOVED***;
        $tables[0***REMOVED*** = new ControllerMvcMinorSuite(
            $major->reveal(), 'basic', 'all', null, null, false
        );

        //$this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createControllerMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());

        //$this->assertEquals($expected, );
    }


    /**
     * @group x1x1
     */
    public function testCreateGearfileControllerMvcLongName()
    {
        $template = <<<EOS
controller:
    -
        db: SrcMvcBasic
        type: Action
        name: SrcMvcBasicController
        user: all
        columns: {  }
        service: factories
        namespace: SrcMvcBasic\Controller
        dependency:
            - SrcMvcBasic\Service\SrcMvcBasicService
            - SrcMvcBasic\Form\SrcMvcBasicForm
            - SrcMvcBasic\SearchForm\SrcMvcBasicSearchForm
        actions:
            - { name: Create, role: admin }
            - { name: Edit, role: admin }
            - { name: List, role: admin }
            - { name: View, role: admin }
            - { name: Delete, role: admin }

EOS;
        $expected = 'controller-mvc.yml';



        $minor = $this->prophesize(ControllerMvcMinorSuite::class);
        $minor->getSuiteName()->willReturn('controller-mvc')->shouldBeCalled();
        //$minor->getTableAlias()->willReturn('MvcTest')->shouldBeCalled();
        //$minor->getUserType()->willReturn(['all'***REMOVED***)->shouldBeCalled();
        //$minor->getColumns()->willReturn([
        //    'mycolumn'
        //***REMOVED***)->shouldBeCalled();

        //$minor->getForeignKeys()->willReturn(null)->shouldBeCalled();
        //$minor->getTableAssoc()->willReturn(null)->shouldBeCalled();
        $major = $this->prophesize(ControllerMvcMajorSuite::class);
        $major->getSuite()->willReturn('controller-mvc')->shouldBeCalled();


        $tables = [***REMOVED***;
        $tables[0***REMOVED*** = new ControllerMvcMinorSuite(
            $major->reveal(), 'basic', 'all', null, null, true
        );

        $this->persist->save($minor->reveal(), $expected, $template)->shouldBeCalled();

        $this->service->createControllerMvcGearfile($minor->reveal(), $tables);
        $this->assertEquals($template, $this->service->getCode());

        //$this->assertEquals($expected, );
    }


    public function testCreateSingleInterface()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'service', 1, 1, 'long');

        $this->assertEquals(['Interfaces\ServiceInterface'***REMOVED***, $data);
    }

    public function testCreateMultipleInterfaceUsingService()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'service', 5, 5, 'long');

        $this->assertEquals([
            'Interfaces\ServiceInterfaceOne',
            'Interfaces\ServiceInterfaceTwo',
            'Interfaces\ServiceInterfaceThree',
            'Interfaces\ServiceInterfaceFour',
            'Interfaces\ServiceInterfaceFive',
        ***REMOVED***, $data);
    }


    public function testCreateMultipleInterfaceUsingRepository()
    {
        $data = $this->service->createMultiplesImplements($this->suite->reveal(), 'repository', 5, 5, 'short');

        $this->assertEquals([
            'Interfaces\RepositoryInterOne',
            'Interfaces\RepositoryInterTwo',
            'Interfaces\RepositoryInterThree',
            'Interfaces\RepositoryInterFour',
            'Interfaces\RepositoryInterFive',
        ***REMOVED***, $data);
    }
}
