<?php

namespace App\Model;

class SalleManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'salle';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}