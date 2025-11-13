<?php

namespace App\Services;

use App\Models\User;
use App\Models\Commission;

class CommissionService
{
    // Commission percentages per level
    protected $levels = [
        1 => 10, // 10%
        2 => 5, // 5%
        3 => 3, // 3%
        4 => 2, // 2%
        5 => 1, // 1%
    ];

    public function distribute(int $userId, float $purchaseAmount)
    {
        $currentUser = User::find($userId);
        $upline = $currentUser->referrer; // level 1

        $level = 1;

        while ($upline && $level <= 5) {
            $percent = $this->levels[$level] ?? 0;
            $commissionAmount = ($purchaseAmount * $percent) / 100;

            if ($commissionAmount > 0) {
                Commission::create([
                    'user_id' => $upline->id,
                    'from_user_id' => $currentUser->id,
                    'amount' => $commissionAmount,
                    'level' => $level,
                ]);
            }

            $upline = $upline->referrer;
            $level++;
        }
    }
}
