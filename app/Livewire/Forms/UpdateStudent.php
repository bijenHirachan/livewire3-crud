<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UpdateStudent extends Form
{
    public Student $student;

    #[Rule('required|min:3')]
    public $name = ''; 

    #[Rule('required|email')]
    public $email = ''; 

    #[Rule('nullable|image')]
    public $image = ''; 

    #[Rule('required')]
    public $section_id = '';

    public function setStudent(Student $student)
    {
        $this->student = $student;

        $this->name = $student->name;
        $this->email = $student->email;
        $this->section_id = $student->section_id;
    }

    public function update($class_id)
    {
        $this->student->update([
            'name' => $this->name,
            'class_id' => $class_id,
            'section_id' => $this->section_id,
            'email' => $this->email,
        ]);

        if($this->image) {
            $this->student->addMedia($this->image)->toMediaCollection();
        }
    }
}
