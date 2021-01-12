<style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight active">
            {{ __('Task List') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <table>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>option</th>
                    </tr>
                    <tr>
                    @foreach ($tasks as $task)
                      <td>{{$task->id}}</td>
                      <td>{{$task->title}}</td>
                      <td>{{$task->description}}</td>
                      <td>
                          <a href="{{url('/delete/'.$task->id)}}">delete</a>
                          <a href="{{url('/edit/'.$task->id)}}">edit</a>
                      </td>
                    </tr>
                    @endforeach
                  </table>
            </div>
        </div>
       
    </div>
</x-app-layout>
