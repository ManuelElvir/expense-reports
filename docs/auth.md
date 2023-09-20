# Documentation de l'URL `/api/login_check`

Cette URL est utilisée pour l'authentification des utilisateurs et la génération d'un token JWT (JSON Web Token) après une connexion réussie.

## Endpoint

- **URL** : `/api/login_check`
- **Méthode HTTP** : POST

## Exemple de demande (Request)

Vous devez envoyer une demande POST avec les informations d'identification de l'utilisateur au format JSON dans le corps de la requête.

```json
{
    "username": "user1@example.com",
    "password": "12345678"
}
```

## Réponse (Response)

Si l'authentification réussit, l'API renverra un token JWT au format JSON dans la réponse.

```json
{
    "token": "votre-jwt-token-ici"
}
```

Le token JWT généré doit ensuite être utilisé pour les demandes ultérieures nécessitant une authentification. en rajoutant dans le header de chaque requête la clé 
`Authorization : Bearer votre-jwt-token-ici`
Codes de statut HTTP

    200 OK : Authentification réussie, le token JWT est renvoyé.
    401 Unauthorized : Échec de l'authentification, des informations d'identification incorrectes.

N'oubliez pas d'inclure le token JWT dans les en-têtes de vos futures demandes pour accéder aux ressources protégées par l'authentification.