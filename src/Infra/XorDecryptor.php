<?php

namespace App\Infra;

class XorDecryptor
{
    public function xorThis($text, $key)
    {
        $outText = '';

        for($i=0; $i<strlen($text); ) {
            for($j=0; ($j<strlen($key) && $i<strlen($text)); $j++,$i++) {
                $outText .= $text{$i} ^ $key{$j};
//                echo 'i=' . $i . ', ' . 'j=' . $j . ', ' . $outText{$i} . "\n"; // For debugging
            }
        }

        return $outText;
    }
}