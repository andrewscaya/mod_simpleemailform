<?php

namespace ModsimpleemailformTest;

use Mockery;
use Joomla\Registry\Registry;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */

/**
 * Helper test case.
 *
 * @since 2.0.0
 */
class sefv2helperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Joomla\Registry\Registry
     * @since 2.0.0
     */
    private $params;

    /**
     *
     * @var sefv2helper
     * @since 2.0.0
     */
    private $sefv2helper;

    /**
     *
     * @var sefv2helper reflection
     * @since 2.0.0
     */
    private $sefv2HelperReflection;

    /**
     * Prepares the environment before running a test.
     *
     * @since 2.0.0
     */
    protected function setUp()
    {
        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObjectJformBasic');

        $this->params = unserialize($paramsSerialized);

        $this->sefv2helper = \sefv2helper::getInstance();

        $this->sefv2HelperReflection = new \ReflectionClass($this->sefv2helper);
    }

    /**
     * Cleans up the environment after running a test.
     *
     * @since 2.0.0
     */
    protected function tearDown()
    {
        $this->sefv2helper = null;

        \Mockery::close();

        parent::tearDown();
    }

    protected function createJoomlaMocks()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('load')->once()->andReturn(true);

        $jFactoryMock = Mockery::mock('overload:JFactory');
        $jMailMock = Mockery::mock('overload:JMail');
        $jFactoryMock->shouldReceive('getMailer')->once()->andReturn($jMailMock);
        $jDocumentMock = Mockery::mock('overload:JDocument');
        $jFactoryMock->shouldReceive('getDocument')->once()->andReturn($jDocumentMock);
        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock->shouldReceive('getTag')->once()->andReturn('en-GB');
        $jFactoryMock->shouldReceive('getLanguage')->once()->andReturn($jLanguageMock);
        $jInputMock = Mockery::mock('overload:JInput');
        $jInputMock->shouldReceive('getMethod')->once()->andReturn('POST');
        $jApplicationMock = Mockery::mock('overload:JApplication');
        $jApplicationMock->input = $jInputMock;
        $jFactoryMock->shouldReceive('getApplication')->once()->andReturn($jApplicationMock);
        $jSessionMock = Mockery::mock('overload:JSession');
        $jFactoryMock->shouldReceive('getSession')->once()->andReturn($jSessionMock);

        /*$stdClassComponentFake = new \stdClass;
        $stdClassComponentFake->id = 10000;
        $jComponentHelperMock = Mockery::mock('overload:JComponentHelper');
        $jComponentHelperMock->shouldReceive('getComponent')->with('mod_simpleemailform')->once()->andReturn($stdClassComponentFake);*/

        $jTableExtensionMock = Mockery::mock('overload:JTableExtension');
        $jTableModuleMock = Mockery::mock('overload:JTableModule');
        $jTableMock = Mockery::mock('overload:JTable');
        $jTableMock->shouldReceive('getInstance')->with('extension')->once()->andReturn($jTableExtensionMock);
        /*$jTableExtensionMock->shouldReceive('load')->with(10000)->once()->andReturn(true);
        $jTableExtensionMock->shouldReceive('check')->once()->andReturn(true);
        $jTableExtensionMock->shouldReceive('store')->once()->andReturn(true);*/
        $jTableMock->shouldReceive('getInstance')->with('module')->once()->andReturn($jTableModuleMock);
        /*$jTableModuleMock->shouldReceive('load')->with(93)->once()->andReturn(true);
        $jTableModuleMock->shouldReceive('check')->once()->andReturn(true);
        $jTableModuleMock->shouldReceive('store')->once()->andReturn(true);*/

        $stdClassModuleHelperResultFake = new \stdClass;
        $stdClassModuleHelperResultFake->id = 93;
        $jModuleHelperMock = Mockery::mock('overload:JModuleHelper');
        $jModuleHelperMock
            ->shouldReceive('getModule')
            ->with('mod_simpleemailform')
            ->once()
            ->andReturn($stdClassModuleHelperResultFake);

        $jFileMock = Mockery::mock('overload:JFile');
    }

    /**
     * Tests static sefv2helper::getInstance()
     *
     * @since 2.0.0
     */
    public function testGetInstanceIfObjectIsOfRightClassAndInterface()
    {
        $this->assertInstanceOf('sefv2helper', $this->sefv2helper);

        $this->assertInstanceOf('sefv2helperfactoryinterface', $this->sefv2helper);
    }

    /**
     * Tests static sefv2helper::buildForm()
     *
     * @since 2.0.0
     *
     * @param string containing the wanted form object's type
     * @param string containing the wanted form object's class name
     *
     * @dataProvider providerTestBuildFormIfCorrespondingObjectsAreReturned
     */
    public function testBuildFormIfCorrespondingObjectsAreReturned($wantedObjectType, $wantedObjectClassName)
    {
        $this->createJoomlaMocks();

        $this->params->set('mod_simpleemailform_formType', $wantedObjectType);

        $formObject = $this->sefv2helper->buildForm($this->params);

        $this->assertInstanceOf($wantedObjectClassName, $formObject);

        $this->assertInstanceOf('sefv2formrendererinterface', $formObject);

        if (get_class($formObject) === 'sefv2modsimpleemailform') {
            $this->assertInstanceOf('sefv2jformproxyinterface', $formObject);
        }
    }

    public function providerTestBuildFormIfCorrespondingObjectsAreReturned()
    {
        return array(
            array(
                'classic',
                'sefmodsimpleemailform',
            ),
            array(
                'jform',
                'sefv2modsimpleemailform',
            ),
            array(
                'shouldreturnclassicbydefault',
                'sefmodsimpleemailform',
            ),
        );
    }

    public function testCloneMethodIsNotAccessible()
    {
        $reflection = new \ReflectionMethod('\sefv2helper', '__clone');
        $this->assertTrue($reflection->isPrivate());
    }
}
