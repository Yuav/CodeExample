<?php
namespace CodeExample\ModelGenerator;

use CodeExample\Model\Citizen;

class CitizenGenerator
{
    /**
     *
     * @return \CodeExample\Model\Citizen
     */
    public function generateCitizen()
    {
        // FIXME - use randomized data from seed files
        $c = new Citizen();
        $c->setAddress('adsf');
        $c->setAge(12);
        $c->setFname('asdf');
        $c->setLname('adsf');
        $c->setMobile('9124122');
        return $c;
    }
}
