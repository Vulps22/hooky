<?php

use PHPUnit\Framework\TestCase;

class TestBase extends TestCase{

    protected $sql;
    protected $testUserId;

    protected function setUp(): void
    {
        $this->sql = new SQL();
        $this->testUserId = null;

        $testTarget = [
            'email' => 'jane@example.com',
            'password' => 'password',
            'dob' => '1993-03-24',
            'terms_accepted' => '0000-00-00'
        ];


        $this->testUserId = $this->sql->insert('user', $testTarget);
    }

    protected function tearDown(): void
    {
        $this->sql->delete('user', $this->testUserId, 'id');
    }
}

?>