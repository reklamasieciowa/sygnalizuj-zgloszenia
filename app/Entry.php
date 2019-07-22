<?php

namespace App;

use App\Attachment;
use App\Status;
use App\Subject;
use Illuminate\Database\Eloquent\Model;
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

    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }
}
