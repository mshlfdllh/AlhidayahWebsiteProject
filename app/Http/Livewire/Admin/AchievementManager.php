<?php
// =============================================================
// app/Http/Livewire/Admin/AchievementManager.php
// =============================================================
namespace App\Http\Livewire\Admin;
 
use App\Models\Achievement;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
 
class AchievementManager extends Component
{
    use WithPagination, WithFileUploads;
 
    // List state
    public string $search          = '';
    public string $filterLevel     = '';
    public string $filterYear      = '';
 
    // Form state
    public bool   $showModal       = false;
    public bool   $isEditing       = false;
    public ?int   $editingId       = null;
 
    // Form fields
    public string $student_name      = '';
    public string $education_level   = '';
    public string $competition_name  = '';
    public string $competition_level = '';
    public string $award             = '';
    public string $year              = '';
    public bool   $is_featured       = false;
    public $photo = null;
 
    protected array $rules = [
        'student_name'      => 'required|string|max:255',
        'education_level'   => 'required|in:SD,SMP,SMA',
        'competition_name'  => 'required|string|max:255',
        'competition_level' => 'required|in:Kecamatan,Kabupaten/Kota,Provinsi,Nasional,Internasional',
        'award'             => 'required|string|max:255',
        'year'              => 'required|integer|min:2000',
        'photo'             => 'nullable|image|max:2048',
    ];
 
    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal  = true;
        $this->isEditing  = false;
    }
 
    public function openEditModal(int $id)
    {
        $achievement = Achievement::findOrFail($id);
        $this->fill([
            'editingId'         => $id,
            'student_name'      => $achievement->student_name,
            'education_level'   => $achievement->education_level,
            'competition_name'  => $achievement->competition_name,
            'competition_level' => $achievement->competition_level,
            'award'             => $achievement->award,
            'year'              => $achievement->year,
            'is_featured'       => $achievement->is_featured,
        ]);
        $this->showModal = true;
        $this->isEditing = true;
    }
 
    public function save()
    {
        $this->validate();
 
        $data = [
            'student_name'      => $this->student_name,
            'education_level'   => $this->education_level,
            'competition_name'  => $this->competition_name,
            'competition_level' => $this->competition_level,
            'award'             => $this->award,
            'year'              => $this->year,
            'is_featured'       => $this->is_featured,
        ];
 
        if ($this->photo) {
            $data['photo'] = $this->photo->store('achievements', 'public');
        }
 
        if ($this->isEditing) {
            Achievement::find($this->editingId)->update($data);
            session()->flash('success', 'Prestasi berhasil diperbarui!');
        } else {
            Achievement::create($data);
            session()->flash('success', 'Prestasi berhasil ditambahkan!');
        }
 
        $this->closeModal();
    }
 
    public function delete(int $id)
    {
        $achievement = Achievement::findOrFail($id);
        if ($achievement->photo) {
            \Storage::disk('public')->delete($achievement->photo);
        }
        $achievement->delete();
        session()->flash('success', 'Prestasi berhasil dihapus!');
    }
 
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }
 
    private function resetForm()
    {
        $this->reset([
            'student_name', 'education_level', 'competition_name',
            'competition_level', 'award', 'year', 'is_featured',
            'photo', 'editingId', 'isEditing',
        ]);
        $this->resetErrorBag();
    }
 
    public function updatingSearch()
    {
        $this->resetPage();
    }
 
    public function render()
    {
        $achievements = Achievement::query()
            ->when($this->search, fn ($q) => $q->search($this->search))
            ->when($this->filterLevel, fn ($q) => $q->byLevel($this->filterLevel))
            ->when($this->filterYear, fn ($q) => $q->byYear((int) $this->filterYear))
            ->latest()
            ->paginate(15);
 
        $years = Achievement::distinct()->orderByDesc('year')->pluck('year');
 
        return view('livewire.admin.achievement-manager', compact('achievements', 'years'));
    }
}
 