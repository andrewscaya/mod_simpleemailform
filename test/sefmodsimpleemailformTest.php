<?php

namespace ModsimpleemailformTest;

use PHPUnit_Framework_TestCase;
use Mockery;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */

/**
 * SefModsimpleemailform test case.
 *
 * @since 1.8.8
 */
class sefmodsimpleemailformTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Joomla\Registry\Registry
     * @since 1.8.8
     */
    private $params;

    /**
     * @var sefmodsimpleemailform
     * @since 1.8.8
     */
    private $modsimpleemailform;

    /**
     * @var sefmodsimpleemailform
     * @since 1.8.8
     */
    private $modsimpleemailformReflection;

    /**
     * @var array (Reflection Properties)
     * @since 1.8.8
     */
    private $modsimpleemailformProperties = array();

    /**
     * @var array (Reflection Methods)
     * @since 1.8.8
     */
    private $modsimpleemailformMethods = array();

    /**
     * Color argument
     *
     * @var string
     * @since 1.8.8
     */
    protected $color = 'red';

    /**
     * Message argument
     *
     * @var string
     * @since 1.8.8
     */
    protected $standardMessage = 'This is a test';

    /**
     * Message argument
     *
     * @var null
     * @since 1.8.8
     */
    protected $nullMessage = null;

    /**
     * Message argument
     *
     * @var string
     * @since 1.8.8
     */
    protected $emptyMessage = ' ';

    /**
     * Filename argument
     *
     * @var string
     * @since 1.8.8
     */
    protected $standardFn = 'test.php';

    /**
     * Filename argument
     *
     * @var string
     * @since 1.8.8
     */
    protected $emptyFn = ' ';

    /**
     * Prepares the environment before running a test.
     *
     * @since 1.8.8
     */
    protected function setUp()
    {
        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObjectClassicBasic');

        $this->params = unserialize($paramsSerialized);

        $this->modsimpleemailform = new \sefmodsimpleemailform($this->params);

        $this->modsimpleemailformReflection = new \ReflectionClass($this->modsimpleemailform);

        $this->setAllPropertiesAccessible();

        $this->setAllMethodsAccessible();
    }

    /**
     * Cleans up the environment after running a test.
     *
     * @since 1.8.8
     */
    protected function tearDown()
    {
        parent::tearDown();

        \Mockery::close();

        $this->modsimpleemailform = null;

        $this->modsimpleemailformReflection = null;

        $this->modsimpleemailformProperties = null;

        $this->modsimpleemailformMethods = null;
    }

    protected function setAllPropertiesAccessible()
    {
        $propertiesList = $this->modsimpleemailformReflection->getProperties();

        for ($i = 0; $i < count($propertiesList); $i++) {
            $key = $propertiesList[$i]->name;
            $this->modsimpleemailformProperties[$key] = $propertiesList[$i];
            $this->modsimpleemailformProperties[$key]->setAccessible(true);
        }
    }

    protected function setAllMethodsAccessible()
    {
        $methodsList = $this->modsimpleemailformReflection->getMethods();

        for ($i = 0; $i < count($methodsList); $i++) {
            $key = $methodsList[$i]->name;
            $this->modsimpleemailformMethods[$key] = $methodsList[$i];
            $this->modsimpleemailformMethods[$key]->setAccessible(true);
        }
    }

    /**
     * Tests sefmodsimpleemailform::__construct()
     *
     * @since 1.8.8
     */
    public function testModsimpleemailformConstruct()
    {
        $this->assertInstanceOf('sefmodsimpleemailform', $this->modsimpleemailform);
    }

    /**
     * Tests sefmodsimpleemailform::uploadAttachment()
     *
     * @since 1.8.8
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
     * Tests sefmodsimpleemailform::formatRow()
     *
     * @since 1.8.8
     *
     * @param string containing the expected result
     * @param string signifying object's $_field property value
     *
     * @dataProvider providerTestFormatRow
     */
    public function testFormatRow($expectedResult, $fieldPropertyValue)
    {
        // @TODO $_POST cannot be an array - code in helper.php will have to be modified in a future version - lines 402-411
        $_POST['mod_simpleemailform_field1_1'] = 'TEST_POST';

        $this->modsimpleemailformProperties['_maxFields']->setValue($this->modsimpleemailform, 1);

        $this->modsimpleemailformProperties['_field']->setValue($this->modsimpleemailform, null);

        $this->modsimpleemailformProperties['_field']->setValue($this->modsimpleemailform, $fieldPropertyValue);

        $output = $this->modsimpleemailform->formatRow();

        $this->assertTrue(is_string($output));

        if (strlen($output) < 1) {
            $this->assertEquals($expectedResult, strlen($output));
        } else {
            $this->assertEquals(1, preg_match("/$expectedResult/i", $output));
        }
    }

    public function providerTestFormatRow()
    {
        return array(
            array(
                '<input type="email"',
                array(
                    1 => array(
                        'value' => '',
                        'size' => 40,
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'F',
                    )
                ),

            ),
            array(
                '<textarea',
                array(
                    1 => array(
                        'value' => '',
                        'size' => '4, 40',
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'A',
                    )
                ),

            ),
            array(
                '<option value="testkey">TEST<\/option>',
                array(
                    1 => array(
                        'value' => array('testkey' => 'TEST'),
                        'size' => 40,
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'D',
                    )
                ),

            ),
            array(
                '<span.+TEST.+input type="radio"',
                array(
                    1 => array(
                        'value' => array('TEST'),
                        'size' => 40,
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'R',
                    )
                ),

            ),
            array(
                '<span.+TEST.+input type="checkbox"',
                array(
                    1 => array(
                        'value' => array('TEST'),
                        'size' => 40,
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'C',
                    )
                ),

            ),
            array(
                '<input type="phone"',
                array(
                    1 => array(
                        'value' => '',
                        'size' => 40,
                        'error' => '',
                        'maxx' => 255,
                        'label' => 'From',
                        'ckRfmt' => 'C',
                        'ckRpos' => 'B',
                        'active' => 'R',
                        'from' => 'U',
                    )
                ),

            ),
            array(
                0,
                null,
            ),
        );
    }

    /**
     * Tests sefmodsimpleemailform::buildCheckRadioField()
     *
     * @since 1.8.8
     *
     * @param string containing the expected result
     * @param string signifying form disposition
     * @param string signifying label position
     *
     * @dataProvider providerTestBuildCheckRadioField
     */
    public function testBuildCheckRadioField($expectedResult, $ckRfmt, $ckRpos)
    {
        $fields = $this->modsimpleemailformProperties['_field']->getValue($this->modsimpleemailform);

        $fields[1]['value'] = array('test' => 'TEST');

        $fields[1]['ckRfmt'] = $ckRfmt;

        $fields[1]['ckRpos'] = $ckRpos;

        $fieldPrefix = $this->modsimpleemailformProperties['_fieldPrefix']->getValue($this->modsimpleemailform);

        $name = $fieldPrefix . '1_1';

        $output = $this->modsimpleemailformMethods['buildCheckRadioField']->invokeArgs(
            $this->modsimpleemailform,
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
     * Tests sefmodsimpleemailform::sendResults()
     *
     * @since 1.8.8
     */
    public function testSendResults()
    {
        $msg = new \sefv2simpleemailformemailmsg();

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

        $result = $this->modsimpleemailform->sendResults($msg, $this->modsimpleemailformProperties['_field']->getValue($this->modsimpleemailform));

        $this->assertTrue($result);
    }

    /**
     * Tests sefmodsimpleemailform::imageCaptcha()
     *
     * @since 1.8.8
     *
     * @param string containing Captcha's URL
     *
     * @dataProvider providerTestImageCaptcha
     */
    public function testImageCaptcha($captchaURL)
    {
        if (!defined('MOD_SIMPLEEMAILFORM_DIR')) {
            define('MOD_SIMPLEEMAILFORM_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..');
        }

        $url_fn = 'captcha_testfile.png';

        $jFileMock = Mockery::mock('overload:JFile');
        $jFileMock->shouldReceive('write')
        ->once()
        ->andReturn(true);

        $output = $this->modsimpleemailform->imageCaptcha(
            '#FFFF00',
            __DIR__,
            60,
            4,
            '#BFBFBF',
            24,
            '#000000',
            $captchaURL,
            200,
            $url_fn
        );

        $this->assertTrue(is_string($output));
        $this->assertEquals(8, strlen($output));
    }

    public function providerTestImageCaptcha()
    {
        return array(
            array(
                'http://localhost/projects/mod_simpleemailform/test',
            ),
            array(
                'http://localhost/projects/mod_simpleemailform/test/'
            ),
        );
    }

    /**
     * Tests sefmodsimpleemailform::textCaptcha()
     *
     * @since 1.8.8
     *
     * @param int representing the captcha's length
     *
     * @dataProvider providerTestTextCaptcha
     */
    public function testTextCaptcha($captchaLen)
    {
        $textCaptcha = '';
        $match = '';
        $output = $this->modsimpleemailform->textCaptcha('white', $captchaLen, 1, 'red', 1, $textCaptcha);
        $this->assertEquals($captchaLen, strlen($output));

        // @TODO This part depends on styling being implemented in sefmodsimpleemailform::textCaptcha()
        //$doc = new \DOMDocument();
        //$doc->loadHTML($output);

        //$spanNode = $doc->getElementsByTagName('span')->item(0);

        //$spanCss = $spanNode->item(0)->getAttributeNode('style')->value;

        //$this->assertEquals(1, preg_match('/background-color: red/i', $spanCss));
        //$this->assertEquals(1, preg_match('/color: white/i', $spanCss));
        //$this->assertEquals($captchaLen, strlen($spanNode->nodeValue));
        // @TODO Check captcha size
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
            array(
                1
            ),
            array(
                0
            ),
        );
    }

    /**
     * Tests sefmodsimpleemailform::FormatErrorMessage()
     *
     * @since 1.8.8
     *
     * @param string we expect to be returned by formatErrorMessage
     * @param string representing the color sent as an argument to formatErrorMessage
     * @param string representing the message sent as an argument to formatErrorMessage
     * @param string representing the filename sent as an argument to formatErrorMessage

     * @dataProvider providerTestFormatErrorMessage
     */
    public function testFormatErrorMessage($expectedResult, $color, $message, $fn = '')
    {
        $actualResult = $this->modsimpleemailformMethods['formatErrorMessage']->invokeArgs(
            $this->modsimpleemailform,
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
            // @TODO Test 3
            //array(<p><b><span style='color:$this->color;'>$this->standardMessage
            //     ('Warning - Invalid filename: no alnum character')</span></b></p>\n",
            //     $this->color, $this->standardMessage, $this->emptyFn),

            //Three tests to check the behaviour with messages
            //Test 4: Null message - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->nullMessage ($this->standardFn)</span></b></p>\n",
                $this->color, $this->nullMessage, $this->standardFn),
            // @TODO Test 4
            //array("<p><b><span style='color:$this->color;'>Warning - No message sent
            //       ($this->standardFn)</span></b></p>\n",
            //       $this->color, $this->nullMessage, $this->standardFn),
            //Test 5: Message with no alnum character - to be replaced by the commented test below
            array("<p><b><span style='color:$this->color;'>$this->emptyMessage ($this->standardFn)</span></b></p>\n",
                $this->color, $this->emptyMessage, $this->standardFn),
            // @TODO Test 5
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

    /**
     * Tests sefmodsimpleemailform::autoResetForm()
     *
     * @since 1.8.8
     *
     * Tests if form is reset in POST
     */
    public function testAutoResetForm()
    {
        $_POST = [1, 2, 3];

        $this->modsimpleemailformMethods['autoResetForm']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        foreach ($_POST as $key => $value) {
            $this->assertTrue(empty($_POST[$key]));
        }
    }

    /**
     * Tests sefmodsimpleemailform::isEmailAddress()
     *
     * Tests if email address is valid
     *
     * @since 1.8.8
     *
     * @param string representing an email address
     *
     * @dataProvider providerTestIsEmailAddressValid
     */
    public function testIsEmailAddressValid($email)
    {
        $this->assertTrue($this->modsimpleemailform->isEmailAddress($email));
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
     * Tests sefmodsimpleemailform::isEmailAddress()
     *
     * Tests if email address is invalid
     *
     * @since 1.8.8
     *
     * @param string representing an email address
     *
     * @dataProvider providerTestIsEmailAddressInvalid
     */
    public function testIsEmailAddressInvalid($email)
    {
        $this->assertFalse($this->modsimpleemailform->isEmailAddress($email));
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

        for ($i = 0; $i < 63; $i++) {
            $address .= 'a';
        }

        return (string) $address;
    }

    /**
     * Invalid email domain address with more than 63 characters
     *
     * @since 1.8.8
     */
    public function getDomainGreaterThan63()
    {
        $address = 'test@test.';

        for ($i = 0; $i < 64; $i++) {
            $address .= 'a';
        }

        return (string) $address;
    }

    /**
     * Greater than 64 characters long local email address
     *
     * @since 1.8.8
     */
    public function getLocalGreaterThan64()
    {
        $address = '';

        for ($i = 0; $i < 65; $i++) {
            $address .= 'a';
        }

        $address .= '@localhost.localdomain';

        return (string) $address;
    }

    /**
     * Tests sefmodsimpleemailform::doesCaptchaMatch()
     *
     * Tests to see if method works properly when captchas match
     *
     * @since 1.8.8
     */
    public function testDoesCaptchaMatchIfMatches()
    {
        $_SERVER['REMOTE_ADDR'] = 'localhost';

        $_POST['mod_simpleemailform_captcha_1'] = 'test';

        $hash = $this->modsimpleemailformMethods['buildCaptchaHash']->invokeArgs(
            $this->modsimpleemailform,
            array('test')
        );

        $_POST['mod_simpleemailform_crsf_1'] = $hash;

        $output = $this->modsimpleemailformMethods['doesCaptchaMatch']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $this->assertTrue($output);
    }

    /**
     * Tests sefmodsimpleemailform::doesCaptchaMatch()
     *
     * Tests to see if method works properly when captchas do not match
     *
     * @since 1.8.8
     */
    public function testDoesCaptchaMatchIfDoesNotMatch()
    {
        $_SERVER['REMOTE_ADDR'] = 'localhost';

        $_POST['mod_simpleemailform_captcha_1'] = 'test';

        $hash = $this->modsimpleemailformMethods['buildCaptchaHash']->invokeArgs(
            $this->modsimpleemailform,
            array('test')
        );

        $_POST['mod_simpleemailform_crsf_1'] = 'wrong';

        $outputBad = $this->modsimpleemailformMethods['doesCaptchaMatch']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $this->assertFalse($outputBad);
    }

    /**
     * Tests sefmodsimpleemailform::renderCaptcha()
     *
     * @since 1.8.8
     */
    public function testRenderCaptcha()
    {
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

        $output = $this->modsimpleemailformMethods['renderCaptcha']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $doc = new \DOMDocument();
        $doc->loadHTML($output);
        $captchaInputNode = $doc->getElementsByTagName('input')->item(0);
        $this->assertSame('mod_simpleemailform_captcha_1', $captchaInputNode->getAttributeNode('name')->value);
    }

    /**
     * Tests sefmodsimpleemailform::cleanupCaptchas()
     *
     * @since 1.8.8
     */
    public function testCleanupCaptchas()
    {
        $this->modsimpleemailformProperties['_captchaDir']->setValue($this->modsimpleemailform, __DIR__);

        $this->modsimpleemailformProperties['_useCaptcha']->setValue($this->modsimpleemailform, 'I');

        touch(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile1.img', time());

        touch(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile2.img', time() - 3600);

        $this->modsimpleemailformMethods['cleanupCaptchas']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $this->assertTrue(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile1.img'));

        $this->assertFalse(file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile2.img'));

        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile1.img')) {
            unlink(__DIR__ . DIRECTORY_SEPARATOR . 'captcha_testfile1.img');
        }
    }

    // @TODO Make test that fails
    /**
     * Tests sefmodsimpleemailform::cleanupCaptchas()
     *
     * @since 1.8.8
     */
    /*public function testCleanupCaptchasFailTestModeOn()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';

        $this->modsimpleemailformProperties['_testMode']->setValue($this->modsimpleemailform, 'Y');

        $testModeFieldValuePre = $this->modsimpleemailformProperties['_testInfo']->getValue($this->modsimpleemailform);

        $this->assertTrue(empty($testModeFieldValuePre));

        $this->modsimpleemailformMethods['cleanupCaptchas']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $testModeFieldValuePost = $this->modsimpleemailformProperties['_testInfo']->getValue($this->modsimpleemailform);

        $this->assertFalse(empty($testModeFieldValuePost));
    }*/

    // @TODO Make test that fails
    /**
     * Tests sefmodsimpleemailform::cleanupCaptchas()
     *
     * @since 1.8.8
     */
    /*public function testCleanupCaptchasFail()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';

        $output = $this->modsimpleemailformMethods['cleanupCaptchas']->invokeArgs(
            $this->modsimpleemailform,
            array()
        );

        $doc = new \DOMDocument();
        $doc->loadHTML($output);
        $spanNode = $doc->getElementsByTagName('span')->item(0);
        $this->assertSame('Unable to cleanup old CAPTCHAs', $spanNode->nodeValue);
    }*/

    /**
     * Tests sefmodsimpleemailform::compareCsrfHash()
     *
     * @since 1.8.8
     *
     * @param bool representing the expected result
     * @param string representing the form's CSRF
     * @param string representing the session's CSRF
     *
     * @dataProvider providerTestCompareCsrfHash
     */
    public function testCompareCsrfHash($expected, $formCsrf, $formSess)
    {
        $csrfFieldValue = $this->modsimpleemailformProperties['_csrfField']->getValue($this->modsimpleemailform);

        $_POST[$csrfFieldValue] = $formCsrf;

        $_SESSION[$csrfFieldValue] = $formSess;

        $output = $this->modsimpleemailformMethods['compareCsrfHash']->invokeArgs(
            $this->modsimpleemailform,
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
     * Tests sefmodsimpleemailform::main()
     *
     * Tests if form is not submitted
     *
     * @since 1.8.8
     */
    public function testMainReturnValueWithoutSubmit()
    {
        $doc = new \DOMDocument();
        $doc->loadHTML($this->modsimpleemailform->main());
        $nodeList = $doc->getElementsByTagName('form');
        $this->assertEquals(1, count($nodeList));
        $this->assertEquals('post', $nodeList->item(0)->getAttributeNode('method')->value);
    }

    /**
     * Tests sefmodsimpleemailform::main()
     *
     * Tests if form was submitted
     *
     * @since 1.8.8
     */
    public function testMainReturnValueWithSubmit()
    {
        $csrfFieldValue = $this->modsimpleemailformProperties['_csrfField']->getValue($this->modsimpleemailform);
        $msgValue = $this->modsimpleemailformProperties['_msg']->getValue($this->modsimpleemailform);

        $_POST['mod_simpleemailform_submit_1'] = true;

        $output = $this->modsimpleemailform->main();

        $this->assertEquals(0, preg_match("/style='color:red;'>Please/i", $output));
    }

    /**
     * Tests sefmodsimpleemailform::main()
     *
     * Tests if form was submitted but invalid
     *
     * @since 1.8.8
     */
    public function testMainReturnValueWithInvalidSubmit()
    {
        $csrfFieldValue = $this->modsimpleemailformProperties['_csrfField']->getValue($this->modsimpleemailform);
        $msgValue = $this->modsimpleemailformProperties['_msg']->getValue($this->modsimpleemailform);

        $_POST['mod_simpleemailform_submit_1'] = true;
        $_POST[$csrfFieldValue] = 'test';
        $_SESSION[$csrfFieldValue] = 'test';

        $output = $this->modsimpleemailform->main();

        $this->assertEquals(1, preg_match("/style='color:red;'>Please/i", $output));
    }

    /**
     * Tests sefmodsimpleemailform::main()
     *
     * Tests if test mode is set to false
     *
     * @since 1.8.8
     */
    public function testMainTestModeFalse()
    {
        ini_set('display_errors', 0);
        $this->modsimpleemailformProperties['_testMode']->setValue($this->modsimpleemailform, 'N');
        $this->modsimpleemailform->main();
        $this->assertSame('0', ini_get('display_errors'));
    }

    /**
     * Tests sefmodsimpleemailform::main()
     *
     * Tests if test mode is set to true
     *
     * @since 1.8.8
     */
    public function testMainTestModeTrue()
    {
        ini_set('display_errors', 0);
        $this->modsimpleemailformProperties['_testMode']->setValue($this->modsimpleemailform, 'Y');
        $this->modsimpleemailform->main();
        $this->assertSame('1', ini_get('display_errors'));
    }
}
