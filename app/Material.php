<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'code', 'group', 'name',
        'measure', 'stock', 'min',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function rules()
    {
        return[
            'code' => 'required|string|max:255',
            'group' => 'required|numeric|min:0',
            'name' => 'required|string|max:255',
            'measure' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',
            'min' => 'required|numeric|min:0',
        ];
    }


    public function setNameAttribute($value = '')
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_UPPER, "UTF-8");
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withTimestamps()->withPivot('amount', 'recipient');
    }

}
