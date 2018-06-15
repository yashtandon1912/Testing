<?php

use app\models\LoginForm;
use PHPUnit\Framework\Assert;

class LoginTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {

    }

    protected function _after()
    {
          \Yii::$app->user->logout();
    }

    // tests
    public function testLoginNoUser()
    {
        $this->tester = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        expect_not($this->tester->login());
        expect_that(\Yii::$app->user->isGuest);
    }
    public function testLoginWrongPassword()
    {
        $this->tester = new LoginForm([
            'username' => 'demo',
            'password' => 'wrong_password',
        ]);

        expect_not($this->tester->login());
        expect_that(\Yii::$app->user->isGuest);
        expect($this->tester->errors)->hasKey('password');
    }

    public function testLoginCorrect()
    {
        $this->tester = new LoginForm([
            'username' => 'demo',
            'password' => 'demo',
        ]);

        expect_that($this->tester->login());
        expect_not(\Yii::$app->user->isGuest);
        expect($this->tester->errors)->hasntKey('password');
    }

}
