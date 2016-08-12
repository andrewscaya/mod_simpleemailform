<?php

namespace ModSimpleEmailFormTest;

use PHPUnit_Framework_TestCase;
use Mockery;
use \_SimpleEmailForm;
use \modSimpleEmailForm;
use \DOMDocument;
use JFactory;
use JDocument;
use JMail;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */

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
     *
     * @var ReflectionProperty
     */
    private $fieldProperty;

    /**
     *
     * @var ReflectionMethod
     */
    private $formatErrorMessageMethod;

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
    public function testSendResults()
    {
        $this->setFieldPropertyAccessible();

        $msg = new \_SimpleEmailForm();

        $jFactoryMock = Mockery::mock('overload:JFactory');
        $jDocumentMock = Mockery::mock('overload:JDocument');
        $jMailMock = Mockery::mock('overload:JMail');
        $jMailMock->shouldReceive('addRecipient')
                  ->once()
                  ->with($msg->to)
                  ->andReturn(true);
        $jMailMock->shouldReceive('setSender')
                  ->once()
                  ->with($msg->from)
                  ->andReturn(true);
        $jMailMock->shouldReceive('setSubject')
                  ->once()
                  ->with($msg->subject)
                  ->andReturn(true);
        $jMailMock->shouldReceive('setBody')
                  ->once()
                  ->with($msg->body)
                  ->andReturn(true);
        $jMailMock->shouldReceive('send')
                  ->once()
                  ->andReturn(true);
        $jFactoryMock->shouldReceive('getDocument')
            ->once()
            ->andReturn($jDocumentMock);
        $jFactoryMock->shouldReceive('getMailer')
            ->once()
            ->andReturn($jMailMock);

        $result = $this->modSimpleEmailForm->sendResults($msg, $this->fieldProperty->getValue($this->modSimpleEmailForm));

        $this->assertTrue($result);
    }

    protected function setFieldPropertyAccessible()
    {
        $this->fieldProperty = $this->modSimpleEmailFormReflection->getProperty('_field');
        $this->fieldProperty->setAccessible(true);
    }

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
     *
     * Tests if email address is valid
     *
     * @param string representing an email address
     *
     * @dataProvider providerTestIsEmailAddressValid
     */
    public function testIsEmailAddressValid($email)
    {
        $this->assertTrue($this->modSimpleEmailForm->isEmailAddress($email));
    }

    public function providerTestIsEmailAddressValid()
    {
        return array(
            array(
                'test@localhost.localdomain',
            ),
            array(
                'test@127.0.0.1',
            ),
            array(
                $this->getDomainWith63Chars(),
            ),
        );
    }

    /**
     * Tests modSimpleEmailForm::isEmailAddress()
     *
     * Tests if email address is invalid
     *
     * @param string representing an email address
     *
     * @dataProvider providerTestIsEmailAddressInvalid
     */
    public function testIsEmailAddressInvalid($email)
    {
        $this->assertFalse($this->modSimpleEmailForm->isEmailAddress($email));
    }

    public function providerTestIsEmailAddressInvalid()
    {
        return array(
            array(
                '',
            ),
            array(
                'test@',
            ),
            array(
                'test@localhost..localdomain',
            ),
            array(
                'test@-localhost.localdomain',
            ),
            array(
                'test@localhost.localdomain-',
            ),
            array(
                'test.@localhost.localdomain',
            ),
            array(
                'test.@127.0.0.1',
            ),
            array(
                '@localhost.localdomain',
            ),
            array(
                ' @localhost.localdomain',
            ),
            array(
                '@127.0.0.1',
            ),
            array(
                ' @127.0.0.1',
            ),
            array(
                $this->getDomainGreaterThan63(),
            ),
            array(
                $this->getLocalGreaterThan64(),
            ),
        );
    }

    public function getDomainWith63Chars()
    {
        $address = 'test@test.';

        $i = 0;

        while ($i < 63) {
            $address .= 'a';
            $i++;
        }

        return (string) $address;
    }

    /**
     * Invalid email domain address with more than 63 characters
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function getDomainGreaterThan63()
    {
        $address = 'test@test.';

        $i = 0;

        while ($i < 64) {
            $address .= 'a';
            $i++;
        }

        return (string) $address;
    }

    /**
     * Greater than 64 characters long local email address
     *
     * Tests modSimpleEmailForm::isEmailAddress()
     */
    public function getLocalGreaterThan64()
    {
        $address = '';

        $i = 0;

        while ($i < 65) {
            $address .= 'a';
            $i++;
        }

        $address .= '@localhost.localdomain';

        return (string) $address;
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
    public function testFormatErrorMessage($expectedResult, $color, $message, $fn = '')
    {
        $this->setFormatErrorMessageMethodAccessible();

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
            //array(<p><b><span style='color:$this->color;'>$this->standardMessage
            //     ('Warning - Invalid filename: no alnum character')</span></b></p>\n",
            //     $this->color, $this->standardMessage, $this->emptyFn),

            //Three tests to check the behaviour with messages
            //Test 4: Null message - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->nullMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->nullMessage, $this->standardFn),
            // @todo Test 4
            //array("<p><b><span style='color:$this->color;'>Warning - No message sent
            //       ($this->standardFn)</span></b></p>\n",
            //       $this->color, $this->nullMessage, $this->standardFn),
            //Test 5: Message with no alnum character - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->emptyMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->emptyMessage, $this->standardFn),
            //@todo Test 5
            //array("<p><b><span style='color:$this->color;'>Warning - Invalid message: no alnum character
            //       ($this->standardFn)</span></b></p>\n",
            //       $this->color, $this->emptyMessage, $this->standardFn),
            //Test 6: Valid message
            array("<p><b><span style='color:$this->color;'>$this->standardMessage ($this->standardFn)</span></b></p>\n",
                  $this->color, $this->standardMessage, $this->standardFn),
            //No test required for color. Only issue is whether it is put in the right place in the string or not.
            //If it's not, all previous tests will fail.
        );
    }

    protected function setFormatErrorMessageMethodAccessible()
    {
        $this->formatErrorMessageMethod = $this->modSimpleEmailFormReflection->getMethod('formatErrorMessage');
        $this->formatErrorMessageMethod->setAccessible(true);
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
