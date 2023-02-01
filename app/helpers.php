<?php
function character_limiter($str, $n = 500, $end_char = ' &#8230;')
{
    $str = strip_tags($str);
    if (strlen($str) < $n)
    {
        return html_entity_decode($str);
    }

    $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n", "&nbsp;"), ' ', $str));

    if (strlen($str) <= $n)
    {
        return html_entity_decode($str);
    }

    $out = "";
    foreach (explode(' ', trim($str)) as $val)
    {
        $out .= $val.' ';

        if (strlen($out) >= $n)
        {
            $out = trim($out);
            return (strlen($out) == strlen($str)) ? html_entity_decode($out) : html_entity_decode($out.$end_char);
        }
    }
}

function convertDateTimeToDate($tstamp)
{
    return date('F j, Y',strtotime($tstamp));
}

function convertDateTimeToDateTime($tstamp)
{
    $date = new DateTime($tstamp, new DateTimeZone('UTC'));
    $date->setTimezone(new DateTimeZone('America/New_York'));
    return $date->format('m/d g:iA');
}

function convertDateTimeToTime($tstamp)
{
    $date = new DateTime($tstamp, new DateTimeZone('UTC'));
    $date->setTimezone(new DateTimeZone('America/New_York'));
    return $date->format('g:iA');
}

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return '#'.random_color_part().random_color_part().random_color_part();
}

function timeDiff($tstamp)
{
    $date = new DateTime($tstamp);
    $now = new DateTime();
    $interval = $date->diff($now, true);

    if ($interval->y) {
        if($interval->y == 1) {
            return  $interval->y.' year ago';
        } else {
            return  $interval->y.' years ago';
        }
    } elseif ($interval->m) {
        if($interval->m == 1) {
            return  $interval->m.' month ago';
        } else {
            return  $interval->m.' months ago';
        }
    } elseif ($interval->d) {
        if($interval->d == 1) {
            return  $interval->d.' day ago';
        } else {
            return  $interval->d.' days ago';
        }
    } elseif ($interval->h) {
        if($interval->h == 1) {
            return  $interval->h.' hour ago';
        } else {
            return  $interval->h.' hours ago';
        }
    } elseif ($interval->i) {
        if($interval->i == 1) {
            return  $interval->i.' minute ago';
        } else {
            return  $interval->i.' minutes ago';
        }
    } else {
        return "Just now";
    }
}