<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $user_id;
    public function mount(){

        if(!session()->has('company_id')) {
            if($this->auth->user->company_id){
                session(['company_id' => $this->auth->user()->company_id]);
            }else{
                // si no hay company_id, redirige a la página de login
                
            }
            
        }
    }

    public function render()
    {
       
        return view('livewire.dashboard');
    }


}
