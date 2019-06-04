# Staff Create

#### (**Client Only**)

Store staff on client

**URL** : `/api/client/staff/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "email": $email,
    "username": $username,
    "first_name": $firstName,
    "last_name": $lastName,
    "password": 'secret',
    "password_confirmation": 'secret',
}
```

**Content examples**

```json
{
    "success":true,
    "message":"New staff has been created.",
    "staff": {
        "id": 38,
        "client_id": 75,
        "staff_id": 126,
        "deleted_at": null,
        "created_at": "2019-06-05 01:03:46",
        "updated_at": "2019-06-05 01:03:46",
        "user": {
            "id": 126,
            "dispatcher_id": null,
            "code": "dz",
            "global_prefix": null,
            "role": 3,
            "username": "LolaGaylord",
            "email": "sporer.geovanni@gmail.com",
            "api_token": null,
            "first_name": "Lola",
            "last_name": "Gaylord",
            "contact_number": null,
            "business_name": null,
            "business_address": null,
            "is_active": 1,
            "payment_mode": 0,
            "created_at": "2019-06-05 01:03:46",
            "updated_at": "2019-06-05 01:03:46",
            "full_name": "Lola Gaylord",
        }
    },
}
```
