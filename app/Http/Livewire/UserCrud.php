<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class UserCrud extends Component
{
    public $route = 'index';
    public $userId,$name,$email,$dob,$mobile,$country,$gender = 0;
    public $users;

    public function mount()
    {
        $this->users = User::get(['name','id','gender','dob','email','mobile','country'])->toArray();
    }

    public function updated($field)
    {
        $this->validateOnly($field, $this->getValidation());
    }

    public function submit()
    {
        $validatedData = $this->validate($this->getValidation());

        $data = User::create($validatedData);
        $this->resetValues();
       // $this->mount();
        $this->users[] = $validatedData + ['id' => $data['id']];
        session()->flash('message', 'User successfully saved.');
    }

    public function resetValues()
    {
        $this->id = null;
        $this->name = null;
        $this->email = null;
        $this->dob = null;
        $this->mobile = null;
        $this->country = null;
        $this->gender = 0;
    }

    public function edit($id)
    {
        $user = User::find($id);
       
        $this->route = 'edit';
        $this->userId = $id;
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->dob = $user['dob'];
        $this->mobile = $user['mobile'];
        $this->country = $user['country'];
        $this->gender = $user['gender'];
    }
    public function gotoindex()
    {
        $this->route = 'index';
    }
    public function updatemodel()
    {
        $validatedData = $this->validate($this->getValidation());

        $data = User::UpdateOrCreate(['id' => $this->userId],$validatedData);
        $this->resetValues();
        $this->route = 'index';
        $this->mount();
     //   $this->users[] = $validatedData + ['id' => $data['id']];
        session()->flash('message', 'User successfully updated.');

    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        $this->addError('delete', 'User Deleted Successfully.');
    }

    public function getValidation()
    {
        return [
            'name' => 'required|min:6',
            'email' => 'required|email',
            'mobile' => 'numeric',
            'dob' => 'required|date',
            'country' => 'required|string',
            'gender' => 'required',
        ];
    }

    public function render()
    {
        // if($this->route == 'index')
        // {
            $this->users = User::get()->toArray();
       // }
        return view('livewire.user-crud');
    }
}
