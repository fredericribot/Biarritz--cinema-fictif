<?php

namespace App\Model;

class TarifManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'tarif';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}