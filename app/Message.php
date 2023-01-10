<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['message','reciever'];
    //appends the sender email to the message
    protected $appends = ['sender_email','message_time'];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the sender of the message
     *
     * @return string
     */
    public function getSenderEmailAttribute()
    {
        return $this->user->email;
    }


    /**
     * Get the sender of the message
     *
     * @return string
     */
    public function getMessageTimeAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
