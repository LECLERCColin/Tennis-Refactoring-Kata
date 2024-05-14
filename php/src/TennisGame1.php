<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    private int $m_score1 = 0; // On pourrait renommer cette variable en $player1Score pour être plus clair.
    private int $m_score2 = 0; // Et ici, utiliser $player2Score serait plus cohérent.

    public function __construct(
        private string $player1Name, // C'est bien d'utiliser les propriétés promues, ça rend le code plus propre.
        private string $player2Name
    ) {
    }

    public function wonPoint(string $playerName): void
    {
        // On simplifie bien ici avec une ternaire : $this->{($playerName === 'player1' ? 'm_score1' : 'm_score2')}++;
        if ($playerName === 'player1') {
            $this->m_score1++;
        } else {
            $this->m_score2++;
        }
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->m_score1 === $this->m_score2) {
            // On utilise bien match ici, mais on pourrait aussi mettre ce bloc dans une méthode à part pour alléger.
            $score = match ($this->m_score1) {
                0 => 'Love-All',
                1 => 'Fifteen-All',
                2 => 'Thirty-All',
                default => 'Deuce',
            };
        } elseif ($this->m_score1 >= 4 || $this->m_score2 >= 4) {
            $minusResult = $this->m_score1 - $this->m_score2;
            // On pourrait factoriser ce bloc dans une méthode privée pour gérer les avantages et les victoires.
            if ($minusResult === 1) {
                $score = 'Advantage player1';
            } elseif ($minusResult === -1) {
                $score = 'Advantage player2';
            } elseif ($minusResult >= 2) {
                $score = 'Win for player1';
            } else {
                $score = 'Win for player2';
            }
        } else {
            // Cette boucle for est un peu compliquée, on pourrait simplifier le processus de construction du score.
            for ($i = 1; $i < 3; $i++) {
                if ($i === 1) {
                    $tempScore = $this->m_score1;
                } else {
                    $score .= '-';
                    $tempScore = $this->m_score2;
                }
                switch ($tempScore) {
                    case 0:
                        $score .= 'Love';
                        break;
                    case 1:
                        $score .= 'Fifteen';
                        break;
                    case 2:
                        $score .= 'Thirty';
                        break;
                    case 3:
                        $score .= 'Forty';
                        break;
                }
            }
        }
        return $score;
    }
}
