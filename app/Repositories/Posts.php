<?php

namespace App\Repositories;
use GuzzleHttp\Client;
use App\Repositories\Users;

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
