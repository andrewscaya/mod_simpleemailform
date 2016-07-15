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

    /**
     *
     * @var modSimpleEmailForm
     */
    private $modSimpleEmailFormReflection;

    /**
     * Color argument
     *
     * @var color
     */
    protected $color = 'red';

    /**
     * Message argument
     *
     * @var standardMessage
     */
    protected $standardMessage = 'This is a test';
    protected $nullMessage = null;
    protected $emptyMessage = ' ';

    //
    /**
     * Filename argument
     *
     * @var fn
     */
    protected $fn = 'test.php';
    protected $fnNull = null;
    protected $fnSpace = ' ';

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

        $this->modSimpleEmailFormReflection = new \ReflectionClass($this->modSimpleEmailForm);
        $this->formatErrorMessageMethod = $this->modSimpleEmailFormReflection->getMethod('formatErrorMessage');
        $this->formatErrorMessageMethod->setAccessible(true);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->modSimpleEmailForm = null;

        $this->modSimpleEmailFormReflection = null;

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

    //Three tests to check the function's behaviour with filenames
    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageNoFn()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->standardMessage)
        );
        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->standardMessage</span></b></p>\n",
            $message
        );
    }

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageWithFn()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->standardMessage, $this->fn)
        );
        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->standardMessage ($this->fn)</span></b></p>\n",
            $message
        );
    }

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageInvalidFn()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->standardMessage, $this->fnSpace)
        );
        // @todo
//         $this->assertSame(
//             "<p><b><span style='color:$this->color;'>$this->standardMessage('Warning - Invalid filename: no alnum character')</span></b></p>\n",
//             $message
//         );

        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->standardMessage ( )</span></b></p>\n",
            $message
        );
    }

    //Three tests to ckeck the function's behaviour with messages
    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrornullMessageMessage()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->nullMessage, $this->fn)
        );
        // @todo
//         $this->assertSame(
//             "<p><b><span style='color:$this->color;'>$this->standardMessage('Warning - Invalid filename: no alnum character')</span></b></p>\n",
//             $message
//         );

        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->nullMessage ($this->fn)</span></b></p>\n",
            $message
        );
    }

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageSpaceMessage()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->emptyMessage, $this->fn)
        );
        // @todo
//         $this->assertSame(
//             "<p><b><span style='color:$this->color;'>$this->standardMessage('Warning - Invalid filename: no alnum character')</span></b></p>\n",
//             $message
//         );

        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->emptyMessage ($this->fn)</span></b></p>\n",
            $message
        );
    }

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageRealMessage()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->standardMessage, $this->fn)
        );
        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->standardMessage ($this->fn)</span></b></p>\n",
            $message
        );
    }

    /*
	 * Only important thing with color is that the value is put in its
     * rightful place. Html is valid no matter what the value is.
	 */

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageColor()
    {
        $message = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($this->color, $this->standardMessage, $this->fn)
        );
        $this->assertSame(
            "<p><b><span style='color:$this->color;'>$this->standardMessage ($this->fn)</span></b></p>\n",
            $message
        );
    }

    /**
     * Tests modSimpleEmailForm::main()
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
