<?php

namespace ModsimpleemailformTest;

use Mockery;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */

/**
 * Helper test case.
 */
class sefhelperTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Joomla\Registry\Registry
     */
    private $params;

    /**
     *
     * @var Modsimpleemailform
     */
    private $helper;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObject');

        $this->params = unserialize($paramsSerialized);

        $this->helper = \sefhelper::getInstance();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->helper = null;

        \Mockery::close();

        parent::tearDown();
    }

    protected function createJoomlaMocks()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('getInstance')->once()->andReturn($jFormMock);

        $jMailMock = Mockery::mock('overload:JMail');
        $jMailMock->shouldReceive('getInstance')->once()->andReturn($jMailMock);

        $jDocumentMock = Mockery::mock('overload:JDocument');
        $jFactoryMock = Mockery::mock('overload:JFactory');
        $jFactoryMock->shouldReceive('getDocument')->once()->andReturn($jDocumentMock);
    }

    /**
     * Tests static Modsimpleemailform::getInstance()
     */
    public function testGetInstanceIfObjectIsOfRightClassAndInterface()
    {
        $this->assertInstanceOf('sefhelper', $this->helper);

        $this->assertInstanceOf('sefv2helperfactoryinterface', $this->helper);
    }

    /**
     * Tests static Modsimpleemailform::buildForm()
     *
     * @param string containing the wanted form object's type
     * @param string containing the wanted form object's class name
     *
     * @dataProvider providerTestBuildFormIfClassicSefIsReturned
     */
    public function testBuildFormIfCorrespondingObjectsAreReturned($wantedObjectType, $wantedObjectClassName)
    {
        $this->createJoomlaMocks();

        $this->params->set('mod_simpleemailform_formType', $wantedObjectType);

        $formObject = $this->helper->buildForm($this->params);

        $this->assertInstanceOf($wantedObjectClassName, $formObject);

        $this->assertInstanceOf('sefv2formrendererinterface', $formObject);

        if (get_class($formObject) === 'sefv2modsimpleemailform') {
            $this->assertInstanceOf('sefv2jformproxyinterface', $formObject);
        }
    }

    public function providerTestBuildFormIfClassicSefIsReturned()
    {
        return array(
            array(
                'classic',
                'sefmodsimpleemailform'
            ),
            array(
                'jform',
                'sefv2modsimpleemailform'
            ),
            array(
                'shouldreturnclassicbydefault',
                'sefmodsimpleemailform'
            ),
        );
    }
}
