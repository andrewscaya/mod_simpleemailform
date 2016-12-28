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
class sefv2modsimpleemailformTest extends PHPUnit_Framework_TestCase
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

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObject');

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
            $this->jSession
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
            $this->sefv2modsimpleemailformProperties['instance']->getValue($this->sefv2modsimpleemailform)
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
            2,
            count(
                $this->sefv2modsimpleemailformProperties['activeElements']->getValue($this->sefv2modsimpleemailform)
            )
        );
        $this->assertEquals(
            2,
            $this->sefv2modsimpleemailformProperties['activeElementsCount']->getValue($this->sefv2modsimpleemailform)
        );
        $this->assertEquals(
            1,
            preg_match(
                '/<\?xml version="1.0" encoding="UTF-8"\?>/',
                $this->sefv2modsimpleemailformProperties['xmlConfig']->getValue($this->sefv2modsimpleemailform)
            )
        );
    }

    public function testBindProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('bind')->once();

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->bind(array());
    }

    /*public function testCreateXMLConfig(array $paramsArray)
    {

    }*/

    public function testDecorateInput()
    {
        $input = '<input 
                    name="mod_simpleemailform_field2_1" 
                    id="mod_simpleemailform_field2_1"
                    value=""
                    class="required"
                    size="40"
                    required=""
                    aria-required="true"
                    type="text">';

        $output = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input)
        );

        $this->assertEquals(
            1,
            preg_match(
                '/<tr class="mod_sef_tr"><td class="mod_sef_td"><input/',
                $output
            )
        );

        $label = 'My Field';

        $output2 = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input, $label)
        );

        $this->assertEquals(
            1,
            preg_match(
                '/<th.+My Field.+<input/s',
                $output2
            )
        );
    }

    public function testDetermineActiveElementsTrue()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $output = $this->sefv2modsimpleemailformMethods['determineActiveElements']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertTrue($output);

        $activeElements = $this->sefv2modsimpleemailformProperties['activeElements']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(2, count($activeElements));
    }

    public function testDetermineActiveElementsFalse()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray['mod_simpleemailform_field1active'] = 'N';
        $paramsArray['mod_simpleemailform_field2active'] = 'N';

        $output = $this->sefv2modsimpleemailformMethods['determineActiveElements']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertFalse($output);

        $activeElements = $this->sefv2modsimpleemailformProperties['activeElements']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(0, count($activeElements));
    }

    public function testFilterProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('filter')->once();

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->filter(array());
    }

    public function testGetDataProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('getData')->once();

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getData();
    }

    public function testGetErrorsProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('getErrors')->once();

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getErrors();
    }

    public function testGetFieldProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('getField')->once()->withArgs(array('test', null, null));

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getField('test');
    }

    public function testGetFieldsetProxy($set = null)
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('getFieldset')->once()->with('main');

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getFieldset('main');
    }

    /*public function testGetXMLField($active, $name, $label, $value, $size, $maxx, $from)
    {

    }

    public function testGetXMLUploadField($uploadName, $uploadLabel, $uploadAllowedFiles)
    {

    }

    public function testGetXMLCaptchaField($name, $namespace)
    {

    }*/

    public function testLoadProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('load')->once()->with('test');

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->load('test');
    }

    /*public function testProcessFormData()
    {
        $_POST = array(
            'mod_simpleemailform_field1_1' => 'admin@localhost.localdomain',
            'mod_simpleemailform_field2_1' => 'Test',
            'mod_simpleemailform_field3_1' => 'option1',
            'mod_simpleemailform_field4_1' => '<p>This is a test.</p>',
            'mod_simpleemailform_copyMe_1' => '1',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );
    }*/

    public function testRemoveFieldProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('removeField')->once()->withArgs(array('test', null));

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->removeField('test');
    }

    public function testRender()
    {
        $jFormMock = $this->sefv2modsimpleemailformProperties['jForm']->getValue($this->sefv2modsimpleemailform);
        $jFormMock->shouldReceive('getFieldset')->once()->with('main')->andReturn(array());

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $jHtmlMock = Mockery::mock('alias:JHtml');
        $jHtmlMock->shouldReceive('_')->once()->with('form.token')->andReturn('qwerty');

        $output = $this->sefv2modsimpleemailform->render();

        $this->assertTrue((!empty($output)));

        $this->assertEquals(1, preg_match('/<div class="mod_sef">/', $output));

        $this->assertEquals(0, strpos($output, '/<div class="mod_sef">/'));
    }

    public function testResetProxy($xml = false)
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('reset')->once()->with(null);

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->reset();
    }

    /*public function testSendFormData(array $formDataClean, stdClass $emailMsg, array $paramsArray)
    {

    }*/

    public function testTestDump()
    {
        $output = $this->sefv2modsimpleemailformMethods['testDump']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($this->sefv2modsimpleemailform)
        );

        $this->assertEquals(1, preg_match('/Object \(sefv2modsimpleemailform\)/', $output));
    }

    public function testUploadFile()
    {
        $return_value_generator = function () {
            static $counter = 0;

            $counter++;

            switch ($counter) {
                case 1:
                    return true;
                case 2:
                    return false;
                default:
                    throw new Exception("Should never reach this.");
            }
        };

        $filename = 'desttestfile.txt';
        $fileTmpName = '/tmp/temptestfile.txt';

        $jFileMock = Mockery::mock('alias:JFile');
        $jFileMock->shouldReceive('makeSafe')
            ->times(3)
            ->with($filename)
            ->andReturn($filename);

        $jFileMock->shouldReceive('getExt')
            ->times(3)
            ->with($filename)
            ->andReturn('txt');

        $jFileMock->shouldReceive('upload')
            ->twice()
            ->withArgs(array($fileTmpName, Mockery::any()))
            ->andReturnUsing($return_value_generator);

        $output = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName)
        );
        $this->assertTrue($output);
        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);
        $this->assertEquals(1, count($emailMsg->attachment));

        $this->sefv2modsimpleemailformProperties['uploadAllowedFilesArray']
            ->setValue($this->sefv2modsimpleemailform, array('.doc'));
        $output2 = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName)
        );
        $this->assertFalse($output2);

        $output3 = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName)
        );
        $this->assertFalse($output3);
    }

    public function testValidateProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('validate')->once()->withArgs(array(array(), null));

        $this->sefv2modsimpleemailformProperties['jForm']->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->validate(array());
    }
}
