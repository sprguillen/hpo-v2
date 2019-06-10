# Staff Update

#### (**Client Only**)

Update client staff first or last name.

**URL** : `/api/client/staff/:id/update`

**Params**
1. **id** = ClientStaff id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "first_name": $first_name,
    "last_name": $last_name,
}
```

**Content examples**

```json
{
    "success":true,
    "message":"Staff has been updated.",
    "staff":{
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
    }
}
```
