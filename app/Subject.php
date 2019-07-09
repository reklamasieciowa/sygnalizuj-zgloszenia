<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Entry;

class Subject extends Model
{
    protected $fillable = [
        'name',
    ];

    public function entries()
    {
        return $this->HasMany(Entry::class);
    }
}

