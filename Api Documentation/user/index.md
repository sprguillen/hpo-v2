# User Data

Used to collect **logged in user** data.

**URL** : `/api/user/me`

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "success": true,
    "message": "",
    "user": {
        "id": 83,
        "code": null,
        "global_prefix": null,
        "role": 0,
        "username": "NasirHeidenreich",
        "email": "xsimonis@hayes.com",
        "api_token": null,
        "first_name": "Marina",
        "last_name": "Jenkins",
        "contact_number": null,
        "business_name": null,
        "business_address": null,
        "is_active": 1,
        "created_at": "2019-05-03 14:54:50",
        "updated_at": "2019-05-03 14:55:23",
    }
}
```

## Error Response

**Code** : `401 Unauthorized`

**Content** :

```json
{
    "error": "Unauthorized."
}

```
