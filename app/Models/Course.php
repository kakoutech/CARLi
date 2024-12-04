<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function resources()
    {
        return $this->hasMany(CourseResource::class, 'course_id', 'id');
    }

    public function assignQuestionSet(User $user, MultipleChoiceQuestionSet $mcq, $date, $time, User $trainer)
    {
        $item = new UserCourseMultipleChoiceQuestionSet();
        $item->course_id = $this->id;
        $item->user_id = $user->id;
        $item->multiple_choice_question_set_id = $mcq->id;
        $item->date = $date;
        $item->time = $time;
        $item->assigned_by = $trainer->id;
        $item->save();

        return $item;
    }

    public function assignedQuestionSets()
    {
        return $this->hasMany(UserCourseMultipleChoiceQuestionSet::class, 'course_id', 'id');
    }

    public function getStudentQuestionSet($student_id)
    {
        return $this->assignedQuestionSets()->where('user_id', '=', $student_id);
    }

    public function mcqs()
    {
        return $this->hasMany(CourseMultipleChoiceQuestionSet::class, 'course_id', 'id');
    }

    public function multipleChoiceQuestionSets()
    {
        return $this->hasMany(CourseMultipleChoiceQuestionSet::class, 'course_id', 'id');
    }

    public function getMultipleChoiceQuestionSetCount()
    {
        return $this->multipleChoiceQuestionSets()->count();
    }

    public function getResourceCount($type = null)
    {
        return $this->resources()->where('type', '=', $type)->count();
    }

    public function assignResource($type, $resource)
    {
        $current = $this->resources()->where('resource_id', '=', $resource->id)->where('type', '=', $type)->first();
        if ($current) {
            return $this;
        }

        $item = new CourseResource();
        $item->course_id = $this->id;
        $item->type = $type;
        $item->resource_id = $resource->id;
        $item->save();

        return $this;
    }

    public function courseEnrolls()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id', 'id');
    }

    public function enrollLearner(User $user)
    {
        $check = $this->enrolled()->where('learner_id', '=', $user->id)->first();
        if ($check) {
            return $this;
        }

        $item = new CourseEnroll();
        $item->learner_id = $user->id;
        $item->course_id = $this->id;
        $item->save();

        Gamification::addCourseStartPoints($user);

        return $this;
    }

    public function enrolled()
    {
        return $this->hasMany(CourseEnroll::class, 'course_id', 'id');
    }

    public function getEnrollCount()
    {
        return $this->enrolled()->count();
    }

    public function getThumbnail()
    {
        return $this->getImage();
    }

    public function getImage()
    {
        if ($this->thumbnail_path) {
            return asset(str_replace('public', 'storage', $this->thumbnail_path));
        }

        return asset('assets/img/default-tools-and-resources-image.jpg');
    }

    public function scopeMaybePerformSearch($query, $search)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('title', 'LIKE', $search)
                    ->orWhere('description', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function topic()
    {
        return $this->belongsTo(CourseTopic::class, 'course_topic_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(CourseType::class, 'course_type_id', 'id');
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    public function isPublic()
    {
        return $this->view_scope == 0;
    }

    public function isPrivate()
    {
        return $this->view_scope;
    }

    public function getViewScope()
    {
        return $this->isPublic() ? 'Public' : 'Private';
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function hasResources()
    {
        return $this->resources()->count();
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getContent()
    {
        return $this->getDescription();
    }

    public function getDescription()
    {
        $content = $this->description;
        $content = str_replace("&lt;iframe", '<iframe', $content);
        $content = str_replace("&gt;&lt;/iframe&gt;", '></iframe>', $content);
        return $content;
    }

    public function isActive()
    {
        return $this->active;
    }
}
