// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

#nullable disable

using System.Collections.Generic;
using Microsoft.CodeAnalysis.CSharp.Syntax;

namespace Microsoft.CodeAnalysis.CSharp.Extensions
{
    internal partial class DirectiveSyntaxExtensions
    {
        private class DirectiveSyntaxEqualityComparer : IEqualityComparer<DirectiveTriviaSyntax>
        {
            public static readonly DirectiveSyntaxEqualityComparer Instance = new();

            private DirectiveSyntaxEqualityComparer()
            {
            }

            public bool Equals(DirectiveTriviaSyntax x, DirectiveTriviaSyntax y)
                => x.SpanStart == y.SpanStart;

            public int GetHashCode(DirectiveTriviaSyntax obj)
                => obj.SpanStart;
        }
    }
}
