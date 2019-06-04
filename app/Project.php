<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = [
        'name',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }


    public function setNameAttribute($value = '')
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }


    public function materials()
    {
        return $this->belongsToMany(Material::class)->withTimestamps()->withPivot('amount', 'recipient');
    }
}
