<?php

namespace App\Command;

use App\Repository\MovieRepository;
use App\Repository\SeriesRepository;
use App\Repository\VideoGameRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
name: 'app:print-entertainment-media',
description: 'Lists Movies, Series, and Video Games based on criteria.',
)]

class PrintEntertainmentMediaCommand extends Command
{

    //konstruktor
    private $movieRepository;
    private $seriesRepository;
    private $videoGameRepository;

    public function __construct(
        MovieRepository $movieRepository,
        SeriesRepository $seriesRepository,
        VideoGameRepository $videoGameRepository
    ) {
        parent::__construct();
        $this->movieRepository = $movieRepository;
        $this->seriesRepository = $seriesRepository;
        $this->videoGameRepository = $videoGameRepository;
    }

    protected function configure(): void
    {
        $this
            // A --help szövegben jelennek meg ezek az információk
            ->addOption(
                'type',
                null,
                InputOption::VALUE_OPTIONAL,
                'The type of media to list (movie, series, or videogame)'
            )
            ->addOption(
                'title',
                null,
                InputOption::VALUE_OPTIONAL,
                'The title to search for'
            )
        ;
    }

    // ... execute metódus
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // 1. Opciók kiolvasása
        $type = $input->getOption('type');
        $title = $input->getOption('title');

        $results = [];

        // 2. Logika a feltételek alapján
        if ($type) {
            // Ha a type meg van adva, csak abban a típusban keresünk
            switch (strtolower($type)) {
                case 'movie':
                    // A feltételezés az, hogy a repository-ban van egy `findByTitle` metódusod,
                    // ami kezeli, ha a $title null (ekkor mindent visszaad).
                    $results = $this->movieRepository->findByTitle($title);
                    break;
                case 'series':
                    $results = $this->seriesRepository->findByTitle($title);
                    break;
                case 'videogame':
                    $results = $this->videoGameRepository->findByTitle($title);
                    break;
                default:
                    $io->error(sprintf('Invalid type "%s". Available types are: movie, series, videogame.', $type));
                    return Command::INVALID;
            }
        } else {
            // Ha a type nincs megadva, mindenhol keresünk
            $movies = $this->movieRepository->findByTitle($title);
            $series = $this->seriesRepository->findByTitle($title);
            $videoGames = $this->videoGameRepository->findByTitle($title);

            // Összefűzzük az eredményeket
            $results = array_merge($movies, $series, $videoGames);
        }

        // 3. Eredmények megjelenítése
        if (empty($results)) {
            $io->warning('No entertainment media found matching your criteria.');
            return Command::SUCCESS;
        }

        $tableRows = [];
        foreach ($results as $item) {
            $itemType = 'Unknown';
            if ($item instanceof \App\Entity\Movie) {
                $itemType = 'Movie';
            } elseif ($item instanceof \App\Entity\Series) {
                $itemType = 'Series';
            } elseif ($item instanceof \App\Entity\VideoGame) {
                $itemType = 'VideoGame';
            }

            $tableRows[] = [$itemType, $item->getTitle()];
        }

        $io->table(
            ['Type', 'Title'],
            $tableRows
        );

        $io->success('Command finished successfully!');

        return Command::SUCCESS;
    }
}