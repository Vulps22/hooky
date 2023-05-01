<?php

    use PHPUnit\Framework\TestCase;

    class UserTest extends TestCase
    {
        private $sql;
        private $testUserId;
        private $testData = [
            'email' => 'jane@example.com',
            'password' => 'password',
            'dob' => '1993-03-24',
            'terms_accepted' => '0000-00-00'
        ];

        protected function setUp(): void
        {
            $this->sql = new SQL();
            $this->testUserId = null;
        }

        protected function tearDown(): void
        {
            if ($this->testUserId !== null) {
                $this->sql->delete('profile', $this->testUserId, 'user_id');
                $this->sql->delete('user', $this->testUserId, 'id');
                

            }
        }

        public function testConstructWithValidId()
        {
            // Insert a test user
            $this->testUserId = $this->sql->insert('user', $this->testData);

            // Instantiate User with valid ID
            $user = new User($this->testUserId);

            $this->assertInstanceOf(User::class, $user);
        }

        public function testConstructWithInvalidId()
        {
             // Assert that an exception is thrown when trying to instantiate User with an invalid ID
            $this->expectException(Exception::class);
            $this->expectExceptionMessage('Invalid User ID');

            // Instantiate User with invalid ID
            $user = new User(1);

            
        }

        public function testGetUser()
        {
            // Insert a test user
            $this->testUserId = $this->sql->insert('user', $this->testData);

            // Instantiate User with valid ID
            $user = new User($this->testUserId);

            // Perform getUser() method
            $userData = $user->getUser();

            $expectedData = [
                'id' => $this->testUserId,
                'email' => $this->testData['email'],
                'dob' => $this->testData['dob'],
                // Add any other expected data
            ];

            $this->assertArrayHasKey('id', $userData);
            $this->assertEquals($expectedData['id'], $userData['id']);
        
            $this->assertArrayHasKey('email', $userData);
            $this->assertEquals($expectedData['email'], $userData['email']);
        
            $this->assertArrayHasKey('dob', $userData);
            $this->assertEquals($expectedData['dob'], $userData['dob']);
        }

        public function testGetUserProfileWithValidProfile()
        {
            // Insert a test user
            $this->testUserId = $this->sql->insert('user', $this->testData);

            // Insert a test profile for the user
            $profileData = [
                'user_id' => $this->testUserId,
                'display_name' => 'Jane Doe',
                'gender' => 'female',
                'sexuality' => 'straight',
                'bio' => 'I am a cool person.',
                'show_age' => 1,
                'height' => 170,
                'weight' => 60,
                'body_type' => 'toned',
                'position' => 'vers',
                'ethnicity' => 'Caucasian',
                'status' => 'single',
                'nsfw' => 0
            ];

            $profileId = $this->sql->insert('profile', $profileData);

            // Instantiate User with valid ID
            $user = new User($this->testUserId);

            // Perform getUserProfile() method
            $profile = $user->getUserProfile();

            // Create a new array with only the expected fields
            $expectedProfile = [
                'user_id' => $profileData['user_id'],
                'display_name' => $profileData['display_name'],
                'gender' => $profileData['gender'],
                'sexuality' => $profileData['sexuality'],
                'bio' => $profileData['bio'],
                'show_age' => $profileData['show_age'],
                'height' => $profileData['height'],
                'weight' => $profileData['weight'],
                'body_type' => $profileData['body_type'],
                'position' => $profileData['position'],
                'ethnicity' => $profileData['ethnicity'],
                'status' => $profileData['status'],
                'nsfw' => $profileData['nsfw'],
            ];

            $this->assertEquals($profileData, $expectedProfile);
        }

        public function testGetUserProfileWithInvalidProfile()
        {
            // Insert a test user
            $this->testUserId = $this->sql->insert('user', $this->testData);

            // Instantiate User with valid ID
            $user = new User($this->testUserId);

            // Perform getUserProfile() method
            $profile = $user->getUserProfile();

            $this->assertFalse($profile);
        }
    }



?>