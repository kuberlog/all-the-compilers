! Check offloaded function's attributes and classification for OpenACC
! serial.

! { dg-additional-options "-O2" }
! { dg-additional-options "-fopt-info-optimized-omp" }
! { dg-additional-options "-fdump-tree-ompexp" }
! { dg-additional-options "-fdump-tree-oaccdevlow" }

! { dg-additional-options "-Wopenacc-parallelism" } for testing/documenting
! aspects of that functionality.

program main
  implicit none
  integer, parameter :: n = 1024
  integer, dimension (0:n-1) :: a, b, c
  integer :: i

  call setup(a, b)

  !$acc serial loop copyin (a(0:n-1), b(0:n-1)) copyout (c(0:n-1)) ! { dg-message "optimized: assigned OpenACC gang vector loop parallelism" }
  ! { dg-bogus "\[Ww\]arning: region contains gang partitioned code but is not gang partitioned" "TODO 'serial'" { xfail *-*-* } .-1 }
  ! { dg-bogus "\[Ww\]arning: region contains worker partitioned code but is not worker partitioned" "" { target *-*-* } .-2 }
  ! { dg-bogus "\[Ww\]arning: region contains vector partitioned code but is not vector partitioned" "TODO 'serial'" { xfail *-*-* } .-3 }
  do i = 0, n - 1
     c(i) = a(i) + b(i)
  end do
  !$acc end serial loop
end program main

! Check the offloaded function's attributes.
! { dg-final { scan-tree-dump-times "(?n)__attribute__\\(\\(oacc serial, omp target entrypoint\\)\\)" 1 "ompexp" } }

! Check the offloaded function's classification and compute dimensions (will
! always be 1 x 1 x 1 for non-offloading compilation).
! { dg-final { scan-tree-dump-times "(?n)Function is OpenACC serial offload" 1 "oaccdevlow" } }
! { dg-final { scan-tree-dump-times "(?n)Compute dimensions \\\[1, 1, 1\\\]" 1 "oaccdevlow" } }
! { dg-final { scan-tree-dump-times "(?n)__attribute__\\(\\(oacc function \\(1, 1, 1\\), oacc serial, omp target entrypoint\\)\\)" 1 "oaccdevlow" } }
