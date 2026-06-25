<?php

class AnimeService
{
    public function formatDate(string $date): string
    {
        [$annee, $mois, $jour] = explode('-', $date);

        return "$jour-$mois-$annee";
    }
}