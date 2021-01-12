
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight active">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <form action="{{url('/update/'.$task->id)}}" method="post">
                    @csrf
                    <input value="{{$task->title}}" type="text" placeholder="title" name="title">
                    <input value="{{$task->description}}" type="text" placeholder="description" name="description">
                    <input type="submit">
                    </form>
            </div>
        </div>
       
    </div>
</x-app-layout>
