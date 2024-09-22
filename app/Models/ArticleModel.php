<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $allowedFields = ['title', 'content'];
    protected $returnType = \App\Entities\Article::class;

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'content' => 'required',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Please enter a title.',
            'min_length' => 'The {field} must be at least 3 characters long.',
            'max_length' => 'The {field} cannot exceed 255 characters.',
        ],
        'content' => [
            'required' => 'Please enter the content.',
        ],
    ];
}