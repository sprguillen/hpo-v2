# Delete patient_type

#### (**Admin Only**)

Delete patient_type

**URL** : `/api/admin/system/patient-type/:id/destroy`

**Params**
1. **id** = patient-type id

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
    "message":"Patient type has been deleted."
}
```
