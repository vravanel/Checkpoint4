<?php

namespace App\DataFixtures;

use App\Entity\Horse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class HorseFixtures extends Fixture
{
    public const HORSES = [
        ['name' => 'Bella', 'breed' => 'Quarter Horse', 'personality' => 'Calme, patiente et attentionnée',
            'skill' => 'Excellente capacité à créer un environnement apaisant pour les patients anxieux',
            'img' => 'horse-bella.jpg' ],
        ['name' => 'Orion', 'breed' => 'Frison', 'personality' => 'Énergique, enthousiaste et joueur',
            'skill' => 'Capable d\'encourager les patients à sortir de leur zone de confort et à s\'engager activement 
            dans les activités', 'img' => 'horse-orion.jpg' ],
        ['name' => 'Luna', 'breed' => 'Appaloosa', 'personality' => 'Douce, patiente et bienveillante',
            'skill' => 'Capacité à établir un lien de confiance profond avec les patients ayant des antécédents de 
            traumatismes', 'img' => 'palomino-luna.jpg' ],
        ['name' => 'Max', 'breed' => 'Warmblood', 'personality' => 'Confiant, curieux et adaptable',
            'skill' => 'Aptitude à s\'adapter à différents niveaux de compétence des patients et à créer un 
            environnement stimulant pour leur développement', 'img' => 'quarter-horse.jpg' ],
        ['name' => 'Stella', 'breed' => 'Haflinger', 'personality' => 'Douce, sensible et réceptive',
            'skill' => 'Capacité à comprendre intuitivement les besoins émotionnels des patients et à les aider à 
            développer la confiance en soi', 'img' => 'horse-Stella.jpg' ],
        ['name' => 'Apollo', 'breed' => 'Pur-sang', 'personality' => 'Calme, confiant et fiable',
            'skill' => 'Capacité à fournir un soutien émotionnel stable et prévisible pour les patients ayant des 
            troubles de l\'anxiété', 'img' => 'appaloosa.jpg' ],
    ];
    public function __construct(private ParameterBagInterface $parameterBag)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $uploadImageDir = $this->parameterBag->get('image_dir');
        if (!is_dir(__DIR__ . '/../../public' . $uploadImageDir)) {
            mkdir(__DIR__ . '/../../public' . $uploadImageDir, recursive: true);
        }

        foreach (self::HORSES as $horseData) {
            copy(
                __DIR__ . '/data/images/' . $horseData['img'],
                __DIR__ . '/../../public' . $uploadImageDir . '/' . $horseData['img']
            );
            $horse = new Horse();
            $horse->setName($horseData['name']);
            $horse->setBreed($horseData['breed']);
            $horse->setPersonality($horseData['personality']);
            $horse->setSkill($horseData['skill']);
            $horse->setImage($horseData['img']);
            $manager->persist($horse);

        }



        $manager->flush();
    }
}
