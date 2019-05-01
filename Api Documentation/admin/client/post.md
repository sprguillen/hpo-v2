# Client Create

#### (**Admin Only**)

Store client

**URL** : `/api/admin/client/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "email": "sample@email.com",
    "username": "username",
    "first_name": "$firstName",
    "last_name": "lastName",
    "password": "secret",
    "password_confirmation": "secret",
}
```

**Content examples**

```json
{
    "success":true,
    "message":"New client has been created.",
    "client": {
        "email":"murray.nicola@hayes.com",
        "username":"MatildeSenger",
        "first_name":"Matilde",
        "last_name":"Senger",
        "role":0,
        "updated_at":"2019-04-24 14:43:03",
        "created_at":"2019-04-24 14:43:03",
        "id":60
    }
}
```
