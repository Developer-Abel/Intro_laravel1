# CURSO LARAVEL 

### Nombrando rutas
Al definir las rutas en laravel podemos modificar la ruta las veces que sea necesario
y en los links solo hacer referencia a la ruta.

```php
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio')->name('portafolio');
Route::view('/contact','contact')->name('contacto');
```
```html
<nav>
    <ul>
    <li><a href="{{route('/')}}">Home</a></li>
    <li><a href="{{route('acerca')}}">About</a></li>
    <li><a href="{{route('portafolio')}}">Portafolio</a></li>
    <li><a href="{{route('contacto')}}">Contacto</a></li>
    </ul>
</nav>
```
Para que esto funcione en los **href** se inserta le **route** 

### yield, extends, section
Para crear una plantilla e ir añadiendo contenido dinamicamente se crea un archivo que sea la 
la plantilla en este caso la llamaremos **plantila.blade.php**, en este archivo se va a concentrar todo el html (head, nav, body)

```php
<html>
<head>
   <title>titulo</title>
</head>
<body>
   <nav>
      <ul>
         <li><a href="{{route('/')}}">Home</a></li>
         <li><a href="{{route('acerca')}}">About</a></li>
         <li><a href="{{route('portafolio')}}">Portafolio</a></li>
         <li><a href="{{route('contacto')}}">Contacto</a></li>
      </ul>
   </nav>
</body>
</html>
```
Con **@yiend()** definimos la sección donde se quiere ser dinámico dandole un nombre para identificarlo ya que pueden existir muchos **yiends**, en esta plantila vamos hacer dinamico el titulo y el contenido.

```php
<html>
   <head>
      <title>@yield('title','default')</title>
   </head>
   <body>
      <nav>
         <ul>
            <li><a href="{{route('/')}}">Home</a></li>
            <li><a href="{{route('acerca')}}">About</a></li>
            <li><a href="{{route('portafolio')}}">Portafolio</a></li>
            <li><a href="{{route('contacto')}}">Contacto</a></li>
         </ul>
      </nav>
      @yield('content')
   </body>
</html>
```
En el titulo se ingresan 2 parametros, la primera es el nombre de identificación, y la segunda es un titulo por default por si no se llega a ingreasar nada.

Ahora en cualquier archivo podemos llamarla a traves de **@extends()**, y dentro de los parentesis vamos a colocar el nombre de la plantilla (blade busca este archivo en la carpeta **views**).

Por ultimo **@section()** que es la seccion donde vamos a ingresar el contenido dependiendo de que **yiends** se trata, en este caso en los parentesis se le indica el nombre del yiend que va hacer referencia.

```php
@extends('plantilla')

@section('title','Contacto')

@section('content')
   <h1>contacto</h1>
@endsection
```
En la primera sección se ingreso 2 parametros ya que esta haciendo referencia al **yield title**, y como es un contenido corto se puede pasar como segundo parametro y asi ya no utilizamos el cierre de la sección, ahora en la segunda seccion que hace referencia al **yields content** no ponemos otro valor como segundo parametro la que si no lo definimos en la plantilla, a su vez ingresamos el contenido y cerramos la seccion.

### Estructuras de control y mas

En el archivo web (donde se concentran las rutas) por el momento vamos a crear un array con proyectos y lo vamos a pasar por **compact()** en la ruta.

```php
$portafolio =[
    ['title'=>'Proyecto 1'],
    ['title'=>'Proyecto 2'],
    ['title'=>'Proyecto 3'],
    ['title'=>'Proyecto 4'],
];
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio', compact('portafolio'))->name('portafolio');
```
#### forech
La estructura foreach es asi.

```php
@section('content')
   <h1>Portafolio</h1>
   @foreach ($portafolio as $porta)
       <li>{{$porta['title']}}</li>
   @endforeach
@endsection
```
#### if
Si en dado caso el array **$portafolio** no tiene elementos, el forech no funcionaria, para eso podemos incluir un **if** para verificar si tiene elementos que haga el recorrido y si no que muestre un mensaje.

```php
$portafolio =[
    // ['title'=>'Proyecto 1'],
    // ['title'=>'Proyecto 2'],
    // ['title'=>'Proyecto 3'],
    // ['title'=>'Proyecto 4'],
];
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio', compact('portafolio'))->name('portafolio');
```
```php
@section('content')
   <h1>Portafolio</h1>
   @if($portafolio)
      @foreach ($portafolio as $porta)
         <li>{{$porta['title']}}</li>
      @endforeach
   @else
      <li>No hay proyectos</li>
   @endif
@endsection
```
#### isset
Pero que pasa si la variable **$portafolio** no esta declarado, el if no funcionaria, y para eso esta **isset** que se encarga de verificar si la variable existe o esta declarada.
```php
// $portafolio =[
    // ['title'=>'Proyecto 1'],
    // ['title'=>'Proyecto 2'],
    // ['title'=>'Proyecto 3'],
    // ['title'=>'Proyecto 4'],
// ];
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio')->name('portafolio');
```
```php
@section('content')
   <h1>Portafolio</h1>
   @isset($portafolio)
      @foreach ($portafolio as $porta)
         <li>{{$porta['title']}}</li>
      @endforeach
   @else
      <li>No hay proyectos</li>
   @endisset
@endsection
```
#### forelse
Este ultimo valida si el array tiene elementos que mostrar y si no con **empty** podemos mostrar un mensaje.

```php
$portafolio =[
    // ['title'=>'Proyecto 1'],
    // ['title'=>'Proyecto 2'],
    // ['title'=>'Proyecto 3'],
    // ['title'=>'Proyecto 4'],
];
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::view('/portfolio','portfolio',compact('portafolio'))->name('portafolio');
```
```php
@section('content')
   <h1>Portafolio</h1>
   @forelse ($portafolio as $porta)
      <li>{{$porta['title']}}</li>
   @empty
      <li>No hay proyectos</li>
   @endforelse
@endsection
```
#### loop
Esta es una una variable que tiene laravel y que sirve para ver las propiedades del array, como por ejemplo cual es el primer item, cual el ultimo, la profuntidad, que index estamos posicionado etc.

```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta['title']}} <pre>{{var_dump($loop)}}</pre> </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
```json
Proyecto 1
object(stdClass)#213 (10) {
  ["iteration"]=>
  int(1)
  ["index"]=>
  int(0)
  ["remaining"]=>
  int(3)
  ["count"]=>
  int(4)
  ["first"]=>
  bool(true)
  ["last"]=>
  bool(false)
  ["odd"]=>
  bool(true)
  ["even"]=>
  bool(false)
  ["depth"]=>
  int(1)
  ["parent"]=>
  NULL
}
Proyecto 2
object(stdClass)#212 (10) {
  ["iteration"]=>
  int(2)
  ["index"]=>
  int(1)
  ["remaining"]=>
  int(2)
  ["count"]=>
  int(4)
  ["first"]=>
  bool(false)
  ["last"]=>
  bool(false)
  ["odd"]=>
  bool(false)
  ["even"]=>
  bool(true)
  ["depth"]=>
  int(1)
  ["parent"]=>
  NULL
}
.........
```
Por ejemplo podemos saber que proyecto es el ultimo y mandar un  mensaje el proyecto que no sea el ultimo de esta forma.

```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta['title']}} <small>{{$loop->last ? 'Es el ultimo': 'No es el ultimo'}}</small> </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
```text
Proyecto 1 No es el ultimo
Proyecto 2 No es el ultimo
Proyecto 3 No es el ultimo
Proyecto 4 Es el ultimo
```
#### Otras estructuras de control
Estan tambien **for**, **while** y **switch**, los mas utilizados.

```php
@for ()
    
@endfor

@while ()
    
@endwhile

@switch($type)
    @case(1)
        
        @break
    @case(2)
        
        @break
    @default
        
@endswitch
```

### Controladores
En ves de invocar a la vista desde el archivo de las rutas podemos crear un controlador en su lugar, para crear un controlador que solo tenga un solo método se utiliza el siguiente comando.
#### controlador invoke

```console
php artisan make:controller portafolioController -i
```
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class portafolioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
```
Como vemos automaticamente nos crea un unico metodo que es **__incovke** y que por este metodo ya no es necesario declararlo en las rutas, solo se declara la ruta y el controlador.

```php
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::get('/portfolio','portafolioController')->name('portafolio');
```
Ahora para pasar los datos del array a la vista, lo hacemos en el controlador de la siguiente manera.

```php
public function __invoke(Request $request){
      $portafolio =[
      ['title'=>'Proyecto 1'],
      ['title'=>'Proyecto 2'],
      ['title'=>'Proyecto 3'],
      ['title'=>'Proyecto 4'],
      ];
      return view('portfolio',compact('portafolio'));
   }
```
El **compact** podemos declararlo por que debe de ser igual al nombre del array.
Para verificar las rutas declaradas podemos utilizar el siguiente comando.

```console
php artisan route:list
```

#### controlador resource
Este tipo de controlador enlista los metodos de un crud **index, create, store, show, edit, update, delete/destroy** y se realiza con el siguiente comando.

```console
php artisan make:controller portafolioController --resource
```
Puede ser **--resource** o **-r**

```php
class portafolioController extends Controller
{
    public function index(){
    }
    public function create(){
    }
    public function store(Request $request){
    }
    public function show($id){
    }
    public function edit($id){
    }
    public function update(Request $request, $id){
    }
    public function destroy($id){
    }
}
```

Y en el archivo de rutas debemos de especificar el metodo a utilizar de la siguiente forma.

```php
Route::get('/portfolio','portafolioController@index')->name('portafolio');
```

Pero tambien podemos utilizar el controlador sin definir los metodos en el archivo de rutas, de la siguiente forma.
```php
Route::resource('/portfolio', 'portafolioController');
```

Y dependiendo del metodo que se requiere solo especificamos el tipo de accion (get, post, put) y automaticamente tomara el metodo, esto lo podemos ver en la consola con el comando **route:list**

```console
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
| Domain | Method    | URI                        | Name              | Action                                            | Middleware |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
|        | GET|HEAD  | portfolio                  | portfolio.index   | App\Http\Controllers\portafolioController@index   | web        |
|        | POST      | portfolio                  | portfolio.store   | App\Http\Controllers\portafolioController@store   | web        |
|        | GET|HEAD  | portfolio/create           | portfolio.create  | App\Http\Controllers\portafolioController@create  | web        |
|        | GET|HEAD  | portfolio/{portfolio}      | portfolio.show    | App\Http\Controllers\portafolioController@show    | web        |
|        | PUT|PATCH | portfolio/{portfolio}      | portfolio.update  | App\Http\Controllers\portafolioController@update  | web        |
|        | DELETE    | portfolio/{portfolio}      | portfolio.destroy | App\Http\Controllers\portafolioController@destroy | web        |
|        | GET|HEAD  | portfolio/{portfolio}/edit | portfolio.edit    | App\Http\Controllers\portafolioController@edit    | web        |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
```

Tambien podemos dejar solo los metodos que vamos a utilizar de la siguiente forma.

```php
Route::resource('/portfolio', 'portafolioController')->only(['index','show']);
```
```console
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+----------+-----------------------+-----------------+-------------------------------------------------+------------+
| Domain | Method   | URI                   | Name            | Action                                          | Middleware |
+--------+----------+-----------------------+-----------------+-------------------------------------------------+------------+
|        | GET|HEAD | portfolio             | portfolio.index | App\Http\Controllers\portafolioController@index | web        |
|        | GET|HEAD | portfolio/{portfolio} | portfolio.show  | App\Http\Controllers\portafolioController@show  | web        |
+--------+----------+-----------------------+-----------------+-------------------------------------------------+------------+
```
O de esta forma podemos excluir los metodos.

```php
Route::resource('/portfolio', 'portafolioController')->except(['index','show']);
```
Y apareceran todos los metodos menos los que excluimos

```console
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
| Domain | Method    | URI                        | Name              | Action                                            | Middleware |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
|        | POST      | portfolio                  | portfolio.store   | App\Http\Controllers\portafolioController@store   | web        |
|        | GET|HEAD  | portfolio/create           | portfolio.create  | App\Http\Controllers\portafolioController@create  | web        |
|        | PUT|PATCH | portfolio/{portfolio}      | portfolio.update  | App\Http\Controllers\portafolioController@update  | web        |
|        | DELETE    | portfolio/{portfolio}      | portfolio.destroy | App\Http\Controllers\portafolioController@destroy | web        |
|        | GET|HEAD  | portfolio/{portfolio}/edit | portfolio.edit    | App\Http\Controllers\portafolioController@edit    | web        |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
```
#### controlador api
Este controlador sirve para crear un **api-rest** y solo nos crea los metodos necesarios para este proceso (excluyen los metodos **create y edit**).

```console
php artisan make:controller portafolioController --api
```
```php
Route::apiResource('/portfolio', 'portafolioController');
```
```console
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+-----------+-----------------------+-------------------+---------------------------------------------------+------------+
| Domain | Method    | URI                   | Name              | Action                                            | Middleware |
+--------+-----------+-----------------------+-------------------+---------------------------------------------------+------------+
|        | GET|HEAD  | portfolio             | portfolio.index   | App\Http\Controllers\portafolioController@index   | web        |
|        | POST      | portfolio             | portfolio.store   | App\Http\Controllers\portafolioController@store   | web        |
|        | GET|HEAD  | portfolio/{portfolio} | portfolio.show    | App\Http\Controllers\portafolioController@show    | web        |
|        | PUT|PATCH | portfolio/{portfolio} | portfolio.update  | App\Http\Controllers\portafolioController@update  | web        |
|        | DELETE    | portfolio/{portfolio} | portfolio.destroy | App\Http\Controllers\portafolioController@destroy | web        |
+--------+-----------+-----------------------+-------------------+---------------------------------------------------+------------+
```
De igual forma tiene la opción de utilizar **except y only** para activar los metodos.

#### Cambiando ruta a español
Por último al utilizar el **resourse** en la terminal se ven los metodos **create y edit** en ingles, podemos cambiarlo en el archivo que se encuentra en la ruta **app/Providers/AppServiceProvider.php**.

```php
public function boot()
    {
        Route::resourceVerbs([
            'create' => 'crear',
            'edit'   => 'editar'
        ]);
    }
```
Antes
```console
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
| Domain | Method    | URI                        | Name              | Action                                            | Middleware |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
|        | GET|HEAD  | portfolio                  | portfolio.index   | App\Http\Controllers\portafolioController@index   | web        |
|        | POST      | portfolio                  | portfolio.store   | App\Http\Controllers\portafolioController@store   | web        |
|        | GET|HEAD  | portfolio/create           | portfolio.create  | App\Http\Controllers\portafolioController@create  | web        |
|        | GET|HEAD  | portfolio/{portfolio}      | portfolio.show    | App\Http\Controllers\portafolioController@show    | web        |
|        | PUT|PATCH | portfolio/{portfolio}      | portfolio.update  | App\Http\Controllers\portafolioController@update  | web        |
|        | DELETE    | portfolio/{portfolio}      | portfolio.destroy | App\Http\Controllers\portafolioController@destroy | web        |
|        | GET|HEAD  | portfolio/{portfolio}/edit | portfolio.edit    | App\Http\Controllers\portafolioController@edit    | web        |
+--------+-----------+----------------------------+-------------------+---------------------------------------------------+------------+
```
Después
```
C:\wamp64\www\intro_laravel>php artisan r:l
+--------+-----------+------------------------------+-------------------+---------------------------------------------------+------------+
| Domain | Method    | URI                          | Name              | Action                                            | Middleware |
+--------+-----------+------------------------------+-------------------+---------------------------------------------------+------------+
|        | GET|HEAD  | portfolio                    | portfolio.index   | App\Http\Controllers\portafolioController@index   | web        |
|        | POST      | portfolio                    | portfolio.store   | App\Http\Controllers\portafolioController@store   | web        |
|        | GET|HEAD  | portfolio/crear              | portfolio.create  | App\Http\Controllers\portafolioController@create  | web        |
|        | GET|HEAD  | portfolio/{portfolio}        | portfolio.show    | App\Http\Controllers\portafolioController@show    | web        |
|        | PUT|PATCH | portfolio/{portfolio}        | portfolio.update  | App\Http\Controllers\portafolioController@update  | web        |
|        | DELETE    | portfolio/{portfolio}        | portfolio.destroy | App\Http\Controllers\portafolioController@destroy | web        |
|        | GET|HEAD  | portfolio/{portfolio}/editar | portfolio.edit    | App\Http\Controllers\portafolioController@edit    | web        |
+--------+-----------+------------------------------+-------------------+---------------------------------------------------+------------+
```
