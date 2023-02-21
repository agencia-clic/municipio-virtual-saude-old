<?php
namespace App\Helpers;

class Mask {

    /**
     * Create a new default function.
     *
     * @return void
     */
    public static function default($val, $mask)
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($val[$k])) {
                    $maskared .= $val[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }

    /**
     * Create a new default function.
     *
     * @return void
    */
    public static function AvatarShortName($name = "usuário")
    {
        if ($name <> '') {
            $comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
            $semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
            $name = strtoupper(str_replace($comAcentos, $semAcentos, $name)); // maiusculo e sem acentos

            //region first/last
            $parts = explode(" ", $name);

            if (count($parts) >= 2) {
                $lastname = array_pop($parts);
                while (count($parts) > 1) {
                    array_pop($parts);
                }
                $firstname = implode(" ", $parts);
            } else {
                $firstname = $parts[0];
                $lastname = $parts[0];
            }
            //endregion - end - first/last

            $array = array(
                'firstname' => $firstname,
                'lastname' => $lastname,
            );

            if ($array['firstname'] <> $array['lastname']) {
                return substr($array['firstname'], 0, 1) . substr($array['lastname'], 0, 1);
            } else if (strlen($name) >= 2) {
                return substr($array['firstname'], 0, 2);
            } else {
                return substr($array['firstname'], 0, 1) . substr($array['firstname'], 0, 1);
            }
        } else {
            return "..";
        }
    }

    public static function birth($data)
    {
        if($data):
            list($year, $month, $day) = explode('-', $data);
            $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $birth = mktime( 0, 0, 0, $month, $day, $year);
            return floor((((($today - $birth) / 60) / 60) / 24) / 365.25);
        endif;
    }
}