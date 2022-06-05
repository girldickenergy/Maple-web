<?php
    function GetHumanReadableDate($date)
    {
        return date("F jS, Y", strtotime($date));
    }

    function GetHumanReadableSubscriptionExpiration($expiry)
    {
        if (date("Y", strtotime($expiry)) == 2038)
            return "lifetime";

        return GetHumanReadableDate($expiry);
    }

    function GetHumanReadableDateTimeDifference($datetime1, $datetime2, $precision = 1)
    {
        if(!is_int($datetime1))
            $datetime1 = strtotime($datetime1);
    
        if(!is_int($datetime2))
            $datetime2 = strtotime($datetime2);
    
        $past = true;

        if ($datetime1 == $datetime2)
            return 'just now';
    
        if($datetime1 > $datetime2)
        {
            list($datetime1, $datetime2) = array($datetime2, $datetime1);
            $past = false;
        }
    
        $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
        $diffs = array();
    
        foreach($intervals as $interval)
        {
            $ttime = strtotime('+1 '.$interval, $datetime1);
    
            $add = 1;
            $looped = 0;
    
            while ($datetime2 >= $ttime)
            {
                $add++;
                $ttime = strtotime("+".$add." ".$interval, $datetime1);
                $looped++;
            }
    
            $datetime1 = strtotime("+".$looped." ".$interval, $datetime1);
            $diffs[$interval] = $looped;
        }
    
        $count = 0;
        $times = array();
        foreach($diffs as $interval => $value)
        {
            if($count >= $precision)
                break;
    
            if($value > 0)
            {
                if($value != 1)
                    $interval .= "s";
    
                $times[] = $value." ".$interval;
                $count++;
            }
        }
    
        if($past == true)
            $suffix = ' ago';
        else
            $suffix = ' from now';
    
        return implode(", ", $times).$suffix;
    }
?>