<?php
/**
 * sefv2helperTest.php
 *
 * Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
 * Version 2.3.0
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * @package    Simple Email Form Test Suite
 * @copyright  Copyright 2010 - 2018 D. Bierer <doug@unlikelysource.com>
 * @link       http://joomla.unlikelysource.org/
 * @license    GNU/GPLv2, see above
 * @since 2.0.0
 */

namespace ModsimpleemailformTest;

use Mockery;
use Joomla\Registry\Registry;

/**
 * sefv2helper test case.
 *
 * @since 2.0.0
 */
class sefv2helperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Joomla\Registry\Registry
     * @since 2.0.0
     */
    private $params;

    /**
     *
     * @var sefv2helper
     * @since 2.0.0
     */
    private $sefv2helper;

    /**
     *
     * @var sefv2helper reflection
     * @since 2.0.0
     */
    private $sefv2HelperReflection;

    /**
     * Prepares the environment before running a test.
     *
     * @since 2.0.0
     */
    protected function setUp()
    {
        // current directory constant
        defined('MOD_SIMPLEEMAILFORM_DIR')
            || define('MOD_SIMPLEEMAILFORM_DIR', dirname(dirname(dirname(__FILE__))));

        parent::setUp();

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObjectJformBasic');

        $this->params = unserialize($paramsSerialized);

        $this->sefv2helper = \sefv2helper::getInstance();

        $this->sefv2HelperReflection = new \ReflectionClass($this->sefv2helper);
    }

    /**
     * Cleans up the environment after running a test.
     *
     * @since 2.0.0
     */
    protected function tearDown()
    {
        parent::tearDown();

        \Mockery::close();

        $this->sefv2helper = null;
    }

    /**
     * Creates the test doubles that are called in \sefv2helper's
     * build method.
     *
     * @since 2.0.0
     */
    protected function createJoomlaMocks()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('load')->once()->andReturn(true);
        $jFormMock->shouldReceive('setValue')->twice()->withArgs(array(Mockery::any(), null, Mockery::any()));

        $jFactoryMock = Mockery::mock('overload:JFactory');
        $jMailMock = Mockery::mock('overload:JMail');
        $jFactoryMock->shouldReceive('getMailer')->once()->andReturn($jMailMock);
        $jDocumentMock = Mockery::mock('overload:JDocument');
        $jFactoryMock->shouldReceive('getDocument')->once()->andReturn($jDocumentMock);
        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock->shouldReceive('getTag')->once()->andReturn('en-GB');
        $jFactoryMock->shouldReceive('getLanguage')->once()->andReturn($jLanguageMock);
        $jInputMock = Mockery::mock('overload:JInput');
        $jInputMock->shouldReceive('getMethod')->once()->andReturn('POST');
        $jApplicationMock = Mockery::mock('overload:JApplication');
        $jApplicationMock->input = $jInputMock;
        $jFactoryMock->shouldReceive('getApplication')->once()->andReturn($jApplicationMock);
        $jSessionMock = Mockery::mock('overload:JSession');
        $jFactoryMock->shouldReceive('getSession')->once()->andReturn($jSessionMock);

        $jTableExtensionMock = Mockery::mock('overload:JTableExtension');
        $jTableModuleMock = Mockery::mock('overload:JTableModule');
        $jTableMock = Mockery::mock('overload:JTable');
        $jTableMock->shouldReceive('getInstance')->with('extension')->once()->andReturn($jTableExtensionMock);
        $jTableMock->shouldReceive('getInstance')->with('module')->once()->andReturn($jTableModuleMock);

        $stdClassModuleHelperResultFake = new \stdClass;
        $stdClassModuleHelperResultFake->id = 93;
        $jModuleHelperMock = Mockery::mock('overload:JModuleHelper');
        $jModuleHelperMock
            ->shouldReceive('getModule')
            ->with('mod_simpleemailform')
            ->once()
            ->andReturn($stdClassModuleHelperResultFake);

        $jFileMock = Mockery::mock('overload:JFile');
    }

    /**
     * Tests static sefv2helper::getInstance().
     *
     * @since 2.0.0
     */
    public function testGetInstanceIfObjectIsOfRightClassAndInterface()
    {
        $this->assertInstanceOf('sefv2helper', $this->sefv2helper);

        $this->assertInstanceOf('sefv2helperfactoryinterface', $this->sefv2helper);
    }

    /**
     * Tests static sefv2helper::buildForm().
     *
     * @since 2.0.0
     *
     * @param string containing the wanted form object's type
     * @param string containing the wanted form object's class name
     *
     * @dataProvider providerTestBuildFormIfCorrespondingObjectsAreReturned
     */
    public function testBuildFormIfCorrespondingObjectsAreReturned($wantedObjectType, $wantedObjectClassName)
    {
        $this->createJoomlaMocks();

        $formObject = $this->sefv2helper->buildForm($this->params);

        $this->assertInstanceOf($wantedObjectClassName, $formObject);

        $this->assertInstanceOf('sefv2formrendererinterface', $formObject);

        if (get_class($formObject) === 'sefv2modsimpleemailform') {
            $this->assertInstanceOf('sefv2jformproxyinterface', $formObject);
        }
    }

    public function providerTestBuildFormIfCorrespondingObjectsAreReturned()
    {
        return array(
            array(
                'jform',
                'sefv2modsimpleemailform',
            )
        );
    }

    /**
     * Tests static sefv2helper::__clone().
     *
     * @since 2.0.0
     *
     * @dataProvider providerTestBuildFormIfCorrespondingObjectsAreReturned
     */
    public function testCloneMethodIsNotAccessibleAndReturnsNullIfCalled()
    {
        $reflectionMethodClone = new \ReflectionMethod('\sefv2helper', '__clone');

        $this->assertTrue($reflectionMethodClone->isPrivate());

        $methodsList = $this->sefv2HelperReflection->getMethods();

        $foundKey = 0;

        array_walk_recursive(
            $methodsList,
            function ($item, $key) use (&$foundKey) {
                if ($item->name === '__clone') {
                    $foundKey = $key;
                }
            }
        );

        $methodsList[$foundKey]->setAccessible(true);

        $output = $methodsList[$foundKey]->invokeArgs(
            $this->sefv2helper,
            array()
        );

        $this->assertNull($output);
    }
}
