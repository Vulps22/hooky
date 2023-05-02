<?php

class MessageState {
    public const SENDING = 'sending';
    public const SENT = 'sent';
    public const RECEIVED = 'received';
    public const READ = 'read';
    public const DELETED = 'deleted';
}

class Message {

    public $id = null;
    public $sender = null;
    public $target = null;
    public $body = null;
    public $date = null;
    public $state = null;
    private $sql;

    function __construct(){
        $this->sql = new SQL();
    }

    public function load($id){
        if(!$id) throw new Exception("Attempted to load message without ID");

        $message = $this->sql->select('message', $id);
        $this->id = $message['id'];
        $this->sender = $message['sender'];
        $this->target = $message['target'];
        $this->body = $message['text'];
        $this->state = $message['state'];
        $this->date = $message['created_date'];
    }

    public function save()
    {
        if (!$this->sender || !$this->target || !$this->body || !$this->state) {
            throw new Exception("Missing required message data");
        }

        $this->date = date('Y-m-d H:i:s');
    
        $data = [
            'sender' => $this->sender,
            'target' => $this->target,
            'text' => $this->body,
            'state' => $this->state,
            'created_date' => $this->date
        ];


        $this->id = $this->sql->insert('message', $data);
    
        if (!$this->id) {
            throw new Exception("Failed to save message");
        }
    }
    

    public function toArray(){
        $data = [
            'sender' => $this->sender,
            'target' => $this->target,
            'text' => $this->body,
            'state' => $this->state
        ];

        if($this->id) $data['id'] = $this->id;
        if($this->date) $data['date'] = $this->date;

        return $data;
    }

    public function toJson(){

        return json_encode($this->toArray());

    }

}

?>