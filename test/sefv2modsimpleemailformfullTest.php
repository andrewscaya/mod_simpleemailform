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
    protected $preserveGlobalState = false;

    protected $runTestInSeparateProcess = true;

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

        // Define directory constant
        defined('MOD_SIMPLEEMAILFORM_DIR')
        || define('MOD_SIMPLEEMAILFORM_DIR', dirname(dirname(__FILE__)));

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

    /**
     * Sets the visibility of all of \sefv2modsimpleemailform object's
     * properties to public.
     *
     * @since 2.0.0
     */
    public function setAllPropertiesAccessible()
    {
        $propertiesList = $this->sefv2modsimpleemailformReflection->getProperties();

        for ($i = 0; $i < count($propertiesList); $i++) {
            $key = $propertiesList[$i]->name;
            $this->sefv2modsimpleemailformProperties[$key] = $propertiesList[$i];
            $this->sefv2modsimpleemailformProperties[$key]->setAccessible(true);
        }
    }

    /**
     * Sets the visibility of all of \sefv2modsimpleemailform object's
     * methods to public.
     *
     * @since 2.0.0
     */
    public function setAllMethodsAccessible()
    {
        $methodsList = $this->sefv2modsimpleemailformReflection->getMethods();

        for ($i = 0; $i < count($methodsList); $i++) {
            $key = $methodsList[$i]->name;
            $this->sefv2modsimpleemailformMethods[$key] = $methodsList[$i];
            $this->sefv2modsimpleemailformMethods[$key]->setAccessible(true);
        }
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's
     * constructor.
     *
     * @since 2.0.0
     */
    public function createJoomlaMocksAndFakesForConstruct()
    {
        $this->jFormMock = Mockery::mock('overload:JForm');
        $this->jFormMock
            ->shouldReceive('load')
            ->once()
            ->andReturn(true);

        $this->jFactoryMock = Mockery::mock('overload:JFactory');
        $this->jMailMock = Mockery::mock('overload:JMail');
        $this->jFactoryMock
            ->shouldReceive('getMailer')
            ->once()
            ->andReturn($this->jMailMock);

        $this->emailMsgFake = new \sefv2simpleemailformemailmsg;

        $this->jDocumentMock = Mockery::mock('overload:JDocument');
        $this->jFactoryMock
            ->shouldReceive('getDocument')
            ->once()
            ->andReturn($this->jDocumentMock);

        $this->jLanguageMock = Mockery::mock('overload:JLanguage');
        $this->jLanguageMock
            ->shouldReceive('getTag')
            ->once()
            ->andReturn('en-GB');
        $this->jFactoryMock
            ->shouldReceive('getLanguage')
            ->once()
            ->andReturn($this->jLanguageMock);

        $this->jInputMock = Mockery::mock('overload:JInput');
        $this->jInputMock
            ->shouldReceive('getMethod')
            ->once()
            ->andReturn('POST');
        $jApplicationMock = Mockery::mock('overload:JApplication');
        $jApplicationMock->input = $this->jInputMock;
        $this->jApplicationMock = $jApplicationMock;
        $this->jFactoryMock
            ->shouldReceive('getApplication')
            ->once()
            ->andReturn($this->jApplicationMock);

        $this->stdClassModuleHelperResultFake = new \stdClass;
        $this->stdClassModuleHelperResultFake->id = 93;
        $this->jModuleHelperMock = Mockery::mock('overload:JModuleHelper');
        $this->jTableMock = Mockery::mock('overload:JTable');
        $this->jTableExtensionMock = Mockery::mock('overload:JTableExtension');
        $this->jTableModuleMock = Mockery::mock('overload:JTableModule');

        $this->jSessionMock = Mockery::mock('overload:JSession');

        $this->jFileMock = Mockery::mock('overload:JFile');
    }

    /**
     * Tests sefv2modsimpleemailform::__construct()
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstruct()
    {
        // Check if all basic values were initialized correctly.
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
            8,
            count(
                $this->sefv2modsimpleemailformProperties['formActiveElements']->getValue($this->sefv2modsimpleemailform)
            )
        );
        $this->assertEquals(
            8,
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

    /**
     * Tests sefv2modsimpleemailform::createXMLConfig(array $paramsArray)
     *
     * @since 2.0.0
     */
    public function testCreateXMLConfigWithAllEightFields()
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
            preg_match('/<field.+type="editor"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="list"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="checkboxes"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="text".+<field.+type="text"/is', $output)
        );

        $this->assertEquals(
            1,
            preg_match(
                '/^<\?xml'
                . '.+?<fieldset name="main"'
                . '.+?type="email"'
                . '.+?type="text"'
                . '.+?type="radio"'
                . '.+?type="editor"'
                . '.+?type="list"'
                . '.+?type="checkboxes"'
                . '.+?type="text"'
                . '.+?type="text"'
                . '.+?type="file"'
                . '.+?type="captcha"'
                . '.+?form>$/is',
                $output
            )
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
    }

    /**
     * Tests sefv2modsimpleemailform::createXMLConfig(array $paramsArray)
     *
     * @since 2.0.0
     */
    public function testCreateXMLConfigIfMethodReadsCorrectlyTheAllowedFileExtensionParameterForUploadFields()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $fieldUploadAllowedName = $this->sefv2modsimpleemailformProperties['fieldUploadAllowedName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $fieldUploadAllowedName] = '';

        $this->sefv2modsimpleemailformProperties['paramsArray']
            ->setValue($this->sefv2modsimpleemailform, $paramsArray);

        $output = $this->sefv2modsimpleemailformMethods['createXMLConfig']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertEquals(
            1,
            preg_match('/<field.+type="file".+accept=""/is', $output)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  )
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithAllEightFieldsAndUploadedFiles()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $files,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jFileMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertTrue($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:green">Successfully uploaded</p>'
            . '<p style="color:green">Successfully uploaded</p>'
            . '<p style="color:green">Successfully uploaded</p>',
            $msg
        );
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  )
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithAllEightFieldsAndUploadedFilesAreOptionalAndOneUploadedFileIsMissing()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $files,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jFileMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files['mod_simpleemailform_upload3_1'] = null;

        $fieldUploadRequiredName = $this->sefv2modsimpleemailformProperties['fieldUploadRequiredName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $fieldUploadRequiredName] = 'N';

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertTrue($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:green">Successfully uploaded</p>'
            . '<p style="color:green">Successfully uploaded</p>',
            $msg
        );
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  )
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithAllEightFieldsAndUploadedFilesAreRequiredAndOneUploadedFileIsMissing()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $files,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jFileMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files['mod_simpleemailform_upload3_1'] = null;

        $fieldUploadRequiredName = $this->sefv2modsimpleemailformProperties['fieldUploadRequiredName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $fieldUploadRequiredName] = 'Y';

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:red">Error uploading file</p>', $msg);
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  )
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithAllEightFieldsAndUploadedFileError()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $files,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jFileMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $this->sefv2modsimpleemailformProperties['msg']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        $files['mod_simpleemailform_upload3_1'] = array(
            'tmp_name' => '/tmp/phpz93m97',
            'error' => 4,
        );

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:red">Error uploading file</p>', $msg);
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's
     * processFormData tests.
     *
     * @since 2.0.0
     */
    public function setUpProcessFormDataTests()
    {
        defined('JVERSION') || define('JVERSION', '3.0');

        $formDataRaw = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'mod_simpleemailform_field3_1' => 'option1',
            'mod_simpleemailform_field4_1' => '<p>This is a test.</p>',
            'mod_simpleemailform_field5_1' => 'Test: option1',
            'mod_simpleemailform_field6_1' => array('option3', 'option4'),
            'mod_simpleemailform_field7_1' => 'Test: option5',
            'mod_simpleemailform_field8_1' => 'Test again',
            'mod_simpleemailform_copyMe_1' => '1',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $formCleanData = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'mod_simpleemailform_field3_1' => 'option1',
            'mod_simpleemailform_field4_1' => '<p>This is a test.</p>',
            'mod_simpleemailform_field5_1' => 'Test: option1',
            'mod_simpleemailform_field6_1' => array('option3', 'option4'),
            'mod_simpleemailform_field7_1' => 'Test: option5',
            'mod_simpleemailform_field8_1' => 'Test again',
            'mod_simpleemailform_copyMe_1' => '1',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $files = array(
            'mod_simpleemailform_upload1_1' => array(
                'name' => 'test1.odt',
                'type' => 'application/vnd.oasis.opendocument.text',
                'tmp_name' => '/tmp/phpHGL8VA',
                'error' => 0,
                'size' => 186609
            ),
            'mod_simpleemailform_upload2_1' => array(
                'name' => 'test2.odt',
                'type' => 'application/vnd.oasis.opendocument.text',
                'tmp_name' => '/tmp/phpyixKxR',
                'error' => 0,
                'size' => 24558
            ),
            'mod_simpleemailform_upload3_1' => array(
                'name' => 'test3.odt',
                'type' => 'application/vnd.oasis.opendocument.text',
                'tmp_name' => '/tmp/phpz93m97',
                'error' => 0,
                'size' => 40488
            ),
        );

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $jSessionMock = $this->jSessionMock;

        $jFormMock = $this->jFormMock;
        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);
        $jFormMock
            ->shouldReceive('bind')
            ->once()
            ->with($formCleanData);

        $jFileMock = $this->jFileMock;
        $jFileMock
            ->shouldReceive('makeSafe')
            ->once()
            ->with('test1.odt')
            ->andReturn('test1.odt');
        $jFileMock
            ->shouldReceive('makeSafe')
            ->once()
            ->with('test2.odt')
            ->andReturn('test2.odt');
        $jFileMock
            ->shouldReceive('makeSafe')
            ->once()
            ->with('test3.odt')
            ->andReturn('test3.odt');
        $jFileMock
            ->shouldReceive('getExt')
            ->once()
            ->with('test1.odt')
            ->andReturn('odt');
        $jFileMock
            ->shouldReceive('getExt')
            ->once()
            ->with('test2.odt')
            ->andReturn('odt');
        $jFileMock
            ->shouldReceive('getExt')
            ->once()
            ->with('test3.odt')
            ->andReturn('odt');
        $jFileMock
            ->shouldReceive('upload')
            ->once()
            ->withArgs(array('/tmp/phpHGL8VA', Mockery::any()))
            ->andReturn(true);
        $jFileMock
            ->shouldReceive('upload')
            ->once()
            ->withArgs(array('/tmp/phpyixKxR', Mockery::any()))
            ->andReturn(true);
        $jFileMock
            ->shouldReceive('upload')
            ->once()
            ->withArgs(array('/tmp/phpz93m97', Mockery::any()))
            ->andReturn(true);

        $jDocumentMock = $this->jDocumentMock;

        $jMailMock = $this->jMailMock;
        $jMailMock
            ->shouldReceive('setSender')
            ->once()
            ->with('root@localhost')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addCC')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addBCC')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setSubject')
            ->once()
            ->with('Test')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: option3 / option4\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('clearAllRecipients')
            ->once();
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->withArgs(array('root@localhost', null))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addReplyTo')
            ->once()
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addAttachment')
            ->times(3)
            ->with(Mockery::any())
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        return array(
            $formDataRaw,
            $formCleanData,
            $files,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jFileMock,
            $jDocumentMock,
            $jMailMock
        );
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithEightFieldsAndJversionIs3()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '3.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );

        $this->assertTrue($output);

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertFalse(is_array($emailMsg->replyTo));
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsAndJversionIsNot3()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '2.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertTrue($output);

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertTrue(is_array($emailMsg->replyTo));
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsWillReturnFalseIfEmailIsNotSent()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(false);

        define('JVERSION', '3.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertFalse($output);
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsAndThreeAttachments()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '3.0');

        $emailMsg->attachment = array('/tmp/test1.odt', '/tmp/test2.odt', '/tmp/test3.odt');

        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test1.odt')
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test2.odt')
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test3.odt')
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertTrue($output);
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsAndThreeAttachmentsAndIncludeArticleTitle()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $addTitleName = $this->sefv2modsimpleemailformProperties['addTitleName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $addTitleName] = 'Y';

        $jDocumentMock
            ->shouldReceive('getTitle')
            ->once()
            ->andReturn('Home: Article');

        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Article Title: Home: Article\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: Test: option3\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '3.0');

        $emailMsg->attachment = array('/tmp/test1.odt', '/tmp/test2.odt', '/tmp/test3.odt');

        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test1.odt')
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test2.odt')
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('addAttachment')
            ->once()
            ->with('/tmp/test3.odt')
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertTrue($output);
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsWillReturnFalseIfEmailIsNotSentWhenDoingCopyme()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jDocumentMock
            ->shouldReceive('getTitle')
            ->once()
            ->andReturn('Home: Article');

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(true);
        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(false);

        define('JVERSION', '3.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertFalse($output);
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsAndAMultiValueInPost()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $formCleanData['mod_simpleemailform_field6_1'] = array('option3', 'option4');

        $jDocumentMock
            ->shouldReceive('getTitle')
            ->once()
            ->andReturn('Home: Article');

        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: option3 / option4\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock);

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '3.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );

        $this->assertTrue($output);

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(
            1,
            preg_match('/Field\s6:\soption3\s\/\soption4/is', $emailMsg->body)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWithAllEightFieldsAndAMultiValueAndHiddenValueInPost()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $formCleanData['mod_simpleemailform_field6_1'] = array('option3', 'option4');

        $paramsArray['mod_simpleemailform_field6active'] = 'H';

        $jDocumentMock
            ->shouldReceive('getTitle')
            ->once()
            ->andReturn('Home: Article');

        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: option3 / option4\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock);

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        define('JVERSION', '3.0');

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );

        $this->assertTrue($output);

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(
            1,
            preg_match('/Field\s6:\soption3\s\/\soption4/is', $emailMsg->body)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  )
     *
     * @since 2.0.0
     */
    public function testSendFormDataWillReturnFalseAndThrowExceptionIfEmailAddressDoesNotExistWhenCopyme()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        define('JVERSION', '3.0');

        $paramsArray[$formPrefixName . $emailToName] = 'thisaddress@doesnotexist';
        $paramsArray[$formPrefixName . $emailCCName] = 'thisaddress@doesnotexist';
        $paramsArray[$formPrefixName . $emailBCCName] = 'thisaddress@doesnotexist';

        $jDocumentMock
            ->shouldReceive('getTitle')
            ->once()
            ->andReturn('Home: Article');

        $jMailMock2 = Mockery::Mock('overload:JMail');
        $jMailMock2
            ->shouldReceive('setSender')
            ->once()
            ->with('root@localhost')
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('setSubject')
            ->once()
            ->with('Test')
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('addRecipient')
            ->once()
            ->with(array('thisaddress@doesnotexist'))
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('addCC')
            ->once()
            ->with(array('thisaddress@doesnotexist'))
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('addBCC')
            ->once()
            ->with(array('thisaddress@doesnotexist'))
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: Test: option3\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('clearAllRecipients')
            ->once();
        $jMailMock2
            ->shouldReceive('addRecipient')
            ->once()
            ->withArgs(array('thisaddress@doesnotexist', null))
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('addReplyTo')
            ->once()
            ->andReturn($jMailMock2);
        $jMailMock2
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock2)
        );

        $this->assertFalse($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:red">Error : Mail Server</p>'
            . '<p style="color:red">SORRY: This email address is invalid!'
            . '  Please re-enter your email address.',
            $msg
        );
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's
     * sendFormData tests.
     *
     * @since 2.0.0
     */
    public function setUpSendFormDataTests()
    {
        $formCleanData = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'mod_simpleemailform_field3_1' => 'option1',
            'mod_simpleemailform_field4_1' => '<p>This is a test.</p>',
            'mod_simpleemailform_field5_1' => 'Test: option1',
            'mod_simpleemailform_field6_1' => 'Test: option3',
            'mod_simpleemailform_field7_1' => 'Test: option5',
            'mod_simpleemailform_field8_1' => 'Test again',
            'mod_simpleemailform_copyMe_1' => '1',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $emailToName = $this->sefv2modsimpleemailformProperties['emailToName']
            ->getValue($this->sefv2modsimpleemailform);

        $emailCCName = $this->sefv2modsimpleemailformProperties['emailCCName']
            ->getValue($this->sefv2modsimpleemailform);

        $emailBCCName = $this->sefv2modsimpleemailformProperties['emailBCCName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formPrefixName . $emailToName] = 'root@localhost';
        $paramsArray[$formPrefixName . $emailCCName] = 'root@localhost';
        $paramsArray[$formPrefixName . $emailBCCName] = 'root@localhost';

        $jDocumentMock = $this->jDocumentMock;

        $jMailMock = $this->jMailMock;
        $jMailMock
            ->shouldReceive('setSender')
            ->once()
            ->with('root@localhost')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addCC')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addBCC')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setSubject')
            ->once()
            ->with('Test')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with(
                "\n"
                . "Test: option1\n"
                . "Comments: <p>This is a test.</p>\n"
                . "Field 5: Test: option1\n"
                . "Field 6: Test: option3\n"
                . "Field 7: Test: option5\n"
                . "Field 8: Test again"
            )
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('clearAllRecipients')
            ->once();
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->withArgs(array('root@localhost', null))
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addReplyTo')
            ->once()
            ->andReturn($jMailMock);

        return array(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $emailCCName,
            $emailBCCName,
            $jDocumentMock,
            $jMailMock
        );
    }
}
