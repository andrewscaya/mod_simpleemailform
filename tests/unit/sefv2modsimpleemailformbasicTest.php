<?php

/**
 * sefv2modsimpleemailformbasicTest.php
 *
 * Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * Version 2.0.0
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
 * @copyright  Copyright 2010 - 2017 D. Bierer <doug@unlikelysource.com>
 * @link       http://joomla.unlikelysource.org/
 * @license    GNU/GPLv2, see above
 * @since 2.0.0
 */

namespace ModsimpleemailformTest;

use PHPUnit_Framework_TestCase;
use Mockery;

/**
 * sefv2modsimpleemailform test case.
 *
 * @since 2.0.0
 */
class sefv2modsimpleemailformbasicTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Joomla\Registry\Registry
     * @since 2.0.0
     */
    private $params;

    /**
     * @var \sefv2modsimpleemailform
     * @since 2.0.0
     */
    private $sefv2modsimpleemailform;

    /**
     * @var \sefv2modsimpleemailform reflection
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

        $paramsSerialized = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'serializedParamsObjectJformBasic');

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
        parent::tearDown();

        \Mockery::close();

        $this->sefv2modsimpleemailform = null;

        $this->sefv2modsimpleemailformReflection = null;

        $this->sefv2modsimpleemailformProperties = null;

        $this->sefv2modsimpleemailformMethods = null;
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
        $this->jFormMock
            ->shouldReceive('setValue')
            ->twice()
            ->withArgs(array(Mockery::any(), null, Mockery::any()));

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
     * Creates a Cartesian product of passed array of arrays.
     *
     * @since 2.0.0
     */
    public function arrayCartesianProduct($arrays)
    {
        $result = array();
        $arrays = array_values($arrays);
        $sizeIn = count($arrays);
        $size = $sizeIn > 0 ? 1 : 0;
        foreach ($arrays as $array) {
            $size = $size * count($array);
        }
        for ($i = 0; $i < $size; $i++) {
            $result[$i] = array();
            for ($j = 0; $j < $sizeIn; $j++) {
                array_push($result[$i], current($arrays[$j]));
            }
            for ($j = ($sizeIn -1); $j >= 0; $j--) {
                if (next($arrays[$j])) {
                    break;
                } elseif (isset($arrays[$j])) {
                    reset($arrays[$j]);
                }
            }
        }
        return $result;
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstruct()
    {
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
            2,
            count(
                $this->sefv2modsimpleemailformProperties['formActiveElements']->getValue($this->sefv2modsimpleemailform)
            )
        );
        $this->assertEquals(
            2,
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
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithRenderingDisabled()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formRendering = $this->sefv2modsimpleemailformProperties['formRendering']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertTrue($formRendering);

        $formRenderingOverrideName = $this->sefv2modsimpleemailformProperties['formRenderingOverrideName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $params[$formPrefixName . $formRenderingOverrideName] = 'Y';

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $this->jLanguageMock,
                $params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $formRendering = $this->sefv2modsimpleemailformProperties['formRendering']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertFalse($formRendering);
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithAllPossibleFormAlignLabels()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formLabelAlignName = $this->sefv2modsimpleemailformProperties['formLabelAlignName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $formLabelAlign = $this->sefv2modsimpleemailformProperties['formLabelAlign']
            ->getValue($this->sefv2modsimpleemailform);

        // Align left by default
        $this->assertSame('left', $formLabelAlign);

        // Align right
        $params[$formPrefixName . $formLabelAlignName] = 'R';

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $this->jLanguageMock,
                $params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $formLabelAlign = $this->sefv2modsimpleemailformProperties['formLabelAlign']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('right', $formLabelAlign);

        // Align center
        $params[$formPrefixName . $formLabelAlignName] = 'C';

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $this->jLanguageMock,
                $params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $formLabelAlign = $this->sefv2modsimpleemailformProperties['formLabelAlign']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('center', $formLabelAlign);
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithUnsetEmailTo()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $emailToName = $this->sefv2modsimpleemailformProperties['emailToName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $params[$formPrefixName . $emailToName] = '';

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $this->jLanguageMock,
                $params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $formRendering = $this->sefv2modsimpleemailformProperties['formRendering']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertFalse($formRendering);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:red">SORRY: This email address is invalid!  Please re-enter your email address.</p>',
            $msg
        );
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithChangedLanguageSetting()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formDefaultLangName = $this->sefv2modsimpleemailformProperties['formDefaultLangName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'en-GB',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock
            ->shouldReceive('getTag')
            ->once()
            ->andReturn('fr-FR');

        $this->setUpSefv2modsimpleemailformConstructWithChangedLanguageSettingTests();

        $this->jTableModuleMock
            ->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $this->jTableModuleMock
            ->shouldReceive('store')
            ->once()
            ->andReturn(true);

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $jLanguageMock,
                $this->params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'fr-FR',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'fr-FR',
            $paramsArray[$formPrefixName . $formDefaultLangName]
        );

        $transLang = $this->sefv2modsimpleemailformProperties['transLang']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'Transfert du fichier réussi.',
            $transLang['MOD_SIMPLEEMAILFORM_upload_success']
        );
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithChangedLanguageSettingWithBackendFailureOnCheck()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formDefaultLangName = $this->sefv2modsimpleemailformProperties['formDefaultLangName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'en-GB',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock
            ->shouldReceive('getTag')
            ->once()
            ->andReturn('fr-FR');

        $this->setUpSefv2modsimpleemailformConstructWithChangedLanguageSettingTests();

        $this->jTableModuleMock
            ->shouldReceive('check')
            ->once()
            ->andReturn(false);
        $this->jTableModuleMock
            ->shouldReceive('store')
            ->once()
            ->andReturn(true);

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $jLanguageMock,
                $this->params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'fr-FR',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $formRendering = $this->sefv2modsimpleemailformProperties['formRendering']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertFalse($formRendering);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:red">FATAL ERROR: Schema not ready for update.</p>',
            $msg
        );
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithChangedLanguageSettingWithBackendFailureOnStore()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formDefaultLangName = $this->sefv2modsimpleemailformProperties['formDefaultLangName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'en-GB',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock
            ->shouldReceive('getTag')
            ->once()
            ->andReturn('fr-FR');

        $this->setUpSefv2modsimpleemailformConstructWithChangedLanguageSettingTests();

        $this->jTableModuleMock
            ->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $this->jTableModuleMock
            ->shouldReceive('store')
            ->once()
            ->andReturn(false);

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $jLanguageMock,
                $this->params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'fr-FR',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $formRendering = $this->sefv2modsimpleemailformProperties['formRendering']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertFalse($formRendering);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            '<p style="color:red">FATAL ERROR: Schema not updated.</p>',
            $msg
        );
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithChangedAndInvalidLanguageSettingLanguage()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $formDefaultLangName = $this->sefv2modsimpleemailformProperties['formDefaultLangName']
            ->getValue($this->sefv2modsimpleemailform);

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'en-GB',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $jLanguageMock = Mockery::mock('overload:JLanguage');
        $jLanguageMock
            ->shouldReceive('getTag')
            ->once()
            ->andReturn('zz-ZZ');

        $this->setUpSefv2modsimpleemailformConstructWithChangedLanguageSettingTests();

        $this->jTableModuleMock
            ->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $this->jTableModuleMock
            ->shouldReceive('store')
            ->once()
            ->andReturn(true);

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
                $this->jFormMock,
                $this->jMailMock,
                $this->emailMsgFake,
                $this->jDocumentMock,
                $jLanguageMock,
                $this->params,
                $this->jInputMock,
                $this->jTableExtensionMock,
                $this->jTableModuleMock,
                $this->stdClassModuleHelperResultFake,
                $this->jSessionMock,
                $this->jFileMock
            )
        );

        $params = $this->sefv2modsimpleemailformProperties['params']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'zz-ZZ',
            $params[$formPrefixName . $formDefaultLangName]
        );

        $transLang = $this->sefv2modsimpleemailformProperties['transLang']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame(
            'Successfully uploaded',
            $transLang['MOD_SIMPLEEMAILFORM_upload_success']
        );
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's
     * constructor when tests change the language settings.
     *
     * @since 2.0.0
     */
    public function setUpSefv2modsimpleemailformConstructWithChangedLanguageSettingTests()
    {
        $this->jModuleHelperMock
            ->shouldReceive('getModule')
            ->with('mod_simpleemailform')
            ->once()
            ->andReturn($this->stdClassModuleHelperResultFake);
        $this->jTableExtensionMock
            ->shouldReceive('find')
            ->with(array('element' => 'mod_simpleemailform'))
            ->once()
            ->andReturn(10000);
        $this->jTableExtensionMock
            ->shouldReceive('load')
            ->with(10000)
            ->once()
            ->andReturn(true);
        $this->jTableExtensionMock
            ->shouldReceive('bind')
            ->with(Mockery::any())
            ->once();
        $this->jTableExtensionMock
            ->shouldReceive('check')
            ->once()
            ->andReturn(true);
        $this->jTableExtensionMock
            ->shouldReceive('store')
            ->once()
            ->andReturn(true);
        $this->jTableModuleMock
            ->shouldReceive('load')
            ->with(93)
            ->once()
            ->andReturn(true);
        $this->jTableModuleMock
            ->shouldReceive('bind')
            ->with(Mockery::any())
            ->once();
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithPOST()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);
        $jFormMock
            ->shouldReceive('reset')
            ->once()
            ->andReturn(true);

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(true);

        $_POST = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $jInputMock = $this->jInputMock;
        $jInputMock->post = $jInputMock;
        $jInputMock->files = $jInputMock;
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn($_POST);
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn(array());

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
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
            )
        );

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:green">Form Successfully Submitted!</p>', $msg);
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     */
    public function testSefv2modsimpleemailformConstructWithPOSTAndResetButton()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $jFormMock
            ->shouldReceive('reset')
            ->once()
            ->andReturn(true);

        $_POST = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_reset_1' => 'Reset'
        );

        $jInputMock = $this->jInputMock;
        $jInputMock->post = $jInputMock;
        $jInputMock->files = $jInputMock;
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn($_POST);
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn(array());

        $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
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
            )
        );

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('', $msg);
    }

    /**
     * Tests sefv2modsimpleemailform::__construct(
     *                                       \JForm $jForm,
     *                                       \JMail $jMail,
     *                                       sefv2simpleemailformemailmsg $emailMsg,
     *                                       \JDocument $jDocument,
     *                                       \JLanguage $jLanguage,
     *                                       Registry $params,
     *                                       \JInput $jInput,
     *                                       \JTableExtension $jTableExtension,
     *                                       \JTableModule $jTableModule,
     *                                       \stdClass $jModuleHelperResult,
     *                                       \JSession $jSession,
     *                                       \JFile $jFile
     *                                   ).
     *
     * @since 2.0.0
     *
     * @runInSeparateProcess
     */
    public function testSefv2modsimpleemailformConstructWithPOSTAndWithARedirectURL()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);
        $jFormMock
            ->shouldReceive('reset')
            ->once()
            ->andReturn(true);

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(true);

        $_POST = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $jInputMock = $this->jInputMock;
        $jInputMock->post = $jInputMock;
        $jInputMock->files = $jInputMock;
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn($_POST);
        $jInputMock
            ->shouldReceive('getArray')
            ->once()
            ->withArgs(array(array(), null, 'raw', true))
            ->andReturn(array());

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $formRedirectURLName = $this->sefv2modsimpleemailformProperties['formRedirectURLName']
            ->getValue($this->sefv2modsimpleemailform);

        $this->params->set($formPrefixName . $formRedirectURLName, 'http://localhost:8181/redirecturl');

        $redirectedToURL = $this->sefv2modsimpleemailformProperties['redirectedToURL']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('', $redirectedToURL);

        $output = $this->sefv2modsimpleemailformMethods['__construct']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array(
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
            )
        );

        $redirectedToURL = $this->sefv2modsimpleemailformProperties['redirectedToURL']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('http://localhost:8181/redirecturl', $redirectedToURL);
    }

    /**
     * Tests sefv2modsimpleemailform::bind($data).
     *
     * @since 2.0.0
     */
    public function testBindProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('bind')->once();

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->bind(array());
    }

    /**
     * Tests sefv2modsimpleemailform::createXMLConfig(array $paramsArray).
     *
     * @since 2.0.0
     */
    public function testCreateXMLConfig()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $output = $this->sefv2modsimpleemailformMethods['createXMLConfig']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertEquals(
            1,
            preg_match('/<fieldset name="main">.+<field.*type="email".*<field.*type="text"/is', $output)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::decorateInput($input, $label = null)
     *
     * @since 2.0.0
     */
    public function testDecorateInputWithoutLabel()
    {
        $input = '<input 
                    name="mod_simpleemailform_field2_1" 
                    id="mod_simpleemailform_field2_1"
                    value=""
                    class="required"
                    size="40"
                    required=""
                    aria-required="true"
                    type="text">';

        $output = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input)
        );

        $expectedPattern = '/<tr\sclass="mod_sef_tr">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<td\swidth="5">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<input.+name="mod_simpleemailform_field2_1".+type="text">/is';

        $this->assertEquals(
            1,
            preg_match(
                $expectedPattern,
                $output
            )
        );
    }

    /**
     * Tests sefv2modsimpleemailform::decorateInput($input, $label = null).
     *
     * @since 2.0.0
     */
    public function testDecorateInputWithLabel()
    {
        $input = '<input 
                    name="mod_simpleemailform_field2_1" 
                    id="mod_simpleemailform_field2_1"
                    value=""
                    class="required"
                    size="40"
                    required=""
                    aria-required="true"
                    type="text">';

        $label = '<label>My Field</label>';

        $output = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input, $label)
        );

        $this->assertEquals(
            1,
            preg_match(
                '/<th.+<label>My\sField<\/label>.+<input/s',
                $output
            )
        );
    }

    /**
     * Tests sefv2modsimpleemailform::decorateInput($input, $label = null).
     *
     * @since 2.0.0
     */
    public function testDecorateInputTypeSubmitWithLabel()
    {
        $input = '<input 
                    name="mod_simpleemailform_submit_1" 
                    id="mod_simpleemailform_submit_1"
                    value="Submit"
                    class="required"
                    type="submit">';

        $output = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input, 'test')
        );

        $expectedPattern = '/<tr\sclass="mod_sef_tr">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<td\swidth="5">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<input.+name="mod_simpleemailform_submit_1".+type="submit">/is';

        $this->assertEquals(
            1,
            preg_match(
                $expectedPattern,
                $output
            )
        );
    }

    /**
     * Tests sefv2modsimpleemailform::decorateInput($input, $label = null).
     *
     * @since 2.0.0
     */
    public function testDecorateInputTypeResetWithLabel()
    {
        $input = '<input 
                    name="mod_simpleemailform_reset_1" 
                    id="mod_simpleemailform_reset_1"
                    value="Submit"
                    class="required"
                    type="reset">';

        $output = $this->sefv2modsimpleemailformMethods['decorateInput']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($input, 'test')
        );

        $expectedPattern = '/<tr\sclass="mod_sef_tr">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<td\swidth="5">.*'
            . '<td\sclass="mod_sef_td">.*'
            . '<input.+name="mod_simpleemailform_reset_1".+type="reset">/is';

        $this->assertEquals(
            1,
            preg_match(
                $expectedPattern,
                $output
            )
        );
    }

    /**
     * Tests sefv2modsimpleemailform::determineActiveElements(array $paramsArray).
     *
     * @since 2.0.0
     */
    public function testDetermineActiveElementsTrue()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $output = $this->sefv2modsimpleemailformMethods['determineActiveElements']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertTrue($output);

        $activeElements = $this->sefv2modsimpleemailformProperties['formActiveElements']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(2, count($activeElements));
    }

    /**
     * Tests sefv2modsimpleemailform::determineActiveElements(array $paramsArray).
     *
     * @since 2.0.0
     */
    public function testDetermineActiveElementsFalse()
    {
        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray['mod_simpleemailform_field1active'] = 'N';
        $paramsArray['mod_simpleemailform_field2active'] = 'N';

        $output = $this->sefv2modsimpleemailformMethods['determineActiveElements']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($paramsArray)
        );

        $this->assertFalse($output);

        $activeElements = $this->sefv2modsimpleemailformProperties['formActiveElements']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertEquals(0, count($activeElements));
    }

    /**
     * Tests sefv2modsimpleemailform::filter(array $data, $group = null).
     *
     * @since 2.0.0
     */
    public function testFilterProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('filter')->once();

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->filter(array());
    }

    /**
     * Tests sefv2modsimpleemailform::getData().
     *
     * @since 2.0.0
     */
    public function testGetDataProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('getData')->once();

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getData();
    }

    /**
     * Tests sefv2modsimpleemailform::getErrors().
     *
     * @since 2.0.0
     */
    public function testGetErrorsProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('getErrors')->once();

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getErrors();
    }

    /**
     * Tests sefv2modsimpleemailform::getField($name, $group = null, $value = null).
     *
     * @since 2.0.0
     */
    public function testGetFieldProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('getField')->once()->withArgs(array('test', null, null));

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getField('test');
    }

    /**
     * Tests sefv2modsimpleemailform::getFieldset($set = null).
     *
     * @since 2.0.0
     */
    public function testGetFieldsetProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('getFieldset')->once()->with('main');

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->getFieldset('main');
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLField($active, $from, $name, $label, $value, $size, $maxx).
     *
     * @param $active
     * @param $from
     * @param $name
     * @param $label
     * @param $value
     * @param $size
     * @param $maxx
     *
     * @since 2.0.0
     *
     * @dataProvider providerGetXMLFieldAllPossibleCombinations
     */
    public function testGetXMLFieldAllPossibleCombinations($active, $from, $name, $label, $value, $size, $maxx)
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($active, $from, $name, $label, $value, $size, $maxx)
        );

        if ($active === 'H') {
            $this->assertEquals(
                1,
                preg_match('/type="hidden"/is', $output)
            );
        } elseif ($active === 'R') {
            $this->assertEquals(
                1,
                preg_match('/required="required"/is', $output)
            );
        } else {
            $this->assertEquals(
                0,
                preg_match('/type="hidden"/is', $output)
            );
            $this->assertEquals(
                1,
                preg_match('/required=""/is', $output)
            );
        }

        if ($active !== 'H' && $from === 'F') {
            $this->assertEquals(
                1,
                preg_match('/type="email".+validate="email"/is', $output)
            );

            $namePattern = "/name=\"$name\"/is";

            $this->assertEquals(
                1,
                preg_match($namePattern, $output)
            );

            $labelPattern = "/label=\"$label\"/is";

            $this->assertEquals(
                1,
                preg_match($labelPattern, $output)
            );

            $valuePattern = "/value=\"$value\"/is";

            $this->assertEquals(
                1,
                preg_match($valuePattern, $output)
            );

            $sizePattern = "/size=\"$size\"/is";

            $this->assertEquals(
                1,
                preg_match($sizePattern, $output)
            );

            $maxxPattern = "/maxLength=\"$maxx\"/is";

            $this->assertEquals(
                1,
                preg_match($maxxPattern, $output)
            );
        } elseif ($active !== 'H' && $from === 'S') {
            $this->assertEquals(
                1,
                preg_match('/type="text"/is', $output)
            );

            $namePattern = "/name=\"$name\"/is";

            $this->assertEquals(
                1,
                preg_match($namePattern, $output)
            );

            $labelPattern = "/label=\"$label\"/is";

            $this->assertEquals(
                1,
                preg_match($labelPattern, $output)
            );

            $valuePattern = "/value=\"$value\"/is";

            $this->assertEquals(
                1,
                preg_match($valuePattern, $output)
            );

            $sizePattern = "/size=\"$size\"/is";

            $this->assertEquals(
                1,
                preg_match($sizePattern, $output)
            );

            $maxxPattern = "/maxLength=\"$maxx\"/is";

            $this->assertEquals(
                1,
                preg_match($maxxPattern, $output)
            );
        } elseif ($active !== 'H' && $from === 'R') {
            $this->assertEquals(
                1,
                preg_match('/type="radio"/is', $output)
            );
        } elseif ($active !== 'H' && $from === 'C' && strpos($value, ',') !== false) {
            $this->assertEquals(
                1,
                preg_match('/type="checkboxes"/is', $output)
            );
        } elseif ($active !== 'H' && $from === 'C' && strpos($value, ',') === false) {
            $this->assertEquals(
                1,
                preg_match('/type="checkboxes"/is', $output)
            );
        } elseif ($active !== 'H' && $from === 'D') {
            $this->assertEquals(
                1,
                preg_match('/type="list"/is', $output)
            );
        } elseif ($active !== 'H' && $from === 'A') {
            $this->assertEquals(
                1,
                preg_match('/type="editor"/is', $output)
            );
        }
    }

    public function providerGetXMLFieldAllPossibleCombinations()
    {
        $arraysTemp = array(
            array('Y', 'R', 'H'),
            array('F', 'S', 'N', 'A', 'D', 'R', 'C', 'U'),
            array('name1', 'name2'),
            array('name1', 'name2'),
            array('value1', 'value1=Value1,value2=Value2'),
            array(0, 50, 100),
            array(0, 50, 100),
        );

        return $this->arrayCartesianProduct($arraysTemp);
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLField($active, $from, $name, $label, $value, $size, $maxx).
     *
     * @since 2.0.0
     */
    public function testGetXMLFieldSingleCheckbox()
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Y', 'C', 'test', 'test', 'option1=Value1', 50, 50)
        );

        $this->assertEquals(
            1,
            preg_match(
                '/type="checkboxes".+<option.+value="option1">Value1<\/option>/is',
                $output
            )
        );
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLField($active, $from, $name, $label, $value, $size, $maxx).
     *
     * @since 2.0.0
     */
    public function testGetXMLFieldUnknownFromParameter()
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Y', 'Z', 'test', 'test', 'Test', 50, 50)
        );

        $this->assertEquals(
            1,
            preg_match('/type="text"/', $output)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLField($active, $from, $name, $label, $value, $size, $maxx).
     *
     * @since 2.0.0
     */
    public function testGetXMLFieldMultipleCheckboxesRadioAndDropdownInputs()
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Y', 'R', 'test', 'test', 'option1=Test1,option2=Test2', 50, 50)
        );

        $radioPattern =
            "/type=\"radio\".+<option.+value=\"option1\">Test1<\/option><option.+value=\"option2\">Test2/is";

        $this->assertEquals(
            1,
            preg_match($radioPattern, $output)
        );

        $output2 = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Y', 'C', 'test', 'test', 'option1=Test1,option2=Test2', 50, 50)
        );

        $checkboxesPattern =
            "/type=\"checkboxes\".+<option.+value=\"option1\">Test1<\/option><option.+value=\"option2\">Test2/is";

        $this->assertEquals(
            1,
            preg_match($checkboxesPattern, $output2)
        );

        $output3 = $this->sefv2modsimpleemailformMethods['getXMLField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Y', 'D', 'test', 'test', 'option1=Test1,option2=Test2', 50, 50)
        );

        $dropDownPattern =
            "/type=\"list\".+<option\svalue=\"option1\">Test1<\/option><option\svalue=\"option2\">Test2/is";

        $this->assertEquals(
            1,
            preg_match($dropDownPattern, $output3)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLUploadField($uploadName, $uploadLabel, $uploadAllowedFiles).
     *
     * @param string $expectedOutput
     * @param string $uploadName
     * @param string $uploadLabel
     * @param string $uploadAllowedFiles
     *
     * @since 2.0.0
     *
     * @dataProvider providerGetXMLUploadField
     */
    public function testGetXMLUploadField($expectedOutput, $uploadName, $uploadLabel, $uploadAllowedFiles)
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLUploadField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($uploadName, $uploadLabel, $uploadAllowedFiles)
        );

        $this->assertEquals(
            1,
            preg_match($expectedOutput, $output)
        );
    }

    public function providerGetXMLUploadField()
    {
        return array(
            array(
                '/<field.+name="Name1".+type="file".+label="Name1".+accept="".+\/>/is',
                'Name1',
                'Name1',
                ''
            ),
            array(
                '/<field.+name="Name2".+type="file".+label="Name2".+accept="\.doc".+\/>/is',
                'Name2',
                'Name2',
                '.doc'
            ),
            array(
                '/<field.+name="Name3".+type="file".+label="Name3".+accept="\.doc,.*\.odt\".+\/>/is',
                'Name3',
                'Name3',
                '.doc, .odt'
            ),
        );
    }

    /**
     * Tests sefv2modsimpleemailform::getXMLCaptchaField($name, $namespace).
     *
     * @since 2.0.0
     */
    public function testGetXMLCaptchaField()
    {
        $output = $this->sefv2modsimpleemailformMethods['getXMLCaptchaField']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array('Test1', 'Testnamespace1')
        );

        $captchaPattern =
            '/<field.+name="Test1".+type="captcha".+validate="captcha".+namespace="Testnamespace1"/is';

        $this->assertEquals(
            1,
            preg_match($captchaPattern, $output)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::load($xmlConfigString).
     *
     * @since 2.0.0
     */
    public function testLoadProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('load')->once()->with('test');

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->load('test');
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testProcessFormData()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files = array();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertTrue($output);
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithFailedCheckToken()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files = array();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(false);

        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:red">"Invalid Token" - Error: Unable to Submit Form</p>', $msg);
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithInvalidRawData()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files = array();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        // Return an error message containing a colon.
        $RuntimeExceptionFake = new \RuntimeException('Error: Field');
        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(false);
        $jFormMock
            ->shouldReceive('getErrors')
            ->once()
            ->andReturn(array($RuntimeExceptionFake));

        $jMailMock
            ->shouldReceive('send')
            ->twice()
            ->andReturn(true);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:red">"Field" - Error: Unable to Submit Form</p>', $msg);

        $this->sefv2modsimpleemailformProperties['msg']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Return an error message that doesn't contain a colon.
        $RuntimeExceptionFake = new \RuntimeException('An error occurred.');
        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(false);
        $jFormMock
            ->shouldReceive('getErrors')
            ->once()
            ->andReturn(array($RuntimeExceptionFake));

        $output2 = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output2);

        $msg = $this->sefv2modsimpleemailformProperties['msg']
            ->getValue($this->sefv2modsimpleemailform);

        $this->assertSame('<p style="color:red">"An error occurred." - Error: Unable to Submit Form</p>', $msg);
    }

    /**
     * Tests sefv2modsimpleemailform::processFormData(
     *                                      array $formDataRaw,
     *                                      array $files,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testProcessFormDataWithFailedSendFormData()
    {
        list(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpProcessFormDataTests();

        $files = array();

        $jSessionMock
            ->shouldReceive('checkToken')
            ->once()
            ->andReturn(true);

        $jFormMock
            ->shouldReceive('validate')
            ->once()
            ->withArgs(array($formDataRaw, null))
            ->andReturn(true);

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(false);

        $output = $this->sefv2modsimpleemailformMethods['processFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formDataRaw, $files, $paramsArray, $emailMsg)
        );

        $this->assertFalse($output);
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's processFormData tests.
     *
     * @since 2.0.0
     */
    public function setUpProcessFormDataTests()
    {
        defined('JVERSION') || define('JVERSION', '3.0');

        $formDataRaw = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $formCleanData = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
            'a7843da35a03fb2fbe19834411ec1955' => '1',
            'mod_simpleemailform_submit_1' => 'Submit'
        );

        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $formPrefixName = $this->sefv2modsimpleemailformProperties['formPrefixName']
            ->getValue($this->sefv2modsimpleemailform);

        $jSessionMock = $this->sefv2modsimpleemailformProperties['jSession']
            ->getValue($this->sefv2modsimpleemailform);

        $jFormMock = $this->jFormMock;
        $jFormMock
            ->shouldReceive('bind')
            ->once()
            ->with($formCleanData);

        $jDocumentMock = $this->jDocumentMock;

        $jMailMock = $this->jMailMock;
        $jMailMock
            ->shouldReceive('setSender')
            ->once()
            ->with('root@localhost')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setSubject')
            ->once()
            ->with('Test')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with('')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);

        return array(
            $formDataRaw,
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $jSessionMock,
            $jFormMock,
            $jDocumentMock,
            $jMailMock
        );
    }

    /**
     * Tests sefv2modsimpleemailform::removeField($name, $group = null).
     *
     * @since 2.0.0
     */
    public function testRemoveFieldProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('removeField')->once()->withArgs(array('test', null));

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->removeField('test');
    }

    /**
     * Tests sefv2modsimpleemailform::render()
     *
     * @since 2.0.0
     */
    public function testRender()
    {
        $jHtmlMock = Mockery::mock('alias:JHtml');
        $jHtmlMock
            ->shouldReceive('_')
            ->times(4)
            ->with('form.token')
            ->andReturn('qwerty');

        // Test with an empty fieldset.
        $jFormMock = $this->jFormMock;
        $jFormMock
            ->shouldReceive('getFieldset')
            ->once()
            ->with('main')
            ->andReturn(array());
        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue(
                $this->sefv2modsimpleemailform,
                $jFormMock
            );
        $output = $this->sefv2modsimpleemailform->render();
        $this->assertNotEmpty($output);
        $this->assertStringStartsWith('<div class="mod_sef">', $output);
        $this->assertEquals(
            1,
            preg_match('/<div class="mod_sef">(?!type="email".+type="text".+name="subject")/', $output)
        );
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Test with a fieldset.
        $inputObject1 = new \stdClass();
        $inputObject1->input = '<input type="email" name="test">';
        $inputObject1->hidden = false;
        $inputObject1->label = 'From';
        $inputObject2 = new \stdClass();
        $inputObject2->input = '<input type="text" name="subject">';
        $inputObject2->hidden = false;
        $inputObject2->label = 'Subject';
        $inputObject3 = new \stdClass();
        $inputObject3->input = '<input type="hidden" name="hiddentest">';
        $inputObject3->hidden = true;
        $fakeFieldSet = array(
            $inputObject1,
            $inputObject2,
            $inputObject3,
        );
        $jFormMock = $this->jFormMock;
        $jFormMock
            ->shouldReceive('getFieldset')
            ->once()
            ->with('main')
            ->andReturn($fakeFieldSet);
        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue(
                $this->sefv2modsimpleemailform,
                $jFormMock
            );
        $output2 = $this->sefv2modsimpleemailform->render();
        $this->assertNotEmpty($output2);
        $this->assertStringStartsWith('<div class="mod_sef">', $output2);
        $this->assertEquals(
            1,
            preg_match(
                '/<div class="mod_sef">.+type="email".+type="text".+name="subject".+type="hidden"/is',
                $output2
            )
        );
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Test the form anchor.
        $this->sefv2modsimpleemailformProperties['formAnchor']
            ->setValue(
                $this->sefv2modsimpleemailform,
                '#testanchor'
            );
        $output3 = $this->sefv2modsimpleemailform->render();
        $this->assertEquals(
            1,
            preg_match('/<a.+id="#testanchor".+name="#testanchor".+<form.+action="#testanchor"/is', $output3)
        );
        $this->sefv2modsimpleemailformProperties['formAnchor']
            ->setValue(
                $this->sefv2modsimpleemailform,
                '#'
            );
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Test turning off rendering.
        $this->sefv2modsimpleemailformProperties['formRendering']
            ->setValue(
                $this->sefv2modsimpleemailform,
                false
            );
        $output4 = $this->sefv2modsimpleemailform->render();
        $this->assertEmpty($output4);
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Test turning on test mode while rendering is still off.
        $this->sefv2modsimpleemailformProperties['formTestMode']
            ->setValue(
                $this->sefv2modsimpleemailform,
                'Y'
            );
        $output5 = $this->sefv2modsimpleemailform->render();
        $this->assertEmpty($output5);
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );

        // Test test mode if rendering is back on.
        $this->sefv2modsimpleemailformProperties['formRendering']
            ->setValue(
                $this->sefv2modsimpleemailform,
                true
            );
        $output6 = $this->sefv2modsimpleemailform->render();
        $this->assertStringStartsWith(
            '<pre>Object (sefv2modsimpleemailform)',
            $output6
        );
        $this->sefv2modsimpleemailformProperties['output']
            ->setValue(
                $this->sefv2modsimpleemailform,
                ''
            );
    }

    /**
     * Tests sefv2modsimpleemailform::reset($xml = false).
     *
     * @since 2.0.0
     */
    public function testResetProxy($xml = false)
    {
        $jFormMock = Mockery::mock('overload:JForm');

        $jFormMock->shouldReceive('reset')->once()->with(null);

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->reset();
    }

    /**
     * Tests sefv2modsimpleemailform::setDefaultValuesOfActiveElements(
     *                                      array $formActiveElements,
     *                                      $formActiveElementsCount,
     *                                      array $paramsArray,
     *                                      \Jform $jForm
     *                                  ).
     *
     * @param int $count
     *
     * @since 2.0.0
     */
    public function testSetDefaultValuesOfActiveElements()
    {
        $formActiveElements = $this->sefv2modsimpleemailformProperties['formActiveElements']
            ->getValue($this->sefv2modsimpleemailform);

        $formActiveElementsCount = $this->sefv2modsimpleemailformProperties['formActiveElementsCount']
            ->getValue($this->sefv2modsimpleemailform);

        $instance = $this->sefv2modsimpleemailformProperties['formInstance']
            ->getValue($this->sefv2modsimpleemailform);

        $fieldValueName = $this->sefv2modsimpleemailformProperties['fieldValueName']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray = $this->sefv2modsimpleemailformProperties['paramsArray']
            ->getValue($this->sefv2modsimpleemailform);

        $paramsArray[$formActiveElements[0] . $fieldValueName] = 'Test value';
        $paramsArray[$formActiveElements[1] . $fieldValueName] = 'Another test value';

        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock
            ->shouldReceive('setValue')
            ->twice()
            ->withArgs(array($formActiveElements[0] . '_' . $instance, '', 'Test value'));

        $jFormMock
            ->shouldReceive('setValue')
            ->twice()
            ->withArgs(array($formActiveElements[1] . '_' . $instance, '', 'Another test value'));

        $this->sefv2modsimpleemailformMethods['setDefaultValuesOfActiveElements']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formActiveElements, $formActiveElementsCount, $paramsArray, $jFormMock)
        );
    }

    /**
     * Tests sefv2modsimpleemailform::sendFormData(
     *                                      array $formDataClean,
     *                                      array $paramsArray,
     *                                      sefv2simpleemailformemailmsg $emailMsg,
     *                                      \JMail $jMail
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testSendFormData()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->twice()
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
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testSendFormDataAndIncludeArticleTitle()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
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
            ->with("\nArticle Title: Home: Article")
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('send')
            ->twice()
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
     *                                  ).
     *
     * @since 2.0.0
     */
    public function testSendFormDataWillReturnFalseIfEmailIsNotSent()
    {
        list(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $jDocumentMock,
            $jMailMock
            ) = $this->setUpSendFormDataTests();

        $jMailMock
            ->shouldReceive('send')
            ->once()
            ->andReturn(false);

        $output = $this->sefv2modsimpleemailformMethods['sendFormData']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($formCleanData, $paramsArray, $emailMsg, $jMailMock)
        );
        $this->assertFalse($output);
    }

    /**
     * Creates the test doubles that are called from \sefv2modsimpleemailform's sendFormData tests.
     *
     * @since 2.0.0
     */
    public function setUpSendFormDataTests()
    {
        defined('JVERSION') || define('JVERSION', '3.0');

        $formCleanData = array(
            'mod_simpleemailform_field1_1' => 'root@localhost',
            'mod_simpleemailform_field2_1' => 'Test',
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

        $paramsArray[$formPrefixName . $emailToName] = 'root@localhost';

        $jDocumentMock = $this->jDocumentMock;

        $jMailMock = $this->jMailMock;
        $jMailMock
            ->shouldReceive('setSender')
            ->once()
            ->with('root@localhost')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setSubject')
            ->once()
            ->with('Test')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('setBody')
            ->once()
            ->with('')
            ->andReturn($jMailMock);
        $jMailMock
            ->shouldReceive('addRecipient')
            ->once()
            ->with(array('root@localhost'))
            ->andReturn($jMailMock);

        return array(
            $formCleanData,
            $emailMsg,
            $paramsArray,
            $formPrefixName,
            $emailToName,
            $jDocumentMock,
            $jMailMock
        );
    }

    /**
     * Tests sefv2modsimpleemailform::testDump($data, $indent = 0).
     *
     * @since 2.0.0
     */
    public function testTestDump()
    {
        $output = $this->sefv2modsimpleemailformMethods['testDump']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($this->sefv2modsimpleemailform)
        );

        $this->assertEquals(1, preg_match('/Object \(sefv2modsimpleemailform\)/', $output));
    }

    /**
     * Tests sefv2modsimpleemailform::uploadFile($fileName, $fileTmpName, \JFile $jFile)
     *
     * @since 2.0.0
     */
    public function testUploadFile()
    {
        $return_value_generator = function () {
            static $counter = 0;

            $counter++;

            switch ($counter) {
                case 1:
                    return true;
                case 2:
                    return false;
                default:
                    throw new Exception("Should never reach this.");
            }
        };

        $filename = 'desttestfile.txt';
        $fileTmpName = '/tmp/temptestfile.txt';

        $jFileMock = $this->jFileMock;
        $jFileMock
            ->shouldReceive('makeSafe')
            ->times(3)
            ->with($filename)
            ->andReturn($filename);
        $jFileMock
            ->shouldReceive('getExt')
            ->times(3)
            ->with($filename)
            ->andReturn('txt');
        $jFileMock
            ->shouldReceive('upload')
            ->twice()
            ->withArgs(array($fileTmpName, Mockery::any()))
            ->andReturnUsing($return_value_generator);

        // Test a normal upload
        $output = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName, $this->jFileMock)
        );
        $this->assertTrue($output);
        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);
        $this->assertEquals(1, count($emailMsg->attachment));

        // Disallow TXT file extension.
        $emailMsg->attachment = array();
        $this->sefv2modsimpleemailformProperties['uploadAllowedFilesArray']
            ->setValue($this->sefv2modsimpleemailform, array('.doc'));
        $output2 = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName, $this->jFileMock)
        );
        $this->assertFalse($output2);
        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);
        $this->assertEquals(0, count($emailMsg->attachment));

        // Reset allowed file extensions but simulate JFile::upload error (generator returns false).
        $this->sefv2modsimpleemailformProperties['uploadAllowedFilesArray']
            ->setValue($this->sefv2modsimpleemailform, array());
        $output3 = $this->sefv2modsimpleemailformMethods['uploadFile']->invokeArgs(
            $this->sefv2modsimpleemailform,
            array($filename, $fileTmpName, $this->jFileMock)
        );
        $this->assertFalse($output3);
        $emailMsg = $this->sefv2modsimpleemailformProperties['emailMsg']
            ->getValue($this->sefv2modsimpleemailform);
        $this->assertEquals(0, count($emailMsg->attachment));
    }

    /**
     * Tests sefv2modsimpleemailform::validate(array $data, $group = null).
     *
     * @since 2.0.0
     */
    public function testValidateProxy()
    {
        $jFormMock = Mockery::mock('overload:JForm');
        $jFormMock->shouldReceive('validate')->once()->withArgs(array(array(), null));

        $this->sefv2modsimpleemailformProperties['jForm']
            ->setValue($this->sefv2modsimpleemailform, $jFormMock);

        $this->sefv2modsimpleemailform->validate(array());
    }
}
