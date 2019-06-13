# Client Update Dispatcher Mode

#### (**Admin Only**)

Update client dispatcher mode.

**URL** : `/api/admin/client/dispatcher/{code}/update`

**Params**
1. code = User code

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": "$client->id", **Required
    "dispatcher_id": "$dispatcher_id", **Required
}
```

**Content examples**

```json
{
    "success":true,
    "message":":FirstName_LastName client has been updated.",
    "client":{
        "id":33,
        "code":null,
        "global_prefix":null,
        "role":0,
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
