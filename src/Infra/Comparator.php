<?php

namespace App\Infra;

class Comparator
{
    public function compare($words, $dicoWords, $key)
    {
        $i = 0;
        foreach ($words as $word) {

            if (!empty($word)) {
                if (strpos($dicoWords, $word) !== false) {
                    $i++;
//                echo 'TRUE. Word : '. $word . ' Key => ' . $key . "\n";
                }
            }
        }
        return ['words' => $i, 'key' => $key];
    }
}
