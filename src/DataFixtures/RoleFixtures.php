<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixtures extends Fixture
{
    const ROLES = [
        [
            'name' => 'ROLE_USER',
            'description' => 'Animateur',
            'hierarchy' => 0,
        ],
        [
            'name' => 'ROLE_ADMIN',
            'description' => 'Administrateur',
            'hierarchy' => 1,
        ],
        [
            'name' => 'ROLE_SUPERADMIN',
            'description' => 'Super administrateur',
            'hierarchy' => 2,
        ],
    ];

    public function load(ObjectManager $manager)
    {
        for ($nRole = 0; $nRole < count(self::ROLES); $nRole++) {
            $role = new Role();
            $role->setName(self::ROLES[$nRole]["name"]);
            $role->setDescription(self::ROLES[$nRole]["description"]);
            $role->setHierarchy(self::ROLES[$nRole]["hierarchy"]);
            $this->addReference('role' . $nRole, $role);
            $manager->persist($role);
        }
        $manager->flush();
    }
}
