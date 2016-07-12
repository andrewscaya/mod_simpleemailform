<?php

/**
 * modSimpleEmailForm test case.
 */
class modSimpleEmailFormTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var modSimpleEmailForm
     */
    private $modSimpleEmailForm;

    public $object;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObject');
        $params = unserialize($paramsSerialized);

        $message = '';

        $this->modSimpleEmailForm = new modSimpleEmailForm($params);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->modSimpleEmailForm = null;

        parent::tearDown();
    }

    public function testmodSimpleEmailFormConstruct()
    {
        $this->assertInstanceOf('modSimpleEmailForm', $this->modSimpleEmailForm);
    }

    public function testAllPhptFiles()
    {
        $tests = glob('test/phpt/*.phpt');

        $output = array();

        foreach ($tests as $file) {
            exec("pear run-tests $file", $output);
            $this->assertTrue(in_array('1 PASSED TESTS', $output));
        }
    }

    /**
     * Tests modSimpleEmailForm->formatRow()
     */
//     public function testFormatRow()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testFormatRow()
//         //$this->markTestIncomplete("formatRow test not implemented");

//         //$this->modSimpleEmailForm->formatRow(/* parameters */);
//         return TRUE;
//     }

    /**
     * Tests modSimpleEmailForm->sendResults()
     */
//     public function testSendResults()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testSendResults()
//         $this->markTestIncomplete("sendResults test not implemented");

//         $this->modSimpleEmailForm->sendResults(/* parameters */);
//     }

    /**
     * Tests modSimpleEmailForm->imageCaptcha()
     */
//     public function testImageCaptcha()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testImageCaptcha()
//         $this->markTestIncomplete("imageCaptcha test not implemented");

//         $this->modSimpleEmailForm->imageCaptcha(/* parameters */);
//     }

    /**
     * Tests modSimpleEmailForm->textCaptcha()
     */
//     public function testTextCaptcha()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testTextCaptcha()
//         $this->markTestIncomplete("textCaptcha test not implemented");

//         $this->modSimpleEmailForm->textCaptcha(/* parameters */);
//     }

    /**
     * Tests modSimpleEmailForm::isEmailAddress()
     */
//     public function testIsEmailAddress()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest::testIsEmailAddress()
//         $this->markTestIncomplete("isEmailAddress test not implemented");

//         modSimpleEmailForm::isEmailAddress(/* parameters */);
//     }

    /**
     * Tests modSimpleEmailForm->main()
     */
    public function testMain()
    {
        $doc = new DOMDocument();
        $doc->loadHTML($this->modSimpleEmailForm->main());
        $nodeList = $doc->getElementsByTagName('form');
        $this->assertEquals(1, count($nodeList));
        $this->assertEquals('post', $nodeList->item(0)->getAttributeNode('method')->value);
    }
}
