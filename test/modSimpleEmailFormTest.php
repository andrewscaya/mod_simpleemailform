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
     * @var nullMessage
     * @var emptyMessage
     */
    protected $standardMessage = 'This is a test';
    protected $nullMessage = null;
    protected $emptyMessage = ' ';

    //
    /**
     * Filename argument
     *
     * @var standardFn
     * @var emptyFn
     */
    protected $standardFn = 'test.php';
    protected $emptyFn = ' ';

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
        
        $this->formatErrorMessageMethod = null;

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
            $key = array_search('1 FAILED TESTS:', $output);
            if ($key) {
                $key++;
                echo PHP_EOL . 'FAILED PHPT: ' . $output[$key] . PHP_EOL;
            }
            $this->assertTrue(!in_array('1 FAILED TESTS:', $output));
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

    /**
     * Tests modSimpleEmailForm::FormatErrorMessage()
     */

    /**
    * @param string we expect to be returned by formatErrorMessage
    * @param string representing the color sent as an argument to formatErrorMessage
    * @param string representing the message sent as an argument to formatErrorMessage
    * @param string representing the filename sent as an argument to formatErrorMessage
    
    * @dataProvider providerTestFormatErrorMessage
    */
    public function testFormatErrorMessage ($expectedResult, $color, $message, $fn = '')
    {
        $actualResult = $this->formatErrorMessageMethod->invokeArgs(
            $this->modSimpleEmailForm,
            array($color, $message, $fn)
        );
        
        $this->assertSame($expectedResult, $actualResult);
    }
    
    public function providerTestFormatErrorMessage()
    {
        return array(
            //Three tests to check the behaviour with filenames
            //Test 1: Valid without filename
            array("<p><b><span style='color:$this->color;'>$this->standardMessage</span></b></p>\n", 
                  $this->color, $this->standardMessage),
            //Test 2: Valid with filename
            array("<p><b><span style='color:$this->color;'>$this->standardMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->standardMessage, $this->standardFn),
            //Test 3: Invalid filename - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->standardMessage ( )</span></b></p>\n", 
                  $this->color, $this->standardMessage, $this->emptyFn),
            //@todo Test 3
//            array(<p><b><span style='color:$this->color;'>$this->standardMessage
//                  ('Warning - Invalid filename: no alnum character')</span></b></p>\n",
//                  $this->color, $this->standardMessage, $this->emptyFn),
            
            //Three tests to check the behaviour with messages
            //Test 4: Null message - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->nullMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->nullMessage, $this->standardFn),
            // @todo Test 4
//            array("<p><b><span style='color:$this->color;'>Warning - No message sent
//                    ($this->standardFn)</span></b></p>\n",
//                    $this->color, $this->nullMessage, $this->standardFn),
            //Test 5: Message with no alnum character - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->emptyMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->emptyMessage, $this->standardFn),
            //@todo Test 5
//            array("<p><b><span style='color:$this->color;'>Warning - Invalid message: no alnum character
//                    ($this->standardFn)</span></b></p>\n", 
//                    $this->color, $this->emptyMessage, $this->standardFn),
            //Test 6: Valid message
            array("<p><b><span style='color:$this->color;'>$this->standardMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->standardMessage, $this->standardFn),
            //No test required for color. Only issue is whether it is put in the right place in the string or not.
            //If it's not, all previous tests will fail.
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
