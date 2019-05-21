# Delete dispatcher

#### (**Admin Only**)

Delete dispatcher

**URL** : `/api/admin/system/dispatcher/:id/destroy`

**Params**
1. **id** = dispatcher id

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
}
```

**Content examples**

```json
{
    "success":true,
    "message":"Dispatcher has been deleted."
}
```
