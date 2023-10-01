<?php

namespace App\Livewire\Student;

use App\Livewire\Forms\StoreStudent;
use App\Models\Classes;
use App\Models\Section;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public StoreStudent $form;
    
    #[Rule('required')]
    public $class_id = ''; 

    public $sections = [];

    public function render()
    {
        return view('livewire.student.create', [
            'classes' => Classes::all()
        ]);
    }

    public function save()
    {

        $this->validate();

        $this->form->store(class_id: $this->class_id);

        return redirect(route('students.index'))
            ->with('status', 'Student successfully created.');
    }

    public function updatedClassId($value)
    {
        $this->sections = Section::where('class_id', $value)->get();
    }
}
