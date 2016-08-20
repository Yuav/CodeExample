<?php
namespace CodeExample\ModelGenerator;

use CodeExample\Model\Project;

class ProjectGenerator
{
    /**
     *
     * @return \CodeExample\Model\Project
     */
    public function generateProject()
    {
        // FIXME - use randomized data from seed files
        $c = new Project();
        $c->setAmount(123.123);
        $c->setDateEnd(new \DateTime());
        $c->setDateStart(new \DateTime());
        $c->setDescription('asdf');
        $c->setProjID('asdf');
        return $c;
    }
}
