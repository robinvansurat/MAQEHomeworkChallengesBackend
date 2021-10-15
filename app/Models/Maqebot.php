<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maqebot extends Model
{
    use HasFactory;

    public static function decodeCodex($codex)
    {
        $codex = strtoupper($codex);
        $delimiters = ['R', 'L', 'W'];
        // $newStr = str_replace($delimiters, $delimiters[0], $codex); // 'foo. bar. baz.'

        // $parts = preg_split('@(?<=R|W|L|\d)@', $codex);

        // $arr = explode($delimiters[0], $codex);
        $chars = preg_split('//', $codex, -1, PREG_SPLIT_NO_EMPTY);
        $decode_codex = [];
        $previous = null;
        $NR = "";
        $allow_case = ["R", "r", "L", "l", "W", "w"];
        foreach ($chars as $key => $value) {
            if (
                (($previous === "W") && (!is_numeric($value)))
                || (($previous === "R") && (is_numeric($value)))
                || (($previous === "L") && (is_numeric($value)))
            ) {
                // return ["false" => $decode_codex, $key => $value];
                return false;

            } else {
                if (is_numeric($value)) {
                    $NR = $NR . $value;
                    $previous = null;
                } elseif (in_array($value, $allow_case)) {
                    if ($NR !== "") {
                        $decode_codex[] = (int) $NR;
                        $NR = "";
                    }
                    if (is_string($value)) {
                        $decode_codex[] = $value;
                        $previous = $value;
                    }
                } else {
                    return false;
                }
            }
        }
        if ($NR !== "") {
            $decode_codex[] = (int) $NR;
        }

        return [$codex, $decode_codex]; // ['foo', 'bar', 'baz', '']
        // $codex = preg_split('/ (R|W) /', $codex);
        // return $codex;
    }
}
