<?php
namespace App\Helpers;

use App\Models\RewardSetting;

class AppHelper
{
    public static function makeReward(int $saleAmt)
    {
        try {
            $rewardSetting = RewardSetting::first();
            $rewardSetting_price = (int) $rewardSetting->price;
            $rewardSetting_point = (int) $rewardSetting->point;
            $reward = ($saleAmt / $rewardSetting_price) * $rewardSetting_point;
            return $reward;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }
}

?>