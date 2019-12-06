<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App
 * @property integer sender_id
 * @property integer receiver_id
 * @property string message
 */
class Message extends Model
{
    protected $table = 'messages';

    protected  $fillable = ['sender_id', 'receiver_id', 'message'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receiver()
    {
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }
}
