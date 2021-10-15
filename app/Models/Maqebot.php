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

        return $decode_codex;
    }
}
