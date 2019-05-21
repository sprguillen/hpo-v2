# Delete client from a service

#### (**Admin Only**)

Delete client from the service

**URL** : `/api/admin/services/client/:id/destroy`

**Params**
1. **id** = ClientService id

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
    "message":"Client has been remove on this service."
}
```
