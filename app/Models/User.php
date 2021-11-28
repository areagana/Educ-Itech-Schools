<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use Sortable ,LogsActivity;

    protected static $logAttributes = [
        'firstName',
        'lastName',
        'email',
        'school_id',
        'account_status'
    ];
    protected static $logOnlyDirty = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'account_status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'school_id'
    ];

    public $sortable =[
        'firstName',
        'lastName',
        'email',
        'school_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * relationships
     */
    /**
     * A user can create schools and user can belong to school.
     * Leave this as a many to many relationship to cater for that flexibility
     */
     
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    /**
     * user forms
     */
    public function forms()
    {
        return $this->belongsToMany(Form::class)
                    ->withTimeStamps();
    }

    //subjects
    public function subjects()
    {
        return $this->belongsToMany(Subject::class)
                    ->withTimeStamps();
    }

    /**
     * Assignments
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    /**
     * user creating terms for schools
     */
    public function terms()
    {
        return $this->hasMany(Term::class);
    }

    /**
     * User Creating Notices
     */
    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    /**
     * User Creating announcements
     */
    public function announcements()
    {
        return $this->hasMany(Annoucement::class);
    }

    /**
     * User Creating conferences
     */
    public function conferences()
    {
        return $this->hasMany(Conference::class);
    }

    /**
     * user creating courses
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


    /**
     * assignment submissions
     */
    public function assignment_submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }

    /**
     * submission comments
     */
    public function submission_comments()
    {
        return $this->hasMany(SubmissionComment::class);
    }

    /**
     * user has graded many asssignments
     */
    public function graded_assignments()
    {
        return $this->hasMany(AssignmentSubmission::class,'graded_by');
    }
   
    // schemes

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    /**
     * results
     */
    public function examresults()
    {
        return $this->hasMany(Examresult::class);
    }
}
