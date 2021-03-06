// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

#nullable disable

using System;
using System.Collections.Immutable;
using System.Composition;
using System.Diagnostics;
using System.Linq;
using System.Threading;
using System.Threading.Tasks;
using Microsoft.CodeAnalysis.CodeActions;
using Microsoft.CodeAnalysis.CodeFixes;
using Microsoft.CodeAnalysis.CSharp.Extensions;
using Microsoft.CodeAnalysis.CSharp.Syntax;
using Microsoft.CodeAnalysis.Diagnostics;
using Microsoft.CodeAnalysis.Editing;
using Microsoft.CodeAnalysis.Formatting;
using Microsoft.CodeAnalysis.Host.Mef;
using Microsoft.CodeAnalysis.PooledObjects;
using Microsoft.CodeAnalysis.Shared.Extensions;
using Microsoft.CodeAnalysis.Simplification;
using Microsoft.CodeAnalysis.Text;

namespace Microsoft.CodeAnalysis.CSharp.ConvertSwitchStatementToExpression
{
    using Constants = ConvertSwitchStatementToExpressionConstants;

    [ExportCodeFixProvider(LanguageNames.CSharp, Name = PredefinedCodeFixProviderNames.ConvertSwitchStatementToExpression), Shared]
    internal sealed partial class ConvertSwitchStatementToExpressionCodeFixProvider : SyntaxEditorBasedCodeFixProvider
    {
        [ImportingConstructor]
        [Obsolete(MefConstruction.ImportingConstructorMessage, error: true)]
        public ConvertSwitchStatementToExpressionCodeFixProvider()
        {
        }

        public override ImmutableArray<string> FixableDiagnosticIds
            => ImmutableArray.Create(IDEDiagnosticIds.ConvertSwitchStatementToExpressionDiagnosticId);

        internal sealed override CodeFixCategory CodeFixCategory => CodeFixCategory.CodeStyle;

        public override Task RegisterCodeFixesAsync(CodeFixContext context)
        {
            var switchLocation = context.Diagnostics.First().AdditionalLocations[0];
            var switchStatement = (SwitchStatementSyntax)switchLocation.FindNode(getInnermostNodeForTie: true, context.CancellationToken);
            if (switchStatement.ContainsDirectives)
            {
                // Avoid providing code fixes for switch statements containing directives
                return Task.CompletedTask;
            }

            context.RegisterCodeFix(
                new MyCodeAction(c => FixAsync(context.Document, context.Diagnostics.First(), c)),
                context.Diagnostics);
            return Task.CompletedTask;
        }

        protected override async Task FixAllAsync(
            Document document, ImmutableArray<Diagnostic> diagnostics,
            SyntaxEditor editor, CancellationToken cancellationToken)
        {
            using var spansDisposer = ArrayBuilder<TextSpan>.GetInstance(diagnostics.Length, out var spans);
            foreach (var diagnostic in diagnostics)
            {
                cancellationToken.ThrowIfCancellationRequested();

                var switchLocation = diagnostic.AdditionalLocations[0];
                if (spans.Any((s, nodeSpan) => s.Contains(nodeSpan), switchLocation.SourceSpan))
                {
                    // Skip nested switch expressions in case of a fix-all operation.
                    continue;
                }

                spans.Add(switchLocation.SourceSpan);

                var properties = diagnostic.Properties;
                var nodeToGenerate = (SyntaxKind)int.Parse(properties[Constants.NodeToGenerateKey]);
                var shouldRemoveNextStatement = bool.Parse(properties[Constants.ShouldRemoveNextStatementKey]);

                var declaratorToRemoveLocationOpt = diagnostic.AdditionalLocations.ElementAtOrDefault(1);
                var semanticModel = await document.GetSemanticModelAsync(cancellationToken).ConfigureAwait(false);

                SyntaxNode declaratorToRemoveNodeOpt = null;
                ITypeSymbol declaratorToRemoveTypeOpt = null;

                if (declaratorToRemoveLocationOpt != null)
                {
                    declaratorToRemoveNodeOpt = declaratorToRemoveLocationOpt.FindNode(cancellationToken);
                    declaratorToRemoveTypeOpt = semanticModel.GetDeclaredSymbol(declaratorToRemoveNodeOpt, cancellationToken).GetSymbolType();
                }

                var switchStatement = (SwitchStatementSyntax)switchLocation.FindNode(getInnermostNodeForTie: true, cancellationToken);

                var switchExpression = Rewriter.Rewrite(
                   switchStatement, semanticModel, declaratorToRemoveTypeOpt, nodeToGenerate,
                   shouldMoveNextStatementToSwitchExpression: shouldRemoveNextStatement,
                   generateDeclaration: declaratorToRemoveLocationOpt is object);

                editor.ReplaceNode(switchStatement, switchExpression.WithAdditionalAnnotations(Formatter.Annotation));

                if (declaratorToRemoveLocationOpt is object)
                {
                    editor.RemoveNode(declaratorToRemoveLocationOpt.FindNode(cancellationToken));
                }

                if (shouldRemoveNextStatement)
                {
                    // Already morphed into the top-level switch expression.
                    SyntaxNode nextStatement = switchStatement.GetNextStatement();
                    Debug.Assert(nextStatement.IsKind(SyntaxKind.ThrowStatement, SyntaxKind.ReturnStatement));
                    editor.RemoveNode(nextStatement.IsParentKind(SyntaxKind.GlobalStatement) ? nextStatement.Parent : nextStatement);
                }
            }
        }

        private sealed class MyCodeAction : CustomCodeActions.DocumentChangeAction
        {
            public MyCodeAction(Func<CancellationToken, Task<Document>> createChangedDocument)
                : base(CSharpAnalyzersResources.Convert_switch_statement_to_expression, createChangedDocument)
            {
            }
        }
    }
}
