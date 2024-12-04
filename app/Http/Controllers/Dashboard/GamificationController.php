<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\BadgeGroup;
use App\Models\BadgeLevel;
use App\Models\BadgeSetting;
use App\Models\UserBadge;
use App\Models\UserPoints;
use Illuminate\Http\Request;

class GamificationController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard.gamification.history');
    }

    public function history(Request $request)
    {
        abort_unless(user()->canView('gamification.history'), 403);

        $builder = UserPoints::query();

        $builder->maybePerformSearch($request->input('search'));

        $builder->latest();

        return view('dashboard.gamification.history', ['points' => $builder->paginate(25)]);
    }

    public function badges(Request $request)
    {
        abort_unless(user()->canView('gamification.badges.index'), 403);

        $badges = Badge::all();

        return view('dashboard.gamification.badges', ['badges' => $badges]);
    }

    public function settings(Request $request)
    {
        abort_unless(user()->canView('gamification.settings'), 403);

        return view('dashboard.gamification.settings', ['groups' => BadgeGroup::all()]);
    }

    public function handleSettings(Request $request)
    {
        abort_unless(user()->canView('gamification.settings'), 403);

        $request->validate([
            'settings' => ['required']
        ]);

        foreach ($request->input('settings') as $option => $values) {
            $setting = BadgeSetting::where('slug', '=', $option)->first();
            if ($setting) {
                $setting->value = isset($values['value']) ? $values['value'] : null;
                $setting->value_2 = isset($values['value_2']) ? $values['value_2'] : null;
                $setting->active = isset($values['active']) && $values['active'] == 'true' ? true : false;
                $setting->save();
            }
        }

        return redirect()->route('dashboard.gamification.settings')->with(['success' => 'Settings Saved.']);
    }

    public function addBadgeLevel(Request $request, Badge $badge)
    {
        abort_unless(user()->canView('gamification.badges.add'), 403);

        return view('dashboard.gamification.badge-level-add', ['badge' => $badge]);
    }

    public function editBadgeLevel(Request $request, Badge $badge, BadgeLevel $badge_level)
    {
        abort_unless(user()->canView('gamification.badges.edit'), 403);

        return view('dashboard.gamification.badge-level-edit', ['badge' => $badge, 'badge_level' => $badge_level]);
    }

    public function badgeLevel(Request $request, Badge $badge, BadgeLevel $badge_level)
    {
        abort_unless(user()->canView('gamification.badges.levels'), 403);

        return view('dashboard.gamification.badge-level', ['badge' => $badge, 'badge_level' => $badge_level]);
    }

    public function removeBadgeLevelFromUser(Request $request, Badge $badge, BadgeLevel $badge_level, UserBadge $user_badge)
    {
        abort_unless(user()->canView('gamification.badges.level.remove-from-user'), 403);

        $user_badge->delete();

        return redirect()->route('dashboard.gamification.badges.levels', [$badge->id, $badge_level->id])->with(['success' => 'Badge Level Removed From User.']);
    }

    public function deleteBadgeLevel(Request $request, Badge $badge, BadgeLevel $badge_level)
    {
        abort_unless(user()->canView('gamification.badges.level.delete'), 403);

        $badge_level->delete();

        return redirect()->route('dashboard.gamification.badges')->with(['success' => 'Badge Level Removed.']);
    }
}
