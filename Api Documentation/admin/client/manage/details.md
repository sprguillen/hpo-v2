# Client (individual)

#### (**Admin Only**)

Used to get client details

**URL** : `/api/admin/client/details/{code}`

**Params**
- `code` = User code

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "client":{
        "id": 20,
        "code": "v",
        "global_prefix": "",
        "role": 0,
        "username": "creichert",
        "email": "noble95@gmail.com",
        "api_token": null,
        "first_name": "Carolina",
        "last_name": "Terry",
        "contact_number": "724-808-5780 x690",
        "business_name": "Jenkins, Rippin and Hane",
        "business_address": "75164 Dare Unions Apt. 214 Gusikowskiton, MA 84152",
        "is_active": 1,
        "payment_mode": 0,
        "created_at": "2019-05-11 22:47:18",
        "updated_at": "2019-05-11 23:13:08"
    }
}
```
