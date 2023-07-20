<?php

namespace App\DataFixtures;

use App\Entity\Appointment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppointmentFixtures extends Fixture implements DependentFixtureInterface
{
    public const APPOINTMENTS = [
        ['limit' => 4, 'user' => ['Brian', 'Alexandre'], 'date' => '2023-07-28 14:10:00', ],
        ['limit' => 2, 'user' => ['Brian', 'Alexandre'], 'date' => '2023-07-31 14:30:00', ],
        ['limit' => 3, 'user' => ['Brian', 'Alexandre', 'Arthur'], 'date' => '2023-07-25 11:30:00', ],
        ['limit' => 2, 'user' => ['Arthur', 'Alexandre'], 'date' => '2023-07-26 13:30:00', ],
        ['limit' => 2, 'user' => ['Brian', 'Arthur'], 'date' => '2023-07-21 19:30:00', ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach(self::APPOINTMENTS as $appointmentData) {
            $appointment = new Appointment();
            $appointment->setDate(new \DateTime($appointmentData['date']));
            $appointment->setNbUser($appointmentData['limit']);
            foreach($appointmentData['user'] as $appointmentUser) {
                $appointment->addUser($this->getReference('user_' . $appointmentUser));
            }
            $manager->persist($appointment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
