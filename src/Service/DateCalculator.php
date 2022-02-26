<?php

namespace App\Service;

class DateCalculator {

    public function yearsDifference($year) {
        $curYear = date( format: 'Y' );
        $diff = $curYear - $year;
        return $diff;
    }

}