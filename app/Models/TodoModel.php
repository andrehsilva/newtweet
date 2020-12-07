<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoModel extends Model
{
    use HasFactory;

    protected $table = 'todos';

    protected $fillable = ['title', 'completed','created_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }


    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'like', '%'.$search.'%')
                ->orWhere('title', 'like', '%'.$search.'%')
                ->orWhere('completed', 'like', '%'.$search.'%');
    }

}
