<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\Status;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
	use SoftDeletes;

	protected $dates = [
        'deleted_at',
    ];

    protected $hidden = [
        'hash',
    ];

    protected $fillable = [
        'company', 'subject_id', 'anonymous', 'person', 'who', 'what', 'where', 'when', 'how', 'attachment_id', 'why', 'already_done', 'agree', 'status_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
