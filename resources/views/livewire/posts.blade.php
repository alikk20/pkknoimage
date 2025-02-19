
<div class="py-10 px-24">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">

            @if (session()->has('message'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                  <div class="flex">
                    <div>
                      <p class="text-sm">{{ session('message') }}</p>
                    </div>
                  </div>
                </div>
            @endif

            <div class="flex justify-between">
                <h1 class="pt-4 text-xl font-bold">POST</h1>
                <button wire:click="create()" class="bg-blue-400 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded my-3">Create New Post</button>
            </div>
            @if($isOpen)
                @include('livewire.create')
            @endif

            <table class="table-fixed w-full">
                <thead>
                <tr class="bg-blue-200">
                    <th class="px-4 py-2 items-center w-12">No</th>
                    <th class="px-4 py-2 w-64">Title</th>
                    <th class="px-4 py-2">Content</th>
                    <th class="px-4 py-2 w-48">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td class="border px-4 py-2">{{ $post->id }}</td>
                            <td class="border px-4 py-2">{{ $post->title }}</td>
                            <td class="border px-4 py-2">{{ $post->content }}</td>
                            <td class="border px-4 py-2 flex justify-center gap-2">
                                <button wire:click="edit({{ $post->id }})" class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded">Edit</button>
                                <button wire:click="delete({{ $post->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
