# Expense Report API Endpoints

## Introduction

Welcome to the documentation for the expense management API. This API allows you to manage the expense reports of a user with ID #1.

## Endpoints

### Get all expense reports

Retrieves a list of all expense reports for user #1.

- **URL**: `/expense-reports`
- **HTTP Method**: GET
- **Responses**: List of expense reports in JSON format.

#### Sample call

```http
GET /expense-reports
```
#### Sample response
- **Status code**: `200`
```json
[
    {
        "id": number,
        "date": string,
        "montant": string,
        "type": string,
        "societe": string
    }
]
```

### Get an expense report

Retrieves a specific expense report by its identifier.

- **URL**: /expense-reports/{id}
- **HTTP Method**: GET
- **Parameter**: id (expense claim identifier)
- **Response**: Expense claim details in JSON format.

#### Sample call

```http
GET /expense-reports/1
```

#### Sample response
- **Status code**: `200`
```json
{
    "id": number,
    "date": string,
    "montant": string,
    "type": string,
    "societe": string
}
```

### Create a new an expense report

Ajoute une nouvelle note de frais pour l'utilisateur #1.

- **URL**: /expense-reports
- **HTTP Method**: POST
- **Request body**: Expense report data in JSON format (date, amount, type, etc.).
- **Response**: Details of expense report added in JSON format.

#### Sample call

```http
POST /expense-reports
Content-Type: application/json
{
    "date": "2023-09-09",
    "montant": 75.50,
    "type": "essence",
    "societe": "Acme Inc."
}
```

#### Sample response
- **Status code**: `201`
```json
{
    "id": number,
    "date": string,
    "montant": string,
    "type": string,
    "societe": string
}
```

### Edit an expense report

Modify an existing expense report by its identifier.

- **URL**: `/expense-reports`
- **HTTP Method**: PUT
- **Parameter**: id (expense claim identifier)
- **Request body**: Expense report data in JSON format (date, amount, type, etc.).
- **Response**: Default response.

#### Sample call

```http
PUT /api/notes-de-frais/1
Content-Type: application/json
{
    "date": "2023-09-10",
    "montant": 85.25,
    "type": "péage"
}
```
#### Sample response
- **Status code**: `200`
```json
{
    "id": number,
    "date": string,
    "montant": string,
    "type": string,
    "societe": string
}
```

### DELETE an expense report

Delete an existing expense report by its identifier.

- **URL**: `/expense-reports`
- **HTTP Method**: DELETE
- **Parameter**: id (expense claim identifier)
- **Response**: No content.

#### Sample call

```http
DELETE /api/notes-de-frais/1
```
#### Sample response
- **Status code**: `204`

## Remarques

-  Authentication and rights management are not implemented in this version of the API. Routes are only available to user #1.
-  Please do not hesitate to contact the developer if you have any questions or require further assistance.

#### Sample Error response
- **Status code**: `500`
```json
{
    "statusCode": 500,
    "message": "Internal server error",
}
```