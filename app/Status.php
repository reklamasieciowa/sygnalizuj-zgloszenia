<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Entry;

class Status extends Model
{
	protected $fillable = [
        'name',
    ];

    public function entries()
    {
        return $this->HasMany(Entry::class);
    }
}
