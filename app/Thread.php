<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }
}
