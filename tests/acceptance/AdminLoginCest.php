<?php

class AdminLoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function _tryToTest(AcceptanceTester $I)
    {
    }

    public function _setModulePositionCustom(AcceptanceTester $I, $module, $position = 'position-7')
    {
        $I->amOnPage('administrator/index.php?option=com_modules');
        $I->searchForItem($module);
        $I->click(['link' => $module]);
        $I->waitForElement(['id' => 'general'], 30);
        $I->selectOptionInChosen('Position', $position);
        $I->click(['xpath' => "//div[@id='toolbar-apply']/button"]);
        $I->waitForText('Module successfully saved', 30, ['id' => 'system-message-container']);
    }

    // tests
    public function installJoomlaRemoveInstallDirInstallEnableAndPublishSEFv2(\AcceptanceTester $I)
    {
        $module = 'Simple Email Form';
        $moduleDir = '/tmp/mod_simpleemailform';
        $position = 'position-2';
        $adminEmail = 'root@localhost';

        $I->installJoomlaRemovingInstallationFolder();
        $I->doAdministratorLogin();
        $I->installExtensionFromFolder($moduleDir);
        $I->displayModuleOnAllPages($module);
        $I->publishModule($module);
        $this->_setModulePositionCustom($I, $module, $position);

        $I->amOnPage('administrator/index.php?option=com_modules');
        $I->searchForItem($module);
        $I->click(['link' => $module]);
        $I->waitForElement(['id' => 'general'], 30);
        $I->fillField('#jform_params_mod_simpleemailform_emailTo', $adminEmail);
        $I->checkOption("#jform_params_mod_simpleemailform_formType0");
        $I->click(['xpath' => "//div[@id='toolbar-apply']/button"]);
        $I->amOnPage('/');
        $I->see('From');
        $I->see('Subject');
    }
}
