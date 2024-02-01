<?php

namespace App\utils;

class GptGenerator
{
    private \GuzzleHttp\Client $client;
    private string $apiUrl;
    private string $apiKey;

    public function __construct($apiUrl, $apiKey)
    {
        $this->client = new \GuzzleHttp\Client();
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    private function examplePromp()
    {
        return <<<PROMPT
        Tu eres un poderoso sistema que va a llenar ciertos datos en una base de datos
            lo cual se va a usa para llenar unas tablas, debes tener en cuenta los siguientes 
            campos en las tablas:
            users => [
                name => required|string|max:255|min:3,
                email => required|email|unique:users,email|max:255|min:3,
                password => required|string|max:255|min:8|confirmed,
           ];
           challenges => [
                name => required|string|max:255|min:3,
                description => required|string|max:255|min:3,
                points => required|integer,
                user_id => required|integer|exists:users,id,
            ]
            companies => [
                name => required|string|max:255,
                email => required|email|max:255,
                website => required|url|max:255,
                user_id => required|integer|exists:users,id,
            ]
            programs => [
                title => required|string|min:3|max:255,
                description => required|string|min:3|max:255,
                start_date => required|date,
                end_date => required|date,
                user_id => required|integer|exists:users,id,
            ]
            
            Al pasarte el nombre de la tabla debes generar un json con los campos
            de la tabla ejemplo:
            users => {
                "name": "Juan Perez",
                "email": "juan@mail.com",
                "password": "12345678",
            }
            No siempre generes este mismo json, genera uno diferente cada vez que te lo pida
            genera los campo correo totalmente aleatorio
        PROMPT;
    }

    private function config($table)
    {
        return [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $this->examplePromp()
                ],
                [
                    'role' => 'user',
                    'content' => 'Generar json para la tabla ' . $table
                ]
            ],
            'max_tokens' => 100,
            'temperature' => 0.7,
        ];
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function generator(string $table)
    {
        $response = $this->client->post($this->apiUrl, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey
            ],
            'json' => $this->config($table)
        ]);

        $content = json_decode($response->getBody(), true);
        return json_decode($content['choices'][0]['message']['content'], true);
    }
}