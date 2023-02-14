<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * setting primaryKey for posts table
     * 
     * @var string
     */
    protected $primaryKey = 'post_id';

    // public function get()
    // {

    // }

    public function post(array $data)
    {
        self::insert($data);
    }
}
