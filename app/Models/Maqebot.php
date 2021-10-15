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

        return $decode_codex; // ['foo', 'bar', 'baz', '']
        // $codex = preg_split('/ (R|W) /', $codex);
        // return $codex;
    }

    public static function findTheResult($codex)
    {
        $x = 0;
        $y = 0;
        $direction = ["North", "East", "West", "South"];
        $direction_present = $direction[0];
        foreach ($codex as $key => $value) {
            switch ($value) {
                case 'R':
                    switch ($direction_present) {
                        case 'North':
                            $direction_present = $direction[1];
                            break;
                        case 'East':
                            $direction_present = $direction[3];
                            break;
                        case 'West':
                            $direction_present = $direction[0];
                            break;
                        default:
                            $direction_present = $direction[2];
                            break;
                    }
                    break;
                case 'L':
                    switch ($direction_present) {
                        case 'North':
                            $direction_present = $direction[2];
                            break;
                        case 'East':
                            $direction_present = $direction[0];
                            break;
                        case 'West':
                            $direction_present = $direction[3];
                            break;
                        default:
                            $direction_present = $direction[1];
                            break;
                    }
                    break;
                case 'W':
                    # code...
                    break;
                default:
                    switch ($direction_present) {
                        case 'North':
                            $y += $value;
                            break;
                        case 'East':
                            $x += $value;

                            break;
                        case 'West':
                            $x -= $value;

                            break;
                        default:
                            $y -= $value;

                            break;
                    }
                    break;
            }
        }

        return ["x"=>$x,"y"=>$y,"direction"=>$direction_present];
    }
}
