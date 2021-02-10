
@csrf
<label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
<label for="">Url <br> <input type="text" name="url" value="{{old('url',$project->url)}}"></label> <br>
<label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{old('description',$project->description)}}</textarea></label> <br> <br>

<button>{{$btnText}}</button>