<?php

if (!function_exists('GetRequiredJobs')) {

    /**
     * Translates bit flag reqJob to comma de-limited string of required jobs.
     *
     * @param reqJob
     * @return Comma de-limited string of required jobs
     */
    function GetRequiredJobs($jobId)
    {
        if ($jobId == 0) return 'Beginner';
        $requiredJob = [];

        if (($jobId & 1) == 1) $requiredJob[] = 'Warrior';
        if (($jobId & 2) == 2) $requiredJob[] = 'Magician';
        if (($jobId & 4) == 4) $requiredJob[] = 'Bowman';
        if (($jobId & 8) == 8) $requiredJob[] = 'Thief';
        if (($jobId & 16) == 16) $requiredJob[] = 'Pirate';

        return implode(', ', $requiredJob);
    }
}

if (!function_exists('GetTradeAvailable')) {
    function GetTradeAvailable($tradeAvailable) {
        if ($tradeAvailable == 0) return 'Not tradeable';
        if ($tradeAvailable == 1) return 'Tradeable';
        if ($tradeAvailable == 2) return 'Tradeable until equipped';
    }
}

if (!function_exists('GetRandomSkin')) {
    function GetRandomSkin() {
        $skins = [2000, 2004, 2010, 2001, 2003, 2005, 2013, 2002, 2011];
        return $skins[rand(0, count($skins)-1)];
    }
}
