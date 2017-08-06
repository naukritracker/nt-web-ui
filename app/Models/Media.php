<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'media';

     /**
     * Defining One to One relationship with User detail Model.
     *
     */
    public function userdetail()
    {
        return $this->belongsTo('App\Models\UserDetail', 'resume_media_id', 'id');
    }
}
