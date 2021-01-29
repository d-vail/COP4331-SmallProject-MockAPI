<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the user that owns this tag.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The contacts that belong to this tag.
     */
    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'tag_contacts');
    }
}
