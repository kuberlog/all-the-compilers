// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

#nullable disable

using System;
using System.Composition;
using System.Threading;
using Microsoft.CodeAnalysis;
using Microsoft.CodeAnalysis.Host;
using Microsoft.CodeAnalysis.Host.Mef;
using Microsoft.CodeAnalysis.Navigation;
using Microsoft.CodeAnalysis.Options;
using Microsoft.CodeAnalysis.Text;

namespace Microsoft.VisualStudio.LanguageServices.LiveShare.UnitTests
{
    using Workspace = CodeAnalysis.Workspace;

    [ExportWorkspaceServiceFactory(typeof(IDocumentNavigationService), ServiceLayer.Test), Shared, PartNotDiscoverable]
    internal class MockDocumentNavigationServiceFactory : IWorkspaceServiceFactory
    {
        [ImportingConstructor]
        [Obsolete(MefConstruction.ImportingConstructorMessage, error: true)]
        public MockDocumentNavigationServiceFactory()
        {
        }

        public IWorkspaceService CreateService(HostWorkspaceServices workspaceServices)
        {
            return new MockDocumentNavigationService();
        }

        private class MockDocumentNavigationService : IDocumentNavigationService
        {
            public bool CanNavigateToLineAndOffset(Workspace workspace, DocumentId documentId, int lineNumber, int offset, CancellationToken cancellationToken) => true;

            public bool CanNavigateToPosition(Workspace workspace, DocumentId documentId, int position, int virtualSpace, CancellationToken cancellationToken) => true;

            public bool CanNavigateToSpan(Workspace workspace, DocumentId documentId, TextSpan textSpan, CancellationToken cancellationToken) => true;

            public bool TryNavigateToLineAndOffset(Workspace workspace, DocumentId documentId, int lineNumber, int offset, OptionSet options, CancellationToken cancellationToken) => true;

            public bool TryNavigateToPosition(Workspace workspace, DocumentId documentId, int position, int virtualSpace, OptionSet options, CancellationToken cancellationToken) => true;

            public bool TryNavigateToSpan(Workspace workspace, DocumentId documentId, TextSpan textSpan, OptionSet options, bool allowInvalidSpans, CancellationToken cancellationToken) => true;
        }
    }
}
