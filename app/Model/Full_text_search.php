<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Full_text_search extends Model
{
    use Notifiable;
    use SearchableTrait;

    protected $table = 'person_names';

    protected $searchable = [
        'columns' => [
            'person_names.id' => 10,
            'person_names.first_name' => 10,
            'person_names.last_name' => 10,
            'person_names.created_at' => 10,
            'person_names.updated_at' => 10,
        ]
    ];

    protected $guarded = [];
}
