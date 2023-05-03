<?php
    class SQLTest extends TestBase
    {

        private $testData = [
            'email' => 'jane@example.com',
            'password' => 'password',
            'dob' => '1993-03-24',
            'terms_accepted' => '0000-00-00'
        ];

        public function testSelect()
        {
            // Insert a test user
            $expectedResult['id'] = $this->testUserId = $this->sql->insert('user', $this->testData);

            // Perform the select operation
            array_push($expectedResult, $this->testData);
            $expectedKeys = ['id', 'password', 'email', 'dob', 'terms_accepted', 'created_date', 'last_updated_date'];
            $result = $this->sql->select('user', $this->testUserId);

            $this->assertEquals(
                array_keys($result),
                $expectedKeys,
                'SQL Select returns all columns from the table'
            );
        }

        public function testInsert()
        {
            $this->testUserId = $this->sql->insert('user', $this->testData);

            $this->assertIsNumeric($this->testUserId, 'SQL insert returns numeric ID from user table');
        }

        public function testUpdate()
        {

            $this->testUserId = $this->sql->insert('user', $this->testData);

            // Prepare test data
            $table = 'user';
            $id = $this->testUserId;
            $data = [
                'email' => 'jane.doe@example.com',
                'dob' => '1994-05-10',
                'terms_accepted' => '2022-01-01'
            ];

            // Perform the update operation
            $result = $this->sql->update($table, $id, $data);

            // Assertions
            $this->assertEquals($this->testUserId, $result, 'SQL update operation successful');
        }

        public function testDelete()
        {
            $this->testUserId = $this->sql->insert('user', $this->testData);
            // Prepare test data
            $table = 'user';
            $id = $this->testUserId;

            // Perform the delete operation
           $result = $this->sql->delete($table, $id);

            // Assertions
            $this->assertTrue($result, 'SQL delete operation Successful');
        }
    }
?>