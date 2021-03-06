// Licensed to the .NET Foundation under one or more agreements.
// The .NET Foundation licenses this file to you under the MIT license.
// See the LICENSE file in the project root for more information.

using Microsoft.CodeAnalysis.DesignerAttribute;
using Microsoft.CodeAnalysis.SolutionCrawler;

namespace Microsoft.CodeAnalysis.Remote
{
    /// <remarks>Note: this is explicitly <b>not</b> exported.  We don't want the <see
    /// cref="RemoteWorkspace"/> to automatically load this.  Instead, VS waits until it is ready
    /// and then calls into OOP to tell it to start analyzing the solution.  At that point we'll get
    /// created and added to the solution crawler.
    /// </remarks>
    internal sealed class RemoteDesignerAttributeIncrementalAnalyzerProvider : IIncrementalAnalyzerProvider
    {
        private readonly RemoteCallback<IRemoteDesignerAttributeDiscoveryService.ICallback> _callback;
        private readonly RemoteServiceCallbackId _callbackId;

        public RemoteDesignerAttributeIncrementalAnalyzerProvider(RemoteCallback<IRemoteDesignerAttributeDiscoveryService.ICallback> callback, RemoteServiceCallbackId callbackId)
        {
            _callback = callback;
            _callbackId = callbackId;
        }

        public IIncrementalAnalyzer CreateIncrementalAnalyzer(Workspace workspace)
            => new RemoteDesignerAttributeIncrementalAnalyzer(_callback, _callbackId);
    }
}
