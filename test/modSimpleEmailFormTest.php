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
     * @var Array
     *        ReflectionProperty
     */
    private $modSimpleEmailFormProperties = array();

    /**
     *
     * @var Array
     *        ReflectionMethod
     */
    private $modSimpleEmailFormMethods = array();

    /**
     * Color argument
     *
     * @var string
     */
    protected $color = 'red';

    /**
     * Message argument
     *
     * @var string
     */
    protected $standardMessage = 'This is a test';

    /**
     * Message argument
     *
     * @var null
     */
    protected $nullMessage = null;

    /**
     * Message argument
     *
     * @var string
     */
    protected $emptyMessage = ' ';

    /**
     * Filename argument
     *
     * @var string
     */
    protected $standardFn = 'test.php';

    /**
     * Filename argument
     *
     * @var string
     */
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

        $this->setAllPropertiesAccessible();

        $this->setAllMethodsAccessible();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->modSimpleEmailForm = null;

        $this->modSimpleEmailFormReflection = null;

        $this->modSimpleEmailFormProperties = null;

        $this->modSimpleEmailFormMethods = null;

        \Mockery::close();

        parent::tearDown();
    }

    protected function setAllPropertiesAccessible()
    {
        $propertiesList = $this->modSimpleEmailFormReflection->getProperties();

        for ($i = 0; $i < count($propertiesList); $i++) {
            $key = $propertiesList[$i]->name;
            $this->modSimpleEmailFormProperties[$key] = $propertiesList[$i];
            $this->modSimpleEmailFormProperties[$key]->setAccessible(true);
        }
    }

    protected function setAllMethodsAccessible()
    {
        $methodsList = $this->modSimpleEmailFormReflection->getMethods();

        for ($i = 0; $i < count($methodsList); $i++) {
            $key = $methodsList[$i]->name;
            $this->modSimpleEmailFormMethods[$key] = $methodsList[$i];
            $this->modSimpleEmailFormMethods[$key]->setAccessible(true);
        }
    }

    /**
     * Tests modSimpleEmailForm::__construct()
     */
    public function testmodSimpleEmailFormConstruct()
    {
        $this->assertInstanceOf('modSimpleEmailForm', $this->modSimpleEmailForm);
    }

    /**
     * Tests modSimpleEmailForm::uploadAttachment()
     */
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
     * Tests modSimpleEmailForm::formatRow()
     */
//     public function testFormatRow()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testFormatRow()
//         //$this->markTestIncomplete("formatRow test not implemented");

//         //$this->modSimpleEmailForm->formatRow(/* parameters */);
//         return TRUE;
//     }

    /**
     * Tests modSimpleEmailForm::buildCheckRadioField()
     *
     * @param string containing the expected result
     * @param string signifying form disposition
     * @param string signifying label position
     *
     * @dataProvider providerTestBuildCheckRadioField
     */
    public function testBuildCheckRadioField($expectedResult, $ckRfmt, $ckRpos)
    {
        $fields = $this->modSimpleEmailFormProperties['_field']->getValue($this->modSimpleEmailForm);

        $fields[1]['value'] = array('test' => 'TEST');

        $fields[1]['ckRfmt'] = $ckRfmt;

        $fields[1]['ckRpos'] = $ckRpos;

        $fieldPrefix = $this->modSimpleEmailFormProperties['_fieldPrefix']->getValue($this->modSimpleEmailForm);

        $name = $fieldPrefix . '1_1';

        $output = $this->modSimpleEmailFormMethods['buildCheckRadioField']->invokeArgs(
            $this->modSimpleEmailForm,
            array($fields[1], $name, 'radio', array('test'))
        );

        $doc = new \DOMDocument();
        $doc->loadHTML($output);

        $xpath = new \DOMXPath($doc);

        if (!empty($fields[1]['ckRfmt']) && !empty($fields[1]['ckRpos']) && $fields[1]['ckRfmt'] != 'C') {
            $table = $doc->getElementsByTagName('table')->item(0);
            $node = $xpath->query('*', $table)->item(0)->firstChild;
            $this->assertSame($expectedResult, $node->nodeName);

            if ($fields[1]['ckRpos'] == 'B') {
                $this->assertSame('TEST', substr($node->nodeValue, 4, 4));
                $this->assertEquals(1, preg_match('/TEST.+<input/i', $output));
            } else {
                $node = $doc->getElementsByTagName('th')->item(0);
                $this->assertSame('TEST', substr($node->nodeValue, 4, 4));
                $this->assertEquals(1, preg_match('/<input.+TEST/i', $output));
            }

            $nodeList = $doc->getElementsByTagName('input');
            $this->assertEquals('radio', $nodeList->item(0)->getAttributeNode('type')->value);
            $this->assertEquals('mod_simpleemailform_field1_1_test', $nodeList->item(0)->getAttributeNode('id')->value);
            $this->assertEquals('test', $nodeList->item(0)->getAttributeNode('value')->value);
        } elseif (!empty($fields[1]['ckRfmt']) && !empty($fields[1]['ckRpos']) && $fields[1]['ckRfmt'] == 'C') {
            $span = $doc->getElementsByTagName('span')->item(0);
            $node = $xpath->query('*', $span)->item(0);
            $this->assertSame($expectedResult, $node->nodeName);

            if ($fields[1]['ckRpos'] == 'B') {
                $this->assertSame('TEST', substr($span->nodeValue, 4, 4));
                $this->assertEquals(1, preg_match('/TEST.+<input/i', $output));
            } else {
                $node = $doc->getElementsByTagName('th')->item(0);
                $this->assertSame('TEST', substr($span->nodeValue, 4, 4));
                $this->assertEquals(1, preg_match('/<input.+TEST/i', $output));
            }

            $nodeList = $doc->getElementsByTagName('input');
            $this->assertEquals('radio', $nodeList->item(0)->getAttributeNode('type')->value);
            $this->assertEquals('mod_simpleemailform_field1_1_test', $nodeList->item(0)->getAttributeNode('id')->value);
            $this->assertEquals('test', $nodeList->item(0)->getAttributeNode('value')->value);
        } else {
            $table = $doc->getElementsByTagName('table')->item(0);
            $node = $xpath->query('*', $table)->item(0)->firstChild;
            $this->assertSame($expectedResult, $node->nodeName);

            $nodeList = $doc->getElementsByTagName('td');
            $this->assertEquals('Undefined', $nodeList->item(0)->nodeValue);
        }
    }

    public function providerTestBuildCheckRadioField()
    {
        return array(
            array(
                'th', 'H', 'B'
            ),
            array(
                'td', 'H', 'A'
            ),
            array(
                'th', 'V', 'B'
            ),
            array(
                'td', 'V', 'A'
            ),
            array(
                'input', 'C', 'B'
            ),
            array(
                'input', 'C', 'A'
            ),
            array(
                'td', '', ''
            ),
        );
    }

    /**
     * Tests modSimpleEmailForm::sendResults()
     */
    public function testSendResults()
    {
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

        $result = $this->modSimpleEmailForm->sendResults($msg, $this->modSimpleEmailFormProperties['_field']->getValue($this->modSimpleEmailForm));

        $this->assertTrue($result);
    }

    /**
     * Tests modSimpleEmailForm::imageCaptcha()
     */
//     public function testImageCaptcha()
//     {
//         // TODO Auto-generated modSimpleEmailFormTest->testImageCaptcha()
//         $this->markTestIncomplete("imageCaptcha test not implemented");

//         $this->modSimpleEmailForm->imageCaptcha(/* parameters */);
//     }

    /**
     * Tests modSimpleEmailForm::textCaptcha()
     *
     * @param int representing the captcha's length
     *
     * @dataProvider providerTestTextCaptcha
     */
    public function testTextCaptcha($captchaLen)
    {
        $textCaptcha = '';
        $match = '';
        $output = $this->modSimpleEmailForm->textCaptcha('white', $captchaLen, 1, 'red', 1, $textCaptcha);
        $this->assertEquals($captchaLen, strlen($output));

        //@todo This part depends on styling being implemented in modSimpleEmailForm::textCaptcha()
        //$doc = new \DOMDocument();
        //$doc->loadHTML($output);

        //$spanNode = $doc->getElementsByTagName('span')->item(0);

        //$spanCss = $spanNode->item(0)->getAttributeNode('style')->value;

        //$this->assertEquals(1, preg_match('/background-color: red/i', $spanCss));
        //$this->assertEquals(1, preg_match('/color: white/i', $spanCss));
        //$this->assertEquals($captchaLen, strlen($spanNode->nodeValue));
        //@todo Check captcha size
    }

    public function providerTestTextCaptcha()
    {
        return array(
            array(
                rand(4, 20)
            ),
            array(
                rand(4, 20)
            ),
            array(
                rand(4, 20)
            ),
        );
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
        $actualResult = $this->modSimpleEmailFormMethods['formatErrorMessage']->invokeArgs(
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

    public function testAutoResetForm()
    {
        $_POST = [1, 2, 3];

        $this->modSimpleEmailFormMethods['autoResetForm']->invokeArgs(
            $this->modSimpleEmailForm,
            array()
        );

        foreach ($_POST as $key => $value) {
            $this->assertTrue(empty($_POST[$key]));
        }
    }

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
     * Tests modSimpleEmailForm::renderCaptcha()
     */
    public function testRenderCaptcha()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $output = $this->modSimpleEmailFormMethods['renderCaptcha']->invokeArgs(
            $this->modSimpleEmailForm,
            array()
        );

        $doc = new \DOMDocument();
        $doc->loadHTML($output);
        $captchaInputNode = $doc->getElementsByTagName('input')->item(0);
        $this->assertSame('mod_simpleemailform_captcha_1', $captchaInputNode->getAttributeNode('name')->value);
    }

    /**
     * Tests modSimpleEmailForm::cleanupCaptchas()
     */
    public function testCleanupCaptchas()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';

        $output = $this->modSimpleEmailFormMethods['cleanupCaptchas']->invokeArgs(
            $this->modSimpleEmailForm,
            array()
        );

        $doc = new \DOMDocument();
        $doc->loadHTML($output);
        $spanNode = $doc->getElementsByTagName('span')->item(0);
        $this->assertSame('Unable to cleanup old CAPTCHAs', $spanNode->nodeValue);
    }

    /**
     * Tests modSimpleEmailForm::compareCsrfHash()
     *
     * @param bool representing the expected result
     * @param string representing the form's CSRF
     * @param string representing the session's CSRF
     *
     * @dataProvider providerTestCompareCsrfHash
     */
    public function testCompareCsrfHash($expected, $formCsrf, $formSess)
    {
        $csrfFieldValue = $this->modSimpleEmailFormProperties['_csrfField']->getValue($this->modSimpleEmailForm);

        $_POST[$csrfFieldValue] = $formCsrf;

        $_SESSION[$csrfFieldValue] = $formSess;

        $output = $this->modSimpleEmailFormMethods['compareCsrfHash']->invokeArgs(
            $this->modSimpleEmailForm,
            array()
        );

        if ($expected) {
            $this->assertTrue($output);
        } else {
            $this->assertFalse($output);
        }
    }

    public function providerTestCompareCsrfHash()
    {
        $string1 = substr(str_shuffle(MD5(microtime())), 0, 10);
        $string2 = substr(str_shuffle(MD5(microtime())), 0, 10);

        return array(
            array(
                true, $string1, $string1
            ),
            array(
                false, $string1, $string2
            ),
            array(
                false, $string2, $string1
            ),
            array(
                false, null, $string1
            ),
            array(
                false, $string2, null
            ),
            array(
                false, null, null
            ),
        );
    }

    /**
     * Tests modSimpleEmailForm::main()
     */
    public function testMainReturnValueWithoutSubmit()
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($this->modSimpleEmailForm->main());
        $nodeList = $doc->getElementsByTagName('form');
        $this->assertEquals(1, count($nodeList));
        $this->assertEquals('post', $nodeList->item(0)->getAttributeNode('method')->value);
    }

    /**
     * Tests modSimpleEmailForm::main()
     */
    public function testMainReturnValueWithSubmit()
    {
        $csrfFieldValue = $this->modSimpleEmailFormProperties['_csrfField']->getValue($this->modSimpleEmailForm);
        $msgValue = $this->modSimpleEmailFormProperties['_msg']->getValue($this->modSimpleEmailForm);

        $_POST['mod_simpleemailform_submit_1'] = true;
        $_POST[$csrfFieldValue] = 'test';
        $_SESSION[$csrfFieldValue] = 'test';

        $this->modSimpleEmailForm->main();

        /* @todo assertions */
    }

    /**
     * Tests modSimpleEmailForm::main()
     */
    public function testMainTestModeFalse()
    {
        ini_set('display_errors', 0);
        $this->modSimpleEmailFormProperties['_testMode']->setValue($this->modSimpleEmailForm, 'N');
        $this->modSimpleEmailForm->main();
        $this->assertSame('0', ini_get('display_errors'));
    }

    /**
     * Tests modSimpleEmailForm::main()
     */
    public function testMainTestModeTrue()
    {
        ini_set('display_errors', 0);
        $this->modSimpleEmailFormProperties['_testMode']->setValue($this->modSimpleEmailForm, 'Y');
        $this->modSimpleEmailForm->main();
        $this->assertSame('1', ini_get('display_errors'));
    }
}
