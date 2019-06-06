# Get all white listed ip

#### (**Admin Only**)

Used to white-listed-ip list

**URL** : `/api/admin/system/white-listed-ip`

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "white_listed_ips":
    [
        {
            "id": 6,
            "address": "132.150.93.219",
            "created_at": "2019-05-31 00:23:54",
            "updated_at": "2019-05-31 00:26:19",
        },
    ],
}
```
