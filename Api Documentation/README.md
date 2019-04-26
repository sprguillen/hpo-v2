# RESTAPIDocs

## Open Endpoints

Open endpoints require no Authentication.

* [Login](login.md) : `POST /api/auth/login`

## Endpoints that require Authentication

Closed endpoints require a valid Token to be included in the header of the
request. A Token can be acquired from the Login view above.

### Admin related

Each endpoint manipulates or displays information related to the Admin whose
Token is provided with the request:

* [Client info](admin/client/client.md)
* [Processor info](admin/processor/processor.md)

### Backend Models

* [User table](models/user.md)
