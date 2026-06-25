<?php

class UtilisateurService
{
    public function emailValide(string $email): bool
    {
        return filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        ) !== false;
    }
}