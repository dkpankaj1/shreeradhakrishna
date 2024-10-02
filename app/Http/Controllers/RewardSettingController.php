<?php

namespace App\Http\Controllers;

use App\Models\RewardSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RewardSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : View
    {
        try {
            $reward = RewardSetting::first();
            if($reward == null){
                RewardSetting::create(['price' => 100,'point' => 1,'alert_limit' => 100]);
                $reward = RewardSetting::first();
            }
            return view('setting.reward.index', compact('reward'));
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RewardSetting  $rewardSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(RewardSetting $rewardSetting) : View
    {
        try {
            $reward = $rewardSetting;
            return view('setting.reward.edit', compact('reward'));
        } catch (\Exception $e) {
            return view('error.404', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RewardSetting  $rewardSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RewardSetting $rewardSetting) : RedirectResponse
    {
        $request->validate([
            'price'         => 'required|numeric',
            'point'         => 'required|numeric',
            'alert_limit'   => 'required|numeric'
        ]);

        $reward = [
            "price"         => $request->price,
            "point"         => $request->point,
            'alert_limit'   => (int)$request->alert_limit
        ];

        try {
            $rewardSetting->update($reward);
            return redirect()->route('setting.reward.index')->with('success', 'Reward Update successfull');
        } catch (\Exception $e) {
            return back()->with('danger', $e->getMessage());
        }
    }
}
