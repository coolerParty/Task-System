<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserTaskComponent extends Component
{
    public function deleteTask($task_id)
    {
        $task = Task::where('id',$task_id)->where('user_id',Auth::user()->id)->first();
        if($task->cover_image)
        {
            unlink('assets/images/task/'.$task->cover_image); // Deleting Image
        }
        if($task->gallery)
        {
            $images = explode(",", $task->gallery);
            foreach($images as $image)
            {                
                if ($image)
                {
                    unlink('assets/images/task/'.$image); 
                }
            }
        }
        $task->delete();
        session()->flash('message','Task has been deleted successfully');
        return redirect(route('user.task'));
    }

    public function render()
    {
        // ->select('id','title','slug','short_description','cover_image','status','priority','created_at')
        $tasks = Task::where('user_id',Auth::user()->id)->select('id','title','slug','short_description','cover_image','status','priority','created_at')->orderby('created_at','DESC')->get();
        return view('livewire.user.user-task-component',['tasks'=>$tasks])->layout('layouts.base');
    }
}