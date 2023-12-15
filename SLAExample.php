<?php

class SLAExample
{
    private $id;
    private $projectRepo;
    private $subProjects;
    private $requestedProjects;

    private $result;

    public function __construct($id, $requestedProjects, $projectRepo)
    {
        $this->id = $id;
        $this->requestedProjects = $requestedProjects;
        $this->projectRepo = $projectRepo;
    }

    public function before()
    {
        $subProjects = $this->projectRepo->getSubprojectIds($this->id);
        array_unshift($subProjects, $this->id);
        if (count(array_diff($subProjects, $this->requestedProjects))) {
            return $this->doSomething($subProjects);
        }
    }

    private function doSomething($subProjects)
    {
        return 'foo';
    }

    public function readable()
    {
        $this->getSubprojects();
        if ($this->subprojectsDiffersFromRequestedProjects()) {
            $this->doSomethingEmbeded();
        }

        return $this->result;
    }

    private function getSubprojects()
    {
        $this->getSubprojectsFromRepo();
        $this->addCurrentProjectToStartOfSubprojects();
    }

    private function getSubprojectsFromRepo()
    {
        $this->subProjects = $this->projectRepo->getSubprojects($this->id);
    }

    private function addCurrentProjectToStartOfSubprojects()
    {
        array_unshift($this->subProjects, $this->id);
    }

    private function subprojectsDiffersFromRequestedProjects()
    {
        return count(array_diff($this->subProjects, $this->requestedProjects));
    }

    private function doSomethingEmbeded()
    {
        $this->result = 'foo';
    }
}
