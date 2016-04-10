<?php

namespace App\Repositories;

trait HasRepositories
{
    /**
     * Repositories
     * @var array
     */
    protected $_repos;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setRepositories($this->repos);
    }

    /**
     * Attach repositories
     * @return array
     */
    public function setRepositories(array $repos = [])
    {
        // determine repos
        $repos = empty($repos) ? $this->repos : $repos;

        // set repos
        $this->_repos = [];

        // instantiate repositories
        foreach ($repos as $repo)
        {
            $this->_repos[] = new $repo;
        }
    }

    /**
     * Get attached repositories
     * @return array
     */
    public function getRepositories()
    {
        return $this->_repos;
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        $instance = new static;

        foreach ($instance->_repos as $repo)
        {
            if (method_exists($repo, $method))
            {
                return call_user_func_array([$repo, $method], $parameters);
            }
        }

        return call_user_func_array([$instance, $method], $parameters);
    }
}