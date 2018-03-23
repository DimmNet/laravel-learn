<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tasks extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'complete'
    ];

    /**
     * Получить пользователя.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Обрезает текст из body до 40 слов.
     *
     * @return string
     */
    public function getShortBodyAttribute()
    {
        $string = strip_tags($this->body);
        return Str::words($string, 40);
    }

    /**
     * Заменяет пробелы на нижнее подчеркивание в заголовке.
     *
     * @return string
     */
    public function getClearTitleAttribute()
    {
        return str_slug($this->title, '_');
    }
}
