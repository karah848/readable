<?php

class Details
{
    private $id;
    private $repo;
    private $subProjects;
    private $bar;

    private $result;

    public function __construct($id, $requestedProjects, $projectRepo)
    {
        $this->id = $id;
        $this->bar = $requestedProjects;
        $this->repo = $projectRepo;
    }

    public function before()
    {
        $foo = $this->repo->getFoo($this->id);
        if (count(array_diff($foo, $this->bar))) {
            return $this->doSomething();
        }
    }

    public function readable()
    {
        $this->getSubprojects();
        if ($this->fooDiffersFromBar()) {
            $this->doSomething();
        }

        return $this->result;
    }


    private function doSomething()
    {
        return 'foo';
    }

    private function getSubprojects()
    {
        $this->getSubprojectsFromRepo();
        $this->addCurrentProjectToStartOfSubprojects();
    }

    private function getSubprojectsFromRepo()
    {
        $this->subProjects = $this->repo->getSubprojects($this->id);
    }

    private function addCurrentProjectToStartOfSubprojects()
    {
        array_unshift($this->subProjects, $this->id);
    }

    private function fooDiffersFromBar()
    {
        return count(array_diff($this->subProjects, $this->bar));
    }

    private function doSomethingEmbeded()
    {
        $this->result = 'foo';
    }
}
