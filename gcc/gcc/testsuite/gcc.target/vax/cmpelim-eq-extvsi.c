/* { dg-do compile } */
/* { dg-options "-fdump-rtl-cmpelim -dp" } */
/* { dg-skip-if "code quality test" { *-*-* } { "-O0" } { "" } } */

typedef signed int __attribute__ ((mode (SI))) int_t;
typedef struct
  {
    int_t h : 7;
    int_t i : 18;
    int_t l : 7;
  }
bit_t;

int_t
eq_extvsi (bit_t x)
{
  int_t v;

  v = x.i;
  if (v == 0)
    return v;
  else
    return v + 2;
}

/* Expect assembly like:

	extv $7,$18,4(%ap),%r0		# 32	[c=68]  *extv_non_const_2_ccz
	jeql .L1			# 34	[c=26]  *branch_ccz
	addl2 $2,%r0			# 31	[c=32]  *addsi3
.L1:

 */

/* { dg-final { scan-rtl-dump-times "deleting insn with uid" 1 "cmpelim" } } */
/* { dg-final { scan-assembler-not "\t(bit|cmpz?|tst). " } } */
/* { dg-final { scan-assembler "extv\[^ \]*_ccz(/\[0-9\]+)?\n" } } */
/* { dg-final { scan-assembler "branch_ccz\n" } } */
