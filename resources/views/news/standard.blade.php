<x-app-layout>

<ul>

    @foreach ($categories as $itemCategory)

<!-- nom de la route suivi de l'identifiant    -->
        <li> <a href="{{route('news.standard.category' ,$itemCategory->id )}}"> {{$itemCategory->name}}</a>
        </li>
        
    @endforeach

@if (Gate::allows('admin'))
    <h1 class="text-green-800"> admin </h1>
@else
<h1> not admin </h1>
@endif
</ul>
<h1 class="text-orange-600 bg-slate-400">  Liste des news </h1>

@forelse ($actus as $itemActu)
<h3> {{Str::limit($itemActu->titre , 20)}}   </h3>
<a href="{{route('news.standard.detail' , $itemActu)}}" > Voir...</a>

@empty
<h2>  Pas de news </h2>

@endforelse
{{$actus->links()}}
</x-app-layout>