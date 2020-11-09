<?php


use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

    protected $table = 'grades';
    protected $guarded = [];


    public function student() {
        return $this->belongsTo(Student::class);
    }
}