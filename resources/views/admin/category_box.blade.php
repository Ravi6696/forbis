<div class="col-md-6">
    <div class="filter-research back-white">
        <p class="contrat-check-title nouveau-title">NOUVELLE CATEGORIE</p>
        <hr>
        <input type="text" name="title" id="title" class="form-control" value="">
        <p class="error error_title"></p>
        <div class="text-right mt-3">
            <button type="submit" data-id="" class="foorbis-btn creer-btn">Créer</button>
        </div>
    </div>
</div>
@foreach ($categories as $key=>$category)
<div class="col-md-6">
    <div class="filter-research back-white">
        <p class="contrat-check-title nouveau-title">{{$category->title}}</p>
        <hr>
        <textarea type="text" name="title" id="title{{$category->id}}" class="form-control"
            value="">{{$category->subCategories()->pluck('title')->implode('-')}}</textarea>
        <p class="error error_title"></p>
        <div class="text-right mt-3">
            <button type="submit" data-id="{{$category->id}}" class="foorbis-btn creer-btn">Mettre a
                jour</button>
        </div>
    </div>
</div>
@endforeach
