<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\Task;
use App\Models\SubTask;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class UserTaskEditComponent extends Component
{   
    use WithFileUploads;
    public $task_id;
    public $title;
    public $slug;
    public $short_description;
    public $cover_image;
    public $new_cover_image;
    public $gallery;
    public $new_gallery;
    public $status;
    public $priority;
    public $date;

    public $subtask_id;
    public $no;
    public $st_description;
    public $st_status;

    public $st_enabledAdd;

    public  function mount($task_id)
    {
        $task                    = Task::where('user_id',Auth::user()->id)->where('id',$task_id)->select('id','title','slug','short_description','cover_image','gallery','status','priority','created_at')->first();
        $this->title             = $task->title;
        $this->slug              = $task->slug;
        $this->short_description = $task->short_description;
        $this->cover_image       = $task->cover_image;
        $this->gallery           = $task->gallery;
        $this->status            = $task->status;
        $this->priority          = $task->priority;
        $this->date              = $task->created_at;
        $this->task_id           = $task->id;

        $this->st_status     = 0;
        $this->st_enabledAdd = True;
    }

    public function updated($fields)
    {

        $this->validateOnly($fields,[
            'title'             => ['required', Rule::unique('tasks')->ignore($this->task_id)],
            'short_description' => 'required|max:200',
            'status'            => 'required',
            'priority'          => 'required',
        ]);

        if($this->new_cover_image)
        {
            $this->validateOnly($fields,[
                'new_cover_image' => 'required|mimes:jpeg,jpg,png|max:2000',
            ]);
        }

    }

    public function updateTask()
    {

       $this->validate([
            'title'             => ['required', Rule::unique('tasks')->ignore($this->task_id)],
            'short_description' => 'required|max:200',
            'status'            => 'required',
            'priority'          => 'required',
        ]);

        if($this->new_cover_image)
        {
            $this->validate([
                'new_cover_image' => 'required|mimes:jpeg,jpg,png|max:2000',
            ]);
        }

        $task                    = Task::where('user_id', Auth::user()->id)->where('id',$this->task_id)->first();
        $task->title             = $this->title;
        $task->slug              = Str::slug($this->title);
        $task->short_description = $this->short_description;
        if($this->new_cover_image)
        {
            if($this->cover_image)
            {
                unlink('assets/images/task/'.$this->cover_image); // Deleting Image
            }
            
            $imagename = Carbon::now()->timestamp. '.' . $this->new_cover_image->extension();

            $originalPath   = public_path().'/assets/images/task/';
            $thumbnailImage = Image::make($this->new_cover_image);
            $thumbnailImage->fit(400,400);
            $thumbnailImage->save($originalPath.$imagename);

            $task->cover_image = $imagename;
        }
        if($this->new_gallery)
        {
            if($this->gallery)
            {
                $images = explode(",",$this->gallery);
                foreach($images as $gal)
                {
                    if($gal)
                    {
                        unlink('assets/images/task/'.$gal);
                    }
                }
            }

            $imagesname = '';
            foreach($this->new_gallery as $key=>$image)
            {
                $imgName   = Carbon::now()->timestamp . $key . '.' . $image->extension();
                $imagePath = public_path().'/assets/images/task/';
                $postImage = Image::make($image);
                $postImage->fit(400,400);
                $postImage->save($imagePath.$imgName);
                $imagesname = $imagesname . ',' . $imgName;
            }
            $task->gallery  = $imagesname;
        }

        $task->status   = $this->status;
        $task->priority = $this->priority;
        $task->user_id  = Auth::user()->id;
        $task->save();
        session()->flash('message','Task has been Updated successfully!');
    }

    public function cancelEdit()
    {
        $this->st_enabledAdd  = true;
        $this->resetvalue();   
        session()->flash('sub_message','Edit Cancelled!');     
    }

    public function showAddSubTaskModal()
    {
        $this->st_enabledAdd  = true;
        $this->resetvalue();      
    }

    public function addSubTask()
    {
        $this->validate([
            'no'             => 'sometimes|numeric',
            'st_description' => 'required|max:200',
            'st_status'      => 'required',
        ]);

        $subtask              = new SubTask();
        $subtask->no          = $this->no;
        $subtask->description = $this->st_description;
        $subtask->status      = $this->st_status;
        $subtask->task_id     = $this->task_id;
        $subtask->save();
        session()->flash('modal_message','subTask has been Addes successfully!');

        $this->resetvalue();
        $this->st_enabledAdd = true;
    }

    public function showEditSubTaskModal($subtask_id)
    {
        $this->resetvalue();
        $this->st_enabledAdd  = false;

        $subtask              = Subtask::where('id',$subtask_id)->first();
        $this->subtask_id     = $subtask->id;
        $this->no             = $subtask->no;
        $this->st_status      = $subtask->status;
        $this->st_description = $subtask->description;
    }

    

    public function updateSubTask()
    {
        $this->validate([
            'no'             => 'sometimes|numeric',
            'st_description' => 'required|max:200',
            'st_status'      => 'required',
        ]);

        $subtask              = Subtask::where('id',$this->subtask_id)->first();        
        $subtask->no          = $this->no;
        $subtask->status      = $this->st_status;
        $subtask->description = $this->st_description;
        $subtask->save();
        session()->flash('sub_message','subTask has been Updated successfully!');

        $this->resetvalue();
        $this->st_enabledAdd  = false;
    }

    public function deleteSubTask($subtask_id)
    {
        $subtask              = Subtask::where('id',$subtask_id)->first();
        $subtask->delete();
        session()->flash('sub_message','subTask has been deleted successfully!');
    }

    public function resetvalue()
    {
        $this->no             = null;
        $this->st_description = null;
        $this->st_status      = 0;
        $this->subtask_id     = null;
    }

    public function render()
    {
        $subtasks = SubTask::where('task_id',$this->task_id)->select('id','no','description','status')->get();
        return view('livewire.user.user-task-edit-component',['subtasks'=>$subtasks])->layout('layouts.base');
    }
}
