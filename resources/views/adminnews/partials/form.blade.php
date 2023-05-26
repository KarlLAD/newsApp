<!-- début du formulaire -->
<form action="{{!empty($actu)?route('news.edit' , $actu->id):route('news.add')}}" method="post" enctype="multipart/form-data">

    @csrf

    <div class=mb-5>
        <label for="" class="mb-3 text-base font-medium text-orange-900">
            Titre de la news
        </label>

        <input type="text" name="titre" value="{{!empty($actu)?$actu->titre:''}}" placeholder="Saisir un titre" class="w-full rounded-md boder-orange-600 bg-gray-100 py-3 px-3">
        @error('titre')
        Vous devez saisir un titre pour la news
        @enderror
        <!--    sélection d'une catégorie     -->

        <div class="mb5">

            <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
            <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <option selected>hoisir une catégorie</option>
                @foreach ($categories as $itemCategory)

                <!--  if simplifié  -->
                @if (!empty($actu) && $itemCategory->id == $actu->category_id)
                <option value="{{$itemCategory->id}}" selected> {{$itemCategory->name}}</option>
                @else
                <option value="{{$itemCategory->id}}">{{$itemCategory->name}}</option>
                @endif

                @endforeach


            </select>



        </div>

        <!--  ajout de l'image  -->
        <div class=mb-5>
            <label for="" class="mb-3 text-base font-medium text-orange-900">
                Image
            </label>
            @isset($actu)

            <img class="h-20 w-20 rounded-full object-cover object-center" src="{{ Storage::url($actu->image)}}" alt="" />
            @endisset

            <input type="file" name="image" placeholder="Ajouter une image" class="w-full rounded-md boder-orange-600 bg-gray-100 py-3 px-3">
            @error('image')
            Ajoutez une image au bon format
            @enderror


            <div class=mb-5>
                <label for="" class="mb-3 text-base font-medium text-orange-900">
                    Description
                </label>

                <textarea name="description" placeholder="Entrez une description (falcutatif)" class="w-full rezize-none rounded-md boder-orange-600 bg-blue-100 py-24 px-3 ">

                {{!empty($actu)?$actu->titre:''}}
                </textarea>

                <div class="mb-5">
                    <button class="bg-green-700 px-8 py-3 text-white rounded-md font-bold">Ajouter</button>

                </div>

            </div>

</form>
