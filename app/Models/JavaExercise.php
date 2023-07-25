<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\JavaExerciseTopicUser;
use Illuminate\Support\Facades\Auth;

class JavaExercise extends Model
{
    use SoftDeletes;

    public $table = 'java_exercises';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'grade',
        'module_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function topicWorkedOn(): int
    {
        return JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get()->count();
    }

    public function topicPassed(): int
    {
        $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        $topicsPassed = 0;

        foreach ($topics as $topic) {
            $topicUser = JavaExerciseTopicUser::with('javaExerciseTopic')
                ->where('java_exercise_topic_id', $topic->id)
                ->where('user_id', auth()->id())
                ->where('status', 'OK')
                ->first();

            if ($topicUser)
                $topicsPassed+=1;
        }

        return $topicsPassed;
    }

    public function topicGrading(): int
    {
        
        
        // $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        // $allvalue = 0;
        // // dd($topics);
        // foreach ($topics as $topic) {
        //     $topicsUser = JavaExerciseTopicUser::where('java_exercise_topic_id', $topic->id)->where('user_id', auth()->id())->get()->count();
        //     // $topicsUser = JavaExerciseTopicUser::where('java_exercise_topic_id', $topic->id)->pluck('report');//ikicontohe cel cuman aku gangerti bener gak e soale gaiso di delok e
        //     // dd($topicsUser);
        //     if($topicsUser == 0){

        //     }elseif($topicsUser < $topic->percobaan){
        //         $allvalue += $topic->max;
        //     }else{
        //         $allvalue += $topic->min;
        //     }
        // }
        // // return response()->json($topics);

        $totalScore = 0;
        $pattern = '/Total Score: (\d+)/';

        $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        foreach ($topics as $topic) {
            $report = JavaExerciseTopicUser::with('user')->where([
                'java_exercise_topic_id' => $topic->id,
                'user_id' => Auth::id(),
            ])->orderBy('created_at', 'desc')->first();

            if ($report && preg_match($pattern, $report->report, $matches)) {
                $totalScore += intval($matches[1]);
            } 
        }

        return $totalScore == 0 ? $totalScore : $totalScore  / $this->topicWorkedOn();
    }

    public function topicPassedTeacher(): int
    {
        $topics = JavaExerciseTopic::with('javaExercise')->where('java_exercise_id', $this->id)->get();
        $topicsPassed = 0;

        foreach ($topics as $topic) {
            $topicUser = JavaExerciseTopicUser::with('javaExerciseTopic')
                ->where('java_exercise_topic_id', $topic->id)
                ->where('status', 'OK')
                ->first();

            if ($topicUser)
                $topicsPassed+=1;
        }

        return $topicsPassed;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
