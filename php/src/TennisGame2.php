<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $P1point = 0; // On pourrait renommer cette variable en $player1Points pour plus de clarté.
    private int $P2point = 0; // Pareil ici, utiliser $player2Points serait plus explicite.
    private string $P1res = ''; // Renommer en $player1Result serait plus clair.
    private string $P2res = ''; // Et ici en $player2Result pour rester cohérent.

    public function __construct(
        private string $player1Name, // Bien joué pour l'utilisation des propriétés promues ici.
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        $score = '';
        // Ce bloc est répétitif, on pourrait penser à une fonction privée pour le simplifier.
        if ($this->P1point === $this->P2point && $this->P1point < 4) {
            if ($this->P1point === 0) {
                $score = 'Love';
            }
            if ($this->P1point === 1) {
                $score = 'Fifteen';
            }
            if ($this->P1point === 2) {
                $score = 'Thirty';
            }
            $score .= '-All';
        }

        // On pourrait factoriser ce type de structure répétitive avec une fonction.
        if ($this->P1point === $this->P2point && $this->P1point >= 3) {
            $score = 'Deuce';
        }

        // Ce bloc est assez complexe et répétitif. On pourrait le refaire pour améliorer la lisibilité.
        if ($this->P1point > 0 && $this->P2point === 0) {
            if ($this->P1point === 1) {
                $this->P1res = 'Fifteen';
            }
            if ($this->P1point === 2) {
                $this->P1res = 'Thirty';
            }
            if ($this->P1point === 3) {
                $this->P1res = 'Forty';
            }

            $this->P2res = 'Love';
            $score = "{$this->P1res}-{$this->P2res}";
        }

        // Encore une fois, répétition du code. Une méthode dédiée serait une bonne idée pour éviter ça.
        // On continue avec des commentaires similaires...

        // Les conditions sont détaillées pour chaque point, ce qui rend le code long et complexe.
        // On pourrait utiliser un tableau associatif pour les correspondances de score, ça serait plus efficace.
        if ($this->P1point >= 4 && $this->P2point >= 0 && ($this->P1point - $this->P2point) >= 2) {
            $score = 'Win for player1';
        }

        if ($this->P2point >= 4 && $this->P1point >= 0 && ($this->P2point - $this->P1point) >= 2) {
            $score = 'Win for player2';
        }

        return $score;
    }

    public function wonPoint(string $player): void
    {
        // Ici, on pourrait simplifier la logique avec un opérateur ternaire ou en externalisant dans une méthode privée.
        if ($player === 'player1') {
            $this->P1Score();
        } else {
            $this->P2Score();
        }
    }

    private function SetP1Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P1Score();
        }
    }

    private function SetP2Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P2Score();
        }
    }

    private function P1Score(): void
    {
        $this->P1point++; // On pourrait combiner ceci avec P2Score en passant un paramètre supplémentaire.
    }

    private function P2Score(): void
    {
        $this->P2point++;
    }
}
