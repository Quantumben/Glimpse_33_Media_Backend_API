<?php
namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class Helper {

    static function errorLogger(Throwable|Exception $th): void
    {
        if (app()->environment() != 'production') {
            throw $th;
        }

        Log::error($th->getMessage(), [$th->getFile().':'.$th->getLine()]);
    }

    static function generateTransactionID(): string
    {
        $prefix = "PREFIX-";
        $timestamp = time();
        $rand = substr(str_shuffle('aBcDeFgHiJklMnOPqRsTuVwXyZ1234567890'), 0, 9);
        $transactionID = $prefix . $timestamp . $rand;

        return $transactionID;
    }

}
