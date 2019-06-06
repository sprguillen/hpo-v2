# Get all sources

#### (**Admin Only**)

Used to collect sources list

**URL** : `/api/admin/system/source`

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "sources":{
        "current_page":1,
        "data":
        [
            {
                "id":2,
                "code":"1",
                "name":"in",
                "created_at":"2019-05-22 00:20:33",
                "updated_at":"2019-05-22 00:34:47"
            },
            {
                "id":3,
                "code":"2",
                "name":"TEST",
                "created_at":"2019-05-22 00:20:33",
                "updated_at":"2019-05-22 00:20:33"
            },
        ],
        "first_page_url": "http://localhost/api/admin/system/source?page=1",
        "from": 1,
        "last_page": 4,
        "last_page_url": "http://localhost/api/admin/system/source?page=4",
        "next_page_url": "http://localhost/api/admin/system/source?page=2",
        "path": "http://localhost/api/admin/system/source",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 36
    }
}
```
> Result is in `pagination` format. See [Pagination format](../../helper/pagination.md)
