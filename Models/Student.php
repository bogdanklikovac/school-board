<?php


use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'students';
    protected $guarded = [];


    public function board() {
        return $this->belongsTo(Board::class);
    }

    public function grade() {
        return $this->hasMany(Grade ::class);
    }
}