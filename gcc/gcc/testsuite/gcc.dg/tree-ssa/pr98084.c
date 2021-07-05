/* PR tree-optimization/98084 */
/* { dg-do compile } */
/* { dg-options "-O2" } */

enum {
  JSON_VARIANT_STRING,
  JSON_VARIANT_UNSIGNED,
  JSON_VARIANT_REAL,
  JSON_VARIANT_ARRAY,
  _JSON_VARIANT_TYPE_INVALID,
  _JSON_VARIANT_MAGIC_ZERO_UNSIGNED,
  _JSON_VARIANT_MAGIC_ZERO_REAL,
  _JSON_VARIANT_MAGIC_EMPTY_STRING,
  _JSON_VARIANT_MAGIC_EMPTY_ARRAY
} json_variant_type(int *v) {
  if (!v)
    return _JSON_VARIANT_TYPE_INVALID;
  if (v == (int *)_JSON_VARIANT_MAGIC_ZERO_UNSIGNED)
    return JSON_VARIANT_UNSIGNED;
  if (v == (int *)_JSON_VARIANT_MAGIC_ZERO_REAL)
    return JSON_VARIANT_REAL;
  if (v == (int *)_JSON_VARIANT_MAGIC_EMPTY_STRING)
    return JSON_VARIANT_STRING;
  if (v == (int *)_JSON_VARIANT_MAGIC_EMPTY_ARRAY)
    return JSON_VARIANT_ARRAY;
}