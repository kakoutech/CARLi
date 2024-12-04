<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Gamification extends Model
{
    public static function setting($key, $field = 'value')
    {
        $setting = BadgeSetting::where('slug', '=', $key)->first();

        return $setting->{$field};
    }

    public static function addLoginPoints(User $user)
    {
        if (self::setting('points-login', 'active')) {
            if (!session()->get('login_points')) {
                $number_of_points = self::setting('points-login');
                $user->addPoints('user_login', $number_of_points);
                session()->put('login_points', true);
            }
        }
    }

    public static function addCertificatePoints(User $user)
    {
        if (self::setting('points-certificate', 'active')) {
            $number_of_points = self::setting('points-certificate');
            $user->addPoints('certificate_awarded', $number_of_points);
        }
    }

    public static function addCourseStartPoints(User $user)
    {
        if (self::setting('points-course-start', 'active')) {
            $number_of_points = self::setting('points-course-start');
            $user->addPoints('course_started', $number_of_points);
        }
    }

    public static function addCourseCompletePoints(User $user)
    {
        if (self::setting('points-course-completed', 'active')) {
            $number_of_points = self::setting('points-course-completed');
            $user->addPoints('course_completed', $number_of_points);
        }
    }

    public static function addVirtualClassPoints(User $user)
    {
        if (self::setting('points-virtual-class', 'active')) {
            $number_of_points = self::setting('points-virtual-class');
            $user->addPoints('virtual_class_enrolled', $number_of_points);
        }
    }
}
