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
    * formatErrorMessage
    */
    
    //Argument for color
	protected $color = "red";

	//Arguments for message
	protected $standardMessage = "This is a test";
	protected $messageNull = null;
	protected $emptyMessage = " ";
	
	//Arguments for filename
	protected $fn = "test.php";
	protected $fnNull = null;
	protected $fnSpace = " ";

	//Three tests to ckeck the function's behaviour with filenames
	public function testFormatErrorMessageNoFn () {
		$message = formatErrorMessage($this->color, $this->standardMessage);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage</span></b></p>\n", $message);
	}

	public function testFormatErrorMessageWithFn () {
		$message = formatErrorMessage($this->color, $this->standardMessage, $this->fn);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage ($fn)</span></b></p>\n", $message);
	}

	public function testFormatErrorMessageInvalidFn () {
		$message = formatErrorMessage($this->color, $this->standardMessage, $this->fnSpace);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage 
			('Warning - Invalid filename: no alnum character')</span></b></p>\n", $message);
	}

	//Three tests to ckeck the function's behaviour with messages
	public function testFormatErrorMessageNullMessage () {
		$message = formatErrorMessage($this->color, $this->messageNull, $this->fn);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage 
			('Warning - Invalid filename: no alnum character')</span></b></p>\n", $messagee);
	}

	public function testFormatErrorMessageSpaceMessage () {
		$message = formatErrorMessage($this->color, $this->emptyMessage, $this->fn);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage 
			('Warning - Invalid filename: no alnum character')</span></b></p>\n", $message);
	}

	public function testFormatErrorMessageRealMessage () {
		$message = formatErrorMessage($this->color, $this->standardMessage, $this->fn);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage 
			($this->fn)</span></b></p>\n", $message);
	}

	//Only important thing with color is that the value is put in its 
	//rightful place. Html is valid no matter what the value is.
	public function testFormatErrorMessageColor () {
		$message = formatErrorMessage($this->color, $this->standardMessage, $this->fn);
		$this->assertSame("<p><b><span style='color:$this->color;'>$this->standardMessage 
			($this->fn)</span></b></p>\n", $message);
    }
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
