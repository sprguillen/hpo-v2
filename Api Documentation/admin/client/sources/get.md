# Client source list

#### (**Admin Only**)

Used to collect client sources

**URL** : `/api/admin/client/{id}/sources`

**Params**
1. **id** = user/client id

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "sources":[
        {
            "id":12,
            "user_id":95,
            "source_id":7,
            "created_at":"2019-05-28 01:11:52",
            "updated_at":"2019-05-28 01:11:52",
            "source":
            {
                "id":7,
                "code":"dignissimos",
                "name":"Feeney PLC",
                "created_at":"2019-05-22 01:59:38",
                "updated_at":"2019-05-22 01:59:38"
            }
        },
        {
            "id":12,
            "user_id":95,
            "source_id":7,
            "created_at":"2019-05-28 01:11:52",
            "updated_at":"2019-05-28 01:11:52",
            "source":
            {
                "id":7,
                "code":"dignissimos",
                "name":"Feeney PLC",
                "created_at":"2019-05-22 01:59:38",
                "updated_at":"2019-05-22 01:59:38"
            }
        },
    ]
}
```
