<?php

class AdminLoginCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }

    public function login(AcceptanceTester $I)
    {
        $I->amOnPage('/administrator/index.php');
        $I->comment('Fill Username Text Field');
        $I->fillField('#mod-login-username', 'admin');
        $I->comment('Fill Password Text Field');
        $I->fillField('#mod-login-password', 'admin');
        $I->comment('I click Login button');
        $I->click('Log in');
        $I->comment('I see Administrator Control Panel');
        $I->see('Control Panel', '.page-title');
    }
}
