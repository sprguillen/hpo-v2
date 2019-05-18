# Services list

#### (**Admin Only**)

Used to collect Services list

**URL** : `/api/admin/services`

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "processors":{
        "current_page":1,
        "data":[
            {
                "id":1,
                "code":"b",
                "name":"orchestrate value-added portals",
                "default_cost":5448,
                "created_at":"2019-05-18 01:38:18",
                "updated_at":"2019-05-18 01:38:18"
            },
            {
                "id":2,
                "code":"c",
                "name":"whiteboard innovative systems",
                "default_cost":2005,
                "created_at":"2019-05-18 01:38:18",
                "updated_at":"2019-05-18 01:38:18"
            },
            {
                "id":3,
                "code":"d",
                "name":"syndicate plug-and-play networks",
                "default_cost":566,
                "created_at":"2019-05-18 01:38:18",
                "updated_at":"2019-05-18 01:38:18"
            },
            {
                "id":4,
                "code":"e",
                "name":"utilize one-to-one convergence",
                "default_cost":8471,
                "created_at":"2019-05-18 01:38:18",
                "updated_at":"2019-05-18 01:38:18"
            }
        ],
        "first_page_url": "http://localhost/api/admin/services?page=1",
        "from": 1,
        "last_page": 4,
        "last_page_url": "http://localhost/api/admin/services?page=4",
        "next_page_url": "http://localhost/api/admin/services?page=2",
        "path": "http://localhost/api/admin/services",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 36
    }
}
```
