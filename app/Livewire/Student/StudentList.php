<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentList extends Component
{
    use WithPagination;

    public $search = '';
    public $class = '';
    public $department = '';
    public $house = '';
    public $sortField = 'first_name';
    public $sortDirection = 'asc';
    public $perPage = 20;
    public $pageList = [10, 20, 50, 100, 200];
    public $selected = [];
    public $selectAll = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'class' => ['except' => ''],
        'department' => ['except' => ''],
        'house' => ['except' => ''],
        'sortField' => ['except' => 'first_name'],
        'sortDirection' => ['except' => 'asc'],
        'perPage' => ['except' => 20],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingClass()
    {
        $this->resetPage();
    }

    public function updatingDepartment()
    {
        $this->resetPage();
    }

    public function updatingHouse()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            // Fetch IDs of selected students based on current filters
            $this->selected = Student::query()
                ->when($this->search, function ($query) {
                    $query->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');
                })
                ->when($this->class, function ($query) {
                    $query->where('classes_id', $this->class);
                })
                ->when($this->department, function ($query) {
                    $query->where('department_id', $this->department);
                })
                ->when($this->house, function ($query) {
                    $query->where('house_id', $this->house);
                })
                ->pluck('id')
                ->toArray();
        } else {
            $this->selected = [];
        }
    }


    public function updatedSelected($value)
    {
        $this->selected = $value;
    }

    public function deleteSelected()
    {
        Student::whereIn('id', $this->selected)->delete();
        $this->reset(['selected', 'selectAll']);
    }

    public function exportSelected($format)
    {
        $username = auth()->user()->username;

        if ($format == 'excel') {
            return Excel::download(new StudentExport($this->selected, $username), "students_{$username}.xlsx");
        } elseif ($format == 'pdf') {
            $students = Student::whereIn('id', $this->selected)
                ->with(['house', 'department', 'classes'])
                ->get();
            $pdf = PDF::loadView('exports.students', compact('students'));
            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'students.pdf');
        }
    }

    public function render()
    {
        $students = Student::query()
            ->when($this->search, function ($query) {
                $query->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->class, function ($query) {
                $query->where('classes_id', $this->class);
            })
            ->when($this->department, function ($query) {
                $query->where('department_id', $this->department);
            })
            ->when($this->house, function ($query) {
                $query->where('house_id', $this->house);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->with(['house', 'department', 'classes'])
            ->paginate($this->perPage);

        return view('livewire.student.student-list', [
            'students' => $students,
            'classes' => \App\Models\Classes::orderby('name', 'asc')->get(),
            'departments' => \App\Models\Department::all(),
            'houses' => \App\Models\House::all(),
        ]);
    }
}
