<?php

namespace App\Classes\Api;

use App\Classes\Api\Interfaces\RepositoryInterface;
use GuzzleHttp\ClientInterface;

abstract class Repository implements RepositoryInterface
{
    /**
     * HTTP client.
     *
     * @var object
     */
    protected $client;

    /**
     * Model associated with the class.
     *
     * @var string
     */
    protected $model;

    /**
     * Default page number.
     *
     * @var int
     */
    protected $page = 1;

    /**
     * Default posts per page amount.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * RestApiClient constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->setClient($client);
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param mixed $perPage
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Cast JSON to array.
     *
     * @param string $json
     * @return mixed
     */
    protected function toArray(string $json)
    {
        return json_decode($json, true);
    }

    /**
     * Get base API URL.
     *
     * @return mixed
     */
    public function getBaseUrl()
    {
        return env('API_PLACEHOLDER_BASE_URL') . $this->getModel();
    }

    /**
     * Get the post.
     *
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->getClient()->get($this->getModel() . '/' . $id);
        $responseJson = $response->getBody()->getContents();

        return $this->toArray($responseJson);
    }

    /**
     * Get all of the posts from the Api.
     *
     * @param array $data
     * @return array
     */
    public function all(array $data)
    {
        // Query settings
        $data['_page'] = $data['_page'] ?? $this->getPage();
        $data['_limit'] = $data['_limit'] ?? $this->getPerPage();

        $response = $this->getClient()->get($this->getModel(), ['query' => $data]);
        $responseJson = $response->getBody()->getContents();

        return [
            'data' => $this->toArray($responseJson),
            'total' => $response->getHeader('X-Total-Count')[0],
        ];
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $response = $this->getClient()->post($this->getModel(), [
            'form_params' => $data,
        ]);
        $responseJson = $response->getBody()->getContents();

        return $this->toArray($responseJson);
    }

    /**
     * Update the post.
     *
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $response = $this->getClient()->put($this->getModel() . '/' . $id, [
            'form_params' => $data,
        ]);
        $responseJson = $response->getBody()->getContents();

        return $this->toArray($responseJson);
    }

    /**
     * Delete the post.
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $response = $this->getClient()->delete($this->getModel() . '/' . $id);
        $responseJson = $response->getBody()->getContents();

        return $this->toArray($responseJson);
    }
}