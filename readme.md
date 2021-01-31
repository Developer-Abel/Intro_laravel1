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
```console
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

### Helpers
Vamos a crear un **helper** para tener una función donde nos indique en que vista estamos (home,contacto,portafolio...) y dependiendo de eso que se active el link poniendose en un color rojo.
Primero vamos a utilizar la funcion **request()** que ya viene con laravel y nos da una serie de propiedades que podemos aprovechar para crear una función.

Primero esta esta propiedad que nos muestra la **url** completa en donde estamos situados, dependiendo de que link estamos pulsando.

```php
request()->url()
```
Ejemplo
```
http://localhost:8000/portfolio
```

Esta otra propiedad muestra solo el nombre de la **url**

```php
request()->path()
```

Ejemplo
```
portfolio
```

Por último esta propiedad nos indica con **true o false** si estamos en la ruta que le espesificamos y esta propiedad es la que vamos a utilizar en los links.

```php
request()->routeIs('portafolio')
```

Ahora en los links indicamos si esque estamos situados en la **url** que estamos espeficicando en la clase agregamos **activate** que esto significa que se va a colorear de color rojo, y si no que no agrege nada (usando el operador ternario).

```php
<ul>
   <li class="{{request()->routeIs('inicio') ? 'active':''}}"><a href="/">Home</a></li>
   <li class="{{request()->routeIs('acerca') ? 'active':''}}"><a href="/about">About</a></li>
   <li class="{{request()->routeIs('portafolio') ? 'active':''}}"><a href="{{route('portafolio')}}">Portafolio</a></li>
   <li class="{{request()->routeIs('contacto') ? 'active':''}}"><a href="{{url('contact')}}">Contacto</a></li>
</ul>
```
```css
<style>
   .active a{
      color: red;
      text-decoration:none;
   }
</style>
```

#### helper
En este momento dependiendo de que link pulsemos se va a activar (coloreandose de color rojo), pero ahora vamos a formar una función para que sea mas práctico y si lo llegamos a utlizar en otro lugar ya estaria disponible.
Para eso vamos a crear un archivo asi **"app/helpers.php"** dentro vamos acrear una función y agregamos la logica del operador ternario que tenemos en los links.

```php
function setActive($routeName){
   return request()->routeIs($routeName) ? 'active':'';
}
```

Para que esto funcione vamos a declararlo en el archivo **composer.json** en la sección del **autoload** creamos un elemento mas **files** y añadimos la ruta donde se encuentra el archivo helper para que se cargue al iniciar laravel.

```json
"autoload": {
        "psr-4": {
            "App\\": "app/"
        },
        "classmap": [
            "database/seeds",
            "database/factories"
        ],
        "files": ["app/helpers.php"]
    },
```

Por último debemos de reiniciar composer para que tome los cambios.

```console
C:\wamp64\www\intro_laravel>composer dumpautoload
Generating optimized autoload files
> Illuminate\Foundation\ComposerScripts::postAutoloadDump
> @php artisan package:discover --ansi
Discovered Package: [32mbeyondcode/laravel-dump-server[39
Discovered Package: [32mfideloper/proxy[39m
Discovered Package: [32mlaravel/tinker[39m
Discovered Package: [32mnesbot/carbon[39m
Discovered Package: [32mnunomaduro/collision[39m
[32mPackage manifest generated successfully.[39m
Generated optimized autoload files containing 3847 classes
```

Y listo ahora podemos quitar lo que teniamos en los links y agregar la función del helper.

```php
<ul>
   <li class="{{setActive('inicio')}}"><a href="/">Home</a></li>
   <li class="{{setActive('acerca')}}"><a href="/about">About</a></li>
   <li class="{{setActive('portafolio')}}"><a href="{{route('portafolio')}}">Portafolio</a></li>
   <li class="{{setActive('contacto')}}"><a href="{{url('contact')}}">Contacto</a></li>
</ul>
```
#### partials
Vamos a separar el **nav** para que se vea un poco limpio el código, para eso vamos a crear una carpeta que se llame **partials** en la carpeta de views que contendra archivos parciales.

```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="/">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="/about">About</a></li>
       <li class="{{setActive('portafolio')}}"><a href="{{route('portafolio')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{url('contact')}}">Contacto</a></li>
    </ul>
 </nav>
 ```

 Y en la plantilla lo llamamos con **@include()** y la ruta, siempre las rutas para las vistas van a empezar de la carpeta **view** entonces la plantilla quedaria asi.

 ```php
<html>
   <head>
      <title>@yield('title','default')</title>
      <style>
         .active a{
            color: red;
            text-decoration:none;
         }
      </style>
   </head>
   <body>
      @include('partials.nav')

      @yield('content')
   </body>
</html>
```

### Envío de datos de formulario

El envio de datos a traves de formularios se realiza por medio de post, para eso vamos a crear una que va hacer de contacto, pero antes es importante resaltar que laravel utiliza un sistema de autenticación en los formularios, entonces se requiere de un token.

Para eso ingresamos **@csrf** en el formulario y nos crea un campo oculto con el token.
```php
@csrf
```

También requiere de un tipo de metodo, en nuestro caso va hacer **POST**.
```php
method="POST"
```

Y por último la ruta (contacto hace referencia al nombre que le dimos a la ruta).
```php
action="{{route('contacto')}}"
```

El formulario quedaria asi.
```php
@section('content')
   <h1>contacto</h1>
   <form action="{{route('contacto')}}" method="POST">
      @csrf
      <input type="text" name="nombre" placeholder="nombre"><br>
      <input type="text" name="asunto" placeholder="asunto"><br>
      <input type="text" name="email" placeholder="email"><br>
      <textarea name="mensaje" id="" cols="30" rows="5">Mensaje</textarea> <br>
      <button type="submit">Enviar</button>
   </form>
@endsection
```

Es importante recalcar que todos los campos deben de llevar su propiedad **name**.

Ahora vamos a crear el controlador **MessgeController** para agregarla en la ruta.
```console
C:\wamp64\www\intro_laravel>php artisan make:controller MessageController
Controller created successfully.
```

```php
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::get('/portfolio','portafolioController@index')->name('portafolio');
Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('contacto');
```
Tenemos 2 rutas **contact** la direfencia es que una es **post** y la otra de tipo **get**, el método al que estamos ingresando es **store**.

En el controlador creamos el método y retornamos **request()** que esto va visualizar todos los campos del formulario.
```php
class MessageController extends Controller
{
    function store(Request $request){
        return request();
    }
}
```
```json
{"_token":"jJmHfSOH70X6riuJJ64mKjaZ3gClzkMWONgixtt4","nombre":null,"asunto":null,"email":null,"mensaje":"Mensaje"}
```

Si queremos obtener solo el valor de un input seria cualquiera de estas opciones.
```php
return request('nombre');
return $request->get('nombre');
return $request->nombre;
```

### Validación campos formulario

Para validar los campos de un formulario, en el controlador existe **request()->validate([])** para especificar las validaciones de cada campo.

```php
request()->validate([
         'nombre' => 'required'
      ]);
```

Y en la vista podemos obtenerla de forma general (los errores se muestran en ingles).
```php
{{$errors}}
```

O si se quiere saber si hay o no error (muestra false o true).
```php
{{var_dump($errors->any())}}
```

Si queremos ver todos los errores den forma de array.
```php
{{var_dump($errors->all())}}
```

Pero lo mas usual es que se muestre el mensaje de error de bajo de cada input.
```php
<input type="text" name="nombre" placeholder="nombre"><br>
{!! $errors->first('nombre','<small>:message</small><br>')!!}
```

Ahora en el controlador donde ingresamos las validaciones se pueden crear mas de una validación para cada input, un ejempo es el campo de **mensaje** que estamos validando que no vaya vacio y que tenga almenos 3 carácteres.
```php
function store(Request $request){
      request()->validate([
         'nombre' => 'required',
         'email' => 'required',
         'asunto' => 'required',
         'mensaje' => 'required |min:3'
      ]);

      return "paso";
   }
```

### Traducción de mensajes

Existe una archivo que permite la traducción de mensajes y cuando se instala laravel no lo trae por defecto, la ruta seria **resources/lang/es** y contienen los archivos **auth,pagination ...**, asi que vamos a crear la carpeta y los archivos los descargamos desde github ya que existen varios ya traducidos.
**
Los mensajes de error esta en el archivo **validation.php**, el cual podemos modificarlo.
```php
return [
    'required' => 'El campo :attribute es obligatorio'
];
```

Y para que funcione en la carpeta **config/app** en **'locale' => 'en',** lo cambiamos a **es**
```php
'locale' => 'es',
```

Ahora cuando un campo este vacio el error regresara en español, pero existen muchos mensajes de error que aun no estan traducidos para esto vamos a la siguiente enlace para obtener los archivos ya traducidos, los descargamos y listo.
Enlace: https://github.com/Laravel-Lang/lang/tree/master/src/es

Pero también podemos realizar traducciones personalizados solo para el formulario que estamos trabajando, en el controlador después de las validaciones podemos agregar los mensajes de validación de esta forma.

```php
function store(Request $request){
      request()->validate([
         'nombre' => 'required',
         'email' => 'required',
         'asunto' => 'required',
         'mensaje' => 'required |min:3'
      ],
      [
         'nombre.required' => 'Necesito tu nombre',
         'mensaje.required' => 'Necesito tu mensaje',
         'mensaje.min' => 'Ingresa almenos 3 letras',
         
      ]
   );

      return "paso";
   }
```

Por último existe otro archivo de traducción que hace referecia a mensajes de laravel ya sean errores o mensajes normales y esto se encuentra en **resources/lang/es.json** de igual forma se tiene que crear el archivo y el archivo traducción estan en el siguiente enlace.
Enlace: https://github.com/Laravel-Lang/lang/tree/master/src/es




