<?php

namespace App\Model;

class GenreManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'genre';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}