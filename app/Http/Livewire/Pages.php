<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Pages extends Component
{
    use WithPagination;
    public $title;
    public $slug;
    public $content;
    public $modelId;
    public $modalConfirmDeleteVisible = false;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;
   
    public $modalFormVisible = false;

    public function updatedisSetToDefaultNotFoundPage(){
        $this->isSetToDefaultHomePage = null;
    }
    public function updatedisSetToDefaultHomePage(){
        $this->isSetToDefaultNotFoundPage = null;
    }
     /**
     * the livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages',[
            'data' => $this->read()
        ]);
    }
    
   public function mount()
   {

    $this->resetPage();
   }
        
    /**
     * rules
     *
     * @return void
     */
    public function rules(){

        return [
            'title' => 'required',
            'slug' => ['required',Rule::unique('pages', 'slug')->ignore($this->modelId)],
            'content' => 'required'
        ];
    }
    
    /**
     * create 
     *
     * @return void
     */
    public function create(){
        
        $this->validate();
        Page::create($this->modalData());
        $this->modalFormVisible = false;

        $this->title = null;
        $this->slug = null;
        $this->content = null;
    }    
    
    /**
     * show the confirmation for deletion
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }
    public function delete()
    {
        Page::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * modalData collect data
     *
     * @return void
     */
    public function modalData(){
       
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage
        ];
    }
    

    
    /**
     * shows the form modal of the create function
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetvalidation();
        $this->reset();
        // Pages::reset();
        $this->modalFormVisible = true;
    }

    // public function reset(){
    //     $this->modelId = null;
    //     $this->title = null;
    //     $this->slug = null;
    //     $this->content = null;
    //     $this->isSetToDefaultNotFoundPage = null;
    //     $this->isSetToDefaultHomePage = null;
    // }

    /**
     * updatedTitle copy the title in slug
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedTitle($value)
    {
    
       $this->slug = Str::slug($value);
    }

    // public function generateSlug($value){

    //     $proccess1 = str_replace(' ','-', $value);
    //     $proccess2 = strtolower($proccess1);
       
    //     $this->slug= $proccess2;
    // }
    
    /**
     * read
     *
     * @return void
     */
    public function read()
    {
        return Page::paginate(5);
    }    



    /**
     * update
     *
     * @return void
     */
    public function update()
    {
       $this->validate();
       $this->unassignDefaultHomePage();
       $this->unssignedisSetToDefaultNotFoundPage();
       Page::find($this->modelId)->update($this->modalData());
       $this->modalFormVisible = false;

    }
    


    /**
     * updateShowModal
     *
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetvalidation();
        // $this->reset();
        $this->modelId =$id;
        $this->modalFormVisible=true;
        $this->loadModal($id);
    }

    private function unassignDefaultHomePage()
    {
        if ($this->isSetToDefaultHomePage != null) {
            Page::where('is_default_home', true)->update([
                'is_default_home' => false,
            ]);
        }
    }

    private function unssignedisSetToDefaultNotFoundPage()
    {
        if ($this->isSetToDefaultNotFoundPage != null) {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }

    /**
     * loadModal
     *
     * @param  mixed $id
     * @return void
     */
    public function loadModal($id)
    {
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true;
        // return $data;
    }

    public function deleteData($id)
    {
        $delData=Page::find($id);
        $delData->delete();

    }

}

    
