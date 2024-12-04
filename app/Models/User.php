<?php

namespace App\Models;

use App\Notifications\ReflectionJournalSubmission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $dates = [
        'reflection_activity_date',
        'created_at',
        'updated_at'
    ];

    public function learners()
    {
        if ($this->account_type == 'trainer') {
            return $this->hasMany(User::class, 'trainer_id', 'id')->where('account_type', '=', 'learner');
        }

        return $this->hasMany(User::class, 'employer_id', 'id')->where('account_type', '=', 'learner');
    }

    public function getLearnerCount()
    {
        return $this->learners()->count();
    }

    public function trainers()
    {
        return $this->hasMany(User::class, 'employer_id', 'id')->where('account_type', '=', 'trainer');
    }

    public function getTrainerCount()
    {
        return $this->trainers()->count();
    }

    public function employer()
    {
        return $this->belongsTo(User::class, 'employer_id', 'id');
    }

    public function getAvatar()
    {
        if ($this->avatar_path && Storage::exists($this->avatar_path)) {
            return asset(str_replace('public', 'storage', $this->avatar_path));
        }

        return asset('assets/img/avatar.png');
    }

    public function sessions()
    {
        return $this->hasMany(UserSession::class, 'user_id', 'id');
    }

    public function recordSession()
    {
        $open_session = $this->sessions()->where('session_id', '=', session()->getId())->first();
        if (!$open_session) {
            $open_session = new UserSession();
            $open_session->user_id = $this->id;
            $open_session->session_id = session()->getId();
            $open_session->time_start = now();
        }

        $open_session->time_end = now()->addMinutes(5);
        $open_session->minutes = $open_session->time_end->diffInMinutes($open_session->time_start);
        $open_session->save();

        return $open_session;
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'user_id', 'id');
    }

    public function updatePermission($action, $status)
    {
        $current = $this->permissions()->where('action', '=', $action)->first();
        if (!$current) {
            $current = new Permission();
            $current->user_id = $this->id;
            $current->action = $action;
        }

        $current->permission = (bool) $status;
        $current->save();

        return $current;
    }

    public function badges()
    {
        return $this->hasMany(UserBadge::class, 'user_id', 'id');
    }

    public function enrolled()
    {
        return $this->hasMany(CourseEnroll::class, 'learner_id', 'id');
    }

    public function canView($action)
    {
        return canUserView($this, $action);
    }

    public function getDisplayAccountType()
    {
        return $this->getDisplayRole();
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isDeleted()
    {
        return $this->deleted_at;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeByEmployer($query, $employer_id)
    {
        return $query->where('employer_id', '=', $employer_id);
    }

    public function scopeSuperadmins($query)
    {
        return $query->whereIn('account_type', ['admin', 'superadmin']);
    }

    public function scopeLearners($query)
    {
        return $query->whereIn('account_type', ['learner']);
    }

    public function scopeTrainers($query)
    {
        return $query->whereIn('account_type', ['trainer']);
    }

    public function scopeEmployers($query)
    {
        return $query->whereIn('account_type', ['employer']);
    }

    public function points()
    {
        return $this->hasMany(UserPoints::class, 'user_id', 'id');
    }

    public function addPoints($action, $points)
    {
        return $this->recordPoints($action, $points);
    }

    public function subtractPoints($action, $points)
    {
        return $this->recordPoints($action, -$points);
    }

    public function recordPoints($action, $points)
    {
        $user_points = new UserPoints();
        $user_points->user_id = $this->id;
        $user_points->action = $action;
        $user_points->points = $points;
        $user_points->pre_balance = $this->getPointsTotal();
        $user_points->post_balance = $user_points->pre_balance + $user_points->points;
        $user_points->save();

        return $user_points;
    }

    public function getPointsTotal()
    {
        return (float) $this->points()->sum('points');
    }

    public function virtualClasses()
    {
        return $this->hasMany(VirtualClassAttendee::class, 'learner_id', 'id');
    }

    public function scopeMaybePerformSearch($query, $search = null)
    {
        if ($search) {
            $search = '%' . $search . '%';

            $query->where(function ($query) use ($search) {
                return $query->where('first_name', 'LIKE', $search)
                    ->orWhere('last_name', 'LIKE', $search)
                    ->orWhere('email', 'LIKE', $search);
            });
        }

        return $query;
    }

    public function getDisplayRole()
    {
        switch ($this->account_type) {
            case "admin":
                return 'Administrator';
                break;
            case "learner":
                return 'Learner';
                break;
            case "employer":
                return 'Employer';
                break;
            case "trainer":
                return 'Trainer';
                break;
        }
    }

    public function userMcqs()
    {
        return $this->hasMany(UserCourseMultipleChoiceQuestionSet::class, 'user_id', 'id');
    }

    public function availableAssessments()
    {
        return Assessment::query()->where('active', '=', 1)->get();
    }

    public function assignedQuestionSets()
    {
        return $this->hasMany(UserCourseMultipleChoiceQuestionSet::class, 'user_id', 'id');
    }

    public function getUnreadMessages()
    {
        $user_id = $this->id;

        $builder = $this->conversations()->where('last_reply_by', '!=', $this->id)->whereHas('messages', function ($query) use ($user_id) {
            return $query->where('unread', '=', 1)->where('user_id', '!=', $user_id);
        });

        return $builder->limit(5)->get();
    }

    public function getUnreadMessageCount()
    {
        $user_id = $this->id;
        $builder = $this->conversations()->where('last_reply_by', '!=', $this->id)->whereHas('messages', function ($query) use ($user_id) {
            return $query->where('unread', '=', 1)->where('user_id', '!=', $user_id);
        });

        //$query = str_replace(array('?'), array('\'%s\''), $builder->toSql());
        //$query = vsprintf($query, $builder->getBindings());
        //dump($query);

        return $builder->count();
    }

    public function getNotificationCount()
    {
        return $this->notifications()->count();
    }

    public function conversations()
    {
        $user_id = $this->id;

        return Conversation::where(function ($query) use ($user_id) {
            return $query->where('sender_id', '=', $user_id)->orWhere('receiver_id', '=', $user_id);
        });
    }

    public function startConversationWith(User $user)
    {
        $sender_id = $this->id;
        $receiver_id = $user->id;

        $current_conversation = Conversation::query()->where(function ($query) use ($sender_id, $receiver_id) {
            return $query->where('sender_id', '=', $sender_id)->where('receiver_id', '=', $receiver_id);
        })->orWhere(function ($query) use ($sender_id, $receiver_id) {
            return $query->where('sender_id', '=', $receiver_id)->where('receiver_id', '=', $sender_id);
        })->first();

        if ($current_conversation) {
            return $current_conversation;
        }

        $current_conversation = new Conversation();
        $current_conversation->sender_id = $sender_id;
        $current_conversation->receiver_id = $receiver_id;
        $current_conversation->save();

        return $current_conversation;
    }

    public function userCertificates()
    {
        return $this->hasMany(UserCertificate::class, 'user_id', 'id');
    }

    public function certificates()
    {
        return $this->hasMany(UserCertificate::class, 'user_id', 'id')->latest();
    }

    public function assignCertificate(Certificate $certificate)
    {
        $data = json_encode($certificate->toArray());
        $item = new UserCertificate();
        $item->user_id = $this->id;
        $item->certificate_id = $certificate->id;
        $item->certificate_data = $data;
        $item->save();

        return $item;
    }

    public function isActive()
    {
        return $this->active;
    }

    public function isSuperAdmin()
    {
        return $this->account_type == 'admin' ? true : false;
    }

    public function isAdmin()
    {
        return $this->account_type == 'admin' ? true : false;
    }

    public function isLearner()
    {
        return $this->account_type == 'learner' ? true : false;
    }

    public function isTrainer()
    {
        return $this->account_type == 'trainer' ? true : false;
    }

    public function isEmployer()
    {
        return $this->account_type == 'employer' ? true : false;
    }


    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id', 'id');
    }

    public function reflectiveJournalEntries()
    {
        return $this->hasMany(ReflectiveJournalEntry::class, 'user_id', 'id');
    }

    public function journals()
    {
        return $this->hasMany(ReflectiveJournalEntry::class, 'user_id', 'id');
    }

    public function sendReflectionJournalSubmission($user, $responses)
    {
        return $this->notify(new ReflectionJournalSubmission($user, $responses));
    }

    public function assessmentResponses()
    {
        return $this->hasMany(AssessmentResponse::class, 'user_id', 'id');
    }
}
