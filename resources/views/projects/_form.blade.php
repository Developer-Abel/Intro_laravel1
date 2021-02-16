
@csrf

<div class="form-group">
    <label for="title">Título </label>
    <input class="form-control border-0 bg-light shadow-sm" type="text" name="title" id="title" value="{{old('title',$project->title)}}">
</div>


<div class="form-group">
    <label for="url">Url </label>
    <input class="form-control border-0 bg-light shadow-sm" type="text" name="url" id="url" value="{{old('url',$project->url)}}">
</div>


<div class="form group">
    <label for="description">Descripción </label>
    <textarea class="form-control border-0 bg-light shadow-sm" name="description"  id="description" cols="20" rows="4">{{old('description',$project->description)}}</textarea>
</div>
<button class="btn btn-primary btn-lg btn-block">{{$btnText}}</button>
<a class="btn btn-link btn-block" href="{{route('project.index')}}">Cancelar</a>

