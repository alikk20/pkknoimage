<?php
  
namespace App\Livewire;
  
use Livewire\Component;
use App\Models\Post;
  
class Posts extends Component
{
    public $title, $content, $post_id;
    public $isOpen = 0;
    public $search;
    public $updatesQueryString = [
        ['search' => ['except' => '']]
    ];

    public function mount(){
        $this->search =request()->query('search', $this->search);
    }

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('content', 'like', '%' . $this->search . '%')
                    ->paginate(4);
        return view('livewire.posts',['posts'=>$posts]);
    }
    
  
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->title = '';
        $this->content = '';
        $this->post_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
   
        Post::updateOrCreate(['id' => $this->post_id], [
            'title' => $this->title,
            'content' => $this->content
        ]);
  
        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
            return redirect()->to('/posts');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->title = $post->title;
        $this->content = $post->content;
    
        $this->openModal();
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
        return redirect()->to('/posts');
    }
}
