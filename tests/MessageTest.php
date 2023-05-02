<?php

use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{

    private $sql;
    private $testSenderId;
    private $testTargetId;
    private $testMessageId;

    protected function setUp(): void
    {
        $this->sql = new SQL();
        $this->testSenderId = null;
        $this->testTargetId = null;
        $this->testMessageId = null;

        $testSender = [
            'email' => 'jane@example.com',
            'password' => 'password',
            'dob' => '1993-03-24',
            'terms_accepted' => '0000-00-00'
        ];

        $testTarget = [
            'email' => 'jane@example.com',
            'password' => 'password',
            'dob' => '1993-03-24',
            'terms_accepted' => '0000-00-00'
        ];

        $this->testTargetId = $this->sql->insert('user', $testTarget);
        $this->testSenderId = $this->sql->insert('user', $testSender);
    }

    protected function tearDown(): void
    {
        $this->sql->delete('message', $this->testMessageId, 'id');
        $this->sql->delete('user', $this->testSenderId, 'id');
        $this->sql->delete('user', $this->testTargetId, 'id');
    }

    public function testSave()
    {
        // Create a new instance of the Message class
        $message = new Message();

        // Set the message properties
        $message->sender = $this->testSenderId;
        $message->target = $this->testTargetId;
        $message->body = 'body';
        $message->state = MessageState::SENDING;

        // Call the save method
        $message->save();

        $this->testMessageId = $message->id;

        // Assert that the message has been saved successfully
        $this->assertNotNull($message->id, "ID is Null");
        $this->assertNotNull($message->date, "Date Is Null");
    }

    public function testLoad()
    {

        //create a new message to load
         $message = new Message();

         // Set the message properties
         $message->sender = $this->testSenderId;
         $message->target = $this->testTargetId;
         $message->body = 'body';
         $message->state = MessageState::SENDING;

         // Call the save method
         $message->save();

         $this->testMessageId = $message->id;

         $this->assertNotNull($this->testMessageId);

        // Create a new instance of the Message class
        $message = new Message();

        // Attempt to load a message with a valid ID
        $message->load($this->testMessageId);

        // Assert that the message properties are set correctly
        $this->assertEquals($this->testSenderId, $message->sender, "Sender ID Failed");
        $this->assertEquals($this->testTargetId, $message->target, "Target ID Failed");
        $this->assertEquals('body', $message->body, "Message Body Failed");
        $this->assertEquals(MessageState::SENDING, $message->state, "Message State Failed");
        $this->assertNotNull($message->date, "Message Date Failed");
    }

    public function testLoadInvalidId()
    {
        // Create a new instance of the Message class
        $message = new Message();

        // Attempt to load a message with an invalid ID
        $this->expectException(Exception::class);
        $message->load(null);
    }

    public function testSaveMissingFields()
    {
        // Create a new instance of the Message class
        $message = new Message();

        // Attempt to save the message without setting required fields
        $this->expectException(Exception::class);
        $message->save();
    }

    public function testToArray()
    {
        // Create a new instance of the Message class
        $message = new Message();

        // Set the message properties
        $message->sender = '1';
        $message->target = '2';
        $message->body = 'body';
        $message->state = MessageState::SENT;
        $message->date = 'date';

        // Call the toArray method
        $data = $message->toArray();

        // Assert that the returned data is as expected
        $this->assertEquals('1', $data['sender']);
        $this->assertEquals('2', $data['target']);
        $this->assertEquals('body', $data['text']);
        $this->assertEquals(MessageState::SENT, $data['state']);
        $this->assertEquals('date', $data['date']);
    }

    public function testToJson()
    {
        // Create a new instance of the Message class
        $message = new Message();

        // Set the message properties
        $message->sender = 'sender';
        $message->target = 'target';
        $message->body = 'body';
        $message->state = 'state';
        $message->date = 'date';

        // Call the toJson method
        $json = $message->toJson();

        // Assert that the returned JSON is valid and contains the expected values
        $expectedJson = '{"sender":"sender","target":"target","text":"body","state":"state","date":"date"}';
        $this->assertJsonStringEqualsJsonString($expectedJson, $json);
    }
}



?>