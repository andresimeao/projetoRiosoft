<?php

namespace Utils;

class DateTimeUtils {

    /**
     * Método para adcionar dias a partir de um time previamente informado.
     * @var int $time Unix Time.
     * @var int $days Quantidade de dias a ser adcionado no Unix Time.
     * @author Gustavo Henrique Evaristo dos Santos <gustavo.evaristo@riosoft.com.br>
     */
    public static function getDateWithAddDays($time, $days) {
        return date('Y-m-d H:i:s', ($time + (86400 * $days)));
    }

}