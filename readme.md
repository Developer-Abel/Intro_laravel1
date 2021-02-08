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