// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

using System.Diagnostics.CodeAnalysis;
using System.Threading;
using System.Threading.Tasks;
using Microsoft.CodeAnalysis.FindUsages;
using Microsoft.CodeAnalysis.Options;
using Roslyn.Utilities;

namespace Microsoft.CodeAnalysis.Navigation
{
    internal class DefaultSymbolNavigationService : ISymbolNavigationService
    {
        public bool TryNavigateToSymbol(ISymbol symbol, Project project, OptionSet? options = null, CancellationToken cancellationToken = default)
            => false;

        public Task<bool> TrySymbolNavigationNotifyAsync(ISymbol symbol, Project project, CancellationToken cancellationToken)
            => SpecializedTasks.False;

        public bool WouldNavigateToSymbol(
            DefinitionItem definitionItem, Solution solution, CancellationToken cancellationToken,
            [NotNullWhen(true)] out string? filePath, out int lineNumber, out int charOffset)
        {
            filePath = null;
            lineNumber = 0;
            charOffset = 0;

            return false;
        }
    }
}
