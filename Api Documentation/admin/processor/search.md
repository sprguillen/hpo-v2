# Search processor

#### (**Admin Only**)

Used to search user processor using name (`first_name`, `last_name`) or `email`.

**URL** : `/api/admin/processor/search/{$key}`

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
                "id":45,
                "code":null,
                "global_prefix":null,
                "role":0,
                "username":"MadalynKeebler",
                "email":"shea90@yahoo.com",
                "api_token":null,
                "first_name":"Madalyn",
                "last_name":"Keebler",
                "contact_number":null,
                "business_name":null,
                "business_address":null,
                "is_active":1,
                "created_at":"2019-04-24 14:16:39",
                "updated_at":"2019-04-24 14:16:39"
            },
            {
                "id":46,
                "code":null,
                "global_prefix":null,
                "role":0,
                "username":"GraysonWisoky",
                "email":"aletha.torp@runte.net",
                "api_token":null,
                "first_name":"Randi",
                "last_name":"Rippin",
                "contact_number":null,
                "business_name":null,
                "business_address":null,
                "is_active":1,
                "created_at":"2019-04-24 14:29:43",
                "updated_at":"2019-04-24 15:38:30"
            }
        ],
        "first_page_url":"http://localhost/api/admin/processor?page=1",
        "from":1,
        "last_page":4,
        "last_page_url":"http://localhost/api/admin/processor?page=4",
        "next_page_url":"http://localhost/api/admin/processor?page=2",
        "path":"http://localhost/api/admin/processor",
        "per_page":10,
        "prev_page_url":null,
        "to":10,
        "total":36
    }
}
```

> Result is in `pagination` format. See [Pagination format](../../helper/pagination.md)
