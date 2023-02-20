<?php
namespace App\Helpers;

class Mask2 {

    public function AvatarShortName($name = "usuário")
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

    public function birth($data)
    {
        if($data):
            list($year, $month, $day) = explode('-', $data);
            $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $birth = mktime( 0, 0, 0, $month, $day, $year);
            return floor((((($today - $birth) / 60) / 60) / 24) / 365.25);
        endif;
    }

    public function float_min($num) {
        $num = number_format($num,2);
        $num_temp = explode('.', $num);
        $num_temp[1] = $num-(number_format($num_temp[0],2));
        $saida = number_format(((($num_temp[1]) * 60 / 100)+$num_temp[0]),2);
        $saida = strtr($saida,'.',':');
        return $saida;
        
    }

    public function dataDifference($a, $b, $c)
    {
        $start_date = new \DateTime($a);
        $since_start = $start_date->diff(new \DateTime($b));

        if($c=='m'):
            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            return $minutes += $since_start->i;
        elseif($c == "h"):

            $minutes = $since_start->days * 24 * 60;
            $minutes += $since_start->h * 60;
            return $this->float_min(($minutes += $since_start->i) / 60);

        else:
            return 0;
        endif;
    }

    public function nowGreater($a)
    {
        $date_one = new \DateTime($a);
        $date_two = new \DateTime('now');            
        return ($date_one > $date_two);
    }

    public function date_extensive($date)
    {
        $formatter = new \IntlDateFormatter(
        'pt_BR',
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'America/Sao_Paulo',          
            \IntlDateFormatter::GREGORIAN
        );

        return $formatter->format($date);
    }
    
}