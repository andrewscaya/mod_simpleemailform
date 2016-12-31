<?php
/**
 * @package     ModsimpleemailformTest
 * @subpackage
 *
 * @copyright   A copyright
 * @license     A "Slug" license name e.g. GPL2
 */

namespace ModsimpleemailformTest;

use PHPUnit_Framework_TestCase;
use Mockery;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */

/**
 * Sefv2Modsimpleemailform test case.
 */
class sefv2modsimpleemailformfullTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Joomla\Registry\Registry
     * @since 2.0.0
     */
    private $params;

    /**
     * @var sefv2modsimpleemailform
     * @since 2.0.0
     */
    private $sefv2modsimpleemailform;

    /**
     * @var sefv2modsimpleemailform reflection
     * @since 2.0.0
     */
    private $sefv2modsimpleemailformReflection;

    /**
     * @var array (Reflection Properties)
     * @since 2.0.0
     */
    private $sefv2modsimpleemailformProperties = array();

    /**
     * @var array (Reflection Methods)
     * @since 2.0.0
     */
    private $sefv2modsimpleemailformMethods = array();

    /**
     * @var \JApplication
     * @since 2.0.0
     */
    private $jApplicationMock;

    /**
     * @var \JFactory
     * @since 2.0.0
     */
    private $jFactoryMock;

    /**
     * @var \JForm
     * @since 2.0.0
     */
    private $jFormMock;

    /**
     * @var \JMail
     * @since 2.0.0
     */
    private $jMailMock;

    /**
     * @var \sefv2simpleemailformemailmsg
     * @since 2.0.0
     */
    private $emailMsgFake;

    /**
     * @var \JDocument
     * @since 2.0.0
     */
    private $jDocumentMock;

    /**
     * @var \JLanguage
     * @since 2.0.0
     */
    private $jLanguageMock;

    /**
     * @var \JInput
     * @since 2.0.0
     */
    private $jInputMock;

    /**
     * @var \stdClass
     * @since 2.0.0
     */
    private $stdClassModuleHelperResultFake;

    /**
     * @var \JTableExtension
     * @since 2.0.0
     */
    private $jTableExtensionMock;

    /**
     * @var \JTableModule
     * @since 2.0.0
     */
    private $jTableModuleMock;

    /**
     * @var \JModuleHelper
     * @since 2.0.0
     */
    private $jModuleHelperMock;

    /**
     * @var \JTable
     * @since 2.0.0
     */
    private $jTableMock;

    /**
     * @var \JSession
     * @since 2.0.0
     */
    private $jSessionMock;

    /**
     * @var \JFile
     * @since 2.0.0
     */
    private $jFileMock;

    /**
     * Prepares the environment before running a test.
     *
     * @since 2.0.0
     */
    public function setUp()
    {
        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObjectJformFull');

        $this->params = unserialize($paramsSerialized);

        $this->createJoomlaMocksAndFakesForConstruct();

        $this->sefv2modsimpleemailform = new \sefv2modsimpleemailform(
            $this->jFormMock,
            $this->jMailMock,
            $this->emailMsgFake,
            $this->jDocumentMock,
            $this->jLanguageMock,
            $this->params,
            $this->jInputMock,
            $this->jTableExtensionMock,
            $this->jTableModuleMock,
            $this->stdClassModuleHelperResultFake,
            $this->jSessionMock,
            $this->jFileMock
        );

        $this->sefv2modsimpleemailformReflection = new \ReflectionClass($this->sefv2modsimpleemailform);

        $this->setAllPropertiesAccessible();

        $this->setAllMethodsAccessible();
    }

    /**
     * Cleans up the environment after running a test.
     *
     * @since 2.0.0
     */
    public function tearDown()
    {
        $this->sefv2modsimpleemailform = null;

        $this->sefv2modsimpleemailformReflection = null;

        $this->sefv2modsimpleemailformProperties = null;

        $this->sefv2modsimpleemailformMethods = null;

        \Mockery::close();

        parent::tearDown();
    }

    public function setAllPropertiesAccessible()
    {
        $propertiesList = $this->sefv2modsimpleemailformReflection->getProperties();

        for ($i = 0; $i < count($propertiesList); $i++) {
            $key = $propertiesList[$i]->name;
            $this->sefv2modsimpleemailformProperties[$key] = $propertiesList[$i];
            $this->sefv2modsimpleemailformProperties[$key]->setAccessible(true);
        }
    }

    public function setAllMethodsAccessible()
    {
        $methodsList = $this->sefv2modsimpleemailformReflection->getMethods();

        for ($i = 0; $i < count($methodsList); $i++) {
            $key = $methodsList[$i]->name;
            $this->sefv2modsimpleemailformMethods[$key] = $methodsList[$i];
            $this->sefv2modsimpleemailformMethods[$key]->setAccessible(true);
        }
    }

    public function createJoomlaMocksAndFakesForConstruct()
    {
        $this->jFormMock = Mockery::mock('overload:JForm');
        $this->jFormMock->shouldReceive('load')->once()->andReturn(true);

        $this->jFactoryMock = Mockery::mock('overload:JFactory');
        $this->jMailMock = Mockery::mock('overload:JMail');
        $this->jFactoryMock->shouldReceive('getMailer')->once()->andReturn($this->jMailMock);

        $this->emailMsgFake = new \sefv2simpleemailformemailmsg;

        $this->jDocumentMock = Mockery::mock('overload:JDocument');
        $this->jFactoryMock->shouldReceive('getDocument')->once()->andReturn($this->jDocumentMock);
        $this->jLanguageMock = Mockery::mock('overload:JLanguage');
        $this->jLanguageMock->shouldReceive('getTag')->once()->andReturn('en-GB');
        $this->jFactoryMock->shouldReceive('getLanguage')->once()->andReturn($this->jLanguageMock);
        $this->jInputMock = Mockery::mock('overload:JInput');
        $this->jInputMock->shouldReceive('getMethod')->once()->andReturn('POST');
        $jApplicationMock = Mockery::mock('overload:JApplication');
        $jApplicationMock->input = $this->jInputMock;
        $this->jApplicationMock =$jApplicationMock;
        $this->jFactoryMock->shouldReceive('getApplication')->once()->andReturn($this->jApplicationMock);

        $this->stdClassModuleHelperResultFake = new \stdClass;
        $this->stdClassModuleHelperResultFake->id = 93;
        $this->jModuleHelperMock = Mockery::mock('overload:JModuleHelper');
        $this->jModuleHelperMock
            ->shouldReceive('getModule')
            ->with('mod_simpleemailform')
            ->once()
            ->andReturn($this->stdClassModuleHelperResultFake);
        $this->jTableMock = Mockery::mock('overload:JTable');
        $this->jTableExtensionMock = Mockery::mock('overload:JTableExtension');
        $this->jTableExtensionMock->shouldReceive('find')->withArgs(array('element' => 'mod_simpleemailform'))->once()->andReturn(10000);
        $this->jTableExtensionMock->shouldReceive('load')->with(10000)->once()->andReturn(true);
        $this->jTableExtensionMock->shouldReceive('check')->once()->andReturn(true);
        $this->jTableExtensionMock->shouldReceive('store')->once()->andReturn(true);
        $this->jTableMock->shouldReceive('getInstance')->with('extension')->once()->andReturn($this->jTableExtensionMock);
        $this->jTableModuleMock = Mockery::mock('overload:JTableModule');
        $this->jTableModuleMock->shouldReceive('load')->with(93)->once()->andReturn(true);
        $this->jTableModuleMock->shouldReceive('check')->once()->andReturn(true);
        $this->jTableModuleMock->shouldReceive('store')->once()->andReturn(true);
        $this->jTableMock->shouldReceive('getInstance')->with('module')->once()->andReturn($this->jTableModuleMock);

        $this->jSessionMock = Mockery::mock('overload:JSession');
        $this->jSessionMock->shouldReceive('getToken')->once()->andReturn(md5('test'));
        $this->jFactoryMock->shouldReceive('getSession')->once()->andReturn($this->jSessionMock);

        $this->jFileMock = Mockery::mock('overload:JFile');
    }

    /**
     * Tests sefv2modsimpleemailform::__construct()
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstruct()
    {
        $this->assertInstanceOf(
            'sefv2modsimpleemailform',
            $this->sefv2modsimpleemailform
        );
        $this->assertInstanceOf(
            'JForm',
            $this->sefv2modsimpleemailformProperties['jForm']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertInstanceOf(
            'JMail',
            $this->sefv2modsimpleemailformProperties['jMail']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertInstanceOf(
            'sefv2simpleemailformemailmsg',
            $this->sefv2modsimpleemailformProperties['emailMsg']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertInstanceOf(
            'JDocument',
            $this->sefv2modsimpleemailformProperties['jDocument']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertInstanceOf(
            'Joomla\Registry\Registry',
            $this->sefv2modsimpleemailformProperties['params']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertInstanceOf(
            'JInput',
            $this->sefv2modsimpleemailformProperties['jInput']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertSame(
            '1',
            $this->sefv2modsimpleemailformProperties['formInstance']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertEquals(
            8,
            $this->sefv2modsimpleemailformProperties['maxFields']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertSame(
            'en-GB',
            $this->sefv2modsimpleemailformProperties['lang']->getValue($this->sefv2modsimpleemailform)
        );

        $transLang = $this->sefv2modsimpleemailformProperties['transLang']->getValue($this->sefv2modsimpleemailform);

        $this->assertTrue(
            is_array($transLang)
        );
        $this->assertTrue(
            !empty($transLang)
        );
        $this->assertSame(
            'Successfully uploaded',
            $transLang['MOD_SIMPLEEMAILFORM_upload_success']
        );
        $this->assertEquals(
            5,
            count(
                $this->sefv2modsimpleemailformProperties['formActiveElements']->getValue($this->sefv2modsimpleemailform)
            )
        );
        $this->assertEquals(
            5,
            $this->sefv2modsimpleemailformProperties['formActiveElementsCount']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertEquals(
            1,
            preg_match(
                '/<\?xml version="1.0" encoding="UTF-8"\?>/',
                $this->sefv2modsimpleemailformProperties['xmlConfig']->getValue($this->sefv2modsimpleemailform)
            )
        );
    }

    public function testCreateXMLConfig()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $output = $this->sefv2modsimpleemailformMethods['createXMLConfig']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertEquals(
            1,
            preg_match('/<fieldset name="main"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="email"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="text"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="radio"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="email"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="editor"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="list"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="file".+<field.+type="file".+<field.+type="file"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="file".+accept=".html, .odt"/is', $output)
        );

        $this->assertNotEquals(
            1,
            preg_match('/<field.+type="file".+accept=".html,.odt"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="checkbox"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="captcha"/is', $output)
        );

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $fieldUploadAllowedName = $this->sefv2modsimpleemailformProperties['fieldUploadAllowedName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $fieldUploadAllowedName] = '';

        $this->sefv2modsimpleemailformProperties['paramsArray']
            ->setValue($this->sefv2modsimpleemailform, $paramsArray);

        $output2 = $this->sefv2modsimpleemailformMethods['createXMLConfig']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="file".+accept=""/is', $output2)
        );
    }
}
