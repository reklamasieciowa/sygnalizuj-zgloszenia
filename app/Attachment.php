<?php

namespace App;

use App\Entry;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'entry_id', 'file_name', 'mime',
    ];

    public function entry()
    {
    	return $this->belongsTo(Entry::class);
    }
}
