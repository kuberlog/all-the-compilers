/* { dg-do compile } */
/* { dg-require-effective-target arm_neon_ok } */
/* { dg-options "-O1 -ftree-vectorize -funsafe-math-optimizations" }  */
/* { dg-add-options arm_neon } */

#define ordered(a, b) (!__builtin_isunordered (a, b))
#define unordered(a, b) (__builtin_isunordered (a, b))

int x[16];
float a[16];
float b[16];

#define COMPARE(NAME) \
  void \
  cmp_##NAME##_reg (void) \
  { \
    for (int i = 0; i < 16; ++i) \
      x[i] = NAME (a[i], b[i]) ? 2 : 0; \
  } \
  \
  void \
  cmp_##NAME##_zero (void) \
  { \
    for (int i = 0; i < 16; ++i) \
      x[i] = NAME (a[i], 0) ? 2 : 0; \
  }

typedef int int_vec __attribute__((vector_size(16)));
typedef float vec __attribute__((vector_size(16)));

COMPARE (ordered)
COMPARE (unordered)

/* { dg-final { scan-assembler-times {\tvcgt.f32\tq[0-9]+, q[0-9]+, q[0-9]+\n} 2 } } */
/* { dg-final { scan-assembler-times {\tvcgt.f32\tq[0-9]+, q[0-9]+, #0\n} 2 } } */

/* { dg-final { scan-assembler-times {\tvcge.f32\tq[0-9]+, q[0-9]+, q[0-9]+\n} 2 } } */
/* { dg-final { scan-assembler-times {\tvcle.f32\tq[0-9]+, q[0-9]+, #0\n} 2 } } */
