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

### Enviar Emails

Para el envio de email existe la posibilidad de verificar en modo prueba con **log** o con **Mailtrab** y para producción existen varias, la recomentada es Sengrid.

#### Modo prueba log
En el controlador **MessageController** vamos a importar **use App\Mail\MessageReceived; y use Illuminate\Support\Facades\Mail;** ya que vamos a utilizar el motor de email de laravel que es **Mail**.
```php
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
```
Se hace una instancia de la clase **mail** y en el **send** se agrega la clase que enseguida vamos a crear (que hace refencia a la vista del email).
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

   Mail::to('abel@gmail.com')->send(New MessageReceived);

      return "Mensaje enviado";
   }
```

Vamos a crear la clase **MessageReceived**.
```console
C:\wamp64\www\intro_laravel>php artisan make:mail MessageReceived
Mail created successfully.
```
En el método **build** definimos la ruta de la vista de nuestro email.
```php
public function build()
    {
        return $this->view('mails.message-received');
    }
```
En la carpeta **view** creamos la carpeta **mails/message-received.balde.php** y en este archivo es donde va a ir la información del mensaje.
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
</body>
</html>
```
Ahora solo falta ir al archivo **.env** que se encuentra en la raiz y en la parte da ña configuración del email vamos a ponerlo como modo prueba **log**.
```
MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
Al ingresar datos en nuestro formulario y si le damos enviar se va a enviar nuestro correo, para verificarlo vamos a la siguiente ruta **storage/logs/laravel-2021-02-02-log/** (dependiendo cual sea el último log) nos muestra los datos de nuestro mensaje como asunto, remitente, mensaje, hora etc.
```console
[2021-02-02 11:04:09] local.DEBUG: Message-ID: <c6cb1eb3c15e69cfn1fe0979fb84eb76@127.0.0.1>
Date: Tue, 02 Feb 2021 11:04:09 +0000
Subject: Message Received
From: Example <hello@example.com>
To: abel@gmail.com
MIME-Version: 1.0
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
</body>
</html>
```
Vemos que el **from** esta llegando como de prueba, esto se puede configurar en el archivo **.env** incluso podemos ingresar quien esta enviando el correo.
```
MAIL_DRIVER=log
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=abel93lk@gmail.com
MAIL_FROM_NAME= 'Abel Garcia'
```
Y al enviar nuevamente el email saldria así.
```console
[2021-02-02 11:21:48] local.DEBUG: Message-ID: <a6f95e9d8b830cedb8eaa4f3a416184a@127.0.0.1>
Date: Tue, 02 Feb 2021 11:21:48 +0000
Subject: Message Received
From: Abel Garcia <abel93lk@gmail.com>
To: abel@gmail.com
MIME-Version: 1.0
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
</body>
</html>
```
El asunto se declara en el archivo **mail/MessageReceived,php** de la siguiente forma.
```php
public $subject = 'Mensaje recibido';
```
Debe de ser pública para que se pueda utilizar en la vista, al enviar nuevamente el mensaje se veria asi.
```console
[2021-02-02 11:25:22] local.DEBUG: Message-ID: <bf764f959681caa524dfc7f2075c4ba6@127.0.0.1>
Date: Tue, 02 Feb 2021 11:25:22 +0000
Subject: Mensaje recibido
From: Abel Garcia <abel93lk@gmail.com>
To: abel@gmail.com
MIME-Version: 1.0
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable
```
Y para recibir los datos que estamos enviando, basta con guardar en una variable todo el contenido y pasarlo a la vista.
```php
function store(Request $request){
      $message = request()->validate([
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

   Mail::to('abel@gmail.com')->send(New MessageReceived($message));

      return "Mensaje enviado";
   }
```
Y en **Mail/MessageReceived.php** recibimos en el contructor el contenido y lo volvemos a pasar a otra variable para utilizarla en la vista.
```php
class MessageReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Mensaje recibido';
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
```
Hacemos un **var_dump()** en la vista para verificar que el mensaje llego correctamente.
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
    {{var_dump($msg)}}
</body>
</html>
```
La salida en el log se veria así.
```console
Date: Tue, 02 Feb 2021 11:33:59 +0000
Subject: Mensaje recibido
From: Abel Garcia <abel93lk@gmail.com>
To: abel@gmail.com
MIME-Version: 1.0
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: quoted-printable

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Email recibido</h1>
    array(4) {
  ["nombre"]=>
  string(4) "Abel"
  ["email"]=>
  string(17) "lk765mo@gmail.com"
  ["asunto"]=>
  string(20) "Solicito informacion"
  ["mensaje"]=>
  string(33) "Este es mi mensaje del formulario"
}

</body>
</html>
```
Ya solo valtaria darle forma.
```php
<body>
    <h1>Email recibido</h1>
    <p>Recibiste un mensaje de: {{$msg['nombre']}} - {{$msg['email']}} </p>
    <p>Asunto <strong>{{$msg['asunto']}}</strong></p>
    <p>Contenido: {{$msg['mensaje']}} </p>
</body>
```
En el controlador es buena práctica cambiarle el método **send** por **queue**. 
```php
Mail::to('abel@gmail.com')->queue(New MessageReceived($message));
```
Una forma rápida de verificar el mensaje en el navegador seria asi.
```php
// Mail::to('abel@gmail.com')->queue(New MessageReceived($message));
   return new MessageReceived($message);
```
#### Mailtrap
Se tiene que tener una cuenta en **mailtrap** y hay un apartado donde vienen las credenciales y eso se configura en el archivo **.env** y para eso se debe de configurar como **smtp**.
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=name mailtrap
MAIL_PASSWORD=pass mailtrap
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=abel93lk@gmail.com
MAIL_FROM_NAME= 'Abel Garcia'
```
Y sin mover nada mas, los mensajes estarian llegando a **Mailtrap**

#### Sendrid
Para vincularlo con sengrid se tiene que instalar un paquete, los pasos lo podemos obtener aqui
Enlace: https://github.com/s-ichikawa/laravel-sendgrid-driver

```console
C:\wamp64\www\intro_laravel>composer require s-ichikawa/laravel-sendgrid-driver:~2.0
./composer.json has been updated
Running composer update s-ichikawa/laravel-sendgrid-driver
Loading composer repositories with package information
```
Se tuvo que espesificar la versión por que por mi **php** no soportaba la actual.

Y como lo espesifica en el git, se estaria configurando de esta manera el archivo **.env**.
```
#MAIL_DRIVER=log
#MAIL_HOST=smtp.mailtrap.io

MAIL_DRIVER=sendgrid
SENDGRID_API_KEY='YOUR_SENDGRID_API_KEY'
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=abel93lk@gmail.com
MAIL_FROM_NAME= 'Abel Garcia'
```
Por último en el archivo **config/services.php** ingresamos el sengrid.

```json
'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
    ],
```

### Variables de entorno y Base de datos
#### Variables de entorno
Las variables de entorno existen 2 **Entorno de desarrollo** y **Entorno de producción** Estas variables se concentran en el archivo **.env**, este archivo no se sube al git ya que esta en la lista de ingnorados, laravel sabe cual es el archivo de entorno y de producción por la variable **APP_ENV** que puede estar en **local** o **production**.
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:QVmiMNBdz5XwvKRAM33SCeOg2mBqQWBnIy4T+QKTxgY=
APP_DEBUG=true
APP_URL=http://localhost
```

#### Base de datos
Las configuraciones de Base de datos estan en el archivo **config/database.php**, esto quiere decir que si no encuentra la configuración de la base de datos en el archivo **.env** que es esta: **DB_CONNECTION**, toma por default mysql (en este caso).
```php
'default' => env('DB_CONNECTION', 'mysql'),
```
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
Para la conexión tenemos que especificar la BD, el host, el puerto (casi siempre es el mismo), el nombre de la base de datos, y sus credenciales.

### Migraciones
Las migraciones son un control de versiones de la base de datos permite crear y  modificar facilmente las tablas permite destruir y construir el esquema de la base de datos.

Por defecto laravel ya trae unas migraciones que son la creación de usuarios y de la tabla passwords, dentro de los archivos existen 2 funciones **up()** y **down()**.

```php
public function up(){
   Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
   });
}
public function down(){
   Schema::dropIfExists('users');
}
```
La función **up()** crea la tabla y a su vez le añade las columnas que le especifiquemos, cada columna con su tipo de dato.
```php
$table->bigIncrements('id'); // Es autoincrementable
$table->string('name');  // Tipo string
$table->string('email')->unique(); //Tipo string y ademas unico
$table->timestamp('email_verified_at')->nullable(); // Tipo date y comienza con nulo
$table->string('password'); // Tipo string
$table->rememberToken(); // Internamente laravel lo configura con string
$table->timestamps(); // Tipo date laravel lo configura internamente
```
Ahora la función **down()** es lo contrario que la función up(), ya que destruye la tabla.

#### migrate
Bien, el comando para ejecutar la migración.

```console
C:\wamp64\www\intro_laravel>php artisan migrate
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.2 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.16 seconds)
```
En la base de datos crea un tabla adicional **migrations**, en esta tabla se guarda el historial de las migraciones 

```console
mysql> select * from migrations;
+----+------------------------------------------------+-------+
| id | migration                                      | batch |
+----+------------------------------------------------+-------+
|  4 | 2014_10_12_000000_create_users_table           |     1 |
|  5 | 2014_10_12_100000_create_password_resets_table |     1 |
+----+------------------------------------------------+-------+
2 rows in set (0.00 sec)
```
La columna **batch** indica la ves que se registro la migracion, por ejemplo la tabla users y password_resets se hicieron en un solo batch (**se ejecutaron al mismo tiempo**).

#### rollback
Y para ejecutar la función **down**.
```console
C:\wamp64\www\intro_laravel>php artisan migrate:rollback
Rolling back: 2014_10_12_100000_create_password_resets_table
Rolled back:  2014_10_12_100000_create_password_resets_table (0.03 seconds)
Rolling back: 2014_10_12_000000_create_users_table
Rolled back:  2014_10_12_000000_create_users_table (0.01 seconds)
```
Elimina todas las tablas menos el de **migrations** (pero si lo vacia).

#### rollback step
Es posible eliminar por pasos, ejemplo si queremos eliminar la última tabla creada.
```console
mysql> select * from migrations;
+----+------------------------------------------------+-------+
| id | migration                                      | batch |
+----+------------------------------------------------+-------+
| 13 | 2014_10_12_000000_create_users_table           |     1 |
| 14 | 2014_10_12_100000_create_password_resets_table |     1 |
+----+------------------------------------------------+-------+
2 rows in set (0.00 sec)
```
```console
C:\wamp64\www\intro_laravel>php artisan migrate:rollback --step=1
Rolling back: 2014_10_12_100000_create_password_resets_table
Rolled back:  2014_10_12_100000_create_password_resets_table (0.03 seconds)
```
Esto es de acuerdo a la tabla **migrations**.
```console
mysql> select * from migrations;
+----+--------------------------------------+-------+
| id | migration                            | batch |
+----+--------------------------------------+-------+
| 13 | 2014_10_12_000000_create_users_table |     1 |
+----+--------------------------------------+-------+
1 row in set (0.00 sec)
```
Y si volvemos a ejecutar nuevamente la migración.
```console
C:\wamp64\www\intro_laravel>php artisan migrate
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.17 seconds)
```
Solo creo la tabla **password_reset** por es el que se elimino, pero ahora si revisamos la tabla **migrations** veremos que que los **batchs** cambiaron.
```console
mysql> select * from migrations;
+----+------------------------------------------------+-------+
| id | migration                                      | batch |
+----+------------------------------------------------+-------+
| 13 | 2014_10_12_000000_create_users_table           |     1 |
| 15 | 2014_10_12_100000_create_password_resets_table |     2 |
+----+------------------------------------------------+-------+
2 rows in set (0.00 sec)
```
Por que los **batchs** hacen referencia al evento de ejecución, entonces a la hora de realizar un **rollback** normal solo se va a eliminar el último **batch**.
```console
C:\wamp64\www\intro_laravel>php artisan migrate:rollback
Rolling back: 2014_10_12_100000_create_password_resets_table
Rolled back:  2014_10_12_100000_create_password_resets_table (0.03 seconds)
```
```console
mysql> select * from migrations;
+----+--------------------------------------+-------+
| id | migration                            | batch |
+----+--------------------------------------+-------+
| 13 | 2014_10_12_000000_create_users_table |     1 |
+----+--------------------------------------+-------+
1 row in set (0.00 sec)
```
#### fresh
Si ya ejecutamos las migraciones y ya estan creadas las tablas pero se nos olvido añadir una nueva columna tenemos que hacer el **rollback** y después crear las migraciones otravez, pero existe un comando que lo simplifica que es el **fresh**, digamos que vamos añadir una columna **phone** a la tabla **users**.
```php
public function up(){
   Schema::create('users', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name');
      $table->string('phone');
      $table->string('email',6)->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
   });
}
```
```console
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)        | NO   |     | NULL    |                |
| email             | varchar(6)          | NO   | UNI | NULL    |                |
| email_verified_at | timestamp           | YES  |     | NULL    |                |
| password          | varchar(255)        | NO   |     | NULL    |                |
| remember_token    | varchar(100)        | YES  |     | NULL    |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+
```
```console
C:\wamp64\www\intro_laravel>php artisan migrate:fresh
Dropped all tables successfully.
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.2 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.22 seconds)
```
```console
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)        | NO   |     | NULL    |                |
| phone             | varchar(255)        | NO   |     | NULL    |                |
| email             | varchar(6)          | NO   | UNI | NULL    |                |
| email_verified_at | timestamp           | YES  |     | NULL    |                |
| password          | varchar(255)        | NO   |     | NULL    |                |
| remember_token    | varchar(100)        | YES  |     | NULL    |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+
```
Si nos dimos cuenta  elimino la tabla **users** y la volvio a crear junto con la tabla **password_resets**.
Pero el comando **fresh** tiene una desventaja ya que para agregar una columna elimina todos los datos de las tablas (y esto no queremos cuando estemos en producción).

#### update table
Para insertar (actualizar) una columna a una tabla existente y que no nos borre los datos que ya tenemos debemos de crear una migración de actualización de esa tabla, automáticamente al escribir **_to_** y despues **el nombre de la tabla** laravel detecta que queremos modificar la tabla especificada y nos crea la función para modificarla.
```console
C:\wamp64\www\intro_laravel>php artisan make:migration add_phone_to_users_table
Created Migration: 2021_02_04_120629_add_phone_to_users_table
```
```php
public function up(){
   Schema::table('users', function (Blueprint $table) {
      //
   });
}

public function down(){
   Schema::table('users', function (Blueprint $table) {
      //
   });
}
```
Ahora especificamos la columna que deseamos añadir.
```php
public function up(){
   Schema::table('users', function (Blueprint $table) {
      $table->string('phone')->nullable();
   });
}
public function down(){
   Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('phone');
   });
}
```
Por último creamos la migración.
```console
C:\wamp64\www\intro_laravel>php artisan migrate
Migrating: 2021_02_04_120629_add_phone_to_users_table
Migrated:  2021_02_04_120629_add_phone_to_users_table (0.13 seconds)
```
Pero hay una problema, ya que le campo lo puso al final.
```console
+-------------------+---------------------+------+-----+---------+----------------+
| Field             | Type                | Null | Key | Default | Extra          |
+-------------------+---------------------+------+-----+---------+----------------+
| id                | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
| name              | varchar(255)        | NO   |     | NULL    |                |
| email             | varchar(6)          | NO   | UNI | NULL    |                |
| email_verified_at | timestamp           | YES  |     | NULL    |                |
| password          | varchar(255)        | NO   |     | NULL    |                |
| remember_token    | varchar(100)        | YES  |     | NULL    |                |
| created_at        | timestamp           | YES  |     | NULL    |                |
| updated_at        | timestamp           | YES  |     | NULL    |                |
| phone             | varchar(255)        | YES  |     | NULL    |                |
+-------------------+---------------------+------+-----+---------+----------------+
```
Esto se soluciona espeficicando en la migración después de que columna queremos que se añada, ejemplo.
```php
Schema::table('users', function (Blueprint $table) {
   $table->string('phone')->after('email')->nullable();
});
```
#### create table
Vamos a crear una migración de proyectos.
```console
C:\wamp64\www\intro_laravel>php artisan make:migration create_projects_table
Created Migration: 2021_02_04_122813_create_projects_table
```
Archivo creado.
```php
Schema::create('projects', function (Blueprint $table) {
   $table->bigIncrements('id');
   $table->timestamps();
});
```
Le añadimos unas columnas
```php
Schema::create('projects', function (Blueprint $table) {
   $table->bigIncrements('id');
   $table->string('title');
   $table->text('description');
   $table->timestamps();
});
```
Y realizamos la migracion
```console
C:\wamp64\www\intro_laravel>php artisan migrate
Migrating: 2021_02_04_122813_create_projects_table
Migrated:  2021_02_04_122813_create_projects_table (0.11 seconds)
```
#### IMPORTANTE
En el archivo de migración de **users** espeficicamente en la columna **$table->string('email')->unique();** no me dejo guardar en la tabla como **unique** me salia un error de que excedia la longitud de 1000 bytes y lo que pasaba esque creaba la tabla **users** con la columna pero sin el **unique** y lo peor esque como ocurria un error no se llenaba la tabla **migrations**, esto no debe de pasar ya que al hacer **rollback** a las migraciones primero se fija en la tabla **migrations** si cuenta con datos.

Entonces para que pudiera crearse la migración sin problemas le di una longitud por defecto (por ahora de prueba).
```php
$table->string('email',6)->unique();
```
Y lo mismo me paso con el archivo de migracion de la tabla **password_reset** con la columna **$table->string('email')->index();**, en este caso a la columna no ponia como **index** tuve que ponerle una longitud por defecto tambien.
```php
$table->string('email',100)->index();
```
**Es recomendable verificar hasta que longitud se tiene permitido para establecer un index, unique y demás**

### Obtener registros de la BD

Para obtener los registros de la base de datos tenemos que crear un modelo, como ya tenemos la tabla projects vamos a crear su modelo.
```console
C:\wamp64\www\intro_laravel>php artisan make:model Project
Model created successfully.
```

La convención para nombrar el modelo es el de CamelCase, y laravel para saber de que tabla se trata convierte el nombre del modelo a minuscula y le agrega una **S**, pero por si la tabla esta escrito de manera diferente en el modelo podemos especificar su nombre de esta forma **protected $table = 'my_table'**.
Pero bueno ya tenemos el modelo creado.
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{
    //
}
```
Para listar los datos en la vista, desde el controlador importamos el **modelo** y por medio de **Eloquent** hacemos una instancia del modelo y listo.
```php
namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class portafolioController extends Controller
{
  
    public function index(){
        $portafolio = Project::get();
        // $portafolio =[
        //     ['title'=>'Proyecto 1'],
        //     ['title'=>'Proyecto 2'],
        //     ['title'=>'Proyecto 3'],
        //     ['title'=>'Proyecto 4'],
        //     ];
        return view('portfolio', compact('portafolio'));
    }
 
}
```
```php
@extends('plantilla')

@section('title','Portafolio')

@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta['title']}} <small>{{$loop->last ? 'Es el ultimo': 'No es el ultimo'}}</small> </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
```
Mi primer proyecto No es el ultimo
Mi segundo proyecto No es el ultimo
Mi tercer proyecto No es el ultimo
Mi cuarto proyecto Es el ultimo
```
Vamos a cambiar la vista de la siguiente manera.
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta->title}} <br> <small>{{$porta->description}}</small> </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
#### orderBy()
Y bueno ya teniendo el modelo le podemos decir que nos ordene de forma **descendente** por ejemplo
```php
$portafolio = Project::orderBy('created_at','DESC')->get();
```
```
Mi cuarto proyecto
Descripción de Mi cuarto proyecto
Mi tercer proyecto
Descripción de Mi tercer proyecto
Mi segundo proyecto
Descripción de Mi segundo proyecto
Mi primer proyecto
Descripción de Mi primer proyecto
```
#### latest()
El método latest recibe como parámetro la columna que queremos ordenar **descendentemente** y si no le pasamos ninguno va a tomar el campo **created_at**.
```php
$portafolio = Project::latest('updated_at')->get();
```
#### Formato fechas
Las fechas lo obtiene por medio de **carbon** asi que podemos darle formato por ejemplo para obtener el año.
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta->title}} <br> <small>{{$porta->description}}</small>
      <br> {{$porta->created_at->format('Y')}} </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
```
Mi cuarto proyecto
Descripción de Mi cuarto proyecto
2021
Mi tercer proyecto
Descripción de Mi tercer proyecto
2021
Mi segundo proyecto
Descripción de Mi segundo proyecto
2021
Mi primer proyecto
Descripción de Mi primer proyecto
2021
```
Obtener el mes
```php
{{$porta->created_at->format('M')}}
```
Obtener el dia
```php
{{$porta->created_at->format('D')}}
```
Fecha completa
```php
{{$porta->created_at->format('Y-m-d')}}
```
Tambien esta **diffForHumans()** que nos muestra la diferencia de tiempo.
```console
mysql> select * from projects;
+----+---------------------+------------------------------------+---------------------+---------------------+
| id | title               | description                        | created_at          | updated_at          |
+----+---------------------+------------------------------------+---------------------+---------------------+
|  1 | Mi primer proyecto  | Descripción  de Mi primer proyecto | 2021-02-01 00:00:00 | 2021-02-01 00:00:00 |
|  2 | Mi segundo proyecto | Descripción de Mi segundo proyecto | 2021-02-02 00:00:00 | 2021-02-02 00:00:00 |
|  3 | Mi tercer proyecto  | Descripción de Mi tercer proyecto  | 2021-02-03 00:00:00 | 2021-02-03 00:00:00 |
|  4 | Mi cuarto proyecto  | Descripción de Mi cuarto proyecto  | 2021-02-04 00:00:00 | 2021-02-04 00:00:00 |
+----+---------------------+------------------------------------+---------------------+---------------------+
4 rows in set (0.00 sec)
```
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta->title}} <br> <small>{{$porta->description}}</small>
      <br> {{$porta->created_at->diffForHumans()}} </li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
@endsection
```
```
Mi cuarto proyecto
Descripción de Mi cuarto proyecto
hace 1 día
Mi tercer proyecto
Descripción de Mi tercer proyecto
hace 2 días
Mi segundo proyecto
Descripción de Mi segundo proyecto
hace 3 días
Mi primer proyecto
Descripción de Mi primer proyecto
hace 4 días
```
#### Paginación
Vamos a dejar la vista con el titulo nadamas, y vamos a implementar la paginación, para eso en el controlador le añadimos el método **paginate** por defecto la paginación es de 5 elementos, pero como nosostros tenemos 4 vamos a dejarlo con 2.
```php
$portafolio = Project::latest()->paginate(2);
```
Y en la vista ponemos los links de paginación para poder visualizar los elementos.
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($portafolio as $porta)
      <li>{{$porta->title}}</li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$portafolio->links()}}
@endsection
```
**Importante** para mostrar los links debemos de hacer referencia al array, en este caso **$portafolio**.
Y bueno se veria asi en el navegador, aunque sin estilo alguno.
```
Mi cuarto proyecto
Mi tercer proyecto
‹
1
2
›
```
Por último vamos a cambiar las variables de portafolio a proyecto para que tenga mas lógica.
```php
public function index(){
   $proyectos = Project::latest()->paginate(2);
   return view('portfolio', compact('proyectos'));
}
```
```php
@section('content')
   <h1>Portafolio</h1>
   @forelse ($proyectos as $proyecto)
      <li>{{$proyecto->title}}</li>
   @empty
      <li>No hay proyectos</li>
   @endforelse
   {{$proyectos->links()}}
@endsection
```
### Obtener registros inividuales
Para ver los detalles de cada proyecto primero debes de encerrarlos en un link y pasar en el **href** el id del proyecto, si solo pasamos el alias del for laravel tomara el id automaticamente **pero solo si tu id se llamas asi como tal "id" por que por ejemplo si se llama "id_proyecto" no funciona**
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($proyectos as $proyecto)
         <li><a href="{{route('portafolio.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection
```
Ahora vamos a crear la ruta que le estamos indicando, y vamos a ponerle como nombre **portafolio.show**
```php
Route::get('/portfolio/{id}','portafolioController@show')->name('portafolio.show');
```
Y por último vamos a crear la función **show** dentro del controlador, y vamos a usar el método **find** para encontrar el elemento.
```php
public function show($id){
   return Project::find($id);
}
```
Resultado.
```json
{
"id": 4,
"title": "Mi cuarto proyecto",
"description": "Descripción de Mi cuarto proyecto",
"created_at": "2021-02-04 00:00:00",
"updated_at": "2021-02-04 00:00:00"
}
```
Laravel automaticamente lo convierte en formato **json**.

Vamos a crear una vista para mostrar los datos individuales en la ruta **view/projects/show.blade.php** y ocupando las mismas cabeceras vamos a mostrar los datos un poco mas ordenados.
```php
@extends('plantilla')

@section('title', 'Portafolio |'. $project->title)

@section('content')
    <h1>{{$project->title}}</h1>
    <p>{{$project->description}}</p>
    <p>{{$project->created_at->diffForHumans()}}</p>
@endsection
```

Ahora vamos a crear la variable **$project** en el controlador, y pasarlo a la vista.
```php
public function show($id){
   $project = Project::find($id);
   return view('projects.show',[
      'project' => $project
   ]);
}
```
Listo ya tenemos nuestra vista, ahora cuando le demos click a cualquier proyecto nos saldra la descripcion en otra vista.

#### Personalizando erro 404
Pero que pasa si tratan de acceder a un proyecto que no existe, para eso debemos de modificar en el controladro para que falle si un registro no lo encuentra (esto va hacer que nos muestre un error 404).
```php
public function show($id){
   $project = Project::findOrFail($id);
   return view('projects.show',[
      'project' => $project
   ]);
}
```
Cambiando de **find()** a **findOrFail()**, ahora si queremos personalizar el error 404 debemos de crear un archivo en la siguiente ruta, **view/errors/404.blade.php**, y por ahora le vamos a poner **error personalizado** dentro del archivo y listo.

### Restructuración
Vamos a modificar algunos archivos para que tenga una convención tanto los nombres como las rutas.

En el controlador la vista vamos a cambiarle de nombre **project.index**
```php
class portafolioController extends Controller{
    public function index(){
        $proyectos = Project::latest()->paginate();
        return view('projects.index', compact('proyectos'));
    }
```
Y para esto tenemos que renombrar la ruta **view/projects/index.blade.php** (y todo lo del archivo potafolio va a estar en este archivo), ya podemos eliminar el archivo **porfolio.blade.php**.

Vamos a renombrar el controlador de **portafolioController** a **ProjectController** (según la convención de laravel, el nombre del modelo debe de ser el mismo que el controlador+Controller).
```php
class ProjectController extends Controller{
    public function index(){
        $proyectos = Project::latest()->paginate();
        return view('projects.index', compact('proyectos'));
    }
    public function show($id){
        $project = Project::findOrFail($id);
        return view('projects.show',[
            'project' => $project
        ]);
    }
}
```
También le cambiamos de nombre al archivo y a las rutas.
```php
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/{id}','ProjectController@show')->name('projects.show');
```
Actualizamos las rutas en el **nav**
```php
<li class="{{setActive('projects.*')}}"><a href="{{route('projects.index')}}">Portafolio</a></li>
```
También en el **index**
```php
@section('content')
   <h1>Portafolio</h1>
      @forelse ($proyectos as $proyecto)
      <li><a href="{{route('projects.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection
```
Y ya que estamos en eso, vamos a actualizar completamente el nav de acuerdo a los nombres de las rutas.
```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('projects.*')}}"><a href="{{route('projects.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
    </ul>
 </nav>
 ```
 Todas las rutas.
 ```php
Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/{id}','ProjectController@show')->name('projects.show');
Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('contacto');
```
Pero vemos que el nombre **contacto** se repite, vamos a cambiarlo.
```php
Route::post('contact','MessageController@store')->name('messages.store');
```
También en el formulario de **contact.blade**
```php
<form action="{{route('messages.store')}}" method="POST">
   @csrf
   <input type="text" name="nombre" placeholder="nombre"><br>
   {!! $errors->first('nombre','<small>:message</small><br>')!!}
   <input type="text" name="email" placeholder="email"><br>
   {!! $errors->first('email','<small>:message</small><br>')!!}
   <input type="text" name="asunto" placeholder="asunto"><br>
   {!! $errors->first('asunto','<small>:message</small><br>')!!}
   <textarea name="mensaje" id="" cols="30" rows="5"></textarea> <br>
   {!! $errors->first('mensaje','<small>:message</small><br>')!!}
   <button type="submit">Enviar</button>
</form>
```
Y listo podemos continuar.

### Route Model Binding
Podemos pasar el modelo en el constructor lo busca automaticamente, para probarlo vamos a ingresar el modelo en el constructor de esta manera.

```php
public function show(Project $project){
   // $project = Project::findOrFail($id);
   return view('projects.show',[
      'project' => $project
   ]);
}
```
y en la ruta en ves de pasarle **id** vamos a pasarle el **project** esto para que tenga coherencia y vamos a seguir teniendo el mismo resultado.
```php
Route::get('/portfolio/{project}','ProjectController@show')->name('projects.show');
```
#### buscando proyecto por titulo
Laravel tiene un método en donde establece la busqueda por id, para verificarlo nos vamos al modelo y despues al archivo que extiende del modelo, en este archivo hay un método.
```php
public function getRouteKeyName(){
   return $this->getKeyName();
}
```
Y este a su vez llama a **getKeyName()**
```php
public function getKeyName(){
   return $this->primaryKey;
}
```
Como vemos aqui es donde llama al id de la tabla, pero podemos cambiarlo y ponerle el campo que queramos que busque ejmeplo**return $this->title;**.
Pero como no debemos de modificar los archivos internos de laravel ya que al actualizar perderemos los cambios, asi aque en el modelo vamos a sobreescribir el método.
```php
class Project extends Model{
   public function getRouteKeyName(){
      return 'title';
   }
}
```
Ahora si damos click en el proyecto vamos a ver en la url así.
```
http://localhost:8000/portfolio/Mi%20primer%20proyecto
```
Ya lo muestra por el título del proyecto pero ahora el problema esque las rutas no deben de tener espacios porque los espacios los codifica y devuelve **%20** y eso no se ve bien, lo ideal seria que lo sustituyera por un guion **-**.
Para solucionar esto debemos de crear una nueva columna en la tabla llamada **url** y almacenaremos el titulo del proyecto pero con guiones ejem. **Mi-primer-proyecto** y asi ya no habria espacios.
Vamos primero a crear las migraciones.
```console
C:\wamp64\www\intro_laravel> php artisan make:migration add_url_to_projects_table
Created Migration: 2021_02_06_105559_add_url_to_projects_table
```
Creamos el campo **url** lo establecemos como único para que no existan 2 url iguales y que este despues de la columna **description**.
```php
public function up(){
   Schema::table('projects', function (Blueprint $table) {
      $table->string('url')->after('description')->unique();
   });
}
```
creamos la migración.
```
C:\wamp64\www\intro_laravel> php artisan migrate
Migrating: 2021_02_06_105559_add_url_to_projects_table
Migrated:  2021_02_06_105559_add_url_to_projects_table (0.2 seconds)
```
Y listo, ahora llenamos la columna **url** con los nombres de los proyectos con guiones.
```console
+----+---------------------+------------------------------------+---------------------+---------------------+---------------------+
| id | title               | description                        | url                 | created_at          | updated_at          |
+----+---------------------+------------------------------------+---------------------+---------------------+---------------------+
|  1 | Mi primer proyecto  | Descripción de Mi primer proyecto  | Mi-primer-proyecto  | 2021-02-01 00:00:00 | 2021-02-01 00:00:00 |
|  2 | Mi segundo proyecto | Descripción de Mi segundo proyecto | Mi-segundo-proyecto | 2021-02-03 00:00:00 | 2021-02-03 00:00:00 |
|  3 | Mi tercer proyecto  | Descripción de Mi tercer proyecto  | Mi-tercer-proyecto  | 2021-02-04 00:00:00 | 2021-02-04 00:00:00 |
|  4 | Mi cuarto proyecto  | Descripción de Mi cuarto proyecto  | Mi-cuarto-proyecto  | 2021-02-05 00:00:00 | 2021-02-05 00:00:00 |
+----+---------------------+------------------------------------+---------------------+---------------------
```
Ahora en el modelo en ves de apuntar al **title** vamos a decirle que lo busque por la **url**
```php
public function getRouteKeyName(){
   return 'url';
}
```
#### IMPORTANTE
En la migración cuando actualice la **url** como le puse **unique** me arrojo un error que la longitud de bytes debe de ser menor que 1000, bueno esto sucede por la versión de mysql y también por que laravel añadio un char set que es **utf8mb4** el cual soporta emojis, pero esto lo podemos solucionar en el archivo que esta **Providers/AppServiceProvider.php** y agregamos lo siguiente en la función boot().
```php
public function boot(){
   Schema::defaultStringLength(191);
}
```
### Insertar datos a la base de datos
Vamos a crear la ruta para el formulario de crear proyectos y lo llamaremos **projects.create**, algo importante es el orden de las rutas, ya que la ruta **projects.show** tiene en su url un parámetro y si se pone primero cuando intentemos acceder a la ruta **portafolio/crear** laravel va a detectar el **crear** como un parametro y va a dar error, es po eso que primero debe de estar el método **create** y después el **show** asi cuando no encuentre un parametro se pasa a la otra ruta.
```php
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/crear','ProjectController@create')->name('projects.create');
Route::get('/portfolio/{project}','ProjectController@show')->name('projects.show');
```
Ahora vamos a crear el método en el controlador y retornamos la vista.
```php
public function create (){
   return view('projects.create');
}
```
Por último vamos a crear la vista **view/projects/create.blade.php**
```php
@section('title','Crear proyecto')

@section('content')
   <h1>Crear nuevo proyecto</h1>
   <form>
       <label for="">Título <br> <input type="text" name="title"></label> <br>
       <label for="">Url <br> <input type="text" name="url"></label> <br>
       <label for="">Descripción <br> <textarea name="description" id="" cols="20" rows="5"></textarea></label> <br> <br>
       <button>Guardar</button>
</form>
@endsection
```
Hasta ahora nos muestra el formulario, pero aún nos falta agregar el tipo de método y la acción, de igual forma el token oculto **@csrf**.
```php
<form action="{{route('projects.store')}}" method="POST">
    @csrf
       <label for="">Título <br> <input type="text" name="title"></label> <br>
       <label for="">Url <br> <input type="text" name="url"></label> <br>
       <label for="">Descripción <br> <textarea name="description" id="" cols="20" rows="5"></textarea></label> <br> <br>
       <button>Guardar</button>
</form>
```
Pues bien vamos a crear la ruta que indica la acción (**store**).
```php
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/crear','ProjectController@create')->name('projects.create');
Route::post('/portfolio','ProjectController@store')->name('projects.store');
Route::get('/portfolio/{project}','ProjectController@show')->name('projects.show');
```
Y agregamos la función **strore** en el controlador.
```php
public function store(){
return request();
}
```
Con el **request()** vamos a visualizar lo que se escribio en el formulario incluyendo el token oculto, ahora de los valores vamos a insertarla en la base de datos y de una vez cuando se inserte que nos redirija al index (donde se enlistan los proyectos).
```php
public function store(){
   Project::create([
      'title' => request('title'),
      'url' => request('url'),
      'description' => request('description')
   ]);

   return redirect()->route('projects.index');
}
```
Si intentamos guaradar nos va a dar un error, ya que los campos que especificamos no lo hemos declarado en el modelo, asi que vamos a declararlos.
```php
class Project extends Model{
    protected $fillable = ['title','url','description'];
}
```
Con esto ya debe de guardar a la base de datos y redirigir a la vista index, vamos a crear el boton para crear un nuevo proyecto (en este caso va hacer una etiqueta <a>).
```php
@section('content')
   <h1>Portafolio</h1>
      <a href="{{route('projects.create')}}">Nuevo proyecto</a>
      <br>
      @forelse ($proyectos as $proyecto)
      <li><a href="{{route('projects.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection
```
Algo importante en el controlador cuando las variables sean iguales que el nombre de su columna en la base de datos se puede simplificar incluyendo **request()->all()**.
```php
public function store(){
   Project::create([
      'title' => request('title'),
      'url' => request('url'),
      'description' => request('description')
   ]);

   return redirect()->route('projects.index');
}
```
```php
public function store(){
   Project::create([
      request()->all()
      ]);

   return redirect()->route('projects.index');
}
```
Y obtenemos el mismo resultado.

### Protección de datos de forma masiva (request()->all())
Cuando se utiliza la inserción de datos de forma masiva (cuando se ocupa request()->all()), contamos con un riesgo ya que en el formulario se pueden añadir mas inputs y modificar datos (como el id, created_at ...), para esto podemos solucionarlo de varias maneras.

Ingresando en el modelo los campos que vamos a utilizar por medio de **$fillable**
```php
class Project extends Model{
   protected $fillable = ['title','url','description'];
}
```
O lo inverso podemos declarar los campos con *$guarded* que no se tienen que guardar masivamente.
```php
class Project extends Model{
   protected $guarded = ['id','created_at','updated_at'];
}
```

Si declaramos el **$guarded** como vacio y sin declarar el **$fillable**  estaremos desprotegidos contra la inserción masiva;
```php
class Project extends Model{
   protected $guarded = [];
}
```
y podemos protejernos en el controlador de el método **only** que esto permite agregar en la base de datos lo que le especifiquemos en el parametro.
```php
public function store(){
   Project::create([
      request()->only('title','url','description')
      ]);

   return redirect()->route('projects.index');
}
```
La otra forma y la mas optima es crear una validación y asegnarle una variable (en este caso **$datos**) y esta variable es la que pasamos al **create** como parámetro para que se guarde en la base de datos.
```php
public function store(){
        $datos = request()->validate([
            'title' => 'required',
            'url' => 'required',
            'description' => 'required'
        ]);
        Project::create($datos);

        return redirect()->route('projects.index');
    }
```
A partir de ahora si queremos agregar otro campo en el formulario solo lo tenemos que declarar en la validación y listo.

#### IMPORTANTE
podemos desabilitar la protección que viene por defecto en laravel **protected $guarded = [];** solo si no utilizamos la inserción masiva **request()->all()**.

### Form requests (validación)
Los forms requests son pensados para validaciones complejos, clases dedicadas para encapsular la lógica de validación y autorización.
Para crearla es con el siguiente comando.
```console
C:\wamp64\www\intro_laravel>php artisan make:request CreateProyectRequest
Request created successfully.
```
Nos crea una carpeta y el archivo **app/http/Requests/CreateProyectRequest.php** y dentro tenemos 2 métodos, en el **authorize** es donde verificamos la autorización si es **admin,cliente,user, etc.** si retorna **false** arroja un **error 403 forbiden**, pero si pasa ingresan a las reglas **(rules)**.
```php
public function authorize(){
        return false;
    }
```
Las reglas reciben un array, como la que habiamos declarado en el controlador.
```php
public function rules(){
   return [
      //
   ];
}
```
Pues bien vamos a dejar en la función **authorize** como **true** para que pase por el momento y asi verifiquemos las reglas.
```php
public function authorize(){
   return true;
}
```
Y en la función **rules** ingresamos las validaciones que teniamos en el controlador **ProjectController**.
```php
public function rules(){
   return [
      'title' => 'required',
      'url' => 'required',
      'description' => 'required'
   ];
}
```
Ya tenemos las validaciones ahora solo ahi que llamarlo desde el controlador, (**importarlo**), y despues retornar el request para verificar si esta tomando las validaciones.
```php
use App\Http\Requests\CreateProyectRequest;

public function store(CreateProyectRequest $request){
   return $request->validated();
   // $datos = request()->validate([
   //     'title' => 'required',
   //     'url' => 'required',
   //     'description' => 'required'
   // ]);
   // Project::create($datos);

   // return redirect()->route('projects.index');
}
```
Antes de probarlo vamos a la vista a verificar los errores, para eso lo vamos a encapsular en un **foreach**
```php
@section('content')
   <h1>Crear nuevo proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
   <form action="{{route('projects.store')}}" method="POST">
    @csrf
       <label for="">Título <br> <input type="text" name="title"></label> <br>
       <label for="">Url <br> <input type="text" name="url"></label> <br>
       <label for="">Descripción <br> <textarea name="description" id="" cols="20" rows="5"></textarea></label> <br> <br>
       <button>Guardar</button>
</form>
@endsection
```
Ahora si no llenamos los campos guardamos, nos va a arrojar los errores de validación, de lo contrario nos muestra los datos del formulario, y como no estamos utilizando **$request->all()** no nos devuelve el **token**.
Por último vamos a personalizar los mensajes de las reglas.
```php
public function rules(){
   return [
      'title' => 'required',
      'url' => 'required',
      'description' => 'required'
   ];
}
public function messages(){
   return [
      'title.required' => 'El Proyecto necesita un título',
   ];
}
```
Y dejemos que cree el proyecto si los campos del formulario no estan vacios.
```php
public function store(CreateProyectRequest $request){
   Project::create($request->validated());
   return redirect()->route('projects.index');
}
```
Hasta este momento al crear un pryecto no debe de redirigir al listado sin ningun error.

### Actualizar registros
Para actualizar un registro primero vamos a poner un link que nos lleve a la ruta **project.edit** en la vista **show** donde estan los detalle de cada proyecto, pasandole el proyecto como parámetro.
```php
@section('content')
    <h1>{{$project->title}}</h1>
    <a href="{{route('project.edit',$project)}}">Editar</a>
    <p>{{$project->description}}</p>
    <p>{{$project->created_at->diffForHumans()}}</p>
@endsection
```
Creamos la ruta y lo redirecionamos al método **edit**, laravel detecta automaticamente que lo que le estan pasando como parámetro es el **id**.
```php
Route::get('/portfolio/{project}/editar','ProjectController@edit')->name('project.edit');
```
Ahora creamos el método en el controlador, y lo vamos a reditigir a la vista **edit** pasandole como parámetro el proyecto.
```php
public function edit(Project $project){
   return view('projects.edit',[
      'project' =>$project
   ]);
}
```
Procedemos a crear al vista **project/edid.blade.php** y va a ser similar a la vista create, le dejamos los errores de validación ya que lo vamos a utilizar mas después.
```php
@section('content')
   <h1>Editar proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
   <form action="" method="POST">
    @csrf
       <label for="">Título <br> <input type="text" name="title"></label> <br>
       <label for="">Url <br> <input type="text" name="url"></label> <br>
       <label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5"></textarea></label> <br> <br>
       <button>guardar</button>
</form>
@endsection
```
Como estamos pasando el proyecto por la url vamos a reflejarlo en cada uno de los inputs, y al botón lo cambiamos como actualizar.
```php
<form action="" method="POST">
@csrf
   <label for="">Título <br> <input type="text" name="title" value="{{$project->title}}"></label> <br>
   <label for="">Url <br> <input type="text" name="url" value="{{$project->url}}"></label> <br>
   <label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{$project->description}}</textarea></label> <br> <br>
   <button>Actualizar</button>
</form>
```
Continuamos con la actualización de los datos, laravel solo tiene activado los métodos **post y get** pero no **patch,put ni delete** asi que para que se de cuenta que queremos utilizar el método **patch** vamos a pasarle un input oculto o con la directiva **@method('PATCH')**.
También vamos a agregar la ruta para la actualización **project.update**.
```php
<form action="{{route('project.update', $project)}}" method="POST">
    @csrf @method('PATCH')
       <label for="">Título <br> <input type="text" name="title" value="{{$project->title}}"></label> <br>
       <label for="">Url <br> <input type="text" name="url" value="{{$project->url}}"></label> <br>
       <label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{$project->description}}</textarea></label> <br> <br>
       <button>Actualizar</button>
    </form>
```
Vamos a crear la ruta de actualización con el método **patch** como lo indicamos en el formulario y vamos a utilizar la función **update** en el controlador.
```php
Route::patch('/portfolio/{project}','ProjectController@update')->name('project.update');
```

Creamos el método en el controlador utilizando el modelo **Project**, pasamos los parámetros de las columnas a actualizar y redirigiendo a los detalles del proyecto (show).
```php
public function update(Project $project){
   $project->update([
      'title' => request('title'),
      'url' => request('url'),
      'description' => request('description'),
   ]);
   return redirect()->route('projects.show', $project);
    }
```
Pero si queremos validar nuevamente los campos tenemos que crear otro archivo de validación, aun que viendolo bien son los mismos campos asi que mejor vamos a reutilizar el que ya tenemos y solo le cambiamos de nombre al archivo para que se a mas genérico de **Http/Request/CreateProjectRequest.php** a **Http/Request/SaveProjectRequest.php** hacemos igual con la clase.
```php
class SaveProyectRequest extends FormRequest{
...
}
```
Y en el controlador modificamos el nombre de como se llama a este archivo de validación y lo añadimos al método **update**.
```php
use App\Http\Requests\SaveProyectRequest;
public function store(SaveProyectRequest $request){ ...}

public function update(Project $project, SaveProyectRequest $request){
   $project->update( $request->validated() );
   return redirect()->route('projects.show', $project);
}
```
Ahora cuando no se escriba nada en algún campo a la hora de actualizar va a fallar y nos va a mostrar el mensaje de error.
Pero ahora el problema es que si actualizamos los campos y si uno llega a fallar vuelven todo los campos a su valor original, lo cual es un poco molesto estar reinscribiendo todo de nuevo, pero esto se puede eliminar con **old()**.
```php
<form action="{{route('project.update', $project)}}" method="POST">
@csrf @method('PATCH')
   <label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
   <label for="">Url <br> <input type="text" name="url" value="{{old('url',$project->url)}}"></label> <br>
   <label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{old('description',$project->description)}}</textarea></label> <br> <br>
   <button>Actualizar</button>
</form>
```
Con esto cuando falle algún campo los demas quedan con sus valores, ahora vamos a pasar este **old()** al formulario donde se crean los proyectos.
```php
<form action="{{route('projects.store')}}" method="POST">
    @csrf
       <label for="">Título <br> <input type="text" name="title" value="{{old('title')}}"></label> <br>
       <label for="">Url <br> <input type="text" name="url" value="{{old('url')}}"></label> <br>
       <label for="">Descripción <br> <textarea name="description" id="" cols="20" rows="5">{{old('description')}}</textarea></label> <br> <br>
       <button>Guardar</button>
</form>
```
### Reutilizando Formulario
Vamos a crear archivos parciales de los segmentos iguales que contienen en los formularios de **create** y **edit**.

Comenzaremos con los errores, vamos a crear un archivo dentro de la carpeta **partials/validation-errors.blade.php** e incluimos los errores.
```php
/* Archivo editar */
@section('content')
   <h1>Editar proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
```
```php
/* Archivo crear */
@section('content')
   <h1>Crear nuevo proyecto</h1>
    @if ($errors->any())
        
      <ul>
         @foreach ($errors->all() as $error)
             <li>{{$error}}</li>
         @endforeach
      </ul>
    @endif
```
```php
/* Archivo validation-errors.blade */
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</ul>
@endif
```
Ahora inluimos en ambos formularios.
```php
@section('content')
   <h1>Editar proyecto</h1>
   @include('partials/validation-errors')
```
```php
@section('content')
   <h1>Crear nuevo proyecto</h1>
   @include('partials/validation-errors')
```
Seguimos con los inputs, vamos a crear un archivo separado para tener todos los inputs de cada formulario y después incluirlos como lo hicimos con los errores.
Pero aqui hay un problema ya que en el achivo **create** los inputs solo tiene un parámetro en la función **old()**.
```php
<label for="">Título <br> <input type="text" name="title" value="{{old('title')}}"></label> <br>
```
Y en el archivo **edit** tiene 2 parámetros.
```php
<label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
```
Si empatamos para que la función **old** tenga 2 parámetros en ambos casos, va a fallar ya que en el archivo **create** no se tiene declarado esas variables, entonces vamos a realizar una instancia del proyecto en el controlador, asi pasamos todas las columas como **null**.
```php
class ProjectController extends Controller{
   public function index(){....}
   public function show(Project $project){....}
   public function create (){
      return view('projects.create',[
         'project' => new Project()
      ]);
   }
}
```
Ahora si vamos a crear el archivo parcial de los inputs, este archivo va a estar en **view/projets/_form.blade.php**.
```php
<label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
<label for="">Url <br> <input type="text" name="url" value="{{old('url',$project->url)}}"></label> <br>
<label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{old('description',$project->description)}}</textarea></label> <br> <br>
```
Después lo incluimos en los archivos **create** y **edit**.
```php
@section('content')
   <h1>Editar proyecto</h1>
   @include('partials/validation-errors')
   <form action="{{route('project.update', $project)}}" method="POST">
    @csrf @method('PATCH')
      @include('projects/_form')
      <button>Actualizar</button>
    </form>
@endsection
```
```php
@section('content')
   <h1>Crear nuevo proyecto</h1>
   @include('partials/validation-errors')
   <form action="{{route('projects.store')}}" method="POST">
    @csrf
      @include('projects/_form')
      <button>Guardar</button>
   </form>
@endsection
```
Tambien podemos hacer dinámico los botones pasandole como segundo parámetro en cada **inlude()** el texto del botón.
```php
@include('projects/_form',['btnText' => 'Actualizar'])
```
```php
@include('projects/_form',['btnText' => 'Guardar'])
```
Y en el archivo **_form** ponemos el boton con la variable que ya delcaramos.
```php
<button>{{$btnText}}</button>
```
Por último se nos estaba pasando incluir en el archivo **_form** el **@csrf** ya que en los 2 casos se utiliza, y al final queda asi.
```php
@csrf
<label for="">Título <br> <input type="text" name="title" value="{{old('title',$project->title)}}"></label> <br>
<label for="">Url <br> <input type="text" name="url" value="{{old('url',$project->url)}}"></label> <br>
<label for="">Descripción <br> <textarea name="description"  id="" cols="20" rows="5">{{old('description',$project->description)}}</textarea></label> <br> <br>

<button>{{$btnText}}</button>
```
```php
/* archivo edit */
@section('content')
   <h1>Editar proyecto</h1>
   @include('partials/validation-errors')
   <form action="{{route('project.update', $project)}}" method="POST">
      @method('PATCH')
      @include('projects/_form',['btnText' => 'Actualizar'])
    </form>
@endsection
```
```php
/* archivo create*/
@section('content')
   <h1>Crear nuevo proyecto</h1>
   @include('partials/validation-errors')
   <form action="{{route('projects.store')}}" method="POST">

      @include('projects/_form',['btnText' => 'Guardar'])
   </form>
@endsection
```
Y con esto ya tenemos los valores iguales separados en diferentes archivos, esto hace que este un poco mas ordenado el código.

### Eliminado registros
Para eliminar un registro vamos a crear un botón en el archivo **show** que estará dentro de un formulario.
```php
@section('content')
    <h1>{{$project->title}}</h1>
    <a href="{{route('project.edit',$project)}}">Editar</a>
    <form action="{{route('project.destroy',$project)}}" method="POST">
        @csrf @method('DELETE')
        <button>Eliminar</button>
    </form>
    <p>{{$project->description}}</p>
    <p>{{$project->created_at->diffForHumans()}}</p>
@endsection
```
Como vimos es necesario incluir **@csrf** y como habiamos dicho tenemos que declarar el método a utilizar **@method('DELETE')**, y la ruta en este caso hacemos referencia a **project.destroy**.
Vamos a crear la ruta que como digimos va a ser de tipo **delete** y hacemos referencia al método **destroy**.
```php
Route::delete('portfolio/{project}', 'ProjectController@destroy')->name('project.destroy');
```
Vamos a crear el método en el controlador y de la instancia del proyecto vamos a inlcuirle el método **->delete** y con esto laravel sabe que queremos eliminar el proyecto.
```php
public function destroy(Project $project){
   $project->delete();
   return redirect()->route('projects.index');
}
```
#### ¿ Pero porque asi de sencillo?
Ok, todo esta bajo la convención de laravel y esto sucede por que estamos explotando el **Route Model Binding**.

***El route model binding es un mecanismo que llamamos "de conveniencia", básicamente es para "auto-inyectar" instancias de algún modelo usando las rutas de Laravel***. 

Ejemplo en el caso de la función **destroy()** que acabamos de hacer inyectamos el modelo **proyect** en la función por que en la ruta lo estamos pasando como el nombre del modelo.
```php
Route::delete('portfolio/{project}', 'ProjectController@destroy')->name('project.destroy');
```
Y en el controlador lo estamos recibiendo de la misma manera.
```php
public function destroy(Project $project)
```
Entonces hasta este punto laravel sabe que estamos haciendo referencia al modelo **project** o en otras palabras sabe que estamos haciendo rerefencia a la tabla **projects** de nuestra base de datos. 

Y cuando utilizamos el método **delete()** primero lo estamos tomando de la instancia del modelo **project**.
```php
$project->delete();
```
Que este a su ves lo esta tomando de la extensión **Model**.
```php
class Project extends Model{
   protected $guarded = [];
   public function getRouteKeyName(){
      return 'url';
   }
}
```
Y dentro de este **Model** esta la función **delete()** que lo primero que hace es buscar si existe **getKeyName**.
```php
public function delete(){
   if (is_null($this->getKeyName())) {
      throw new Exception('No primary key defined on model.');
   }
}
```
El **getKeyName** proviene de una función que esta retornando el **primaryKey**.
```php
public function getKeyName(){
   return $this->primaryKey;
}
```
Y aqui esta el secreto el **primaryKey** esta declarado con el **id**.
```php
protected $primaryKey = 'id';
```
Lo que quiere decir que al llamar el método **delete()** hace todo este proceso y por último determina que tiene que eliminar el proyecto con el id que se le esta pasando.
NOTA: para que esto funcione la tabla **projects** debe de tener su **primaryKey** como **id** de no ser asi en el modelo se debe especificar como se llama el **primaryKey** ya que como vimos para eliminar hace referencia al **primaryKey**.

### Route Resource
En las rutas vamos a utilizar **resource** para simplificar las rutas a una sola, por el momento tenemos estas rutas:
```php
Route::get('/portfolio','ProjectController@index')->name('projects.index');
Route::get('/portfolio/crear','ProjectController@create')->name('project.create');
Route::get('/portfolio/{project}/editar','ProjectController@edit')->name('project.edit');
Route::patch('/portfolio/{project}','ProjectController@update')->name('project.update');
Route::post('/portfolio','ProjectController@store')->name('projects.store');
Route::get('/portfolio/{project}','ProjectController@show')->name('projects.show');
Route::delete('portfolio/{project}', 'ProjectController@destroy')->name('project.destroy');
```
Listando las rutas por nombre se ve asi:
```console
C:\wamp64\www\intro_laravel>php artisan r:l --name=project
+--------+----------+----------------------------+-----------------+------------------------------------------------+------------+
| Domain | Method   | URI                        | Name            | Action                                         | Middleware |
+--------+----------+----------------------------+-----------------+------------------------------------------------+------------+
|        | GET|HEAD | portfolio                  | projects.index  | App\Http\Controllers\ProjectController@index   | web        |
|        | POST     | portfolio                  | projects.store  | App\Http\Controllers\ProjectController@store   | web        |
|        | GET|HEAD | portfolio/crear            | project.create  | App\Http\Controllers\ProjectController@create  | web        |
|        | PATCH    | portfolio/{project}        | project.update  | App\Http\Controllers\ProjectController@update  | web        |
|        | GET|HEAD | portfolio/{project}        | projects.show   | App\Http\Controllers\ProjectController@show    | web        |
|        | DELETE   | portfolio/{project}        | project.destroy | App\Http\Controllers\ProjectController@destroy | web        |
|        | GET|HEAD | portfolio/{project}/editar | project.edit    | App\Http\Controllers\ProjectController@edit    | web        |
+--------+----------+----------------------------+-----------------+------------------------------------------------+------------+
```
OK, como vemos en la **URI** *porfolio/* es igual en todos, de igual forma los parametros **{projetc}**, los controladores **ProjectController** y por último los nombres **project.** (En nuestro caso hay nombres que tienen una **S** al final vamos aquitarlo y dejarlo estandar, para eso tambien se tiene que modificar donde se hacen referencia a esta ruta, **nav.create,edit,show**).

Que todo este normalizado podemos utilizar **resource** para agrupar todo, de esta forma le decimos que la ruta es **portfolio** del controlador **ProjectController**.
```php
Route::resource('portfolio', 'ProjectController');
```
Hasta aqui si lo listamos filtrando por nombre **project** no nos va a arrojar nada.
```console
C:\wamp64\www\intro_laravel>php artisan r:l --name=project
Your application doesn't have any routes matching the given criteria.
```
Pero si lo filtramos por **portfolio** nos muestra las rutas, esto pasa por que toma como nombre de ruta el nombre que le estamos pasando en la **URI** y como vemos también en los parámetros toma el mismo nombre, si lo dejamos así va a fallar porque no son las variables que buscamos en la vista o en los controladores
```console
C:\wamp64\www\intro_laravel>php artisan r:l --name=portfolio
+--------+-----------+------------------------------+-------------------+------------------------------------------------+------------+
| Domain | Method    | URI                          | Name              | Action                                         | Middleware |
+--------+-----------+------------------------------+-------------------+------------------------------------------------+------------+
|        | GET|HEAD  | portfolio                    | portfolio.index   | App\Http\Controllers\ProjectController@index   | web        |
|        | POST      | portfolio                    | portfolio.store   | App\Http\Controllers\ProjectController@store   | web        |
|        | GET|HEAD  | portfolio/crear              | portfolio.create  | App\Http\Controllers\ProjectController@create  | web        |
|        | GET|HEAD  | portfolio/{portfolio}        | portfolio.show    | App\Http\Controllers\ProjectController@show    | web        |
|        | PUT|PATCH | portfolio/{portfolio}        | portfolio.update  | App\Http\Controllers\ProjectController@update  | web        |
|        | DELETE    | portfolio/{portfolio}        | portfolio.destroy | App\Http\Controllers\ProjectController@destroy | web        |
|        | GET|HEAD  | portfolio/{portfolio}/editar | portfolio.edit    | App\Http\Controllers\ProjectController@edit    | web        |
+--------+-----------+------------------------------+-------------------+------------------------------------------------+------------+
```
Para solucionar esto le decimos que como parámetro se cambia de **portfolio** a **project** y el nombre de las rutas va hacer **project**.
```php
Route::resource('portfolio', 'ProjectController')->parameters(['portfolio' => 'project'])->names('project');
```
Con esto listando nuevamente las rutas filtrandolo por el nombre **project** nos quedaria las rutas como cuando lo teniamos antes.
```console
C:\wamp64\www\intro_laravel>php artisan r:l --name=project
+--------+-----------+----------------------------+-----------------+------------------------------------------------+------------+
| Domain | Method    | URI                        | Name            | Action                                         | Middleware |
+--------+-----------+----------------------------+-----------------+------------------------------------------------+------------+
|        | GET|HEAD  | portfolio                  | project.index   | App\Http\Controllers\ProjectController@index   | web        |
|        | POST      | portfolio                  | project.store   | App\Http\Controllers\ProjectController@store   | web        |
|        | GET|HEAD  | portfolio/crear            | project.create  | App\Http\Controllers\ProjectController@create  | web        |
|        | GET|HEAD  | portfolio/{project}        | project.show    | App\Http\Controllers\ProjectController@show    | web        |
|        | PUT|PATCH | portfolio/{project}        | project.update  | App\Http\Controllers\ProjectController@update  | web        |
|        | DELETE    | portfolio/{project}        | project.destroy | App\Http\Controllers\ProjectController@destroy | web        |
|        | GET|HEAD  | portfolio/{project}/editar | project.edit    | App\Http\Controllers\ProjectController@edit    | web        |
+--------+-----------+----------------------------+-----------------+------------------------------------------------+------------+
```
***Nuevamente si llega a fallar es por que las rutas no coinciden y tenemos que verificar de que vista (archivo) se trata.***

Por último las rutas quedarian de la siguiente forma:
```php
<?php

Route::view('/','home')->name('inicio');
Route::view('/about','about')->name('acerca');

Route::resource('portfolio', 'ProjectController')->parameters(['portfolio' => 'project'])->names('project');

Route::view('/contact','contact')->name('contacto');
Route::post('contact','MessageController@store')->name('messages.store');
```
### Mensajes de sesión
Los mensajes de sesión son los que se muestra al realizar una acción, también conocidas como mensajes flash ya que desaparecen con la siguiente petición (al recargar).
La sesión es un tipo ede almacenamiento temporal donde guardamos información del usuario, soporta varios drivers y para verlo esta en **config/session.php** como esta en modo prueba las sesiones los esta guardando en un archivo, pero puede utilizar **BD, redis, array etc**.

Bien vamos a utilizarlo primero en el controlador de contacto, para que cuando enviemos un email nos rediriga en este caso al mismo formulario (**back()**) y nos muestre un mensaje, para mostrar el mensaje primero le damos un nombre de la variable y después el mensaje dentro del método **with**.
```php
class MessageController extends Controller{
   function store(Request $request){
      $message = request()->validate([....]);

   Mail::to('abel@gmail.com')->queue(New MessageReceived($message));

   return back()->with('status', 'Recibimos tu mensaje, te responderemos en 24 horas');

   }
}
```
Ahora para mostrar el mensaje tenemos que hacerlo en el formulario de contacto ya que con el método **back()** nos redirige alli, lo validamos en un if con el nombre de la variable que le dimos en este caso **status**.
```php
@section('content')
   <h1>contacto</h1>
   
   @if (session('status'))
       {{session('status')}}
   @endif

   @if ($errors->any())
      {{var_dump($errors->all())}}
   @endif
   <form action="{{route('messages.store')}}" method="POST">
      ....
   </form>
@endsection
```
Pero viendolo bien estos mensajes de errores lo vamos a utilizar en casi todas las vista, cuando registremos, actualicemos o eliminemos un registro y va hacer tedioso mostrar los mensajes en cada archivo, mejor el mensaje lo convertimos en un archivo parcial y lo incluimos de bajo del **nav** para que sea visible en todos los archivo.

creamos el archivo **partials/session-message**
```php
@if (session('status'))
    {{session('status')}}
@endif
```
Lo incluimos de bajo del **nav** que esta en el archivo **plantilla**.
```php
<body>
   @include('partials.nav')

   @include('partials.session-message')

   @yield('content')
</body>
```

Y con esto tendriamos los mensajes de acción a la vista de cualquier archivo.
Ahora vamos a ponerle mensaje de sesión de las demas acciones.
```php
public function store(SaveProyectRequest $request){
      Project::create($request->validated());
      return redirect()->route('project.index')->with('status', 'El proyecto fue creado con éxito');
   }
   public function edit(Project $project){ ... }

   public function update(Project $project, SaveProyectRequest $request){
      $project->update( $request->validated() );
      return redirect()->route('project.show', $project)->with('status', 'El proyecto fue actualizado con éxito');
   }

   public function destroy(Project $project){
      $project->delete();
      return redirect()->route('project.index')->with('status', 'El proyecto fue eliminado con éxito');
   }
}
```
### Login y Register
Con el comando **auth** laravel nos crea en el archivo de rutas **Auth::routes();** que internamente contiene los métodos: 
```
GET  /login     = Para mostrar el formulario del login
POST /login     = Donde se envía el formulario del login
POST /logout    = Para cerrar sesión
GET  /registrer = Para mostrar el formulario de registro
POST /registrer = Donde se envía el formulario de registro
```
Nos crea otras rutas para la contraseña pero por el momento no nos interesa, tambien nos crea unas vistas que vamos a verlos.
Ejecutamos el comando, como ya tenemos un archivo que se llama **home** nos pregunta queremos reemplazarlo, en nuestro caso vamos a decirle que no.
```console
C:\wamp64\www\intro_laravel>php artisan make:auth

 The [home.blade.php] view already exists. Do you want to replace it? (yes/no) [no]:
 > no

Authentication scaffolding generated successfully.
```
Ahora si nos vamos a la ruta **http://localhost:8000/register** e intentamos registrarnos (en mi caso ocurrio un error por que cuando hice las migraciones en el email le puse como longitud 6 caracteres, lo modifique y listo) nos va a regirigir a la vista home, ya que asi esta determinado en el archivo.

En el archivo de rutas esta asi:
```php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
```
Por el momento vamos a quira la ruta **home** por que ya tenemos uno, de igual forma eliminamos su controlador.
Nos vamos a **controller/auth/RegisterController.php** y modificamos esta linea **protected $redirectTo = '/home';** ya que es la que nos redirecciona despues de registrarse.
```php
protected $redirectTo = '/';
```
Lo mismo en el LoginController **protected $redirectTo = '/home';** ya que nos redirecciona al home despues de hacer login.
```php
protected $redirectTo = '/';
```
#### auth()->user()
Con el metodo **auth()** nos devuelve un objeto con los datos del usuario, vamos a poner el nombre nadamas en la vista home.
```php
@section('content')
    <h1>home</h1>
    {{auth()->user()->name}}
@endsection
```
Por el momento para cerrar sesión vamos a vaciar la carpeta **storage/framework/sessions** y cuando recargamos vemos que nos arroja un error por que estamos llamando a un objeto que no existe.

#### @auth
Vamos a utilizar esta directiva para que nos muestre el usuario solo si esta autenticado.
```php
@section('content')
    <h1>home</h1>
    @auth
        {{auth()->user()->name}}
    @endauth
@endsection
```
Ahora vamos a crear un link para que nos redirija al **login**, esto lo hacemos en el archivo nav.
```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
       <li> <a href="{{route('login')}}">Login</a> </li>
    </ul>
 </nav>
 ```
 Y si nos logeamos ya nos redirige a la raiz.
 Si nos damos cuenta sigue apareciendo la ruta **login** en el **nav** y si le damos click nos redirecciona al **home** para cambiar la ruta nos vamos a **app/http/Middleware/RedirectifAutenticated.php** y modificamos el return **return redirect('/home');**.
 ```php
if (Auth::guard($guard)->check()) {
   return redirect('/');
}
```
#### @guest
Como ya estamos autenticados no debe de aparecer la ruta **login** en el **nav**, para esto vamos a utilizar **@guest** que hace lo contrario al **@auth** por que solo se muestra si estamos como invitado (si no estamos logeados).
```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
       @guest
         <li> <a href="{{route('login')}}">Login</a> </li>
       @endguest
    </ul>
 </nav>
 ```
 Por último vamos a crear un boton para cerra sesión, vamos a copiarlo de **views/layouts/app.blade.php**, ya que hace la misma función primero nos copiamos el form.
 ```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
       @guest
         <li> <a href="{{route('login')}}">Login</a> </li>
       @endguest

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
      </form>
    </ul>
 </nav>
```
Después creamos nuestro botón y le añadimos javascrip para que se ejcute la acción del formulario al dar click, a parte de eso validamos que cuando no este como invitado (cuando no este logeado) que aparesca el link de **cerrar sesión** y esto se logra solamente dandole un **@else** al **@guest**.
```php
<nav>
    <ul>
       <li class="{{setActive('inicio')}}"><a href="{{route('inicio')}}">Home</a></li>
       <li class="{{setActive('acerca')}}"><a href="{{route('acerca')}}">About</a></li>
       <li class="{{setActive('project.*')}}"><a href="{{route('project.index')}}">Portafolio</a></li>
       <li class="{{setActive('contacto')}}"><a href="{{route('contacto')}}">Contacto</a></li>
       @guest
         <li> <a href="{{route('login')}}">Login</a> </li>
       @else
       <li> <a href="#" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
       @endguest

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
      </form>
    </ul>
 </nav>
 ```
Listo solo nos falta desabilitar la ruta **register** ya que si no todos van a poder registrarse, esto se hace en el archivo de rutas.
```php
Auth::routes(['register' => false]);
``` 
Y con esto cuando ingresemos a la ruta **http://localhost:8000/register** nos arrojara un error 404.

### Middlewares
Los middleares sirven para filtrar peticiones http, en este caso necesitamos que intercepte la petición de un usuario y verifique si esta autenticado para poder crear, eliminar, y editar proyectos.
Existen varias formas de inlcuir un midleware, podemos incluirlo directamente en la ruta.
```php
Route::resource('portfolio', 'ProjectController')
->parameters(['portfolio' => 'project'])->names('project')->middleware('auth');
```
Pero esta restringiria a todas las rutas aun que podemos definir las rutas que solo se quieren protejer, pero tambien lo podemos inluir en el constructor del controlador y definir los métodos a protejer.
```php
class ProjectController extends Controller{
   public function __construct(){
      $this->middleware('auth')->only('create','edit','destroy', 'update');
   }
}
```
O podemos declarar que métodos son los que no van a tener el middleware.
```php
public function __construct(){
   $this->middleware('auth')->except('index','show');
}
```
Con esto los que no esten autenticados podran acceder al listado y detalle de proyectos, pero como no pueden crear ni editar o eliminarlos mejor vamos a ocultar los botones cuando no esten autenticados.
en el archivo **index** validamos que el botón de **prear proyecto** se visualice solo si esta autenticado, para eso utilizamos la directiva **@auth** de blade.
```php
@section('content')
   <h1>Portafolio</h1>
      @auth
         <a href="{{route('project.create')}}">Nuevo proyecto</a>
      @endauth
      <br>
      @forelse ($proyectos as $proyecto)
      <li><a href="{{route('project.show',$proyecto)}}">{{$proyecto->title}}</a></li>
      @empty
         <li>No hay proyectos</li>
      @endforelse
      {{$proyectos->links()}}
@endsection
```
De igual forma para los botones de editar y eliminar que estan en el archivo **show**.
```php
@section('content')
    <h1>{{$project->title}}</h1>
    @auth
        <a href="{{route('project.edit',$project)}}">Editar</a>
        <form action="{{route('project.destroy',$project)}}" method="POST">
            @csrf @method('DELETE')
            <button>Eliminar</button>
        </form>
    @endauth
    <p>{{$project->description}}</p>
    <p>{{$project->created_at->diffForHumans()}}</p>
@endsection
```
Listo solo podran editar, eliminar y actualizar proyectos cuandso esten autenticados.

### Introducción a Laravel Mix
Como vimos laravel ya trae archivos **css** cargados, es por eso que cuando nos redirecciona al login tiene un diseño por default, los archivos de **css** y **js** estan en la carpeta **public/css/app.css** y **public/js/app.js** y en los 2 casos esta minificados para que pesen menos.
Para poder utilizar estos archivos lo debemos de incluir a nuestra plantila.
```php
<head>
   <title>@yield('title','default')</title>
   <link rel="stylesheet" href="/css/app.css">
   <style>
      .active a{
         color: red;
         text-decoration:none;
      }
   </style>
</head>
<body>
   ...
</body>
```
Si recargamos el navegador vemos que cambia de estilo por que en el css esta integrado boostrap 4, podemos hacer lo mismo con javascript y le agregamos **defer** para que se ejecute al final de la carga.
```php
<head>
   <title>@yield('title','default')</title>
   <link rel="stylesheet" href="/css/app.css">
   <script src="/js/app.js" defer></script>
   <style>
      .active a{
         color: red;
         text-decoration:none;
      }
   </style>
</head>
```
Ahora como ya tenemos un arhivo **css**  podemos agrear los estilos que tenemos en la plantilla (los que colorean los links) pero como estamos haciendo al archivo que esta minificado no es buena idea, ya que para minificarlo debe de existir un archivo de donde toma ese código para minificarlo y el archivo se encuentra en **resources/sass/app.scss**, aqui agregamos nuestro estilo.
```css
// Fonts
@import url('https://fonts.googleapis.com/css?family=Nunito');

// Variables
@import 'variables';

// Bootstrap
@import '~bootstrap/scss/bootstrap';

.active a{
    color: red;
    text-decoration:none;
 }
```
Pero si recargamos la página se pierden los cambios y esto pasa por que como estamos en el archivo fuente se tiene que compilar para que se guarde en el archivo minificado (ya que el archivo minificado es el que estamos haciendo referencia en nuestra plantilla).
Para compilarlo utilizamos Laravel Mix que nos proporciona una API fluida para definir los paso de compilación de Webpack de nuestra aplicación Laravel utilizando varios procesadores de CSS y JavaScript.
El archivo de webpack mix se llama **webpack.mix.js** y se encuentra en la raiz, en este archivo nos muestra el archivo con el código fuente y el archivo minificado.
```js
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
```
Bueno vamos a compilar para que tome los estilos que definimos en el archivo **app.scss** y para eso debemos tener instalado **node** (ya lo tengo) y con esto tenemos **npm** pero en esta ocación vamos a utilizar **yarn** vamos a instalarlo.
```console
C:\wamp64\www\intro_laravel>npm install -global yarn

> yarn@1.22.10 preinstall C:\Users\USUARIO\AppData\Roaming\npm\node_modules\yarn
> :; (node ./preinstall.js > /dev/null 2>&1 || true)

C:\Users\USUARIO\AppData\Roaming\npm\yarnpkg -> C:\Users\USUARIO\AppData\Roaming\npm\node_modules\yarn\bin\yarn.js
C:\Users\USUARIO\AppData\Roaming\npm\yarn -> C:\Users\USUARIO\AppData\Roaming\npm\node_modules\yarn\bin\yarn.js
+ yarn@1.22.10
added 1 package in 3.104s
```
Ahora vamos a instalar las dependencias de laravel  para el frond-end es decir las dependencias definidas en que esta en el **package.json**
```json
"devDependencies": {
        "axios": "^0.19",
        "bootstrap": "^4.1.0",
        "cross-env": "^5.1",
        "jquery": "^3.2",
        "laravel-mix": "^4.0.7",
        "lodash": "^4.17.13",
        "popper.js": "^1.12",
        "resolve-url-loader": "^2.3.1",
        "sass": "^1.15.2",
        "sass-loader": "^7.1.0",
        "vue": "^2.5.17"
    }
```
Esto se hace con el siguiente comado
```console
C:\wamp64\www\intro_laravel>yarn
yarn install v1.22.10
info No lockfile found.
[1/4] Resolving packages...
```
Vemos que nos crea una nueva carpeta llamada **node_modules** aqui es donde se van a guardar todas las dependencias.
Ahora si vamos a compilar.
```console
C:\wamp64\www\intro_laravel>yarn dev
yarn run v1.22.10
$ npm run development

> @ development C:\wamp64\www\intro_laravel
```
Si recargamos ya podemos ver los cambios, si aun no toma los estilos podemos hacer lo siguiente **crtl + shift + R** para vaciar el cahé del navegador.

#### Importante
Al ejecutar el comando **npm install** me genero un error de **yargs**  y esto era por que debe de estar instalado la ultima versión asi que segui estos pasos.
```
El problema principal es que el yargs-parserpaquete contiene una vulnerabilidad y la versión posterior no, pero el yargspaquete aún requiere la versión anterior, por lo que para este error básicamente podemos resolverlo forzando yargsa usar la última versión de la yargs-parserque es en el 18.1.3lugar de 18.1.2.

así que primero puede agregar estas líneas a su package.jsonarchivo.

Agregue esta línea a su scriptssección
"preinstall": "npx npm-force-resolutions"
como se muestra aquí:
imagen
Agregue una nueva clave a su package.jsonarchivo llamado resolutionsy agregue una nueva línea con la versión apropiada de yargs-parser
"resolutions": { "yargs-parser": "^18.1.3" }
como se muestra aquí:
imagen
Ejecutar el npm install yargs-parser --save-dev && npm update && npm install
y voilà, está establecido para usar laravel-mix nuevamente como estaba previsto.
```
Y listo con esto solucione el problema, otra cosa a mi el comando **yarn dev** no me funcionó y lo sustitui por **npm dev**.

Ahora para no tener todo amontonado en el archivo **app.js** hice otro archivo **resources/sass/style.scss** y aqui ingrese el estilo de colorear los links cuando esten activos.
```css
/* archivo style.scss */
.active a {
    color: red;
    text-decoration: none;
}
```
y en el archivo **resources/sass/app.scss** lo importe.
```css
// Fonts
@import url('https://fonts.googleapis.com/css?family=Nunito');
// Variables
@import 'variables';
// Bootstrap
@import '~bootstrap/scss/bootstrap';
@import 'style.scss';
```
y volvi a correr **npm dev**.

De igual forma con los archivos js, hice un archivo **resources/js/script.js** y por el momento solo le puse un alert.
```javascript
alert('hola mundo');
```
y lo inclui en el archivo **resources/js/app.js**
```javascript
require('./bootstrap');
require('./script')
```
Nuevamente corremos el comando **npm dev** y si recargamos la página vemos el alert.

Pero estar corriendo el mismo comando cada ves que hay un cambio es fastidioso, para eso tenemos el comando.
```console
> @ development C:\wamp64\www\intro_laravel
> cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js "--watch"
```

Y son esto nos va a compilar automaticamnete cada cuando tengamos un cambio.

Existe una forma de que los cambios se refleje automáticamente sin recargar la pagina y eso se logra incluyendo este código en **webpack.mix.js**
```javascript
mix.browserSync('http://localhost:8000');
```
Después se tiene  que ejecutar  **watch**, esto hara que se ejecute la linea que acabamos de agregar e instalará la dependencia.
```console
C:\wamp64\www\intro_laravel>npm run watch

> @ watch C:\wamp64\www\intro_laravel
> npm run development -- --watch


> @ development C:\wamp64\www\intro_laravel
> cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js "--watch"

        Additional dependencies must be installed. This will only take a moment.

        Running: npm install browser-sync browser-sync-webpack-plugin@2.0.1 --save-dev --production=false
```
Y nuevamente corremos el **watch** para que inicie y podemos ver que al realizar un cambio la pagina se recarga solo de igual forma nos abre una nueva pestaña en un puerto 3000.

Bien en el archivo **public/css/app.css** aún no estan minificado y esto por que no estamos en producción, si ya lo vamos a pasar a produción ejecutamos el comando.
```console
npm run prod
```
Y asi los archivos estan listos para producción.

Ahora existe un problema, por que cada cuando implementamos este comando internamente se le da un nombre diferente al archivo **public/css/app.css** esto por que laravel asume que es el mismo archivo y lo guarda en caché, y entonces cada cuando realicemos la minificación debemos de cambiar el nombre en el link de la plantilla.

Pero hay una forma de solucionarlo, en el archivo **webpack.mix.js** preguntamos si estamos en producción.
```javascript
if(mix.inProduction()){
    mix.version();
}
```
Y ya solo en nuestra plantilla utilizamos la referencia mix para llamar al archivo.
```php
<head>
   <title>@yield('title','default')</title>
   <link rel="stylesheet" href="{{mix('css/app.css')}}">
   <script src="{{mix('js/app.js)'}}" defer></script>
</head>
```
Volvemos a correr **npm run prod**
```console
C:\wamp64\www\intro_laravel>npm run prod

> @ prod C:\wamp64\www\intro_laravel
> npm run production


> @ production C:\wamp64\www\intro_laravel
> cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --no-progress --hide-modules --config=node_modules/laravel-mix/setup/webpack.config.js



 DONE  Compiled successfully in 62583ms                           21:24:25

       Asset     Size  Chunks                    Chunk Names
/css/app.css  143 KiB       0  [emitted]         /js/app
  /js/app.js  352 KiB       0  [emitted]  [big]  /js/app
```

Si inspeccionamos la página vemos que el archivo que estamos llamado cambia de es **app** mas **serie de carácteres** y con esto tenemos sincronizado las minificaciones.

### Diseño con Bootstrap
Se quito el boostrap que tenia y se instralo uno mas reciente.

```console
C:\wamp64\www\intro_laravel>npm remove bootstrap
[..................] / rollbackFailedOptional: verb npm-session 2df7994296bf4d14
```
```console
C:\wamp64\www\intro_laravel>npm install bootstrap@4.3.* --dev
npm WARN install Usage of the `--dev` option is deprecated. Use `--only=dev` instead.
npm WARN browser-sync-webpack-plugin@2.0.1 requires a peer of webpack@^1 || ^2 || ^3 but none is in
```

#### plantilla
Se puso la escala y el csrf (que no se utiliza pero se puso para que no generara errores en la consola)
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
```
Se creo un div para encerrar al header, main, y footer.
```php
<div id="app" class="d-flex flex-column h-screen justify-content-between"></div>
```
```php
<header>
   @include('partials.nav')
   @include('partials.session-message')
</header>

<main>
   @yield('content')
</main>

<footer class="bg-white text-black-50 text-center py-3 shadow">
   {{config('app.name')}} | Copyright @ {{date('Y')}}
</footer>
```
#### nav
Se le puso las siguientes clase al nav
```php
<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
```
En un container se copio el boton toggle de layout.app que viene por defecto en laravel.
```php
<a class="navbar-brand*" href="{{route('home')}}"> {{config('app.name')}}</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
   <span class="navbar-toggler-icon"></span>
</button>
```

La lista desordenada se guardo en un div con el  id que especifica el boton.
```php
<div class="collapse navbar-collapse" id="navbarSupportedContent">
```

Se le agregaron estas clases a los elementos.
```php
<ul class="nav nav-pills">
<li class="nav-item ">
   <a class="nav-link {{setActive('inicio')}}" href="{{route('inicio')}}">Home</a>
</li>
</ul>
```

#### contacto
Se le agregaron estos divs y estas clases al formulario de contacto
```php
<div class="container">
   <div class="row">
      <div class="col-12 col-sm-10 col-lg-10 mx-auto">
         <form class="bg-white shadow rounded py-3 px-4" action="{{route('messages.store')}}" method="POST">
         </form>
      </div>
   </div>
</div>
```
Y a todos los inputs se le modifico de esta manera.
```php
<div class="form-group">
   <label for="name">Nombre</label>
   <input class="form-control bg-light shadow-sm
   @error('nombre') is-invalid @else border-0 @enderror" 
   type="text" name="nombre" id="name" placeholder="nombre">
   @error('nombre')
         <span class="invalid-feedback" role="alert">
            <strong>{{$message}}</strong>
         </span>
   @enderror
</div>
```

A todas las vistas donde extiende de **layout.app** se le cambio por.
```php
@extends('plantilla')
```
### Terminado diseño bootstrap 
Hubieron muchos cambios de diseño solo voy a mencionar algunos que fueron relevantes.

Esto se le agrega en **_variables.scss** para que los titulos se ajusten dependiendo del tamaño de la pantalla
```css
$enable-responsive-font-sizes:true;
```
```html
<h1 class="display-4">Nuevo proyecto</h1>
```
Podemos también habilitar para que los botones sead degradientes (no se nota mucho).
```css
$enable-gradients:true;
```