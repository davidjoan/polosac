<?php

/**
 * ScheduleBusValidator.
 *
 * @package    polosac
 * @subpackage validator
 * @author     David Joan Tataje Mendoza <new.skin007@gmail.com>
 */
class ScheduleBusValidator extends sfGlobalValidator {

    protected function configure($options = array(), $messages = array()) {
        $this->setMessage('invalid', 'Este bus ya esta programado para esa fecha');
    }

    protected function doClean($value) {
        if (!is_array($value)) {
            throw new sfValidatorError($this, 'invalid');
        }

        $qty = Doctrine::getTable('Schedule')->findOneByIdAndTravelDate($value['bus_id'], $value['travel_date']);

        if (is_null($value['id'])) { //es nuevo
            if ($qty > 0) {
                throw new sfValidatorError($this, 'invalid');
            }
        } else {
            if ($qty > 1) {//ya existe
                throw new sfValidatorError($this, 'invalid');
            }
        }



        return $value;
    }

}
