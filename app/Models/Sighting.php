<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sighting extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function client()
    {
        return $this->belongsTo(User::class);
    }

    public function getGPS() {
        if (($this->lat==0)&&($this->long==0)) {

            return __("Keine Angabe");
        } else {

            return "<a href='http://www.google.com/maps/place/{$this->lat},{$this->long}'>{$this->lat},{$this->long}</a>";
        }
    }
}
