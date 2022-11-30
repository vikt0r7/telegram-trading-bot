<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Channel
 * @package App\Models
 * @version November 30, 2022, 1:33 pm UTC
 *
 * @property string $name
 * @property string $tag
 */
class Channel extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'channels';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'tag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'tag' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'string nullable',
        'tag' => 'string nullable'
    ];

    
}
