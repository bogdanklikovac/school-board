<?php


use Illuminate\Database\Eloquent\Model;

class Board extends Model {

    protected $table = 'boards';
    protected $guarded = [];

    public function student() {
        return $this->hasMany(Student ::class);
    }

}