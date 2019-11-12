<?php


namespace App\Model;

class ContactManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'Contact';

    /**
     * Initialise cette class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }
}