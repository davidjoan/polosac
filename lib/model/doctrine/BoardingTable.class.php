<?php

/**
 * BoardingTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class BoardingTable extends DoctrineTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object BoardingTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Boarding');
    }
}