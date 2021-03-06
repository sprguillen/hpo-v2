# RESTAPIDocs

## Api Request Setup
#### Important! [Please Read...](config.md)


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

* System
    * [Source info](admin/system/source/source.md)
    * [Service info](admin/service/service.md)
    * [Dispatcher info](admin/system/dispatcher/dispatcher.md)
    * [Patient Type info](admin/system/patient_type/patient_type.md)
    * [White Listed Ip info](admin/system/white_listed_ip/white_listed_ip.md)

#### Admin Client related

* [Client service info](admin/service/client/client.md)
* [Client source info](admin/client/sources/sources.md)

### Client related

* [Client staff info](client/staff/staff.md)
* [Client patient info](client/patient/index.md)


### User related

* [Get User data](user/index.md)
* [Reset Password](user/password.md)


## Backend Models

* [User table](models/user.md)

## Helper

* [Pagination format](helper/pagination.md)

## Response
All responses, if error occur on the request **(especially on request validation)** it will always return `success:false` sample:

```json
{
    "success":false,
    "message":"The given data was invalid.",
    "errors":{
        "id":[
            "The selected id is invalid."
        ]
    }
}
```
> Sample error on update request if given id is not found or does not exist.

## Deployment
To used the whitelist ip feature make sure to **update the `.env` file** and set the `APP_ENV` to `production` or `live`.
