<?php

namespace App\Model;

class HoraireManager extends AbstractManager
{
    /**
     * 
     */
    const TABLE = 'horaire';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function getActual()
    {
        date_default_timezone_set('Europe/Paris');

        $now = date('H');
        return $now;
    }
}