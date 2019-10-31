<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    Symfony\Bundle\TwigBundle\TwigBundle::class => ['all' => true],
    Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle::class => ['all' => true],
    Symfony\Bundle\SecurityBundle\SecurityBundle::class => ['all' => true],
    Symfony\Bundle\WebProfilerBundle\WebProfilerBundle::class => ['dev' => true, 'test' => true],
    Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle::class => ['all' => true],
    Liip\ImagineBundle\LiipImagineBundle::class => ['all' => true],
    Oneup\FlysystemBundle\OneupFlysystemBundle::class => ['all' => true],
    Symfony\Bundle\MonologBundle\MonologBundle::class => ['all' => true],
    Doctrine\Bundle\DoctrineBundle\DoctrineBundle::class => ['all' => true],
    Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle::class => ['all' => true],
    Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle::class => ['dev' => true, 'test' => true],
    Bazookas\AdminBundle\BazookasAdminBundle::class => ['all' => true],
    Bazookas\CommonBundle\BazookasCommonBundle::class => ['all' => true],
    //    Bazookas\MediaBundle\BazookasMediaBundle::class => ['all' => true],
    //    Bazookas\CronBundle\BazookasCronBundle::class => ['all' => true],
    //    Bazookas\APIFrameworkBundle\BazookasAPIFrameworkBundle::class => ['all' => true],
];