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

if(!function_exists('ParseMapleString')) {
    function ParseMapleString($maple) {
        $maple = preg_replace('/#b([^#]+)#(k)?/i', '<span class="bold desc-b">$1</span>', $maple);
        $maple = preg_replace('/#c([^#]+)#(k)?/i', '<span class="bold desc-c">$1</span>', $maple);
        $maple = preg_replace('/#e([^#]+)#(k)?/i', '<span class="bold desc-e">$1</span>', $maple);
        $maple = preg_replace('/#([^#]+)#(k)?/i', '<span class="bold text-warning">$1</span>', $maple);

        // Replace newlines
        $maple = preg_replace('/\\n\\n/i', '<br>', $maple); // We don't want the description to be enormous
        $maple = preg_replace('/\\n/i', '<br>', $maple);

        // Now we need to account for #'s that DON'T end...
        $maple = preg_replace('/#b([^#]+)/i', '<span class="bold desc-b">$1</span>', $maple);
        $maple = preg_replace('/#c([^#]+)/i', '<span class="bold desc-c">$1</span>', $maple);
        $maple = preg_replace('/#e([^#]+)/i', '<span class="bold desc-e">$1</span>', $maple);
        $maple = preg_replace('/#([^#]+)/i', '<span class="bold text-warning">$1</span>', $maple);

        $maple = preg_replace('/(No chance of Item being destroyed on failure.)/i', '<span class="text-success">$1</span>', $maple);
        $maple = preg_replace('/(The item is destroyed upon failure.)/i', '<span class="text-danger">$1</span>', $maple);

        return $maple;
    }
}
