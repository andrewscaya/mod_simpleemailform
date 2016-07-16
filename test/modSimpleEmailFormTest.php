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
     * Valid email address
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddress()
    {
        $this->assertTrue($this->modSimpleEmailForm->isEmailAddress('test@localhost.localdomain'));
    }

    /**
     * Empty email address
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressEmptyAddress()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress(''));
    }

    /**
     * Invalid email domain address with less than one character
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidDomainLessThanOne()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test@'));
    }

    /**
     * Valid email domain address with 63 characters
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressValidDomainWith63()
    {
        $address = 'test@test.';

        $i = 0;

        while ($i < 63) {
            $address .= 'a';

            $i++;
        }

        $this->assertTrue($this->modSimpleEmailForm->isEmailAddress($address));
    }

    /**
     * Invalid email domain address with more than 63 characters
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidDomainGreaterThan63()
    {
        $address = 'test@test.';

        $i = 0;

        while ($i < 64) {
            $address .= 'a';

            $i++;
        }

        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress($address));
    }

    /**
     * Invalid email domain address with empty part
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidDomainEmptyPart()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test@localhost..localdomain'));
    }

    /**
     * Invalid email domain address that begins with a dash
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidDomainBeginsDash()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test@-localhost.localdomain'));
    }

    /**
     * Invalid email domain address that ends with a dash
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidDomainEndsDash()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test@localhost.localdomain-'));
    }

    /**
     * Email address with IP address as domain
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressWithIPDomain()
    {
        $this->assertTrue($this->modSimpleEmailForm->isEmailAddress('test@127.0.0.1'));
    }

    /**
     * Invalid local email address that ends with a dot
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidLocalThatEndsWithDot()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test.@local'));
    }

    /**
     * Invalid local email address with IP address as domain
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressInvalidLocalWithIPDomain()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('test.@127.0.0.1'));
    }

    /**
     * Empty local email address
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressEmptyLocal()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('@localhost.localdomain'));
    }

    /**
     * Local email address with space
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressLocalWithSpace()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress(' @localhost.localdomain'));
    }

    /**
     * Greater than 64 characters long local email address
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressLocalGreaterThan64()
    {
        $address = '';

        $i = 0;

        while ($i < 65) {
            $address .= 'a';

            $i++;
        }

        $address .= '@localhost.localdomain';

        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress($address));
    }

    /**
     * Empty local email address with IP address as domain
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function testIsEmailAddressEmptyLocalWithIPDomain()
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress('@127.0.0.1'));
    }

    protected function setformatErrorMessageMethodAccessible()
    {
        $this->formatErrorMessageMethod = $this->modSimpleEmailFormReflection->getMethod('formatErrorMessage');
        $this->formatErrorMessageMethod->setAccessible(true);
    }

    //Three tests to check the function's behaviour with filenames
    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */
    public function testFormatErrorMessageNoFn()
    {
        $this->setformatErrorMessageMethodAccessible();

        $this->formatErrorMessageMethod = $this->modSimpleEmailFormReflection->getMethod('formatErrorMessage');
        $this->formatErrorMessageMethod->setAccessible(true);

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
        $this->setformatErrorMessageMethodAccessible();

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
        $this->setformatErrorMessageMethodAccessible();

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
        $this->setformatErrorMessageMethodAccessible();

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
        $this->setformatErrorMessageMethodAccessible();

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
        $this->setformatErrorMessageMethodAccessible();

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
        $this->setformatErrorMessageMethodAccessible();

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
