<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Task;
use App\Models\SubTask;

class UserTaskViewComponent extends Component
{
    public $task_id;
    public $title;
    public $slug;
    public $short_description;
    public $cover_image;
    public $gallery;
    public $status;
    public $priority;
    public $date;

    public  function mount($task_slug)
    {
        $task                    = Task::where('slug',$task_slug)->select('id','title','slug','short_description','cover_image','gallery','status','priority','created_at')->first();
        $this->title             = $task->title;
        $this->slug              = $task->slug;
        $this->short_description = $task->short_description;
        $this->cover_image       = $task->cover_image;
        $this->gallery           = $task->gallery;
        $this->status            = $task->status;
        $this->priority          = $task->priority;
        $this->date              = $task->created_at;
        $this->task_id           = $task->id;

    }

    public function render()
    {
        $subtasks = SubTask::where('task_id',$this->task_id)->select('no','description','status')->get();
        return view('livewire.user.user-task-view-component',['subtasks'=>$subtasks])->layout('layouts.base');
    }
}
