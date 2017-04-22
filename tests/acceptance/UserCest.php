<?php


class UserCest
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
        $I->amOnPage('/login');
        $I->fillField('username', 'user');
        $I->fillField('password', 'user');
        $I->click('login');
        $I->see('Welcome to Recipe Collection');
    }
}
