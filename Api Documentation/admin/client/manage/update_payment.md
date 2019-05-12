# Client Update payment mode

#### (**Admin Only**)

Update client payment mode

**URL** : `/api/admin/client/payment_mode/{code}/update`

**Params**
- `code` = User code

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "id": "123",
    "payment_mode": "1", 
}
```
> NOTE! Payment mode values must be 1 or 0, `0` = **cash**
`1` = **charge**. See [Users model](../../../models/user.md)

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
