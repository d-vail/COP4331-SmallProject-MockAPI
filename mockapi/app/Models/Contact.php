<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'image_url',
        'street_address',
        'city',
        'state',
        'zip',
        'notes',
    ];

    /**
     * Get the user that owns this contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to this contact.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_contacts');
    }
}