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

class UserTaskAddComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $slug;
    public $short_description;
    public $cover_image;
    public $gallery;
    public $status;
    public $priority;

    public $subTasks = [];

    public function mount()
    {
        $this->status = 0;
        $this->priority = 0;
        $this->subTasks = [
            ['no' => '', 'description' => '','status'=> 0]
        ];
    }

    public function addSubTask()
    {
        $this->subTasks[] = ['no' => '', 'description' => '','status'=>0];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'title' => 'required|max:150',
            'short_description' => 'required|max:200',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:2000',
            // 'gallery' => 'sometimes|mimes:jpeg,jpg,png|max:2000',
            'status' => 'required',
            'priority' => 'required',
        ]);
    }

    public function addTask()
    {
        $this->validate([
            'title' => 'required|max:150',
            'short_description' => 'required|max:200',
            'cover_image' => 'required|mimes:jpeg,jpg,png|max:2000',
            // 'gallery' => 'sometimes|mimes:jpeg,jpg,png|max:2000',
            'status' => 'required',
            'priority' => 'required',
       ]);

        $task = new Task();
        $task->title = $this->title;
        $task->slug = Str::slug($this->title);
        $task->short_description = $this->short_description;
        
        if($this->cover_image)
        {
            $imagename = Carbon::now()->timestamp. '.' . $this->cover_image->extension();

            $originalPath   = public_path().'/assets/images/task/';
            $thumbnailImage = Image::make($this->cover_image);
            $thumbnailImage->fit(400,400);
            $thumbnailImage->save($originalPath.$imagename);

            $task->cover_image = $imagename;
        }
        if($this->gallery)
        {
            $imagesname = '';
            foreach($this->gallery as $key=>$image)
            {
                
                $imgName = Carbon::now()->timestamp. $key. '.' . $image->extension();
                // $image->storeAs('products',$imgName);
                $imagePath = public_path().'/assets/images/task/';
                $galleryImage = Image::make($image);
                // $galleryImage->fit(1200,630);
                $galleryImage->fit(400,400);
                $galleryImage->save($imagePath.$imgName);

                $imagesname = $imagesname . ',' . $imgName;
            }

            $task->gallery = $imagesname;
        }
        $task->status = $this->status;
        $task->priority = $this->priority;
        $task->user_id = Auth::user()->id;
        $task->save();

        foreach ($this->subTasks as $subTask) {
            $sTask = new SubTask();
            $sTask->task_id = $task->id;
            $sTask->no = $subTask['no'];
            $sTask->description = $subTask['description'];
            $sTask->status = $subTask['status'];
            $sTask->save();
        }
        session()->flash('message','New Task created successfully!');
    }

    public function removeSubTask($index)
    {
        unset($this->subTasks[$index]);
        $this->subTasks = array_values($this->subTasks);
    }
    
    public function render()
    {
        info($this->subTasks);
        return view('livewire.user.user-task-add-component')->layout('layouts.base');
    }
}
