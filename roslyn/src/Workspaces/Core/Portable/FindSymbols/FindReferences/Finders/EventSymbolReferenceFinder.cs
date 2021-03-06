// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

using System.Collections.Immutable;
using System.Linq;
using System.Threading;
using System.Threading.Tasks;

namespace Microsoft.CodeAnalysis.FindSymbols.Finders
{
    internal class EventSymbolReferenceFinder : AbstractMethodOrPropertyOrEventSymbolReferenceFinder<IEventSymbol>
    {
        protected override bool CanFind(IEventSymbol symbol)
            => true;

        protected override async Task<ImmutableArray<(ISymbol symbol, FindReferencesCascadeDirection cascadeDirection)>> DetermineCascadedSymbolsAsync(
            IEventSymbol symbol,
            Solution solution,
            IImmutableSet<Project>? projects,
            FindReferencesSearchOptions options,
            FindReferencesCascadeDirection cascadeDirection,
            CancellationToken cancellationToken)
        {
            var baseSymbols = await base.DetermineCascadedSymbolsAsync(
                symbol, solution, projects, options, cascadeDirection, cancellationToken).ConfigureAwait(false);

            var backingFields = symbol.ContainingType.GetMembers()
                                                     .OfType<IFieldSymbol>()
                                                     .Where(f => symbol.Equals(f.AssociatedSymbol))
                                                     .ToImmutableArray();

            var associatedNamedTypes = symbol.ContainingType.GetTypeMembers()
                                                            .WhereAsArray(n => symbol.Equals(n.AssociatedSymbol));

            return baseSymbols.Concat(backingFields.SelectAsArray(f => ((ISymbol)f, cascadeDirection)))
                              .Concat(associatedNamedTypes.SelectAsArray(n => ((ISymbol)n, cascadeDirection)));
        }

        protected override Task<ImmutableArray<Document>> DetermineDocumentsToSearchAsync(
            IEventSymbol symbol,
            Project project,
            IImmutableSet<Document>? documents,
            FindReferencesSearchOptions options,
            CancellationToken cancellationToken)
        {
            return FindDocumentsAsync(project, documents, findInGlobalSuppressions: true, cancellationToken, symbol.Name);
        }

        protected override ValueTask<ImmutableArray<FinderLocation>> FindReferencesInDocumentAsync(
            IEventSymbol symbol,
            Document document,
            SemanticModel semanticModel,
            FindReferencesSearchOptions options,
            CancellationToken cancellationToken)
        {
            return FindReferencesInDocumentUsingSymbolNameAsync(symbol, document, semanticModel, cancellationToken);
        }
    }
}
