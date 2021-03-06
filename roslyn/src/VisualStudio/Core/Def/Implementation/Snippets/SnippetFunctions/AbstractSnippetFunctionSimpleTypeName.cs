// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

#nullable disable

using System.Threading;
using Microsoft.CodeAnalysis;
using Microsoft.CodeAnalysis.Text;
using Microsoft.VisualStudio;
using Microsoft.VisualStudio.Text;
using Microsoft.VisualStudio.Text.Editor;
using Roslyn.Utilities;
using TextSpan = Microsoft.CodeAnalysis.Text.TextSpan;
using VsTextSpan = Microsoft.VisualStudio.TextManager.Interop.TextSpan;

namespace Microsoft.VisualStudio.LanguageServices.Implementation.Snippets.SnippetFunctions
{
    internal abstract class AbstractSnippetFunctionSimpleTypeName : AbstractSnippetFunction
    {
        private readonly string _fieldName;
        private readonly string _fullyQualifiedName;

        public AbstractSnippetFunctionSimpleTypeName(AbstractSnippetExpansionClient snippetExpansionClient, ITextBuffer subjectBuffer, string fieldName, string fullyQualifiedName)
            : base(snippetExpansionClient, subjectBuffer)
        {
            _fieldName = fieldName;
            _fullyQualifiedName = fullyQualifiedName;
        }

        protected abstract bool TryGetSimplifiedTypeName(Document documentWithFullyQualifiedTypeName, TextSpan updatedTextSpan, CancellationToken cancellationToken, out string simplifiedTypeName);

        protected override int GetDefaultValue(CancellationToken cancellationToken, out string value, out int hasDefaultValue)
        {
            value = _fullyQualifiedName;
            hasDefaultValue = 1;
            if (!TryGetDocument(out var document))
            {
                return VSConstants.E_FAIL;
            }

            if (!TryGetDocumentWithFullyQualifiedTypeName(document, out var updatedTextSpan, out var documentWithFullyQualifiedTypeName))
            {
                return VSConstants.E_FAIL;
            }

            if (!TryGetSimplifiedTypeName(documentWithFullyQualifiedTypeName, updatedTextSpan, cancellationToken, out var simplifiedName))
            {
                return VSConstants.E_FAIL;
            }

            value = simplifiedName;
            hasDefaultValue = 1;
            return VSConstants.S_OK;
        }

        private bool TryGetDocumentWithFullyQualifiedTypeName(Document document, out TextSpan updatedTextSpan, out Document documentWithFullyQualifiedTypeName)
        {
            documentWithFullyQualifiedTypeName = null;
            updatedTextSpan = default;

            var surfaceBufferFieldSpan = new VsTextSpan[1];
            if (snippetExpansionClient.ExpansionSession.GetFieldSpan(_fieldName, surfaceBufferFieldSpan) != VSConstants.S_OK)
            {
                return false;
            }

            if (!snippetExpansionClient.TryGetSubjectBufferSpan(surfaceBufferFieldSpan[0], out var subjectBufferFieldSpan))
            {
                return false;
            }

            var originalTextSpan = new TextSpan(subjectBufferFieldSpan.Start, subjectBufferFieldSpan.Length);
            updatedTextSpan = new TextSpan(subjectBufferFieldSpan.Start, _fullyQualifiedName.Length);

            var textChange = new TextChange(originalTextSpan, _fullyQualifiedName);
            var newText = document.GetTextSynchronously(CancellationToken.None).WithChanges(textChange);

            documentWithFullyQualifiedTypeName = document.WithText(newText);
            return true;
        }
    }
}
