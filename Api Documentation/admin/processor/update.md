# Processor Update

#### (**Admin Only**)

Store client

**URL** : `/api/admin/processor/:id/update`

**Params**
1. **id** = user/processor id

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
}
```

**Content examples**

```json
{
    "success":true,
    "message":":FirstName_LastName processor has been updated.",
    "processor":{
        "id":33,
        "code":null,
        "global_prefix":null,
        "role":1,
        "username":"SofiaKihn",
        "email":"charlie.padberg@gmail.com",
        "api_token":null,
        "first_name":"Terrell",
        "last_name":"Harber",
        "contact_number":null,
        "business_name":null,
        "business_address":null,
        "is_active":1,
        "created_at":"2019-04-23 15:03:47",
        "updated_at":"2019-04-24 14:54:08"
    }
}
```
