<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## JSON API - {JSON} Placeholde & Laravel

Free fake API for testing and prototyping.

*Conexión de API Placeholde & Laravel:*

Se debe agregar la siguiente variable de entorno al archivo .env:

`Código`

``` [language]
API_ENDPOINT=https://jsonplaceholder.typicode.com
```
 La conexión se registra en el archivo `Ruta:` ``` App/Providers/AppServiceProvider``` para que Laravel inicie el registro por nosotros de la siguiente manera, usando la extensión que nos provee *Laravel* como Guz*zle V7* que actualmente ya viene incluida en el archivo *composer.json ("guzzlehttp/guzzle": "^7.0.1")*:

`Código`

``` [language]
public function register()
    {
        $this->app->singleton('GuzzleHttp\Client', function(){
            return new Client([
                'base_uri' => env('API_ENDPOINT'),
            ]);
        });
    }
```

Luego de que la conexión es exitosa, se genera la Clase `Ruta:` ``` App/Repositories/Posts``` donde a través de funciones se generan las solicitudes de los Metodos (GET, POST, PUT, DELETE) hacia las diferentes URLs:

`Código`

``` [language]
class Posts {

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all(){

        return $this->getMethod('GET','posts');
    }

    public function find($id)
    {
        return $this->getMethod('GET', "posts/{$id}");
    }

    public function delete($id)
    {
        $response = $this->client->request("DELETE", "posts/{$id}");
        return $response->getBody()->getContents();
    }

    public function create($post)
    {
        $response = $this->client->request("POST", "posts",[
            'json'=> [
                'title' => $post->title,
                'body'  => $post->body,
                'userId'=>1
            ]
        ]);

        return $response->getBody()->getContents();
    }

    public  function update($post, $id)
    {
        $response = $this->client->request("PUT","posts/{$id}", [
            'json'=>[
                'title' => $post->title,
                'body'  => $post->body,
            ]
        ]);
        return $response->getBody()->getContents();
    }

    public function getMethod($method,$url)
    {
        $response = $this->client->request($method, $url);

        return json_decode($response->getBody()->getContents());
    }

}
```

Al tener la estructura de conexión y las diferentes solicitudes que permite el API se procede generando el Controlador para dar el manejo entre las Vistas y el API (Recordemos que Laravel es un Framework MVC - Modelo, Vista, Controlador) se usa un  controlador Resource para que nos generen acutomaticmante los siguientes metodos (index, create, show, edit, update, store, destroy) y así poder redireccionar a las diferentes vistas creadas:

`Código`

``` [language]
class PostsController extends Controller
{
    protected $posts;

    public function __construct(PostsRepositories $posts)
    {
         $this->posts = $posts;
    }

    public function index()
    {
        $posts = $this->posts->all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequests $request)
    {

        $post = $this->posts->create($request);

        return view('posts.store', compact('post'));
    }

    public function show($id)
    {
        $post = $this->posts->find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = $this->posts->find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequests $request, $id)
    {
        $post=$this->posts->update($request, $id);

        return view('posts.update', compact('post'));
    }

    public function destroy($id)
    {
        $post = $this->posts->delete($id);

        return view('posts.delete', compact('post'));
    }
}
```
Dentro del la lógica del controlador encontramos un *__construct* con el fin de instanciar la clase *PostsRepositories = Posts*  y de esta forma acceder a través de $this a las diferentes propiedades generadas en la clase Posts *(- all(), find(), delete(), update() - )* y no sobrecargar el archivo PostsController ya que solo se encarga de mediar entre la vista y el modelo, para nuestro caso vista y el api. Dentro del controlador contamos con la variable $posts la cual retorna a la vista con las diferentes respuestas:

Para el tema de las vistas se usa BLADE para tener un mejor manejo del código y reutilizar al máximo lo que se necesite en cada plantilla y contamos con la siguiente estructura:


`Código`

``` [language]
->views
-->layout
-->welcome
---->posts
------>create
------>delete
------>edit
------>show
------>index
------>store
------>update
```

Debido a que se esta manejando un API gratuita y no permite la adición de datos o modificación de datos sobre su BD se muestra la operación ejecutada en las siguientes vistas *delete - update - store* con el fin de evidenciar el proceso o la respuesta Fake por parte del API.
